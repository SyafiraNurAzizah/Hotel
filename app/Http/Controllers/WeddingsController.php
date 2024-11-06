<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wedding;
use Illuminate\Support\Facades\Storage;

class WeddingsController extends Controller
{
    public function index()
    {
        $weddings = Wedding::all();
        return view('wedding.index', compact('weddings'));
    }

    public function edit($id)
    {
        $weddings = Wedding::find($id);

        if (!$weddings) {
            return redirect()->route('admin.wedding.index')->with('error', 'Data tidak ditemukan.');
        }

        return view('admin.wedding.edit', compact('weddings'));
    }

    public function update(Request $request, $id)
    {
        $weddings = Wedding::find($id);

        $request->validate([
            'judul' => 'required',
            'judul_paket1' => 'required',
            'judul_paket2' => 'required',
            'judul_paket3' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'paket1' => 'required',
            'paket2' => 'required',
            'paket3' => 'required',
            'harga' => 'required',
            'kapasitas' => 'required',
        ]);

        if ($request->hasFile('gambar')) {
            if ($weddings->gambar && $weddings->gambar !== 'default.jpg') {
                Storage::delete('public/uploads/' . $weddings->gambar);
            }

            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('storage/uploads'), $imageName);
            $weddings->gambar = $imageName;
        }

        // Update other fields
        $weddings->judul = $request->input('judul');
        $weddings->judul_paket1 = $request->input('judul_paket1');
        $weddings->judul_paket2 = $request->input('judul_paket2');
        $weddings->judul_paket3 = $request->input('judul_paket3');
        $weddings->paket1 = $request->input('paket1');
        $weddings->paket2 = $request->input('paket2');
        $weddings->paket3 = $request->input('paket3');
        $weddings->harga = $request->input('harga');
        $weddings->kapasitas = $request->input('kapasitas');

        $weddings->save();

        return redirect()->route('wedding.index')->with('success', 'Data wedding berhasil diupdate.');
    }

    public function destroy($id)
    {
        $weddings = Wedding::find($id);
        if ($weddings) {
            $weddings->delete();
            return redirect()->route('wedding.index')->with('success', 'Data weddings berhasil dihapus.');
        }
        return redirect()->route('wedding.index')->with('error', 'Data tidak ditemukan.');
    }

    public function create()
    {
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

        Wedding::create([
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

        return redirect()->route('wedding.index')->with('success', 'Data weddings berhasil ditambahkan.');
    }

    public function show($id)
    {
        $weddings = Wedding::find($id);

        if (!$weddings) {
            return redirect()->route('wedding.index')->with('error', 'Data tidak ditemukan');
        }

        return view('admin.wedding.show', compact('weddings'));
    }
}
