<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->text(30),
        'description' => $faker->text,
        'price' => mt_rand (1, 100000) / 100,
        'category_id' => $faker->numberBetween(1, 4),
        'user_id' => $faker->numberBetween(1, 50),
    ];
});
