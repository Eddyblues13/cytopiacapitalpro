<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TradingHistory extends Model
{
    protected $fillable = [
        'user_id',      // ID of the user who copied the trade
        'trader_id',    // ID of the trader whose trade was copied
        'amount',       // Amount used for the trade
        'status',       // Status of the trade (e.g., pending, success, failed)
    ];

    /**
     * Get the user associated with the trading history.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the trader associated with the trading history.
     */
    public function trader()
    {
        return $this->belongsTo(Trader::class);
    }
}
