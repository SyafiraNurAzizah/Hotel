<?php

namespace App\Models;

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
        'total_hari',
        'total_harga',
        'status',
    ];
}
