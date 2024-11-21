<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookingHotel;
use App\Models\MeetingBooking;
use App\Models\Meetings;
use Illuminate\Http\Request;

class AdminMeetingController extends Controller
{
    public function AdminIndex()
    {
        return view('admin.meetingss.firstindex');
    }


    public function showByLocation($city)
    {
        // Ambil data booking berdasarkan kota
        $booking = MeetingBooking::whereHas('hotel', function ($query) use ($city) {
            $query->where('nama_cabang', ucfirst($city));
        })->get();

        // Kirim data ke view dan sertakan nama kota
        return view('admin.meetingss.indexx', [
            'booking' => $booking,
            'city' => ucfirst($city)
        ]);
    }


   public function show($id)
   {

    $booking = MeetingBooking::with(['hotel', 'user'])->findOrFail($id);
    return view('admin.meetingss.show', compact('booking'));
   }


   public function edit($id)
   {
    $booking = MeetingBooking::find($id);
    return view('admin.meetingss.edit', compact('booking'));
   }


   public function update(Request $request, $id)
{
    $booking = MeetingBooking::findOrFail($id);

    // Validasi input
    request()->validate([
        'status' => 'required|string',
    ]);

    // Update status
    $booking->status = $request->status;
    $booking->status_pembayaran = $request->status_pembayaran;
    $booking->save();

    // Ambil nama kota terkait hotel yang diupdate
    $city = $booking->hotel->nama_cabang;

    // Redirect ke halaman dengan parameter city
    return redirect()->route('admin.meetingss.indexx', ['location' => $city])
                 ->with('success', 'Data booking berhasil diperbarui!');

}


        public function destroy($id)
        {
            $booking = MeetingBooking::find($id);

            if ($booking) {
                $city = $booking->hotel->nama_cabang; // Ambil nama kota terkait hotel
                $booking->delete();

                // Pastikan untuk memberikan parameter city saat redirect
                return redirect()->route('admin.meetingss.indexx', ['location' => $city]);
            }

            return redirect()->route('admin.meetingss.indexx', ['city' => 'default_city']);
        }




}