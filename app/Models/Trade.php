<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'symbol',
        'type',
        'direction',
        'entry_price',
        'exit_price',
        'amount',
        'profit',
        'status',
        'entry_date',
        'exit_date',
        'trader_name',
        'notes'
    ];

    protected $casts = [
        'entry_date' => 'datetime',
        'exit_date' => 'datetime',
        'entry_price' => 'float',
        'exit_price' => 'float',
        'amount' => 'float',
        'profit' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getSymbolIconAttribute()
    {
        // Get first 3 uppercase letters from symbol
        $symbol = substr(strtoupper(preg_replace('/[^a-zA-Z]/', '', $this->symbol)), 0, 3);

        // Fallback if symbol is too short
        if (strlen($symbol) < 3) {
            $symbol = str_pad($symbol, 3, 'BTC');
        }

        return "https://s3-symbol-logo.tradingview.com/crypto/XTVC{$symbol}--big.svg";
    }

    public function getFormattedProfitAttribute()
    {
        $currencySymbol = config('currencies.' . $this->user->currency, '$');
        return $currencySymbol . number_format($this->profit, 2);
    }

    public function getFormattedAmountAttribute()
    {
        $currencySymbol = config('currencies.' . $this->user->currency, '$');
        return $currencySymbol . number_format($this->amount, 2);
    }

    public function getFormattedEntryPriceAttribute()
    {
        return number_format($this->entry_price, 4);
    }

    public function getFormattedExitPriceAttribute()
    {
        return $this->exit_price ? number_format($this->exit_price, 4) : null;
    }
}
