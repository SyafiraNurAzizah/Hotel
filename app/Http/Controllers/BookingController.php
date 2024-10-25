<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BookingHotel;
use App\Models\Hotels;
use App\Models\TipeKamar;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BookingController extends Controller
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
            $tipeKamar->jumlah_kamar_tersedia -= $validatedData['jumlah_kamar'];
            $tipeKamar->save();

            // Redirect atau tampilkan pesan sukses
            return redirect()->route('hotel.transaksi.pembayaran-hotel', [
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

    public function pembayaranHotel($location, $nama_tipe, $uuid)
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

        return view('hotel.transaksi.pembayaran-hotel', [
            'location' => ucfirst($location),
            'hotels' => $hotels,
            'room' => $room,
            'booking' => $booking // Pass the booking data to the view
        ]);
    }
}









    // public function storeHotel(Request $request, $location, $nama_tipe)
    // {
    //     $validatedData = $request->validate([
    //         'hotel_id' => 'required|exists:hotels,id',
    //         'tipe_kamar_id' => 'required|exists:tipe_kamar,id',
    //         'check_in' => 'required|date_format:"d F, Y"|before:check_out',
    //         'check_out' => 'required|date_format:"d F, Y"|after:check_in',
    //         'tamu_dewasa' => 'required|integer|min:1',
    //         'tamu_anak' => 'nullable|integer|min:0',
    //         'jumlah_kamar' => 'required|integer|min:1',
    //         'pesan' => 'nullable|string',
    //         'status' => 'required|in:selesai,belum_selesai,sudah_diproses,dibatalkan',
    //         'status_pembayaran' => 'required|in:belum_dibayar,dibayar',
    //     ]);

    //     $checkInFormatted = Carbon::createFromFormat('d F, Y', $validatedData['check_in'])->format('Y-m-d');
    //     $checkOutFormatted = Carbon::createFromFormat('d F, Y', $validatedData['check_out'])->format('Y-m-d');

    //     // Ambil data tipe kamar untuk mendapatkan harga per malam
    //     $tipeKamar = TipeKamar::findOrFail($validatedData['tipe_kamar_id']);
    //     $hargaPerKamar = $tipeKamar->harga_per_malam;

    //     // Hitung jumlah malam
    //     $jumlahMalam = Carbon::parse($checkInFormatted)->diffInDays(Carbon::parse($checkOutFormatted));

    //     // Kalkulasi total harga
    //     $jumlahHarga = $hargaPerKamar * $jumlahMalam * $validatedData['jumlah_kamar'];

    //     $booking = new BookingHotel();
    //     $booking->user_id = $request->user()->id;
    //     $booking->uuid = Str::uuid();
    //     $booking->hotel_id = $validatedData['hotel_id'];
    //     $booking->tipe_kamar_id = $validatedData['tipe_kamar_id'];
    //     $booking->check_in = $checkInFormatted;
    //     $booking->check_out = $checkOutFormatted;
    //     $booking->tamu_dewasa = $validatedData['tamu_dewasa'];
    //     $booking->tamu_anak = $validatedData['tamu_anak'] ?? 0;
    //     $booking->jumlah_kamar = $validatedData['jumlah_kamar'];
    //     $booking->jumlah_harga = $jumlahHarga;
    //     $booking->pesan = $validatedData['pesan'] ?? '';
    //     $booking->status = $validatedData['status'] ?? 'belum_selesai';
    //     $booking->status_pembayaran = $validatedData['status_pembayaran'] ?? 'belum_dibayar';

    //     // Simpan data booking
    //     if ($booking->save()) {
    //         $hotels = Hotels::where('nama_cabang', $location)->get();
    //         $room = TipeKamar::with('hotel')->where('nama_tipe', $nama_tipe)->firstOrFail();

    //         foreach ($hotels as $hotel) {
    //             $hotel->room_types = TipeKamar::where('hotel_id', $hotel->id)->get();
    //         }

    //         return redirect()->route('hotel.transaksi.pembayaran-hotel', [
    //             'location' => ucfirst($location),
    //             'hotels' => $hotels,
    //             'room' => $room,
    //             'nama_tipe' => $nama_tipe,
    //             'uuid' => $booking->uuid
    //         ]);
    //     } else {
    //         return back()->withErrors(['error' => 'Gagal menyimpan data booking.']);
    //     }
    // }
