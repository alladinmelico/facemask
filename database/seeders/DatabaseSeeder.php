<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TagSeeder::class,
            UserSeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
            FollowerSeeder::class,
            ChatSeeder::class,
            MessageSeeder::class
        ]);
    }
}