<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        $plans = [
            [
                'id' => 1,
                'name' => 'Basic',
                'price' => 1000.00,
                'swap_fee' => 1,
                'pairs' => 200,
                'leverage' => '1:500',
                'spread' => '1.2 pips',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'name' => 'Silver',
                'price' => 10000.00,
                'swap_fee' => 1,
                'pairs' => 300,
                'leverage' => '1:500',
                'spread' => '0.8 pips',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 3,
                'name' => 'Gold',
                'price' => 100000.00,
                'swap_fee' => 0,
                'pairs' => 400,
                'leverage' => '1:500',
                'spread' => '0.8 pips',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 4,
                'name' => 'Premium',
                'price' => 300000.00,
                'swap_fee' => 0,
                'pairs' => 500,
                'leverage' => '1:500',
                'spread' => '0.3 pips',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 5,
                'name' => 'Elite',
                'price' => 500000.00,
                'swap_fee' => 0,
                'pairs' => 600,
                'leverage' => '1:600',
                'spread' => '0.2 pips',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 6,
                'name' => 'Titanium',
                'price' => 750000.00,
                'swap_fee' => 0,
                'pairs' => 700,
                'leverage' => '1:700',
                'spread' => '0.2 pips',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 7,
                'name' => 'Diamond',
                'price' => 1000000.00,
                'swap_fee' => 0,
                'pairs' => 800,
                'leverage' => '1:800',
                'spread' => '0.1 pips',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 8,
                'name' => 'Ultimate',
                'price' => 1500000.00,
                'swap_fee' => 0,
                'pairs' => 900,
                'leverage' => '1:1000',
                'spread' => '0.1 pips',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 9,
                'name' => 'Infinite',
                'price' => 2000000.00,
                'swap_fee' => 0,
                'pairs' => 1000,
                'leverage' => '1:1500',
                'spread' => '0.05 pips',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 10,
                'name' => 'Legendary',
                'price' => 5000000.00,
                'swap_fee' => 0,
                'pairs' => 1200,
                'leverage' => '1:2000',
                'spread' => '0.01 pips',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('plans')->insert($plans);
    }
}
