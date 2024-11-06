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
        'tamu_dewasa',
        'tamu_anak',
        'jumlah_kamar',
        'jumlah_harga',
        'pesan',
        'status',
        'status_pembayaran',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
