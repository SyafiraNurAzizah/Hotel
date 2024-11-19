<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotels extends Model
{
    use HasFactory;

    protected $table = "hotels";
    protected $fillable = [
        'nama_cabang',
        'alamat',
        'no_telp',
        'foto_hotel',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Assuming 'user_id' is the foreign key
    }

    public function bookings()
    {
        return $this->hasMany(BookingHotel::class, 'hotel_id');
    }

    public function tipeKamar()
    {
        return $this->hasMany(TipeKamar::class);
    }
    // Model Hotel


}
