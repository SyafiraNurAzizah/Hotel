<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranMeeting extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_meeting';

    protected $fillable = [
        'booking_meeting_id',
        'metode_pembayaran',
        'bukti_pembayaran',
    ];
}
