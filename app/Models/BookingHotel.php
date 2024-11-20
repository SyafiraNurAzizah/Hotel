<?php

namespace App\Models;

use App\Models\User;
use App\Models\Hotels;
use App\Http\Controllers\Admin\AdminHotelController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingHotel extends Model
{
    use HasFactory;

    protected $table = 'booking_hotel';
    protected $fillable = [
        'user_id',
        'hotel_id',
        'tipe_kamar_id',
        'checkin',
        'checkout',
        'tamu_dewasa',
        'tamu_anak',
        'jumlah_kamar',
        'jumlah_harga',
        'pesan',
        'status',
        'status_pembayaran',
        'tamu_id'
    ];


    public function hotel()
    {
        return $this->belongsTo(Hotels::class, 'hotel_id');
    }

    // Definisikan relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tipe_kamar()
    {
        return $this->belongsTo(TipeKamar::class, 'tipe_kamar_id');
    }

    public function tamu()
    {
        return $this->belongsTo(User::class, 'tamu_id');
    }
}
