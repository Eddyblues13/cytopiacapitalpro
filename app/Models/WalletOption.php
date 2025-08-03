<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletOption extends Model
{
    protected $fillable = [
        'coin_code',
        'coin_name',
        'wallet_name',
        'wallet_type',
        'icon',
        'wallet_address',
        'network_type',
    ];
}
