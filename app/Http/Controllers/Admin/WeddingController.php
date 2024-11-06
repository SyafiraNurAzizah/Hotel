<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wedding;

class WeddingController extends Controller
{
    public function index() {
        $weddings = Wedding::all();
        return view('admin.wedding.index', compact('weddings'));
    }
    
    // public function edit ($id) {
    //     $weddings = wedding::findOrFail($id);
    //     return view('admin.wedding.edit', compact('weddings'));
    // }
}
