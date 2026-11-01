<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'stock_name',
        'picture',
        'stock_min_amount',
        'stock_max_amount',
        'stock_js',
        'stock_graph',
        'top_up_amount',
        'top_up_interval',
        'top_up_type',
        'top_up_status',
        'investment_duration',
        'performance',
        'copier_roi',
        'years_of_experience',
        'description',
    ];
}
