<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Hotels;
use App\Models\Meetings;
use Illuminate\Http\Request;
use PHPUnit\Framework\Attributes\Medium;

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
        $meetings = Meetings::findOrFail($roomId);
        
        $gallery = Gallery::where('meeting_id', $roomId)->get();

        // $meetings = Meetings::findOrFail($roomId); 

        $gallery = Gallery::where('meeting_id', $roomId)
            ->get();

        return view('meeting.detailruang', [
            'location' => ucfirst($location),
            'hotels' => $hotels,
            'room' => $meetings,
            'gallery' => $gallery
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Pencarian berdasarkan nama cabang hotel atau kriteria lain
        $hotels = Hotels::where('nama_cabang', 'LIKE', "%{$query}%")->get();


        // Kembali ke view dengan hasil pencarian
        return view('meeting', compact('hotels'));
    }

    public function adminIndex()
    {
        // Ambil data yang ingin ditampilkan, misalnya daftar hotel
        $meetings = Meetings::all();
    
        // Kembalikan view ke `admin.hotel.index` dengan data yang dibutuhkan
        return view('admin.meetings.index', compact('meetings'));
    }
    

}
