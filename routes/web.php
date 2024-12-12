<?php


use Illuminate\Container\Attributes\Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HotelsController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\MeetingsController;
use App\Http\Controllers\Admin\WeddingController;
use App\Http\Controllers\WeddingsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BookingHotelController;
use App\Http\Controllers\MeetingBookingController;
use App\Http\Controllers\Admin\AdminHotelController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\AdminMeetingController;
use App\Http\Controllers\Admin\MeetingController;
use App\Http\Controllers\RoomController;
use App\Http\Middleware\UserAccessMiddleware;
use App\Http\Middleware\AdminAccessMiddleware;
use App\Models\Meetings;





Route::get('/', [HomeController::class, 'index'])->name('index');





//----------------------------------------------------- HOTEL ------------------------------------------------------//
Route::get('/hotel', [HotelsController::class, 'index'])->name('hotel');

Route::get('/hotel/{location}', [HotelsController::class, 'showRooms'])->name('rooms');

Route::get('/hotel/{location}/fasilitas', [HotelsController::class, 'showFasilitas'])->name('fasilitas');

Route::get('/hotel/{location}/{nama_tipe}', [HotelsController::class, 'showRoomsDetail'])->name('detail-hotel');

Route::get('/hotel', [HotelsController::class, 'search'])->name('search.hotel');
//-------------------------------------------------------------------------------------------------------------------//


//------------------------------------------------------ RATING -----------------------------------------------------//
Route::post('/rating/{nama_tipe}', [HotelsController::class, 'storeRating'])->name('rating.store');
Route::get('/rating/{nama_tipe}', [HotelsController::class, 'showRating'])->name('rating.show');
//-------------------------------------------------------------------------------------------------------------------//


//---------------------------------------------------- MEETINGS------------------------------------------------------//
Route::get('/meeting', [MeetingsController::class, 'index'])->name('meeting');

Route::get('/meeting/{location}', [MeetingsController::class, 'showRuang'])->name('ruang');

Route::get('/meeting/{location}/{roomId}', [MeetingsController::class, 'detail'])->name('detail');

Route::get('/meeting', [MeetingsController::class, 'search'])->name('search.meeting');
//-------------------------------------------------------------------------------------------------------------------//


//-------------------------------------------------------- WEDDINGS -------------------------------------------------//
Route::get('/weedings', [HomeController::class, 'weedings'])->name('weedings');

Route::resource('wedding', WeddingsController::class);
//-------------------------------------------------------------------------------------------------------------------//


//----------------------------------------------------- CONTACT -----------------------------------------------------//
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
//-------------------------------------------------------------------------------------------------------------------//


//----------------------------------------------------- PROFILE -----------------------------------------------------//
Route::middleware(['auth.custom'])->group(function () {
    Route::get('/{id}/{firstname}-{lastname}', [HomeController::class, 'profile'])->name('profile');
    Route::put('/{id}/{firstname}-{lastname}', [HomeController::class, 'updateProfile'])->name('updateProfile');
});
//-------------------------------------------------------------------------------------------------------------------//


//-------------------------------------------------- ADDITIONAL ----------------------------------------------------//
Route::get('/termofus', [HomeController::class, 'termofus'])->name('termofus');
Route::get('/kebpolice', [HomeController::class, 'kebpolice'])->name('kebpolice');
Route::get('/privacyhotel', [HomeController::class, 'privacyhotel'])->name('privacyhotel');
//-------------------------------------------------------------------------------------------------------------------//





//---------------------------- LOGIN & REGISTER -----------------------------//
Auth::routes();

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
//-------------------------------------------------------------------------------------------------------------------//





//------------------------------------ USER ----------------------------------//
Route::group(['middleware' => ['auth.custom', UserAccessMiddleware::class]], function () {

    // BOOKING //
    //hotel//
    Route::get('/hotel/{location}/{nama_tipe}/transaksi/{uuid}/lokasi', [BookingHotelController::class, 'lokasiHotel'])->name('hotel.transaksi.lokasi-hotel');

    Route::get('/hotel/{location}/{nama_tipe}/transaksi/{uuid}', [BookingHotelController::class, 'transaksiHotel'])->name('hotel.transaksi.transaksi-hotel')->middleware('remove.room.query');
    Route::post('/hotel/{location}/{nama_tipe}/transaksi', [BookingHotelController::class, 'storeHotel'])->name('booking.hotel.store');

    Route::get('/hotel/{location}/{nama_tipe}/transaksi/{uuid}/pembayaran', [BookingHotelController::class, 'konfirmasiPembayaranHotel'])->name('hotel.transaksi.pembayaran-hotel');
    Route::post('/hotel/{location}/{nama_tipe}/transaksi/{uuid}/pembayaran', [BookingHotelController::class, 'pembayaranHotel'])->name('booking.hotel.pembayaran');
    Route::put('/hotel/{location}/{nama_tipe}/transaksi/{uuid}/pembayaran', [BookingHotelController::class, 'updatePembayaranHotel'])->name('booking.hotel.pembayaran.update');
    Route::post('/hotel/{location}/{nama_tipe}/{uuid}', [BookingHotelController::class, 'cancelHotel'])->name('booking.hotel.cancel');
    //hotel//

    //meeting//
    // Route::resource('meeting_bookings', MeetingBookingController::class);
    // Route::post('/bookings', [MeetingBookingController::class, 'store'])->name('bookings.store');
    Route::get('/meeting/{location}/{roomId}/transaksi/{uuid}/lokasi', [MeetingBookingController::class, 'lokasiMeeting'])->name('meeting.transaksi.lokasi-meeting');

    Route::get('/meeting/{location}/{roomId}/transaksi/{uuid}', [MeetingBookingController::class, 'transaksiMeeting'])->name('meeting.transaksi.transaksi-meeting')->middleware('remove.room.query');
    Route::post('/meeting/{location}/{roomId}/transaksi/', [MeetingBookingController::class, 'storeMeeting'])->name('booking.meeting.store');

    Route::get('/meeting/{location}/{roomId}/transaksi/{uuid}/pembayaran', [MeetingBookingController::class, 'konfirmasiPembayaranMeeting'])->name('meeting.transaksi.pembayaran-meeting');
    Route::post('/meeting/{location}/{roomId}/transaksi/{uuid}/pembayaran', [MeetingBookingController::class, 'pembayaranMeeting'])->name('booking.meeting.pembayaran');
    Route::put('/meeting/{location}/{roomId}/transaksi/{uuid}/pembayaran', [MeetingBookingController::class, 'updatePembayaranMeeting'])->name('booking.meeting.pembayaran.update');
    Route::post('/meeting/{location}/{roomId}/{uuid}', [MeetingBookingController::class, 'cancelMeeting'])->name('booking.meeting.cancel');
    //meeting//
    // ===== //

});
//-------------------------------------------------------------------------------------------------------------------//





//------------------------------ ADMIN SPECIAL -----------------------------------//
Route::get('/admin/hotel/reservasi', [BookingHotelController::class, 'create'])
    ->middleware(['auth.custom', AdminAccessMiddleware::class])
    ->name('admin.hotel.create');

Route::get('admin/hotel/daftar-pengunjung', [BookingHotelController::class, 'daftarPengunjungAdmin'])
    ->middleware(['auth.custom', AdminAccessMiddleware::class])
    ->name('admin.hotel.list-tamu');

Route::get('/admin/hotel/pengunjung', [BookingHotelController::class, 'pengunjungAdmin'])
    ->middleware(['auth.custom', AdminAccessMiddleware::class])
    ->name('admin.hotel.tamu');

 Route::get('/admin/hotel/{id}', [AdminHotelController::class, 'AdminShow'])
    ->where('id', '[0-9]+') // hanya menerima angka untuk {id}
    ->middleware(['auth.custom', AdminAccessMiddleware::class])
    ->name('admin.hotel.show');

Route::get('/admin/hotel/{city}', [AdminHotelController::class, 'showByCity'])
    ->middleware(['auth.custom', AdminAccessMiddleware::class])
    ->name('admin.hotel.index');
//-------------------------------------------------------------------------------------------------------------------//


//------------------------------ ADMIN -----------------------------------//
Route::group(['middleware' => ['auth.custom', AdminAccessMiddleware::class]], function () {

    //----------------------------------------------- ADMIN HOTEL -------------------------------------------------//
    Route::get('/admin', [HomeController::class, 'adminIndex'])->name('admin.index');
    Route::get('/admin/hotel', [HomeController::class, 'adminHotel'])->name('admin.hotel.index');

    Route::get('/admin/hotel', [BookingHotelController::class, 'index'])->name('admin.hotel.index');
    // Route::get('/admin/hotel/{id}', [BookingHotelController::class, 'show'])->name('admin.hotel.show');
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
    // Route::get('/admin/hotel/{city}', [AdminHotelController::class, 'showByCity'])->name('admin.hotel.index');
    // Route::get('/admin/hotel/{id}', [AdminHotelController::class, 'AdminShow'])->name('admin.hotel.show');              // Untuk detail data
    Route::get('/admin/hotel/{id}/edit', [AdminHotelController::class, 'edit'])->name('admin.hotel.edit');              // Untuk form edit
    // Route::post('/admin/hotel/{id}/update', [AdminHotelController::class, 'update'])->name('admin.hotel.update');       
    Route::match(['put', 'post'], 'admin/hotel/{id}/update', [AdminHotelController::class, 'update'])->name('admin.hotel.update');
    Route::delete('/admin/hotel/{id}', [AdminHotelController::class, 'AdminDestroy'])->name('admin.hotel.destroy');     // Untuk menghapus data
    //-------------------------------------------------------------------------------------------------------------//


    //----------------------------------------------- ADMIN REVIEW ------------------------------------------------//
    Route::get('/admin/review', [HotelsController::class, 'indexAdminReview'])->name('admin.review.index');
    Route::get('/admin/review/{location}/{nama_tipe}', [HotelsController::class, 'showAdminReview'])->name('admin.review.show');
    Route::delete('/admin/review/{id}', [HotelsController::class, 'destroyAdminReview'])->name('admin.review.destroy');
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

    // Route CRUD untuk Admin Meeting
    Route::get('/admin/meeting', [AdminMeetingController::class, 'AdminIndex'])->name('admin.meetingss.firstindex'); // Untuk daftar meeting
    Route::get('/admin/meeting/{location}', [AdminMeetingController::class, 'showByLocation'])->name('admin.meetingss.indexx');
    Route::get('/admin/meeting/{id}', [AdminMeetingController::class, 'show'])->name('admin.meetingss.show');
    Route::get('/admin/meeting/{id}/edit', [AdminMeetingController::class, 'edit'])->name('admin.meetingss.edit');              // Untuk form edit
    // Route to handle update - it should accept a PUT method
    Route::put('/admin/meeting/{id}/update', [AdminMeetingController::class, 'update'])->name('admin.meetingss.update');

    Route::delete('/admin/meeting/{id}', [AdminMeetingController::class, 'destroy'])->name('admin.meetingss.destroy');     // Untuk menghapus data
    //-------------------------------------------------------------------------------------------------------------//


    //---------------------------------------------- ADMIN WEDDING ------------------------------------------------//
    Route::get('/admin/wedding', [WeddingController::class, 'index'])->name('admin.wedding.index');
    Route::get('/admin/wedding/{id}', [WeddingController::class, 'edit'])->name('admin.wedding.edit');
    Route::get('/admin/wedding/{id}', [WeddingController::class, 'show'])->name('admin.wedding.show');

    // Route::get('/admin/wedding/create', [WeddingsController::class, 'create'])->name('admin.wedding.create');
    //-------------------------------------------------------------------------------------------------------------//


    //---------------------------------------------- ADMIN CONTACT ------------------------------------------------//
    Route::get('/admin/contact', [ContactController::class, 'index'])->name('admin.contact.index');
    Route::get('/admin/contact/{id}', [ContactController::class, 'show'])->name('admin.contact.show');
    //-------------------------------------------------------------------------------------------------------------//

});
//-------------------------------------------------------------------------------------------------------------------//





// Route untuk halaman detail kamar
// Route::get('/rooms/{id}', [RoomController::class, 'show'])->name('room.show');
