<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Hotels;
use App\Models\TipeKamar;
use App\Models\Rating;
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
            $hotel->room_types = TipeKamar::where('hotel_id', $hotel->id)->orderBy('harga_per_malam', 'asc')->get();
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



    // ---------------------------- RATING ---------------------------- //
    public function storeRating(Request $request, $nama_tipe)
    {
        if (!Auth::check()) { // Cek apakah pengguna sudah login
            return redirect()->route('login')->with('error', 'You must be logged in to submit a rating.');
        }

        $room = TipeKamar::with('hotel')->where('nama_tipe', $nama_tipe)->firstOrFail();

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
            'tipe_kamar_id' => 'required|exists:tipe_kamar,id',
        ]);

        Rating::create([
            'user_id' => Auth::id(), // Ambil ID pengguna yang sedang login
            'tipe_kamar_id' => $request->tipe_kamar_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Thank you for your rating!');
    }

    public function showRating($location, $nama_tipe)
    {
        $hotels = Hotels::where('nama_cabang', $location)->get();

        $room = TipeKamar::with('hotel')->where('nama_tipe', $nama_tipe)->firstOrFail();

        foreach ($hotels as $hotel) {
            $hotel->room_types = TipeKamar::where('hotel_id', $hotel->id)->get();
        }

        return view('hotel.rating', [
            'location' => ucfirst($location),
            'hotels' => $hotels,
            'room' => $room
        ])
            ->with('success', 'Thank you for your rating!');
    }

    public function indexAdminReview()
    {
        // // Assuming you have a relationship between hotel and ratings
        // $ratings = Rating::where('hotel_id', $id)->get();

        // // Calculate the number of reviews for each rating value (1 to 5 stars)
        // $ratingCounts = [1, 2, 3, 4, 5];
        // $ratingData = [];

        // foreach ($ratingCounts as $rating) {
        //     $ratingData[$rating] = $ratings->where('rating', $rating)->count();
        // }

        // Pass the data to the view
        // return view('admin.review.index', compact('ratingData'));
        return view('admin.review.index');
    }

    public function showAdminReview($location, $nama_tipe)
{
    // Retrieve all hotels in the specified location
    $hotels = Hotels::where('nama_cabang', $location)->get();

    // Find the room type (TipeKamar) with the given name and load related ratings
    $room = TipeKamar::with(['hotel', 'ratings.user'])->where('nama_tipe', $nama_tipe)->firstOrFail();

    // Add room types to each hotel for display purposes
    foreach ($hotels as $hotel) {
        $hotel->room_types = TipeKamar::where('hotel_id', $hotel->id)->get();
    }

    // Pass data to the view
    return view('hotel.rating', [
        'location' => ucfirst($location),
        'hotels' => $hotels,
        'room' => $room
    ])->with('success', 'Thank you for your rating!');
}


    public function destroyAdminReview($id)
    {
        Rating::where('id', $id)->delete();
        $room = TipeKamar::with('hotel')->where('id', $id)->firstOrFail();

        return redirect()->route('admin.review.index')->with('success', 'Review deleted successfully.');
    }
    // -------------------------------------------------- //



    public function search(Request $request)
    {
        $query = $request->input('query');

        // Lakukan pencarian berdasarkan nama atau lokasi hotel
        $hotels = Hotels::where('nama_cabang', 'LIKE', "%{$query}%")
            ->orWhere('alamat', 'LIKE', "%{$query}%")
            ->get();

        // Kembalikan hasil pencarian ke view
        return view('hotel', compact('hotels', 'query'));
    }
}
