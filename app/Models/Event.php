<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    // Relasi ke penyelenggara (EO/User)
    public function eo()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke foto-foto event ini
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}
