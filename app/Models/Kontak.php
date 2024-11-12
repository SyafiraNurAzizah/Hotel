<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'nama',
        'email',
        'pesan',
    ];

    // Relasi ke model Hotel
    public function hotel()
    {
        return $this->belongsTo(Hotels::class, 'hotel_id');
    }
}
