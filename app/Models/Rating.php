<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'user_id',
        'tipe_kamar_id',
        'rating',
        'comment',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function tipekamar()
    {
        return $this->belongsTo('App\Models\TipeKamar');
    }

}
