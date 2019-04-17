<?php

use Faker\Generator as Faker;
use App\Vote;

$factory->define(Vote::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 20),
        'film_id' => $faker->numberBetween(1, 20),
        'point' => $faker->numberBetween(1, 5),
    ];
});
