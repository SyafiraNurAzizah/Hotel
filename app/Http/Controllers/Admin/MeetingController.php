<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meetings;
use Illuminate\Http\Request;
// use App\Models\Meeting;


class MeetingController extends Controller
{
    public function index()
    {
        $meetings = Meetings::all();
        return view('admin.meeting.index', compact('meetings'));    
    }
}
