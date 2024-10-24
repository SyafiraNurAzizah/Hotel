<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BookingHotel;
use App\Models\Hotels;
use App\Models\TipeKamar;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function storeHotel(Request $request, $location, $nama_tipe)
    {
        $validatedData = $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'tipe_kamar_id' => 'required|exists:tipe_kamar,id',
            'check_in' => 'required|date_format:"d F, Y"|before:check_out',
            'check_out' => 'required|date_format:"d F, Y"|after:check_in',
            'tamu_dewasa' => 'required|integer|min:1',
            'tamu_anak' => 'nullable|integer|min:0',
            'pesan' => 'nullable|string',
            'status' => 'required|in:selesai,belum_selesai,sudah_diproses,dibatalkan',
            'status_pembayaran' => 'required|in:belum_dibayar,dibayar',
        ]);

        $checkInFormatted = Carbon::createFromFormat('d F, Y', $validatedData['check_in'])->format('Y-m-d');
        $checkOutFormatted = Carbon::createFromFormat('d F, Y', $validatedData['check_out'])->format('Y-m-d');

        $booking = new BookingHotel();
        $booking->user_id = $request->user()->id;
        $booking->hotel_id = $validatedData['hotel_id'];
        $booking->tipe_kamar_id = $validatedData['tipe_kamar_id'];
        $booking->check_in = $checkInFormatted;
        $booking->check_out = $checkOutFormatted;
        $booking->tamu_dewasa = $validatedData['tamu_dewasa'];
        $booking->tamu_anak = $validatedData['tamu_anak'] ?? 0;
        $booking->pesan = $validatedData['pesan'] ?? '';
        $booking->status = $validatedData['status'] ?? 'belum_selesai';
        $booking->status_pembayaran = $validatedData['status_pembayaran'] ?? 'belum_dibayar';

        $booking->save();



        
        $hotels = Hotels::where('nama_cabang', $location)->get();

        $room = TipeKamar::with('hotel')->where('nama_tipe', $nama_tipe)->firstOrFail();

        foreach ($hotels as $hotel) {
            $hotel->room_types = TipeKamar::where('hotel_id', $hotel->id)->get();
        }
        
        if ($booking->save()) {
            return redirect()->route('hotel.pembayaran-hotel', [
                'location' => ucfirst($location),
                'hotels' => $hotels,
                'room' => $room,
                'nama_tipe' => $nama_tipe
            ]);
        } else {
            return back()->withErrors(['error' => 'Gagal menyimpan data booking.']);
        }
        
    }

    public function pembayaranHotel($location, $nama_tipe)
    {
        $hotels = Hotels::where('nama_cabang', $location)->get();
        $room = TipeKamar::with('hotel')->where('nama_tipe', $nama_tipe)->firstOrFail();

        foreach ($hotels as $hotel) {
            $hotel->room_types = TipeKamar::where('hotel_id', $hotel->id)->get();
        }

        return view('hotel.pembayaran-hotel', [
            'location' => ucfirst($location),
            'hotels' => $hotels,
            'room' => $room
        ]);
    }


}
