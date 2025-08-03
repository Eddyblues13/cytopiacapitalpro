<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trader extends Model
{


    protected $table = 'traders';

    protected $fillable = [
        'name',
        'followers',
        'return_rate',
        'min_amount',
        'max_amount',
        'profit_share',
        'is_verified',
        'picture_url',
        'picture_public_id'
    ];
}
