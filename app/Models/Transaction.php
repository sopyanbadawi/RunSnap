<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi ke user yang melakukan transaksi
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke foto-foto yang dibeli dalam transaksi ini
    public function purchasedPhotos()
    {
        return $this->hasMany(PurchasedPhoto::class);
    }
}
