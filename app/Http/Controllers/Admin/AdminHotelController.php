<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookingHotel;
use App\Models\Hotels;
use App\Models\Users;

class AdminHotelController extends Controller
{
    public function AdminIndex()
{
    $bookinghotels = BookingHotel::with(['user', 'hotel'])->get();
    return view('admin.hotel.index', compact('bookinghotels'));
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

    return redirect()->route('admin.hotel.index');
}
public function edit($id)
{
    // Ambil data pemesanan hotel berdasarkan ID
    $bookinghotel = BookingHotel::with(['hotel', 'user'])->findOrFail($id);

    return view('admin.hotel.edit', compact('bookinghotel'));
}
public function update(Request $request, $id)
{
    $bookinghotel = BookingHotel::findOrFail($id);
    
    // Validasi data yang diterima
    $request->validate([
        'status' => 'required|string',
        'status_pembayaran' => 'required|string',
        'jumlah_harga' => 'required|numeric',
    ]);

    // Update data pemesanan
    $bookinghotel->status = $request->status;
    $bookinghotel->status_pembayaran = $request->status_pembayaran;
    $bookinghotel->jumlah_harga = $request->jumlah_harga;
    $bookinghotel->save();

    return redirect()->route('admin.hotel.index')->with('success', 'Pemesan hotel berhasil diupdate.');
}

}
