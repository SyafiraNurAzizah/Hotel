<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileUser extends Model
{
    use HasFactory;

    protected $table = 'profile_user';
    protected $fillable = [
        'user_id',
        'alamat',
        'tanggal_lahir',
        'jenis_kelamin',
        'foto'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookings()
    {
        return $this->hasMany(BookingHotel::class, 'user_id');
    }

    public function bookings_meetings()
    {
        return $this->hasMany(MeetingBooking::class, 'user_id');
    }
}
