<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeKamar extends Model
{
    use HasFactory;

    protected $table = 'tipe_kamar';
    protected $fillable = [
        'hotel_id',
        'nama_tipe',
        'deskripsi',
        'harga_per_malam',
        'jumlah_kamar_tersedia',
        'kapasitas',
        'fasilitas',
        'ukuran_kamar',
        'jenis_kasur',
        'foto',
        'status',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotels::class); 
    }

    public function ratings()
    {
        // return $this->hasMany('App\Models\Rating');
        return $this->hasMany(Rating::class, 'tipe_kamar_id'); 

    }
    
    public function review()
    {
        return $this->hasMany('App\Models\Rating');
    }

    
}
