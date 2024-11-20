<?php

namespace App\Http\Controllers;

use App\Models\Hotels;
use App\Models\Meetings;
use Illuminate\Http\Request;
use App\Models\MeetingBooking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MeetingBookingController extends Controller
{
    public function index()
    {
        $bookings = MeetingBooking::with('user')->get();
        return view('admin.meeting.index', compact('bookings'));
    }

    public function transaksiMeeting($location, $roomId, $uuid)
    {
        $hotels = Hotels::where('nama_cabang', $location)->get();

        $meetings = Meetings::findOrFail($roomId);

        $bookings = MeetingBooking::with('user')->where('uuid', $uuid)->firstOrFail();


        return view('meeting.transaksi.transaksi-meeting', [
            'location' => ucfirst($location),
            'hotels' => $hotels,
            'room' => $roomId,
            'booking' => $bookings,
            'meetings' => $meetings
        ]);
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
        ]);

        // Ambil data ruangan berdasarkan ID
        $meetings = Meetings::findOrFail($roomId);

        
        // Ambil data hotel untuk ditampilkan
        $hotels = Hotels::where('nama_cabang', $location)->get();

        // Ambil data user yang sedang login
        $user = Auth::user();

        // Cek booking yang sudah ada
        $existingBookings = MeetingBooking::where('meeting_id', $roomId)
            ->where('date', $request->date)
            ->where(function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    // Cek jika ada booking yang overlap
                    $query->where('start_time', '<', $request->end_time)
                        ->where('end_time', '>', $request->start_time);
                });
            })
            ->whereNotIn('status', ['selesai', 'dibatalkan'])
            ->count();
            

        // Cek jika jumlah kamar yang tersedia terlampaui
        if ($existingBookings >= $meetings->jumlah_ruang_tersedia) {
            return redirect()->back()->withErrors('Ruang sudah dipesan penuh untuk waktu yang dipilih.');
        }

        // Jika tidak ada konflik, lakukan booking
        $booking = MeetingBooking::create([
            'uuid' => Str::uuid(),
            'user_id' => $user->id,
            'hotel_id' => $request->hotel_id,
            'meeting_id' => $roomId,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('meeting.transaksi.transaksi-meeting', [
            'location' => ucfirst($location),
            // 'hotels' => $hotels,
            'roomId' => $roomId,
            'uuid' => $booking->uuid
        ])->with('success', 'Booking created successfully');
    }



}