<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Hotels;
use App\Models\TipeKamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HotelsController extends Controller
{
    // Method untuk menampilkan daftar hotel
    public function index()
    {
        // Ambil semua hotel
        $hotels = Hotels::all();
        
        // Tampilkan halaman yang sesuai berdasarkan role user
        return Auth::check() && Auth::user()->role == 'admin'
            ? redirect()->route('admin.hotel.index') // Jika admin, redirect ke halaman admin
            : view('hotel', compact('hotels')); // Jika user biasa, tampilkan halaman hotel
            
    }

    // Method untuk menampilkan kamar berdasarkan lokasi
    public function showRooms($location)
    {
        $hotels = Hotels::where('nama_cabang', $location)->get();

        // Ambil tipe kamar untuk setiap hotel
        foreach ($hotels as $hotel) {
            $hotel->room_types = TipeKamar::where('hotel_id', $hotel->id)->get();
        }

        // Cek role user dan tampilkan halaman yang sesuai
        return Auth::check() && Auth::user()->role == 'admin'
            ? view('admin.hotel.rooms', [
                'location' => ucfirst($location),
                'hotels' => $hotels
              ])
            : view('hotel.rooms', [
                'location' => ucfirst($location),
                'hotels' => $hotels
              ]);
    }

    // Method untuk menampilkan fasilitas berdasarkan lokasi
    public function showFasilitas($location)
    {
        $hotels = Hotels::where('nama_cabang', $location)->get();

        // Ambil fasilitas untuk setiap hotel
        foreach ($hotels as $hotel) {
            $hotel->fasilitas = Fasilitas::where('hotel_id', $hotel->id)->get();
        }

        // Cek role user dan tampilkan halaman fasilitas yang sesuai
        return Auth::check() && Auth::user()->role == 'admin'
            ? view('admin.hotel.fasilitas', [
                'location' => ucfirst($location),
                'hotels' => $hotels
              ])
            : view('hotel.fasilitas', [
                'location' => ucfirst($location),
                'hotels' => $hotels
              ]);
    }

    // Method untuk halaman admin, menampilkan daftar hotel
    public function adminIndex()
    {
        $hotels = Hotels::all();
        return view('admin.hotel.index', compact('hotels'));
    }

    // Method untuk admin menampilkan kamar berdasarkan lokasi
    public function adminShowRooms($location)
    {
        $hotels = Hotels::where('nama_cabang', $location)->get();

        // Ambil tipe kamar untuk setiap hotel
        foreach ($hotels as $hotel) {
            $hotel->room_types = TipeKamar::where('hotel_id', $hotel->id)->get();
        }

        return view('admin.hotel.rooms', [
            'location' => ucfirst($location),
            'hotels' => $hotels
        ]);
    }
}
