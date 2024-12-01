<?php

namespace App\Http\Controllers;

use App\Models\Hotels;
use App\Models\Meetings;
use App\Models\ProfileUser;
use App\Models\TipeKamar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function hotel()
    {
        return view('hotel');
    }

    public function meeting()
    {
        return view('meeting');
    }

    public function weddings()
    {
        return view('wedding.index');
    }
    
    public function contact()
    {
        return view('contact');
    }

    public function profile($id, $firstname, $lastname)
    {
        $user = User::where('id', $id)->firstOrFail();

        $bookings = $user->bookings()->orderBy('created_at', 'desc')->get();

        $bookings_meetings = $user->bookings_meetings()->orderBy('created_at', 'desc')->get();

        $meetings = Meetings::all();

        // Safe check for the profile_user of the authenticated user
        $userProfile = Auth::user()->profile_user ?? null;

        // If profile_user is not found, use default values
        if (!$userProfile) {
            $userProfile = (object) [
                'jenis_kelamin' => 'Data tidak tersedia',
                'tanggal_lahir' => 'Data tidak tersedia',
                'alamat' => 'Data tidak tersedia'
            ];
        }

        $user = Auth::user();

        $profile = ProfileUser ::where('user_id', $user->id)->first();

        // Pass user profile along with the other data to the view
        return view('profile', ['user' => $user, 'bookings' => $bookings, 'bookings_meetings' => $bookings_meetings, 'userProfile' => $userProfile, 'profile' => $profile, 'meetings' => $meetings]);
    }

    public function updateProfile(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'no_telp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|string|max:10',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Ambil pengguna yang sedang login
        $user = Auth::user();

        // Pastikan pengguna ditemukan
        if (!$user) {
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
        }

        // Update nama depan dan belakang pengguna
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->no_telp = $request->input('no_telp');
        
        // Simpan perubahan di tabel users
        $user->save();

        // Cek apakah profil pengguna sudah ada
        $profile = ProfileUser::where('user_id', $user->id)->first();

        // Cek apakah ada foto yang diupload
        if ($request->hasFile('foto')) {
            // Simpan foto baru dan ambil path-nya
            $fotoPath = $request->file('foto')->store('photos', 'public');
        } else {
            // Jika tidak ada foto baru, tetap menggunakan foto lama
            $fotoPath = $profile ? $profile->foto : null;
        }

        // Update atau buat data di tabel profile_user
        ProfileUser::updateOrCreate(
            ['user_id' => $user->id], // Kondisi untuk mengecek apakah profil sudah ada
            [
                'alamat' => $request->input('alamat'),
                'tanggal_lahir' => $request->input('tanggal_lahir'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'foto' => $fotoPath, // Simpan path foto yang baru (atau tetap menggunakan yang lama)
            ]
        );

        // Membuat URL baru berdasarkan id, nama depan, dan belakang yang diperbarui
        $newUrl = route('profile', ['id' => $user->id, 'firstname' => $user->firstname, 'lastname' => $user->lastname]);

        // Redirect ke halaman profil yang baru dengan pesan sukses
        return redirect($newUrl)->with('success', 'Profil berhasil diperbarui.');
    }





    public function adminIndex()
    {
        return view('admin.index');
    }
    public function adminHotel()
    {
        return view('admin.hotel.index');
    }
    public function adminMeetings()
    {
        return view('admin.meetings.index');
    }
    public function adminWeddings()
    {
        return view('admin.weddings.index');
    }
    
    
    //FOOTER
    public function termofus()
    {
        return view('termofus');
    }

    public function kebpolice()
    {
        return view('kebpolice');
    }

    public function privacyhotel()
    {
        return view('privacyhotel');
    }
}
 