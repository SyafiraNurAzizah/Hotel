<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookingHotel;
use App\Models\Hotels;
use App\Models\TipeKamar;
use App\Models\Users;

class AdminHotelController extends Controller
{
    public function AdminIndex() {
        $bookinghotels = BookingHotel::all(); // Mengambil semua data dari tabel booking hotels
        return view('nama_view', compact('bookinghotels'));
    }

    public function Adminshow($id)
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

}