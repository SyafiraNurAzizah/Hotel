<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wedding;

class WeddingsController extends Controller
{
    public function index()
    {
        $weddings = Wedding::all();
        return view('wedding.index', compact('weddings'));
    }

    public function show($id)
    {
        $weddings = Wedding::findOrFail($id); 
        return view('wedding.show', compact('weddings'));
    }


}
