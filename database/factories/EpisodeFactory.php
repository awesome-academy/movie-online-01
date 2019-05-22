<?php

use App\Episode;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Episode::class, function (Faker $faker) {
    return [
        'film_id' => $faker->numberBetween($min = 1, $max = 20),
        'user_id' => $faker->numberBetween($min = 1, $max = 20),
        'name' => $faker->name,
        'url' => 'ZIr3hTJDo8s',
        'slug' => Str::slug($faker->name, '-'),
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime(),
    ];
});
