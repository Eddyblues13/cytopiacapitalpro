<?php

namespace App\Models\User;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class PlanHistory extends Model
{
    protected $fillable = [
        'user_id',
        'plan_id',
        'amount',
        'account_type',
    ];

    // Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship to Plan
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
