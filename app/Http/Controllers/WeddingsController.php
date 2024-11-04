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
        $wedding = Wedding::find($id);

        if (!$wedding) {
            return redirect()->route('admin.wedding.index')->with('error', 'Data tidak ditemukan.');
        }

        return view('admin.wedding.edit', compact('wedding'));
    }

    public function update(Request $request, $id)
    {
        $wedding = Wedding::find($id);

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
            if ($wedding->gambar && $wedding->gambar !== 'default.jpg') {
                Storage::delete('public/uploads/' . $wedding->gambar);
            }

            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('storage/uploads'), $imageName);
            $wedding->gambar = $imageName;
        }

        // Update other fields
        $wedding->judul = $request->input('judul');
        $wedding->judul_paket1 = $request->input('judul_paket1');
        $wedding->judul_paket2 = $request->input('judul_paket2');
        $wedding->judul_paket3 = $request->input('judul_paket3');
        $wedding->paket1 = $request->input('paket1');
        $wedding->paket2 = $request->input('paket2');
        $wedding->paket3 = $request->input('paket3');
        $wedding->harga = $request->input('harga');
        $wedding->kapasitas = $request->input('kapasitas');

        $wedding->save();

        return redirect()->route('wedding.index')->with('success', 'Data wedding berhasil diupdate.');
    }

    public function destroy($id)
    {
        $wedding = Wedding::find($id);
        if ($wedding) {
            $wedding->delete();
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
