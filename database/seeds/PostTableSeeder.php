<?php

use App\Post;
use Illuminate\Database\Seeder;


class PostTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker\Factory::create();
        foreach (range(1, 100) as $index) {
            Post::create([
                'type' => $faker->randomNumber(),
                'topic_id' => $faker->randomNumber(),
                'user_id' => $faker->randomNumber(),
                'text' => $faker->paragraph(),
                'images' => $faker->text(),
                'likes_count' => $faker->randomNumber(),
                'comments_count' => $faker->randomNumber(),
            ]);
        }
    }

}
