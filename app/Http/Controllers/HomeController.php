<?php

namespace App\Http\Controllers;

use App\Models\Hotels;
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

        $bookings = $user->bookings;

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
        return view('profile', ['user' => $user, 'bookings' => $bookings, 'userProfile' => $userProfile, 'profile' => $profile]);
    }

    public function updateProfile(Request $request, $firstname, $lastname)
    {
        // Validate the incoming request data
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            // 'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'no_telp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|string|max:10',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update the users table
        $user = User::where('firstname', $firstname)
                    ->where('lastname', $lastname)
                    ->first();

        if ($user) {
            // Update user's first name and last name
            $user->firstname = $request->input('firstname');
            $user->lastname = $request->input('lastname');
            // $user->email = $request->input('email');
            $user->no_telp = $request->input('no_telp');
            $user->save();

            // Retrieve the existing profile
            $profile = ProfileUser ::where('user_id', $user->id)->first();

            // Check if a new photo is uploaded
            if ($request->hasFile('foto')) {
                // Store the new photo and update the path
                $fotoPath = $request->file('foto')->store('photos', 'public');
            } else {
                // If no new photo is uploaded, keep the existing photo path
                $fotoPath = $profile ? $profile->foto : null;
            }

            // Update or create the profile_user table
            ProfileUser ::updateOrCreate(
                ['user_id' => $user->id], // Condition to check if the record exists
                [
                    'alamat' => $request->input('alamat'),
                    'tanggal_lahir' => $request->input('tanggal_lahir'),
                    'jenis_kelamin' => $request->input('jenis_kelamin'),
                    // Handle file upload if a new photo is uploaded
                    'foto' => $fotoPath, // Use the determined photo path
                ]
            );

            // Construct the new URL using the updated first name and last name
            $newFirstname = $user->firstname; // Updated first name
            $newLastname = $user->lastname; // Updated last name
            $newUrl = route('profile', ['firstname' => $newFirstname, 'lastname' => $newLastname]);

            // Redirect to the new URL with success message
            return redirect($newUrl)->with('success', 'Profil berhasil diperbarui.');
        }

        // Handle case where user is not found
        return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
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
 