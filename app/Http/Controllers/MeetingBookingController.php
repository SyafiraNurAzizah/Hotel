<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MeetingBooking;

class MeetingBookingController extends Controller
{
    public function index()
    {
        $bookings = MeetingBooking::with('user')->get();
        return view('meeting_bookings.index', compact('bookings'));
    }

    public function create()
    {
        return view('meeting_bookings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'meeting_room' => 'required|string',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        MeetingBooking::create($request->all());

        return redirect()->route('meeting_bookings.index')->with('success', 'Booking created successfully');
    }
}

