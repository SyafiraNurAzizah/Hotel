<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookingHotel;
use App\Models\Hotels;
use App\Models\TipeKamar;
use App\Models\User;
use App\Models\Users;

class AdminHotelController extends Controller
{
    public function AdminIndex()
    {
        $bookinghotel = BookingHotel::with(['hotel', 'user'])->get();

        // Kirim data ke view
        return view('admin.hotel.firstindex', compact('bookinghotel'));
    }

    public function AdminShow($id)
{
    // Mengambil data booking berdasarkan ID
    $bookinghotels = BookingHotel::with(['hotel', 'user'])->findOrFail($id);

    return view('admin.hotel.show', compact('bookinghotels'));
}

public function AdminDestroy($id)
{
    // Mengambil booking berdasarkan ID dan menghapusnya
    $bookinghotels = BookingHotel::findOrFail($id);
    $bookinghotels->delete();

    return redirect()->route('admin.hotel.index', compact('bookinghotels'))->with('success', 'Pemesan hotel berhasil dihapus.');
}
public function edit($id)
{
    // Ambil data pemesanan hotel berdasarkan ID
    $bookinghotels = BookingHotel::with(['hotel', 'user'])->findOrFail($id);

    return view('admin.hotel.edit', compact('bookinghotels'));
}
public function update(Request $request, $id)
{
    $bookinghotels = BookingHotel::findOrFail($id);

    
    // Validasi data yang diterima
    $request->validate([
        'status' => 'required|string',
        'status_pembayaran' => 'required|string',
        'jumlah_harga' => 'required|numeric',
    ]);

    // Update data pemesanan
    $bookinghotels->status = $request->status;
    $bookinghotels->status_pembayaran = $request->status_pembayaran;
    $bookinghotels->jumlah_harga = $request->jumlah_harga;
    $bookinghotels->save();

    return redirect()->route('admin.hotel.index')->with('success', 'Pemesan hotel berhasil diupdate.');
}

public function ShowReservation(Request $request)
{
    $query = $request->get('query');
    if ($query) {
        $hotels = Hotels::where('nama_cabang', 'like', '%' . $query . '%')->get();
    } else {
        $hotels = Hotels::all();
    }
    return view('admin.hotel.index', compact('hotels', 'query'));
}


}