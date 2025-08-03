<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Deposit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'account_type', 
        'status',
    ];

    /**
     * Relationship: A deposit belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
