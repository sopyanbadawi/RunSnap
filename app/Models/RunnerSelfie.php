<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RunnerSelfie extends Model
{
    protected $fillable = [
        'user_id',
        'image_path',
        'face_embedding',
    ];

    protected $casts = [
        'face_embedding' => 'array',
    ];

    /**
     * Relationship: A selfie belongs to a user (runner).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
