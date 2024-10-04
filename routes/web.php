<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

Route::get('/hotel', [App\Http\Controllers\HomeController::class, 'hotel'])->name('hotel');

Route::get('/weddings', [App\Http\Controllers\HomeController::class, 'weddings'])->name('weddings');

Route::resource('wedding', App\Http\Controllers\WeddingsController::class);

// Route::get('/weddings/{id}', [App\Http\Controllers\WeddingsController::class, 'show'])->name('weddings.show');

//---------------------------- LOGIN & REGISTER -----------------------------//
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('register.create');
// Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'store'])->name('register.store');


Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
//----------------------------------------------------------------------------//


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
