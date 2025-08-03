<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class TradingBalance extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
