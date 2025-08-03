<?php

namespace App\Models\Admin;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}
