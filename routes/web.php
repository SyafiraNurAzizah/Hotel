<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

Route::get('/hotel', [App\Http\Controllers\HomeController::class, 'hotel'])->name('hotel');
Route::get('/meeting', [App\Http\Controllers\HomeController::class, 'meeting'])->name('meeting');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

