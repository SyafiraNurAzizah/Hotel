<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BookingHotel;
use App\Models\Hotels;
use App\Models\PembayaranHotel;
use App\Models\TipeKamar;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookingHotelController extends Controller
{
    public function storeHotel(Request $request, $location, $nama_tipe)
    {
        // Validasi data yang diterima dari permintaan
        $validatedData = $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'tipe_kamar_id' => 'required|exists:tipe_kamar,id',
            'check_in' => 'required|date_format:"d F, Y"|before:check_out',
            'check_out' => 'required|date_format:"d F, Y"|after:check_in',
            'tamu_dewasa' => 'required|integer|min:1',
            'tamu_anak' => 'nullable|integer|min:0',
            'jumlah_kamar' => 'required|integer|min:1',
            'pesan' => 'nullable|string',
            'status' => 'required|in:selesai,belum_selesai,sudah_diproses,dibatalkan',
            'status_pembayaran' => 'required|in:belum_dibayar,dibayar',
        ]);

        // Format tanggal check-in dan check-out ke format yang sesuai
        $checkIn = Carbon::createFromFormat('d F, Y', $validatedData['check_in'])->format('Y-m-d');
        $checkOut = Carbon::createFromFormat('d F, Y', $validatedData['check_out'])->format('Y-m-d');

        // Ambil data tipe kamar
        $tipeKamar = TipeKamar::findOrFail($validatedData['tipe_kamar_id']);
        $kamarTersedia = $tipeKamar->jumlah_kamar_tersedia;

        // Ambil semua pemesanan yang bertumpuk dengan rentang tanggal
        $pesananBertumpuk = BookingHotel::where('tipe_kamar_id', $tipeKamar->id)
            ->where(function ($query) use ($checkIn, $checkOut) {
                $query->whereBetween('check_in', [$checkIn, Carbon::parse($checkOut)->subDay()->format('Y-m-d')])
                      ->orWhereBetween('check_out', [Carbon::parse($checkIn)->addDay()->format('Y-m-d'), $checkOut])
                      ->orWhere(function ($query) use ($checkIn, $checkOut) {
                          $query->where('check_in', '<=', $checkIn)
                                ->where('check_out', '>=', $checkOut);
                      });
            })
            ->get();

        // Hitung jumlah kamar yang sudah dipesan untuk setiap hari dalam rentang tanggal
        $jumlahKamarDipesanPerHari = [];
        foreach ($pesananBertumpuk as $pesanan) {
            $tanggalMulai = Carbon::parse($pesanan->check_in);
            $tanggalAkhir = Carbon::parse($pesanan->check_out);

            while ($tanggalMulai < $tanggalAkhir) {
                $tanggal = $tanggalMulai->format('Y-m-d');
                if (!isset($jumlahKamarDipesanPerHari[$tanggal])) {
                    $jumlahKamarDipesanPerHari[$tanggal] = 0;
                }
                $jumlahKamarDipesanPerHari[$tanggal] += $pesanan->jumlah_kamar;
                $tanggalMulai->addDay();
            }
        }

        // Periksa apakah kamar tersedia di setiap hari dalam rentang pemesanan baru
        $tanggalMulai = Carbon::parse($checkIn);
        $tanggalAkhir = Carbon::parse($checkOut);

        while ($tanggalMulai < $tanggalAkhir) {
            $tanggal = $tanggalMulai->format('Y-m-d');
            $kamarDipesanPadaTanggalIni = $jumlahKamarDipesanPerHari[$tanggal] ?? 0;

            // Cek jika total pemesanan (yang sudah ada + yang baru) melebihi kamar yang tersedia
            if ($kamarDipesanPadaTanggalIni + $validatedData['jumlah_kamar'] > $kamarTersedia) {
                return back()->withErrors(['booking_error' => 'Kamar tidak tersedia untuk tanggal yang dipilih.']);
            }
            $tanggalMulai->addDay();
        }

        // Hitung harga per kamar dan jumlah malam
        $hargaPerKamar = $tipeKamar->harga_per_malam;
        $jumlahMalam = Carbon::parse($checkIn)->diffInDays(Carbon::parse($checkOut));

        // Kalkulasi total harga
        $jumlahHarga = $hargaPerKamar * $jumlahMalam * $validatedData['jumlah_kamar'];

        // Jika tersedia, buat booking baru
        $booking = new BookingHotel();
        $booking->user_id = $request->user()->id;
        $booking->uuid = Str::uuid();
        $booking->hotel_id = $validatedData['hotel_id'];
        $booking->tipe_kamar_id = $validatedData['tipe_kamar_id'];
        $booking->check_in = $checkIn;
        $booking->check_out = $checkOut;
        $booking->tamu_dewasa = $validatedData['tamu_dewasa'];
        $booking->tamu_anak = $validatedData['tamu_anak'];
        $booking->jumlah_kamar = $validatedData['jumlah_kamar'];
        $booking->jumlah_harga = $jumlahHarga;
        $booking->pesan = $validatedData['pesan'];
        $booking->status = $validatedData['status'];
        $booking->status_pembayaran = $validatedData['status_pembayaran'];

        // Simpan booking ke database
        if ($booking->save()) {
            // Update jumlah kamar yang tersedia
            // $tipeKamar->jumlah_kamar_tersedia -= $validatedData['jumlah_kamar'];
            // $tipeKamar->save();

            // Redirect atau tampilkan pesan sukses
            return redirect()->route('hotel.transaksi.transaksi-hotel', [
                'location' => ucfirst($location),
                'hotels' => Hotels::where('nama_cabang', $location)->get(),
                'room' => TipeKamar::with('hotel')->where('nama_tipe', $nama_tipe)->firstOrFail(),
                'nama_tipe' => $nama_tipe,
                'uuid' => $booking->uuid,
                'jumlah_harga' => $jumlahHarga // Pass the total price to the view
            ]);
        } else {
            return back()->withErrors(['error' => 'Gagal menyimpan data booking.']);
        }
    }

    
    public function transaksiHotel($location, $nama_tipe, $uuid)
    {
        // Mengambil semua hotel berdasarkan lokasi
        $hotels = Hotels::where('nama_cabang', $location)->get();
        // Mengambil data tipe kamar berdasarkan nama tipe
        $room = TipeKamar::with('hotel')->where('nama_tipe', $nama_tipe)->firstOrFail();

        // Menambahkan tipe kamar ke masing-masing hotel
        foreach ($hotels as $hotel) {
            $hotel->room_types = TipeKamar::where('hotel_id', $hotel->id)->get();
        }

        // Fetch the booking details using the UUID
        $booking = BookingHotel::with('user')->where('uuid', $uuid)->firstOrFail();

        $pembayaran = PembayaranHotel::where('booking_hotel_id', $booking->id)->first();


        return view('hotel.transaksi.transaksi-hotel', [
            'location' => ucfirst($location),
            'hotels' => $hotels,
            'room' => $room,
            'booking' => $booking,
            'pembayaran' => $pembayaran,
        ]);
    }



    public function cancelHotel($location, $nama_tipe, $uuid)
    {
        // Retrieve the booking by its UUID
        $booking = BookingHotel::where('uuid', $uuid)->firstOrFail();

        // Check if the booking status is not already canceled
        if ($booking->status !== 'dibatalkan') {
            // Update the room availability
            $tipeKamar = TipeKamar::findOrFail($booking->tipe_kamar_id);
            $tipeKamar->jumlah_kamar_tersedia += $booking->jumlah_kamar;
            $tipeKamar->save();

            // Mark the booking as canceled
            $booking->status = 'dibatalkan';
            $booking->save();

            return redirect()->route('detail-hotel', [
                'location' => ucfirst($location),
                'nama_tipe' => $nama_tipe
            ])->with('success', 'Booking telah dibatalkan dan kamar tersedia kembali.');
        }

        // Handle case where booking is already canceled
        return redirect()->route('detail-hotel', [
            'location' => ucfirst($location),   
            'nama_tipe' => $nama_tipe
        ])->withErrors(['error' => 'Booking sudah dibatalkan sebelumnya.']);
    }


    public function pembayaranHotel(Request $request, $location, $nama_tipe, $uuid)
    {
        // Validasi data dari request
        $validatedData = $request->validate([
            'booking_hotel_id' => 'required|exists:booking_hotel,id',
            'metode_pembayaran' => 'required',
            'bukti_pembayaran' => 'nullable',
        ]);

        // Simpan data pembayaran
        $pembayaran = new PembayaranHotel();
        $pembayaran->booking_hotel_id = $validatedData['booking_hotel_id'];
        $pembayaran->metode_pembayaran = $validatedData['metode_pembayaran'];
        $pembayaran->bukti_pembayaran = $validatedData['bukti_pembayaran'];
        $pembayaran->save();

        // Mengambil semua hotel berdasarkan lokasi
        $hotels = Hotels::where('nama_cabang', $location)->get();
        
        // Mengambil data tipe kamar berdasarkan nama tipe
        $room = TipeKamar::with('hotel')->where('nama_tipe', $nama_tipe)->firstOrFail();

        // Fetch the booking details using the UUID
        $booking = BookingHotel::with('user')->where('uuid', $uuid)->firstOrFail();

        // Mengalihkan ke halaman pembayaran hotel dengan parameter yang benar
        return redirect()->route('hotel.transaksi.pembayaran-hotel', [
            'location' => ucfirst($location),
            'nama_tipe' => $room->nama_tipe, // Menambahkan parameter nama_tipe
            'uuid' => $uuid, // Menambahkan parameter uuid
        ]);
    }


    public function updatePembayaranHotel(Request $request, $location, $nama_tipe, $uuid)
    {
        // Validasi data dari request
        $validatedData = $request->validate([
            'booking_hotel_id' => 'required|exists:booking_hotel,id',
            'metode_pembayaran' => 'required',
            'bukti_pembayaran' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Ambil data pembayaran yang terkait dengan booking_hotel_id atau uuid
        $pembayaran = PembayaranHotel::where('booking_hotel_id', $validatedData['booking_hotel_id'])->firstOrFail();

        // Update metode pembayaran
        $pembayaran->metode_pembayaran = $validatedData['metode_pembayaran'];

        // Jika ada file bukti pembayaran yang baru, simpan dan ganti bukti pembayaran lama
        if ($request->hasFile('bukti_pembayaran')) {
            // Hapus bukti pembayaran lama jika ada
            if ($pembayaran->bukti_pembayaran) {
                Storage::delete('public/' . $pembayaran->bukti_pembayaran);
            }

            // Simpan bukti pembayaran baru
            $path = $request->file('bukti_pembayaran')->store('images/hotels/bukti_pembayaran', 'public');
            $pembayaran->bukti_pembayaran = $path;
        }

        $pembayaran->save();

        // Mengambil semua hotel berdasarkan lokasi
        $hotels = Hotels::where('nama_cabang', $location)->get();
        
        // Mengambil data tipe kamar berdasarkan nama tipe
        $room = TipeKamar::with('hotel')->where('nama_tipe', $nama_tipe)->firstOrFail();

        // Mengambil data booking menggunakan UUID
        $booking = BookingHotel::with('user')->where('uuid', $uuid)->firstOrFail();

        // Mengalihkan ke halaman pembayaran hotel dengan pesan sukses
        return redirect()->route('hotel.transaksi.pembayaran-hotel', [
            'location' => ucfirst($location),
            'nama_tipe' => $room->nama_tipe,
            'uuid' => $uuid,
        ])->with('success', 'Bukti pembayaran berhasil diperbarui.');
    }


    
    public function konfirmasiPembayaranHotel($location, $nama_tipe, $uuid)
    {
        // Mengambil semua hotel berdasarkan lokasi
        $hotels = Hotels::where('nama_cabang', $location)->get();
        
        // Mengambil data tipe kamar berdasarkan nama tipe
        $room = TipeKamar::with('hotel')->where('nama_tipe', $nama_tipe)->firstOrFail();

        // Mengambil data booking berdasarkan UUID
        $booking = BookingHotel::with('user')->where('uuid', $uuid)->firstOrFail();

        $pembayaran = PembayaranHotel::where('booking_hotel_id', $booking->id)->first();

        // Mengirim data ke view
        return view('hotel.transaksi.pembayaran-hotel', [
            'hotels' => $hotels,
            'room' => $room,
            'booking' => $booking,
            'pembayaran' => $pembayaran
        ]);
    }

    public function create()
    {
        // Ambil data pengguna, hotel, dan tipe kamar dari database
        $users = User::all();
        $hotels = Hotels::all();
        $roomstype = TipeKamar::all();

        // Kirim data tersebut ke view 'admin.hotel.create'
        return view('admin.hotel.create', compact('users', 'hotels', 'roomstype'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'hotel_id' => 'required|exists:hotels,id',
            'tipe_kamar_id' => 'required|exists:tipe_kamar,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'tamu_dewasa' => 'required|integer|min:1',
            'tamu_anak' => 'nullable|integer|min:0',
            'jumlah_kamar' => 'required|integer|min:1',
            'status' => 'required|in:belum_selesai,selesai,dibatalkan',
            'status_pembayaran' => 'required|in:belum_dibayar,dibayar',
            'pesan' => 'nullable|string'
        ]);
    
        // Ambil data tipe kamar yang dipilih untuk mendapatkan harga
        $roomType = TipeKamar::find($validatedData['tipe_kamar_id']);
        
        if (!$roomType) {
            return back()->with('error', 'Tipe kamar tidak ditemukan.');
        }
    
        // Hitung jumlah harga berdasarkan tipe kamar dan jumlah kamar yang dipesan
        $jumlah_harga = $roomType->harga * $validatedData['jumlah_kamar'];
    
        // Buat objek booking baru
        $booking = new BookingHotel();
        $booking->user_id = $request->user()->id;
        $booking->uuid = Str::uuid();
        $booking->hotel_id = $validatedData['hotel_id'];
        $booking->tipe_kamar_id = $validatedData['tipe_kamar_id'];
        $booking->check_in = $validatedData['check_in'];
        $booking->check_out = $validatedData['check_out'];
        $booking->tamu_dewasa = $validatedData['tamu_dewasa'];
        $booking->tamu_anak = $validatedData['tamu_anak'];
        $booking->jumlah_kamar = $validatedData['jumlah_kamar'];
        $booking->jumlah_harga = $jumlah_harga;  // Harga otomatis dihitung
        $booking->pesan = $validatedData['pesan'];
        $booking->status = $validatedData['status'];
        $booking->status_pembayaran = $validatedData['status_pembayaran'];
    
        // Simpan booking ke database
        $booking->save();
    
        return redirect()->route('admin.hotel.index')->with('success', 'Reservasi berhasil dibuat.');
    }
    
}