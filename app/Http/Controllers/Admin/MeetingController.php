<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotels;
use App\Models\Meetings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MeetingController extends Controller
{
    public function index()
    {
        $meetings = Meetings::all();
        $hotels = Hotels::all();
        return view('admin.meeting.index', compact('meetings', 'hotels'));
    }

    public function create()
    {
        $hotels = Hotels::all();
        return view('admin.meeting.create', compact('hotels'));
    }

    public function store(Request $request)
    {
        // return $request;
        $validated = $request->validate([
            'hotel_id' => 'required|exists:hotels,id', // Ensure hotel exists
            'nama_ruang' => 'required|string|max:255',
            'harga_per_jam' => 'required|numeric',
            'jumlah_ruang_tersedia' => 'required|integer',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|string|in:aktif,nonaktif',
            'kapasitas' => 'required|integer',
            'ukuran_ruangan' => 'required',
            'fasilitas' => 'required',
        ]);

        $photoPath = $request->file('foto')->store('meetings', 'public');

        $meeting = Meetings::create([
            'hotel_id' => $request->hotel_id,
            'nama_ruang' => $validated['nama_ruang'],
            'harga_per_jam' => $validated['harga_per_jam'],
            'jumlah_ruang_tersedia' => $validated['jumlah_ruang_tersedia'],
            'foto' => asset('storage/'.$photoPath),
            'status' => $validated['status'],
            'kapasitas' => $validated['kapasitas'],
            'ukuran_ruang' => $validated['ukuran_ruangan'],
            'fasilitas' => $validated['fasilitas'],
        ]);

        return redirect()->route('admin.meeting.index');
    }

    public function edit($id)
    {
        $meeting = Meetings::findOrFail($id);
        $hotels = Hotels::all();

        return view('admin.meeting.edit', compact('meeting', 'hotels'));
    }

    public function update(Request $request, $id)
    {
        try {
            $meeting = Meetings::findOrFail($id);
            $photoPath = $request->file('foto')->store('meetings', 'public');
            $meeting->update([
                'hotel_id' => $request->hotel_id,
                'nama_ruang' => $request->nama_ruang,
                'harga_per_jam' => $request->harga_per_jam,
                'jumlah_ruang_tersedia' => $request->jumlah_ruang_tersedia,
                'foto' => asset('storage/' . $photoPath),
                'status' => $request->status,
                'kapasitas' => $request->kapasitas,
                'ukuran_ruangan' => $request->ukuran_ruang,
                'fasilitas' => $request->fasilitas,
            ]);
    
            return redirect()->route('admin.meeting.index')->with('success', 'Meeting room updated successfully.');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    
    

    public function destroy($id)
    {
        $meeting = Meetings::findOrFail($id);
        if(!$meeting) {
            return redirect()->back();
        }

        if (Storage::exists('public/' . $meeting->foto)) {
            Storage::delete('public/' . $meeting->foto);
        }

        $meeting->delete();

        return redirect()->back();
    }
}
