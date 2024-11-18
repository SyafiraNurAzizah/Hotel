<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tamu extends Model
{
    use HasFactory;

    protected $table = 'tamu';

    protected $fillable = [
        'nama',
        'no_identitas',
        'no_telp',
    ];

    public function bookings()
    {
        return $this->hasMany(BookingHotel::class, 'tamu_id');
    }
}
