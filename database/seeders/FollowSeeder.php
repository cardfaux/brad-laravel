<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FollowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('follows')->insert([
            'user_id' => 200,
            'followeduser' => 100
        ]);

        DB::table('follows')->insert([
            'user_id' => 300,
            'followeduser' => 100
        ]);

        DB::table('follows')->insert([
            'user_id' => 300,
            'followeduser' => 200
        ]);
    }
}
