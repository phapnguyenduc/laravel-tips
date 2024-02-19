<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all()->take(1000);
        $faker = Faker::create();
        foreach ($users as $user)
        {
            Post::create([
                'title' => $faker->sentence,
                'content' => $faker->paragraph,
                'user_id' => $user->id
            ]);
        }
    }
}
