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

    public function showFasilitas($location)
    {
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
    // public function showFasilitas($location)
    // {
    //     $hotels = Hotels::where('nama_cabang', $location)->get();

    //     // Ambil fasilitas untuk setiap hotel
    //     foreach ($hotels as $hotel) {
    //         $hotel->fasilitas = Fasilitas::where('hotel_id', $hotel->id)->get();
    //     }

    //     // Cek role user dan tampilkan halaman fasilitas yang sesuai
    //     return Auth::check() && Auth::user()->role == 'admin'
    //         ? view('admin.hotel.fasilitas', [
    //             'location' => ucfirst($location),
    //             'hotels' => $hotels
    //           ])
    //         : view('hotel.fasilitas', [
    //             'location' => ucfirst($location),
    //             'hotels' => $hotels
    //           ]);
    // }

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
        // Ambil semua data TipeKamar beserta relasi ratings
        $room = TipeKamar::with('ratings')->get();

        // Total Reviews
        $totalReviews = $room->flatMap->ratings->count();

        // Average Rating
        $averageRating = $room->flatMap->ratings->avg('rating') ?? 0;

        // filter
        // $year = date('Y');
        // $month = date('m');
        // $day = date('d');

        // $filteredRoom = $room->flatMap->ratings->where('created_at', '>=', $year . '-' . $month . '-' . $day)->get();

        // Hitung jumlah ulasan berdasarkan rating
        $ratingsCount = Rating::selectRaw('rating, COUNT(*) as count')
            ->groupBy('rating')
            ->orderBy('rating', 'asc')
            ->pluck('count', 'rating');

        // Label (rating values) dan data (jumlah ulasan)
        $labels = $ratingsCount->keys()->toArray();
        $data = $ratingsCount->values()->toArray();

        // Kirim data ke view
        return view('admin.review.index', [
            'room' => $room,
            'totalReviews' => $totalReviews,
            'averageRating' => $averageRating,
            'labels' => $labels,
            'data' => $data,
            // 'year' => $year,
            // 'month' => $month,
            // 'filteredRoom' => $filteredRoom
        ]);
    }

    public function destroyAdminReview($id)
    {
        // Cari data rating berdasarkan ID
        $rating = Rating::find($id);

        // Jika rating tidak ditemukan, tampilkan pesan error
        if (!$rating) {
            return redirect()->back()->with('error', 'Review not found.');
        }

        // Hapus data rating
        $rating->delete();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Review deleted successfully!');
    }



    // public function indexAdminReview()
    // {
    //     // Ambil semua data TipeKamar beserta relasi ratings
    //     $room = TipeKamar::with('ratings')->get();

    //     // Hitung jumlah ulasan berdasarkan rating
    //     $ratingsCount = Rating::selectRaw('rating, COUNT(*) as count')
    //         ->groupBy('rating')
    //         ->orderBy('rating', 'asc')
    //         ->pluck('count', 'rating');

    //     // Label (rating values) dan data (jumlah ulasan)
    //     $labels = $ratingsCount->keys()->toArray();
    //     $data = $ratingsCount->values()->toArray();

    //     // Kirim data ke view
    //     return view('admin.review.index', [
    //         'room' => $room,
    //         'labels' => $labels,
    //         'data' => $data
    //     ]);
    // }



    public function showAdminReview($location, $nama_tipe)
    {
        $hotels = Hotels::where('nama_cabang', $location)->get();

        $room = TipeKamar::with('hotel')->where('nama_tipe', $nama_tipe)->firstOrFail();

        foreach ($hotels as $hotel) {
            $hotel->room_types = TipeKamar::where('hotel_id', $hotel->id)->get();
        }

        $ratingData = Rating::where('tipe_kamar_id', $room->id)->get();

        $room->ratings = $ratingData;

        return view('admin.review.index', [
            'location' => ucfirst($location),
            'hotels' => $hotels,
            'room' => $room
        ]);
    }



    // public function destroyAdminReview($id)
    // {
    //     $rating = Rating::find($id);

    //     if (!$rating) {
    //         $rating->delete();
    //         return redirect()->back()->with('error', 'Review not found.');
    //     }
    //     return redirect()->back()->with('success', 'Review deleted successfully!');
    // }
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
