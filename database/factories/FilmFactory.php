<?php

use App\Film;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Film::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween($min = 1, $max = 20),
        'title_en' => $faker->realText($maxNbChars = 20),
        'title_vn' => $faker->realText($maxNbChars = 20),
        'thumb' => $faker->imageUrl($width = 640, $height = 480),
        'director' => $faker->name,
        'country_id' => $faker->numberBetween($min = 10, $max = 20),
        'year' => $faker->year($max = 'now'),
        'duration' => $faker->numberBetween($min = 120, $max = 200),
        'description' => $faker->text($maxNbChars = 500),
        'language' => $faker->country,
       	'created_at' => $faker->dateTime(),
    	'updated_at' => $faker->dateTime()
	];
});
