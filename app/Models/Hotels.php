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

    public function tipeKamars()
    {
        return $this->hasMany(TipeKamar::class);
    }
    // Model Hotel


}
