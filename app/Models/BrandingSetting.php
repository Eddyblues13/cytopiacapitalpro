<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandingSetting extends Model
{
    protected $fillable = [
        'logo',
        'footer_logo',
        'email_logo',
        'favicon',
    ];
}
