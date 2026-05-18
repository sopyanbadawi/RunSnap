<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi ke event tempat foto ini diambil
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Relasi ke data pembelian
    public function purchasedPhotos()
    {
        return $this->hasMany(PurchasedPhoto::class);
    }

    // Relasi ke fotografer yang mengunggah
    public function fotografer()
    {
        return $this->belongsTo(User::class, 'fotografer_id');
    }
}
