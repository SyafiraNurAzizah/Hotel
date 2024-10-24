<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;

    protected $table = 'fasilitas_hotel';
    protected $fillable = [
        'hotel_id',
        'nama_fasilitas',
        'deskripsi',
        'foto_fasilitas',
    ];
}
