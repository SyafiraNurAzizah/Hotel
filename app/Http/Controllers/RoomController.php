<?php

namespace App\Http\Controllers;

use App\Models\TipeKamar;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function show($id)
{
    // Ambil data tipe kamar berdasarkan id
    $room = TipeKamar::with('hotel')->findOrFail($id);

    return view('rooms.show', compact('room'));
}
}
