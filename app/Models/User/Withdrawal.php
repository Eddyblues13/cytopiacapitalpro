<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $fillable = [
        'user_id',
        'account_type',
        'crypto_currency',
        'amount',
        'wallet_address',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
