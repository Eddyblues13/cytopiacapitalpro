<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Bronze',
                'price' => 1000.00,
                'swap_fee' => true,
                'pairs' => 200,
                'leverage' => '1:500',
                'spread' => '1.2 pips',
            ],
            [
                'name' => 'Silver',
                'price' => 30000.00,
                'swap_fee' => true,
                'pairs' => 300,
                'leverage' => '1:500',
                'spread' => '0.8 pips',
            ],
            [
                'name' => 'Gold',
                'price' => 60000.00,
                'swap_fee' => false,
                'pairs' => 400,
                'leverage' => '1:500',
                'spread' => '0.8 pips',
            ],
            [
                'name' => 'Premium',
                'price' => 400000.00,
                'swap_fee' => false,
                'pairs' => 500,
                'leverage' => '1:500',
                'spread' => '0.3 pips',
            ],
        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}
