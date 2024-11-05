<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranHotel extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_hotel';
    protected $fillable = [
        'booking_hotel_id',
        'metode_pembayaran',
        'bukti_pembayaran',
    ];
}
