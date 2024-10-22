<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Hotels;
use App\Models\TipeKamar;
use Illuminate\Http\Request;

class HotelsController extends Controller
{
    public function index()
    {
        $hotels = Hotels::all();
        return view('hotel', compact('hotels'));
    }

    public function showRooms($location)
    {

        $hotels = Hotels::where('nama_cabang', $location)->get();

        // Ambil tipe kamar untuk setiap hotel
        foreach ($hotels as $hotel) {
            $hotel->room_types = TipeKamar::where('hotel_id', $hotel->id)->get();
        }
        
        return view('hotel.rooms', [
            'location' => ucfirst($location),
            'hotels' => $hotels
        ]);
    }

    public function showRoomsDetail($location, $nama_tipe)
    {
        $hotels = Hotels::where('nama_cabang', $location)->get();

        $room = TipeKamar::with('hotel')->where('nama_tipe', $nama_tipe)->firstOrFail();

        foreach ($hotels as $hotel) {
            $hotel->room_types = TipeKamar::where('hotel_id', $hotel->id)->get();
        }
        
        return view('hotel.detail-hotel', [
            'location' => ucfirst($location),
            'hotels' => $hotels,
            'room' => $room
        ]);
    }

    public function showFasilitas($location)
    {
        // Ambil hotel berdasarkan lokasi
        $hotels = Hotels::where('nama_cabang', $location)->get();

        // Ambil fasilitas untuk setiap hotel
        foreach ($hotels as $hotel) {
            $hotel->fasilitas = Fasilitas::where('hotel_id', $hotel->id)->get();
        }
        
        return view('hotel.fasilitas', [
            'location' => ucfirst($location),
            'hotels' => $hotels
        ]);
    }

}
