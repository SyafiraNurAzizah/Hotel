<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Hotels;
use App\Models\Meetings;
use Illuminate\Http\Request;

class MeetingsController extends Controller
{
    public function index()
    {
        $hotels = Hotels::get();
        return view('meeting', compact('hotels'));
    }

    public function showRuang($location)
    {

        $hotels = Hotels::where('nama_cabang', $location)->get();

        // Ambil tipe kamar untuk setiap hotel
        foreach ($hotels as $hotel) {
            $hotel->tipe_ruang = Meetings::where('hotel_id', $hotel->id)->get();
        }
        
        return view('meeting.ruang', [
            'location' => ucfirst($location),
            'hotels' => $hotels
        ]);
    }

    public function detail($location, $roomId)
    {
        // Mengambil hotel berdasarkan nama cabang
        $hotels = Hotels::where('nama_cabang', $location)->get();

        // Mengambil detail ruangan berdasarkan ID ruangan
        $meetings = Meetings::findOrFail($roomId); // Pastikan ada model Room untuk mengambil data ruangan
        $gallery = Gallery::where('meeting_id', $roomId)
            ->get();

        return view('meeting.detailruang', [
            'location' => ucfirst($location),
            'hotels' => $hotels,
            'room' => $meetings,
            'gallery' => $gallery
        ]);
    }

//     public function showGallery($location, $roomId)
// {
//     // Retrieve hotel information based on the location
//     $hotels = Hotels::where('nama_cabang', $location)->get();

//     // Find the meeting room using the roomId
//     $meeting = Meetings::with('room')->findOrFail($roomId);

//     // Get the room details
//     $room = $meeting->room; // Ensure there's a relationship for this

//     // Return the view and pass necessary variables
//     return view('meeting.gallery', [
//         'location' => ucfirst($location), // Capitalize the first letter of the location
//         'hotels' => $hotels,              // Pass hotels to the view
//         'roomId' => $roomId,              // Pass roomId to the view
//         'room' => $room                   // Pass the room details to the view
//     ]);
// }

}
