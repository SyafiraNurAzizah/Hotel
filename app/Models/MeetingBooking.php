<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingBooking extends Model
{
    use HasFactory;

    protected $table = 'bookings';
    protected $fillable = [
        'hotel_id',
        'meeting_id',
        'name',
        'email',
        'phone',
        'date',
        'start_time',
        'end_time',
    ];

    // Relasi dengan User (User bisa memiliki banyak booking)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
