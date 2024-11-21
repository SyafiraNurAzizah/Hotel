<?php

use App\Http\Controllers\Admin\AdminHotelController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\AdminMeetingController;
use App\Http\Controllers\Admin\WeddingController;
use App\Http\Controllers\BookingHotelController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RoomController;
use Illuminate\Container\Attributes\Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelsController;
use App\Http\Controllers\MeetingBookingController;
use App\Http\Controllers\MeetingsController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\MeetingController;
use App\Models\Meetings;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

// ----------------------------------- WEDDINGS --------------------------------- //
Route::get('/weedings', [App\Http\Controllers\HomeController::class, 'weedings'])->name('weedings');

// Route::get('/admin/wedding', [WeddingController::class, 'index'])->name('admin.wedding.index');

// Route::get('/admin/wedding/{id}', [WeddingController::class, 'edit'])->name('admin.wedding.edit');

// Route::get('/admin/wedding/{id}', [WeddingController::class, 'show'])->name('admin.wedding.show');

// Route::resource('admin/wedding', WeddingController::class);

Route::prefix('admin')->group(function () {
    Route::get('/admin/contact', [ContactController::class, 'index'])->name('admin.contact.index');
});


Route::get('/admin/contact/{id}', [App\Http\Controllers\ContactController::class, 'show'])->name('admin.contact.show');

Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');

// Route::get('/contact', [ContactController::class, 'index'])->name('contact');
// Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');


Route::resource('wedding', App\Http\Controllers\WeddingsController::class);

Route::get('/admin/wedding', [WeddingController::class, 'index'])->name('admin.wedding.index');
Route::get('/admin/wedding/{id}', [WeddingController::class, 'edit'])->name('admin.wedding.edit');
Route::get('/admin/wedding/{id}', [WeddingController::class, 'show'])->name('admin.wedding.show');

// ----------------------------------- CONTACT --------------------------------- //
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

Route::get('/admin/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('admin.contact.index');
Route::get('/admin/contact/{id}', [App\Http\Controllers\ContactController::class, 'show'])->name('admin.contact.show');

//---------------------------- LOGIN & REGISTER -----------------------------//
Auth::routes();

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth.custom'])->group(function () {
    Route::get('/{id}/{firstname}-{lastname}', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
    Route::put('/{id}/{firstname}-{lastname}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
});
//----------------------------------------------------------------------------//





//------------------------------ ADMIN SPECIAL -----------------------------------//
Route::get('/admin/hotel/reservasi', [BookingHotelController::class, 'create'])
    ->middleware(['auth.custom', App\Http\Middleware\AdminAccessMiddleware::class])
    ->name('admin.hotel.create');

Route::get('admin/hotel/daftar-pengunjung', [BookingHotelController::class, 'daftarPengunjungAdmin'])
    ->middleware(['auth.custom', App\Http\Middleware\AdminAccessMiddleware::class])
    ->name('admin.hotel.list-tamu');

Route::get('/admin/hotel/pengunjung', [BookingHotelController::class, 'pengunjungAdmin'])
    ->middleware(['auth.custom', App\Http\Middleware\AdminAccessMiddleware::class])
    ->name('admin.hotel.tamu');
//----------------------------------------------------------------------------------//

//------------------------------ ADMIN -----------------------------------//
Route::group(['middleware' => ['auth.custom', App\Http\Middleware\AdminAccessMiddleware::class]], function () {

    //----------------------------------------------- ADMIN HOTEL -------------------------------------------------//
    Route::get('/admin', [App\Http\Controllers\HomeController::class, 'adminIndex'])->name('admin.index');
    Route::get('/admin/hotel', [App\Http\Controllers\HomeController::class, 'adminHotel'])->name('admin.hotel.index');

    Route::get('/admin/hotel', [BookingHotelController::class, 'index'])->name('admin.hotel.index');
    Route::get('/admin/hotel/{id}', [BookingHotelController::class, 'show'])->name('admin.hotel.show');
    // Route::get('/admin/admin/create', [BookingHotelController::class, 'create'])->name('admin.hotel.create');
    Route::post('/admin/hotel/store', [BookingHotelController::class, 'store'])->name('admin.hotel.store')->middleware('auth');
    Route::get('/admin/hotel/{id}/edit', [BookingHotelController::class, 'edit'])->name('admin.hotel.edit');
    Route::put('/admin/hotel/{id}', [BookingHotelController::class, 'update'])->name('admin.hotel.update');
    Route::delete('/admin/hotel/{id}', [BookingHotelController::class, 'destroy'])->name('admin.hotel.destroy');
    // Route::get('/admin/hotel/tamu', [BookingHotelController::class, 'pengunjungAdmin'])->name('admin.hotel.tamu');
    // Route::get('admin/hotel/daftar-pengunjung', [BookingHotelController::class, 'daftarPengunjungAdmin'])->name('admin.hotel.list-tamu');
    Route::post('/admin/hotel/tamu', [BookingHotelController::class, 'tambahPengunjungAdmin'])->name('admin.hotel.store.tamu');


    // Route CRUD untuk Admin Hotel
    Route::get('/admin/hotel', [AdminHotelController::class, 'AdminIndex'])->name('admin.hotel.firstindex');            // Untuk daftar hotel
    Route::get('/admin/booking/{city}', [AdminHotelController::class, 'showByCity'])->name('admin.hotel.index');
    Route::get('/admin/hotel/{id}', [AdminHotelController::class, 'AdminShow'])->name('admin.hotel.show');              // Untuk detail data
    Route::get('/admin/hotel/{id}/edit', [AdminHotelController::class, 'edit'])->name('admin.hotel.edit');              // Untuk form edit
    Route::post('/admin/hotel/{id}/update', [AdminHotelController::class, 'update'])->name('admin.hotel.update');       // Untuk update data
    Route::delete('/admin/hotel/{id}', [AdminHotelController::class, 'AdminDestroy'])->name('admin.hotel.destroy');     // Untuk menghapus data
    //-------------------------------------------------------------------------------------------------------------//


    //---------------------------------------------- ADMIN WEDDING ------------------------------------------------//
    Route::get('/admin/wedding', [WeddingController::class, 'index'])->name('admin.wedding.index');
    Route::get('/admin/wedding/{id}', [WeddingController::class, 'edit'])->name('admin.wedding.edit');
    Route::get('/admin/wedding/{id}', [WeddingController::class, 'show'])->name('admin.wedding.show');
    //-------------------------------------------------------------------------------------------------------------//


    //---------------------------------------------- ADMIN MEETING ------------------------------------------------//
    Route::get('/admin/meeting', [MeetingController::class, 'index'])->name('admin.meeting.index');
    Route::get('/admin/meeting/create', [MeetingController::class, 'create'])->name('admin.meeting.create');
    Route::post('/admin/meeting', [MeetingController::class, 'store'])->name('admin.meeting.store');
    // Route::get('/admin/meeting/{id}', [MeetingController::class, 'edit'])->name('admin.meeting.edit');
    // Route::post('/admin/meeting/{id}', [MeetingController::class, 'update'])->name('admin.meeting.update');
    Route::delete('/admin/meeting/{id}', [MeetingController::class, 'destroy'])->name('admin.meeting.destroy');

    Route::get('/admin/meeting/reservasi', [MeetingController::class, 'reservasi'])->name('admin.meeting.reservasi');
    Route::post('/admin/meeting', [MeetingController::class, 'reservasiStore'])->name('admin.meeting.store');
    Route::get('/admin/meeting/pengunjung', [MeetingController::class, 'pengunjungAdmin'])->name('admin.meeting.tamu');
    Route::post('/admin/meeting/tamu', [MeetingController::class, 'tambahPengunjungAdmin'])->name('admin.meeting.store.tamu');
    Route::get('admin/meeting/daftar-pengunjung', [MeetingController::class, 'daftarPengunjungAdmin'])->name('admin.meeting.list-tamu');

    Route::get('/admin/review', [HotelsController::class, 'indexAdminReview'])->name('admin.review.index');
    Route::get('/admin/review/{location}/{nama_tipe}', [App\Http\Controllers\HotelsController::class, 'showAdminReview'])->name('admin.review.show');
    Route::delete('/admin/review/{id}', [App\Http\Controllers\HotelsController::class, 'destroyAdminReview'])->name('admin.review.destroy');
    Route::get('/admin/hotel', [AdminHotelController::class, 'AdminIndex'])->name('admin.hotel.firstindex');                // Untuk daftar hotel
    Route::get('/admin/booking/{city}', [AdminHotelController::class, 'showByCity'])->name('admin.hotel.index');
    Route::get('/admin/hotel/{id}', [AdminHotelController::class, 'AdminShow'])->name('admin.hotel.show');              // Untuk detail data
    Route::get('/admin/hotel/{id}/edit', [AdminHotelController::class, 'edit'])->name('admin.hotel.edit');   
    Route::match(['put', 'post'], 'admin/hotel/{id}/update', [AdminHotelController::class, 'update'])->name('admin.hotel.update');

    Route::delete('/admin/hotel/{id}', [AdminHotelController::class, 'AdminDestroy'])->name('admin.hotel.destroy');     // Untuk menghapus data  // Untuk daftar reservasi

    // Route CRUD untuk Admin Meeting
    Route::get('/admin/meeting', [AdminMeetingController::class, 'AdminIndex'])->name('admin.meetingss.firstindex'); // Untuk daftar meeting
    Route::get('/admin/bookings/location/{location}', [AdminMeetingController::class, 'showByLocation'])->name('admin.meetingss.indexx');
    Route::get('/admin/meeting/{id}', [AdminMeetingController::class, 'show'])->name('admin.meetingss.show');
    Route::get('/admin/meeting/{id}/edit', [AdminMeetingController::class, 'edit'])->name('admin.meetingss.edit');              // Untuk form edit
    // Route to handle update - it should accept a PUT method
    Route::put('/admin/meeting/{id}/update', [AdminMeetingController::class, 'update'])->name('admin.meetingss.update');

    Route::delete('/admin/meeting/{id}', [AdminMeetingController::class, 'destroy'])->name('admin.meetingss.destroy');     // Untuk menghapus data


});
//----------------------------------------------------------------------------//






//------------------------------------ USER ----------------------------------//
Route::group(['middleware' => ['auth.custom', App\Http\Middleware\UserAccessMiddleware::class]], function () {

    // BOOKING //
    //hotel//
    Route::get('/hotel/{location}/{nama_tipe}/transaksi/{uuid}/lokasi', [App\Http\Controllers\BookingHotelController::class, 'lokasiHotel'])->name('hotel.transaksi.lokasi-hotel');

    Route::get('/hotel/{location}/{nama_tipe}/transaksi/{uuid}', [App\Http\Controllers\BookingHotelController::class, 'transaksiHotel'])->name('hotel.transaksi.transaksi-hotel')->middleware('remove.room.query');
    Route::post('/hotel/{location}/{nama_tipe}/transaksi', [App\Http\Controllers\BookingHotelController::class, 'storeHotel'])->name('booking.hotel.store');

    Route::get('/hotel/{location}/{nama_tipe}/transaksi/{uuid}/pembayaran', [App\Http\Controllers\BookingHotelController::class, 'konfirmasiPembayaranHotel'])->name('hotel.transaksi.pembayaran-hotel');
    Route::post('/hotel/{location}/{nama_tipe}/transaksi/{uuid}/pembayaran', [App\Http\Controllers\BookingHotelController::class, 'pembayaranHotel'])->name('booking.hotel.pembayaran');
    Route::put('/hotel/{location}/{nama_tipe}/transaksi/{uuid}/pembayaran', [App\Http\Controllers\BookingHotelController::class, 'updatePembayaranHotel'])->name('booking.hotel.pembayaran.update');
    Route::post('/hotel/{location}/{nama_tipe}/{uuid}', [App\Http\Controllers\BookingHotelController::class, 'cancelHotel'])->name('booking.hotel.cancel');
    //hotel//

    //meeting//
    // Route::resource('meeting_bookings', MeetingBookingController::class);
    // Route::post('/bookings', [App\Http\Controllers\MeetingBookingController::class, 'store'])->name('bookings.store');
    Route::get('/meeting/{location}/{roomId}/transaksi/{uuid}/lokasi', [MeetingBookingController::class, 'lokasiMeeting'])->name('meeting.transaksi.lokasi-meeting');

    Route::get('/meeting/{location}/{roomId}/transaksi/{uuid}', [MeetingBookingController::class, 'transaksiMeeting'])->name('meeting.transaksi.transaksi-meeting')->middleware('remove.room.query');
    Route::post('/meeting/{location}/{roomId}/transaksi/', [MeetingBookingController::class, 'storeMeeting'])->name('booking.meeting.store');

    Route::get('/meeting/{location}/{roomId}/transaksi/{uuid}/pembayaran', [MeetingBookingController::class, 'konfirmasiPembayaranMeeting'])->name('meeting.transaksi.pembayaran-meeting');
    Route::post('/meeting/{location}/{roomId}/transaksi/{uuid}/pembayaran', [MeetingBookingController::class, 'pembayaranMeeting'])->name('booking.meeting.pembayaran');
    Route::put('/meeting/{location}/{roomId}/transaksi/{uuid}/pembayaran', [MeetingBookingController::class, 'updatePembayaranMeeting'])->name('booking.meeting.pembayaran.update');
    Route::post('/meeting/{location}/{roomId}/{uuid}', [MeetingBookingController::class, 'cancelMeeting'])->name('booking.meeting.cancel');
    //meeting//

    // ----- //

});
//-------------------------------------------------------------------------------//


//-------------------------------- HOTEL -----------------------------------//
Route::get('/hotel', [App\Http\Controllers\HotelsController::class, 'index'])->name('hotel');

Route::get('/hotel/{location}', [App\Http\Controllers\HotelsController::class, 'showRooms'])->name('rooms');

Route::get('/hotel/{location}/fasilitas', [App\Http\Controllers\HotelsController::class, 'showFasilitas'])->name('fasilitas');

Route::get('/hotel/{location}/{nama_tipe}', [App\Http\Controllers\HotelsController::class, 'showRoomsDetail'])->name('detail-hotel');
//--------------------------------------------------------------------------//

// ----------------------------------- RATING --------------------------------- //
Route::post('/rating/{nama_tipe}', [App\Http\Controllers\HotelsController::class, 'storeRating'])->name('rating.store');
Route::get('/rating/{nama_tipe}', [App\Http\Controllers\HotelsController::class, 'showRating'])->name('rating.show');
// ---------------------------------------------------------------------------- //

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




Route::get('/termofus', [HomeController::class, 'termofus'])->name('termofus');
Route::get('/kebpolice', [HomeController::class, 'kebpolice'])->name('kebpolice');
Route::get('/privacyhotel', [HomeController::class, 'privacyhotel'])->name('privacyhotel');
