<?php

use App\Http\Controllers\Admin\AdminHotelController;
use App\Http\Controllers\Admin\WeddingController;
use App\Http\Controllers\AdminHotelController as ControllersAdminHotelController;
use App\Http\Controllers\BookingHotelController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RoomController;
use Illuminate\Container\Attributes\Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelsController;
use App\Http\Controllers\MeetingsController;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

// Route::get('/hotel', [App\Http\Controllers\HomeController::class, 'hotel'])->name('hotel');


Route::get('/weedings', [App\Http\Controllers\HomeController::class, 'weedings'])->name('weedings');

// Route::get('/admin/wedding', [WeddingController::class, 'index'])->name('admin.wedding.index');

Route::get('/admin/wedding/{id}', [WeddingController::class, 'edit'])->name('admin.wedding.edit');

Route::get('/admin/wedding/{id}', [WeddingController::class, 'show'])->name('admin.wedding.show');

// Route::resource('admin/wedding', WeddingController::class);

Route::prefix('admin')->group(function () {
    Route::get('/admin/contact', [ContactController::class, 'index'])->name('admin.contact.index');
});


Route::get('/admin/contact/{id}', [App\Http\Controllers\ContactController::class, 'show'])->name('admin.contact.show');

Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');

// Route::get('/contact', [ContactController::class, 'index'])->name('contact');
// Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');


Route::resource('wedding', App\Http\Controllers\WeddingsController::class);

// Route::get('/weddings/{id}', [App\Http\Controllers\WeddingsController::class, 'show'])->name('weddings.show');

//---------------------------- LOGIN & REGISTER -----------------------------//
Auth::routes();

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth.custom'])->group(function () {
    Route::get('/{firstname}-{lastname}', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
});
//----------------------------------------------------------------------------//



//------------------------------ ADMIN -----------------------------------//
Route::group(['middleware' => ['auth', App\Http\Middleware\AdminAccessMiddleware::class]], function () {
    Route::get('/admin', [App\Http\Controllers\HomeController::class, 'adminIndex'])->name('admin.index');
    Route::get('/admin/hotel', [App\Http\Controllers\HomeController::class, 'adminHotel'])->name('admin.hotel.index');
});
//----------------------------------------------------------------------------


//------------------------------------ USER ----------------------------------//
Route::group(['middleware' => ['auth.custom', App\Http\Middleware\UserAccessMiddleware::class]], function () {

    // BOOKING //
//hotel//
    Route::get('/hotel/{location}/{nama_tipe}/transaksi/{uuid}', [App\Http\Controllers\BookingHotelController::class, 'transaksiHotel'])->name('hotel.transaksi.transaksi-hotel')->middleware('remove.room.query');
    Route::post('/hotel/{location}/{nama_tipe}/transaksi', [App\Http\Controllers\BookingHotelController::class, 'storeHotel'])->name('booking.hotel.store');

    Route::get('/hotel/{location}/{nama_tipe}/transaksi/{uuid}/pembayaran', [App\Http\Controllers\BookingHotelController::class, 'konfirmasiPembayaranHotel'])->name('hotel.transaksi.pembayaran-hotel');
    Route::post('/hotel/{location}/{nama_tipe}/transaksi/{uuid}/pembayaran', [App\Http\Controllers\BookingHotelController::class, 'pembayaranHotel'])->name('booking.hotel.pembayaran');
    Route::put('/hotel/{location}/{nama_tipe}/transaksi/{uuid}/pembayaran', [App\Http\Controllers\BookingHotelController::class, 'updatePembayaranHotel'])->name('booking.hotel.pembayaran.update');
    Route::post('/hotel/{location}/{nama_tipe}/{uuid}', [App\Http\Controllers\BookingHotelController::class, 'cancelHotel'])->name('booking.hotel.cancel');
//---//
    // ----- //
    
});
//-------------------------------------------------------------------------------//


//-------------------------------- HOTEL -----------------------------------//
Route::get('/hotel', [App\Http\Controllers\HotelsController::class, 'index'])->name('hotel');

Route::get('/hotel/{location}', [App\Http\Controllers\HotelsController::class, 'showRooms'])->name('rooms');

Route::get('/hotel/{location}/{nama_tipe}', [App\Http\Controllers\HotelsController::class, 'showRoomsDetail'])->name('detail-hotel');

Route::get('/hotel/{location}/fasilitas', [App\Http\Controllers\HotelsController::class, 'showFasilitas'])->name('fasilitas');
//--------------------------------------------------------------------------//


// ------------------------------------ Meetings----------------------------------//
Route::get('/meeting', [App\Http\Controllers\MeetingsController::class, 'index'])->name('meeting');

Route::get('/meeting/{location}', [App\Http\Controllers\MeetingsController::class, 'showRuang'])->name('ruang');

Route::get('/meeting/{location}/{roomId}', [App\Http\Controllers\MeetingsController::class, 'detail'])->name('detail');



// Route::get('/meeting/{location}/{roomId}/gallery', [App\Http\Controllers\MeetingsController::class, 'showGallery'])->name('gallery');
//-----------------------------------------------------------------------------------//







// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//---------------------------------------------------------------------------//



Route::get('/detail/detail1', function () {
    return view('meeting.detail1');
})->name('detail1');



// Route::get('/gallery/{location}', function ($location) {
//     // Periksa apakah view untuk lokasi tersedia
//     $viewName = 'meeting.gallery.gallery-' . $location;
    
//     if (view()->exists($viewName)) {
//         return view($viewName);
//     } else {
//         abort(404); // Jika view tidak ditemukan, tampilkan halaman 404
//     }
// });
Route::get('/detail/detail2', function () {
    return view('hotel.detail2');
})->name('detail2'); // Tambahkan nama disini

// Route::get('/fasilitas/{location}', function ($location) {
//     // Periksa apakah view untuk lokasi tersedia
//     $viewName = 'hotel.fasilitas.fasilitas-' . $location;
    
//     if (view()->exists($viewName)) {
//         return view($viewName);
//     } else {
//         abort(404); // Jika view tidak ditemukan, tampilkan halaman 404
//     }
// });

// Route untuk halaman detail kamar
Route::get('/rooms/{id}', [App\Http\Controllers\RoomController::class, 'show'])->name('room.show');

Route::get('/hotel', [HotelsController::class, 'search'])->name('search.hotel');
Route::get('/meeting', [MeetingsController::class, 'search'])->name('search.meeting');
Route::get('/admin/create', [BookingHotelController::class, 'create'])->name('admin.hotel.create');
Route::post('/admin/hotel/store', [BookingHotelController::class, 'store'])->name('admin.hotel.store')->middleware('auth');


Route::get('/termofus', [HomeController::class, 'termofus'])->name('termofus');
Route::get('/kebpolice', [HomeController::class, 'kebpolice'])->name('kebpolice');
Route::get('/privacyhotel', [HomeController::class, 'privacyhotel'])->name('privacyhotel');
