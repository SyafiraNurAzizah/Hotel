<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wedding extends Model
{
    use HasFactory;

    protected $table = 'weddings';
    
    protected $fillable = [
        'judul',
        'judul_paket1',
        'judul_paket2',
        'judul_paket3',
        'gambar',
        'harga',
        'kapasitas',
        'paket1',
        'paket2',
        'paket3'
    ];
}
