<?php

namespace App\Http\Controllers;

use App\Models\Hotels;
use App\Models\Meetings;
use Illuminate\Http\Request;
use App\Models\MeetingBooking;
use App\Models\PembayaranMeeting;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MeetingBookingController extends Controller
{
    public function index()
    {
        $bookings = MeetingBooking::with('user')->get();
        return view('admin.meeting.index', compact('bookings'));
    }

    public function storeMeeting(Request $request, $location, $roomId)
    {
        // Validasi input
        $request->validate([
            // 'user_id' => 'required',
            'hotel_id' => 'required|exists:hotels,id',
            'meeting_id' => 'required|exists:meetings,id',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'pesan' => 'nullable|string'
        ]);

        // Ambil data ruangan berdasarkan ID
        $meetings = Meetings::findOrFail($roomId);

        
        // Ambil data hotel untuk ditampilkan
        $hotels = Hotels::where('nama_cabang', $location)->get();

        // Ambil data user yang sedang login
        $user = Auth::user();

        
        $date = Carbon::createFromFormat('d F, Y', $request['date'])->format('Y-m-d');

        // Cek booking yang sudah ada
        $existingBookings = MeetingBooking::where('meeting_id', $roomId)
            ->where('date', $date)
            ->where(function ($query) use ($request) {
                // Cek jika ada booking yang overlap
                $query->where('start_time', '<', $request->end_time)
                    ->where('end_time', '>', $request->start_time);
            })
            ->whereNotIn('status', ['selesai', 'dibatalkan']) // Hanya hitung status aktif
            ->count();

        // Cek jika jumlah booking yang aktif sudah melebihi jumlah ruang yang tersedia
        if ($existingBookings >= $meetings->jumlah_ruang_tersedia) {
            return back()->with('ruangTersediaError', 'Ruang sudah dipesan penuh untuk waktu yang dipilih.');
        }

        // Hitung durasi dalam jam
        $startTime = Carbon::parse($request->start_time);
        $endTime = Carbon::parse($request->end_time);
        $duration = $endTime->diffInHours($startTime);

        // Hitung jumlah harga
        $jumlahHarga = abs($duration * $meetings->harga_per_jam);

        // Jika tidak ada konflik, lakukan booking
        $booking = MeetingBooking::create([
            'uuid' => Str::uuid(),
            'user_id' => $user->id,
            'hotel_id' => $request->hotel_id,
            'meeting_id' => $roomId,
            'date' => $date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'jumlah_harga' => $jumlahHarga,
            'pesan' => $request->pesan
        ]);

        return redirect()->route('meeting.transaksi.transaksi-meeting', [
            'location' => ucfirst($location),
            // 'hotels' => $hotels,
            'roomId' => $roomId,
            'uuid' => $booking->uuid
        ])->with('success', 'Booking created successfully');
    }

    public function transaksiMeeting($location, $roomId, $uuid)
    {
        $hotels = Hotels::where('nama_cabang', $location)->get();

        $meetings = Meetings::findOrFail($roomId);

        $bookings = MeetingBooking::with('user')->where('uuid', $uuid)->firstOrFail();

        $pembayaran = PembayaranMeeting::where('booking_meeting_id', $bookings->id)->first();

        return view('meeting.transaksi.transaksi-meeting', [
            'location' => ucfirst($location),
            'hotels' => $hotels,
            'roomId' => $roomId,
            'booking' => $bookings,
            'meetings' => $meetings,
            'pembayaran' => $pembayaran
        ]);
    }
    
    public function cancelMeeting($location, $roomId, $uuid)
    {
        try {
            // Ambil data booking berdasarkan UUID
            $booking = MeetingBooking::with('user')->where('uuid', $uuid)->firstOrFail();

            // Periksa apakah status booking sudah dibatalkan
            if ($booking->status === 'dibatalkan') {
                return redirect()->route('detail-hotel', [
                    'location' => ucfirst($location),
                    'roomId' => $roomId
                ])->withErrors(['error' => 'Booking sudah dibatalkan sebelumnya.']);
            }

            // Ambil data ruang meeting terkait
            $meetingRoom = Meetings::findOrFail($booking->meeting_id);

            // Perbarui jumlah kamar yang tersedia
            $meetingRoom->save();

            // Tandai booking sebagai dibatalkan
            $booking->status = 'dibatalkan';
            $booking->save();

            // Redirect dengan pesan sukses
            return redirect()->route('detail', [
                'location' => ucfirst($location),
                'roomId' => $roomId
            ])->with('success', 'Booking telah dibatalkan dan kamar tersedia kembali.');
        } catch (\Exception $e) {
            // Penanganan error jika terjadi masalah
            return redirect()->route('detail', [
                'location' => ucfirst($location),
                'roomId' => $roomId
            ])->withErrors(['error' => 'Terjadi kesalahan saat membatalkan booking: ' . $e->getMessage()]);
        }
    }



    public function pembayaranMeeting(Request $request, $location, $roomId, $uuid)
    {
        // Validasi data dari request
        $validatedData = $request->validate([
            'booking_meeting_id' => 'required|exists:bookings,id',
            'metode_pembayaran' => 'required',
            'bukti_pembayaran' => 'nullable',
        ]);

        // Simpan data pembayaran
        $pembayaran = new PembayaranMeeting();
        $pembayaran->booking_meeting_id = $validatedData['booking_meeting_id'];
        $pembayaran->metode_pembayaran = $validatedData['metode_pembayaran'];
        $pembayaran->bukti_pembayaran = $validatedData['bukti_pembayaran'];
        $pembayaran->save();

        // Mengambil semua hotel berdasarkan lokasi
        $hotels = Hotels::where('nama_cabang', $location)->get();
        
        // Mengambil data tipe kamar berdasarkan nama tipe
        $meetings = Meetings::findOrFail($roomId);

        // Fetch the booking details using the UUID
        $bookings = MeetingBooking::with('user')->where('uuid', $uuid)->firstOrFail();

        // Mengalihkan ke halaman pembayaran hotel dengan parameter yang benar
        return redirect()->route('meeting.transaksi.pembayaran-meeting', [
            'location' => ucfirst($location),
            'roomId' => $roomId,
            'uuid' => $bookings->uuid,
            'booking' => $bookings,
            'meetings' => $meetings,
        ]);
    }

    public function konfirmasiPembayaranMeeting($location, $roomId, $uuid)
    {
        // Mengambil semua hotel berdasarkan lokasi
        $hotels = Hotels::where('nama_cabang', $location)->get();
        
        // Mengambil data tipe kamar berdasarkan nama tipe
        $meetings = Meetings::findOrFail($roomId);

        // Mengambil data booking berdasarkan UUID
        $booking = MeetingBooking::with('user')->where('uuid', $uuid)->firstOrFail();

        $pembayaran = PembayaranMeeting::where('booking_meeting_id', $booking->id)->first();

        // Mengirim data ke view
        return view('meeting.transaksi.pembayaran-meeting', [
            'hotels' => $hotels,
            'roomId' => $roomId,
            'booking' => $booking,
            'pembayaran' => $pembayaran,
            'meetings' => $meetings
        ]);
    }

    public function updatePembayaranMeeting(Request $request, $location, $roomId, $uuid)
    {
        // Validasi data dari request
        $validatedData = $request->validate([
            'booking_meeting_id' => 'required|exists:bookings,id',
            'metode_pembayaran' => 'required',
            'bukti_pembayaran' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Ambil data pembayaran yang terkait dengan booking_hotel_id atau uuid
        $pembayaran = PembayaranMeeting::where('booking_meeting_id', $validatedData['booking_meeting_id'])->firstOrFail();

        // Update metode pembayaran
        $pembayaran->metode_pembayaran = $validatedData['metode_pembayaran'];

        // Jika ada file bukti pembayaran yang baru, simpan dan ganti bukti pembayaran lama
        if ($request->hasFile('bukti_pembayaran')) {
            // Hapus bukti pembayaran lama jika ada
            if ($pembayaran->bukti_pembayaran) {
                Storage::delete('public/' . $pembayaran->bukti_pembayaran);
            }

            // Simpan bukti pembayaran baru
            $path = $request->file('bukti_pembayaran')->store('images/meetings/bukti_pembayaran', 'public');
            $pembayaran->bukti_pembayaran = $path;
        }

        $pembayaran->save();

        // Mengambil semua hotel berdasarkan lokasi
        $hotels = Hotels::where('nama_cabang', $location)->get();
        
        // Mengambil data tipe kamar berdasarkan nama tipe
        $meetings = Meetings::findOrFail($roomId);

        // Mengambil data booking menggunakan UUID
        $booking = MeetingBooking::with('user')->where('uuid', $uuid)->firstOrFail();

        // Mengalihkan ke halaman pembayaran hotel dengan pesan sukses
        return redirect()->route('meeting.transaksi.pembayaran-meeting', [
            'location' => ucfirst($location),
            'roomId' => $roomId,
            'uuid' => $uuid,
        ])->with('success', 'Bukti pembayaran berhasil diperbarui.');
    }

    function lokasiMeeting(Request $request, $location, $roomId, $uuid)
    {
        // Mengambil semua hotel berdasarkan lokasi
        $hotels = Hotels::where('nama_cabang', $location)->get();
        
        // Mengambil data tipe kamar berdasarkan nama tipe
        $meetings = Meetings::findOrFail($roomId);

        // Mengambil data booking berdasarkan UUID
        $booking = MeetingBooking::with('user')->where('uuid', $uuid)->firstOrFail();

        $pembayaran = PembayaranMeeting::where('booking_meeting_id', $booking->id)->first();

        // Log::info('Room Data:', ['room' => $room]);

        // Mengirim data ke view
        return view('meeting.transaksi.lokasi-meeting', [
            'hotels' => $hotels,
            'roomId' => $roomId,
            'booking' => $booking,
            'pembayaran' => $pembayaran,
            'meetings' => $meetings
        ]);
    }
}