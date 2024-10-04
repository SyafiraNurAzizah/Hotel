<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\wedding;

class WeddingsController extends Controller
{
    public function index()
    {
        $weddings = Wedding::all();
        return view('weddings', compact('weddings'));
    }

    public function show($id)
    {
        $wedding = Wedding::findOrFail($id); 
        return view('wedding.show', compact('wedding'));
    }

}
