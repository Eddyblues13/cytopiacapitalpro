<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        // Clear the table first
        DB::table('admins')->truncate();

        $admins = [
            [
                'id' => 1,
                'name' => 'Admin Admin',
                'email' => 'admin@mail.com',
                'email_verified_at' => null,
                'password' => Hash::make('12345678'), // New hashed password
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('admins')->insert($admins);
    }
}
