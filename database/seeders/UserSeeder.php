<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id' => 100,
            'username' => 'Admin',
            'isAdmin' => 1,
            'avatar' => 'https://i.imgur.com/6VBx3io.png',
            'email' => "admin@gmail.com",
            'email_verified_at' => null,
            'password' => Hash::make('password123'),
            'remember_token' => null,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('users')->insert([
            'id' => 200,
            'username' => 'Agent',
            'isAdmin' => 0,
            'avatar' => 'https://i.imgur.com/6VBx3io.png',
            'email' => "agent@gmail.com",
            'email_verified_at' => null,
            'password' => Hash::make('password123'),
            'remember_token' => null,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('users')->insert([
            'id' => 300,
            'username' => 'User',
            'isAdmin' => 0,
            'avatar' => 'https://i.imgur.com/6VBx3io.png',
            'email' => "user@gmail.com",
            'email_verified_at' => null,
            'password' => Hash::make('password123'),
            'remember_token' => null,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('users')->insert([
            'id' => 400,
            'username' => 'Host',
            'isAdmin' => 0,
            'avatar' => 'https://i.imgur.com/6VBx3io.png',
            'email' => "host@gmail.com",
            'email_verified_at' => null,
            'password' => Hash::make('password123'),
            'remember_token' => null,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);
    }
}
