<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wedding;

class WeddingsController extends Controller
{
    public function index()
    {
        $weddings = Wedding::all();
        return view('admin.wedding.index', compact('weddings'));
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

    public function update(Request $request, $id)
    {
        $wedding = Wedding::find($id);

        // Validasi form jika diperlukan
        $request->validate([
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file gambar
        ]);

        // Cek apakah ada file gambar yang diupload
        if ($request->hasFile('gambar')) {
            // Simpan gambar di folder public dan dapatkan path-nya
            $gambarPath = $request->file('gambar')->store('uploads', 'public');

            // Update path gambar di database
            $wedding->gambar = '/storage/' . $gambarPath;
        }

        // Update data lainnya
        $wedding->judul = $request->input('judul');
        $wedding->judul_paket1 = $request->input('judul_paket1');
        $wedding->judul_paket2 = $request->input('judul_paket2');
        $wedding->judul_paket3 = $request->input('judul_paket3');
        $wedding->harga = $request->input('harga');
        $wedding->kapasitas = $request->input('kapasitas');

        $wedding->save();

        return redirect()->route('admin.wedding.index')->with('success', 'Data wedding berhasil diupdate.');
    }

    public function destroy($id)
    {
        $weddings = wedding::find($id);
        $weddings->delete();
        return redirect()->route('admin.wedding.index')->with('success', 'Data weddings berhasil dihapus.');
    }

    public function create()
    {
        $weddings = wedding::all();
        return view('admin.wedding.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'judul_paket1' => 'required',
            'judul_paket2' => 'required',
            'judul_paket3' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'harga' => 'required',
            'kapasitas' => 'required',
            'paket1' => 'required',
            'paket2' => 'required',
            'paket3' => 'required',
        ]);

        $imageName = time() . '.' . $request->gambar->extension();
        $request->gambar->move(public_path('storage/uploads'), $imageName);


        $weddings = Wedding::create([
            'judul' => $request->input('judul'),
            'judul_paket1' => $request->input('judul_paket1'),
            'judul_paket2' => $request->input('judul_paket2'),
            'judul_paket3' => $request->input('judul_paket3'),
            'gambar' => $imageName,
            'harga' => $request->input('harga'),
            'kapasitas' => $request->input('kapasitas'),
            'paket1' => $request->input('paket1'),
            'paket2' => $request->input('paket2'),
            'paket3' => $request->input('paket3'),
        ]);

        return redirect()->route('admin.wedding.index')->with('success', 'Data weddings berhasil ditambahkan.');
    }

    public function show($id)
    {
        $weddings = wedding::find($id);

        if (!$weddings) {
            return redirect()->route('admin.wedding.index')->with('error', 'Data tidak ditemukan');
        }

        return view('admin.wedding.show', compact('weddings'));
    }
}
