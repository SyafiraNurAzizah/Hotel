<?php

namespace App\Http\Controllers;

use App\Models\Hotels;
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

    public function profile($firstname, $lastname)
    {
        $user = User::where('firstname', $firstname)->where('lastname', $lastname)->firstOrFail();

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

        // Pass user profile along with the other data to the view
        return view('profile', ['user' => $user, 'bookings' => $bookings, 'userProfile' => $userProfile]);
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
 