<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meetings extends Model
{
    use HasFactory;

    protected $table = 'meetings';
    protected $fillable = [
        'hotel_id',
        'nama_ruang',
        'deskripsi',
        'harga_per_jam',
        'jumlah_ruang_tersedia',
        'kapasitas',
        'fasilitas',
        'ukuran_ruang',
        'foto',
        'status',

    ];
}
