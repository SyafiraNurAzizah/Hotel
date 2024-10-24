<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wedding;

class WeddingsController extends Controller
{
    public function index()
    {
        $weddings = Wedding::all();
        return view('wedding.index', compact('weddings'));
    }

    public function show($id)
    {
        $weddings = Wedding::findOrFail($id); 
        return view('wedding.show', compact('weddings'));
    }

    public function edit($id)
{
    // Cari wedding berdasarkan id
    $wedding = Wedding::find($id);

    // Periksa apakah wedding ditemukan
    if (!$wedding) {
        return redirect()->route('admin.wedding.index')->with('error', 'Data tidak ditemukan.');
    }

    // Tampilkan view edit dengan data wedding yang ingin diedit
    return view('admin.wedding.edit', compact('wedding'));
}
}
