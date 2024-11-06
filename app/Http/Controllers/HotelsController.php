<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Hotels;
use App\Models\TipeKamar;
use Illuminate\Http\Request;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

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
            $hotel->room_types = TipeKamar::where('hotel_id', $hotel->id)->orderBy('harga_per_malam', 'asc')->get();
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



    // -------- Rating -------- //
    public function indexRating()
    {
        $tipeKamar = TipeKamar::with('ratings.user')->get(); // Mengambil semua data
        return view('ratings', compact('tipeKamar'));
    }

    public function storeRating(Request $request)
    {
        $request->validate([
            'tipe_kamar_id' => 'required|integer',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);

        Rating::create([
            'user_id' => Auth::id(),
            'tipe_kamar_id' => $request->tipe_kamar_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'status' => 1,
        ]);

        return redirect()->back()->with('success', 'Rating dan komentar berhasil dikirim.');
    }

    public function showRating($id)
    {
        $tipeKamar = TipeKamar::with('ratings.user')->findOrFail($id);
        return view('hotel', compact('tipeKamar'));
    }

}
