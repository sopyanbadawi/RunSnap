<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasedPhoto extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Pembeli foto
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Foto yang dibeli
    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

    // Transaksi yang menaungi pembelian ini
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
