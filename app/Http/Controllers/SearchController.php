<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotels; // Pastikan ini sesuai dengan model Hotel Anda
use App\Models\Meetings;
use App\Models\Wedding;

class SearchController extends Controller
{
    public function search(Request $request)
{
    // Ambil query dari input form pencarian
    $query = $request->input('query');

    // Query database hotels (menggunakan koneksi default)
    if ($query) {
        $hotels = Hotels::where('nama_cabang', 'LIKE', "%{$query}%")
                        ->orWhere('alamat', 'LIKE', "%{$query}%")
                        ->get();
    } else {
        $hotels = Hotels::all();
    }

    // Query database meetings dan weddings (menggunakan koneksi lain)
    $meetings = Meetings::where('hotel_id', 'LIKE', "%{$query}%")->get(); // Sesuaikan field
    $weddings = Wedding::where('judul', 'LIKE', "%{$query}%")->get(); // Sesuaikan field

    // Mengembalikan view dengan hasil pencarian dari kedua database
    return view('search.result', compact('hotels', 'meetings', 'weddings', 'query'));
}

}
