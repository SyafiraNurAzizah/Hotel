<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookingHotel;
use App\Models\MeetingBooking;
use App\Models\Meetings;
use Illuminate\Http\Request;

class AdminMeetingController extends Controller
{
    public function AdminIndex()
    {
        return view('admin.meetingss.firstindex');
    }

    public function showByCity()
    {
        $bookings = Meetings::all();
        return view('admin.meetingss.index', compact('bookings'));
    }

   
}
