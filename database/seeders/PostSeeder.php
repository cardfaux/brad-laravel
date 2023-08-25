<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->insert([
            'user_id' => 100,
            'title' => 'My First Post',
            'body' => 'Lorem ipsum this is my post.',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('posts')->insert([
            'user_id' => 100,
            'title' => 'My Second Post: HTML',
            'body' => 'HTML stands for Hyper Text Markup Language',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('posts')->insert([
            'user_id' => 200,
            'title' => 'Being a Dog Is Fun',
            'body' => 'I like to run and bark.',
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
