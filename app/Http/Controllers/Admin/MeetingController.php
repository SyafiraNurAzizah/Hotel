<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotels;
use App\Models\MeetingBooking;
use Illuminate\Http\Request;
use App\Models\Meetings;
use App\Models\PembayaranMeeting;
use App\Models\Tamu;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MeetingController extends Controller
{
    public function index(Request $request)
    {
        // $users = User::all();
        $hotels = Hotels::with('bookings')->get(); // Eager load the bookings relationship
        $meetings = Meetings::get();
        // // $pembayaran = PembayaranMeeting::where('booking_meeting_id', $booking->id)->first();
        return view('admin.meeting.index', compact('hotels', 'meetings'));
    }

    public function reservasi()
    {
        // Ambil data pengguna, hotel, dan tipe kamar dari database
        $users = User::all();
        $hotels = Hotels::all();
        // $room = TipeKamar::all();
        $meetings = Meetings::get();

        $tamu = Tamu::all();

        // Kirim data tersebut ke view 'admin.hotel.create'
        return view('admin.meeting.reservasi', compact('users', 'hotels', 'meetings', 'tamu'));
    }

    public function reservasiStore(Request $request)
    {
        // Validasi input
        $request->validate([
            'tamu_id' => 'required',
            'hotel_id' => 'required|exists:hotels,id',
            'meeting_id' => 'required|exists:meetings,id',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'status' => 'required',
            'status_pembayaran' => 'required',
            'jumlah_harga' => 'required|numeric',
            'pesan' => 'nullable|string'
        ]);

        // Ambil data ruangan berdasarkan ID
        $meetings = Meetings::findOrFail($request->meeting_id);


        
        // $date = Carbon::createFromFormat('d F, Y', $request['date'])->format('Y-m-d');

        // Cek booking yang sudah ada
        $existingBookings = MeetingBooking::where('meeting_id', $request->meeting_id)
            ->where('date', $request->date)
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


        // Jika tidak ada konflik, lakukan booking
        $booking = MeetingBooking::create([
            'uuid' => Str::uuid(),
            'tamu_id' => $request->tamu_id,
            'hotel_id' => $request->hotel_id,
            'meeting_id' => $request->meeting_id,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'jumlah_harga' => $request->jumlah_harga,
            'pesan' => $request->pesan
        ]);

        PembayaranMeeting::create([
            'booking_meeting_id' => $booking->id, // Asosiasi dengan ID booking
            'metode_pembayaran' => $request->metode_pembayaran,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('admin.meeting.reservasi', [
            'location' => ucfirst($location ?? ''),
            // 'hotels' => $hotels,
            // 'roomId' => $roomId,
            'uuid' => $booking->uuid
        ])->with('success', 'Booking created successfully');
    }



    public function daftarPengunjungAdmin()
    {
        $tamu = Tamu::all(); // Ambil semua data tamu
        return view('admin.meeting.list-tamu', compact('tamu'));
    }
    
    public function pengunjungAdmin()
    {
        $tamu = Tamu::all(); // Ambil semua data tamu
        return view('admin.meeting.tamu', compact('tamu')); // Pastikan view ini ada
    }

    public function tambahPengunjungAdmin(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'no_identitas' => 'required|string',
            'no_telp' => 'required|string',
        ]);

        // $validatedData['no_identitas'] = strtoupper($validatedData['no_identitas']);
    
        Tamu::create($validatedData);
    
        return redirect()->route('admin.meeting.reservasi')->with('success', 'Data tamu berhasil ditambahkan.');
    }

}