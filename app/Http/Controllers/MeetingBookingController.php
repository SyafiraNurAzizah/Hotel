<?php

namespace App\Http\Controllers;

use App\Models\Hotels;
use App\Models\Meetings;
use Illuminate\Http\Request;
use App\Models\MeetingBooking;

class MeetingBookingController extends Controller
{
    public function index()
    {
        $bookings = MeetingBooking::with('user')->get();
        return view('admin.meeting.index', compact('bookings'));
    }

    public function create($location, $roomId)
    {
        $hotels = Hotels::where('nama_cabang', $location)->get();
        $meetings = Meetings::findOrFail($roomId);


        return view('meeting.transaksi.transaksi-meeting', [
            'location' => ucfirst($location),
            'hotels' => $hotels,
            'room' => $meetings,
        ]);
    }

    public function storeMeeting(Request $request, $location, $roomId)
{
    // Validasi input
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'date' => 'required|date',
        'start_time' => 'required',
        'end_time' => 'required|after:start_time',
    ]);

    // Ambil data ruangan berdasarkan ID
    $meetings = Meetings::findOrFail($roomId);

    // Cek booking yang sudah ada
    $existingBookings = MeetingBooking::where('meeting_id', $roomId)
        ->where('date', $request->date)
        ->where(function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
                // Cek jika ada booking yang overlap
                $query->where('start_time', '<', $request->end_time)
                      ->where('end_time', '>', $request->start_time);
            });
        })->count();

    // Cek jika jumlah kamar yang tersedia terlampaui
    if ($existingBookings >= $meetings->jumlah_ruang_tersedia) {
        return redirect()->back()->withErrors('Kamar sudah dipesan penuh untuk waktu yang dipilih.');
    }

    // Jika tidak ada konflik, lakukan booking
    MeetingBooking::create([
        'hotel_id' => $meetings->hotel_id,
        'meeting_id' => $roomId,
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'date' => $request->date,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
    ]);

    // Ambil data hotel untuk ditampilkan
    $hotels = Hotels::where('nama_cabang', $location)->get();

    return view('meeting.transaksi.transaksi-meeting', [
        'location' => ucfirst($location),
        'hotels' => $hotels,
        'room' => $meetings,
    ])->with('success', 'Booking created successfully');
}

}