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
        $bookinghotel = BookingHotel::all();

        // Kirim data ke view
        return view('admin.hotel.firstindex', compact('bookinghotel'));
    }
    public function showByCity($city)
    {
        // Ambil data booking berdasarkan kota
        $bookinghotel = BookingHotel::whereHas('hotel', function ($query) use ($city) {
            $query->where('nama_cabang', ucfirst($city));
        })->get();

        // Kirim data ke view dan sertakan nama kota
        return view('admin.hotel.index', [
            'bookinghotel' => $bookinghotel,
            'city' => ucfirst($city)
        ]);
    }

    public function AdminShow($id)
    {
        // Mengambil data booking berdasarkan ID
        $booking = BookingHotel::with(['hotel', 'user'])->findOrFail($id);

        return view('admin.hotel.show', compact('booking'));
    }


    public function AdminDestroy($id)
    {
        $booking = BookingHotel::find($id);

        if ($booking) {
            $city = $booking->hotel->nama_cabang; // Ambil nama kota terkait hotel
            $booking->delete();

            // Pastikan untuk memberikan parameter city saat redirect
            return redirect()->route('admin.hotel.index', ['city' => $city]);
        }

        return redirect()->route('admin.hotel.inde x', ['city' => 'default_city']);
    }


    public function edit($id)
    {
        // Ambil data pemesanan hotel berdasarkan ID
        $bookinghotel = BookingHotel::with(['hotel', 'user'])->findOrFail($id);

        return view('admin.hotel.edit', compact('bookinghotel'));
    }
    public function update(Request $request, $id)
    {
        // Find the booking hotel by ID
        $bookinghotels = BookingHotel::findOrFail($id);

        $city = $bookinghotels->hotel->city; // Adjust this according to your actual relationship

        // Validate the data
        $request->validate([
            'status' => 'required|string',
            'status_pembayaran' => 'required|string',
            'jumlah_harga' => 'required|numeric',
        ]);

        // Update booking hotel data
        $bookinghotels->status = $request->status;
        $bookinghotels->status_pembayaran = $request->status_pembayaran;
        $bookinghotels->jumlah_harga = $request->jumlah_harga;
        $bookinghotels->save();

        // Redirect with the 'city' parameter
        $city = $bookinghotels->hotel->nama_cabang;

        return redirect()->route('admin.hotel.index', ['city' => $city])->with('success', 'Data booking berhasil diperbarui!');
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