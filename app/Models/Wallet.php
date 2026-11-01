<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = [
        'wallet_name',
        'wallet_address',
        'barcode',
    ];
}
