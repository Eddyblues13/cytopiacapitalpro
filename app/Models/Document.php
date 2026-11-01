<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'user_id',
        'id_card_path',
        'passport_photo_path',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
