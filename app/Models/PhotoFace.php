<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoFace extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo_id',
        'bounding_box',
        'face_embedding',
    ];

    protected $casts = [
        'bounding_box' => 'array',
        'face_embedding' => 'array',
    ];

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }
}
