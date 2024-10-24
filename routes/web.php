<?php

use Illuminate\Console\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

Route::get('/hotel', [App\Http\Controllers\HomeController::class, 'hotel'])->name('hotel');
Route::get('/meeting', [App\Http\Controllers\HomeController::class, 'meeting'])->name('meeting');

Route::get('/weedings', [App\Http\Controllers\HomeController::class, 'weedings'])->name('weedings');

Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');

Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

//---------------------------- LOGIN & REGISTER -----------------------------//
Auth::routes();

// Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('register.create');
// Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'store'])->name('register.store');


Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
//----------------------------------------------------------------------------//


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/detail/detail1', function () {
    return view('detail.detail1');
})->name('detail1');
