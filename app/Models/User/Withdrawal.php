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
        'bank_details',
        'status',
        'withdrawal_method'
    ];

    protected $casts = [
        'bank_details' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
