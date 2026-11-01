<?php

namespace Database\Seeders;

use App\Models\Admin\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create the admin login, or reset its name and password if it already exists.
        // Override the defaults with ADMIN_NAME, ADMIN_EMAIL and ADMIN_PASSWORD in .env.
        Admin::updateOrCreate(
            ['email' => env('ADMIN_EMAIL') ?: 'admin@mail.com'],
            [
                'name' => env('ADMIN_NAME') ?: 'Admin Admin',
                'password' => Hash::make(env('ADMIN_PASSWORD') ?: '12345678'),
            ]
        );
    }
}
