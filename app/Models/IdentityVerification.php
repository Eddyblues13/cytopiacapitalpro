<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IdentityVerification extends Model
{

    protected $fillable = [
        'user_id',
        'front_photo_url',
        'front_photo_public_id',
        'back_photo_url',
        'back_photo_public_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
