<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'meeting_room', 'date', 'start_time', 'end_time', 'notes'
    ];

    // Relasi dengan User (User bisa memiliki banyak booking)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
