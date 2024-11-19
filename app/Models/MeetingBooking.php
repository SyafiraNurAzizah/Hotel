<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingBooking extends Model
{
    use HasFactory;

    protected $table = 'bookings';
    protected $fillable = [
        'uuid',
        'user_id',
        'hotel_id',
        'meeting_id',
        'date',
        'start_time',
        'end_time',
        'jumlah_harga',
        'pesan',
    ];

    // Relasi dengan User (User bisa memiliki banyak booking)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
