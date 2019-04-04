<?php

use App\Comment;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween($min = 1, $max = 20),
        'film_id' => $faker->numberBetween($min = 1, $max = 20),
        'content' => $faker->realText($maxNbChars = 100),
       	'created_at' => $faker->dateTime(),
    	'updated_at' => $faker->dateTime()
    ];
});
