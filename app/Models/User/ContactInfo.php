<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactInfo extends Model
{

    protected $fillable = [
        'user_id',
        'mobile_number',
        'street_address',
        'zip_code',
        'city',
        'state',
        'country',
        'utility_bill_url',
        'utility_bill_public_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
