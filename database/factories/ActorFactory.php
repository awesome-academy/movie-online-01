<?php

use App\Actor;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Actor::class, function (Faker $faker) {
    return [
        'name_vn' => $faker->name,
        'name_real' => $faker->lastName,
        'birthday' => $faker->date($format = 'Y-m-d', $max = '1997'),
        'location' => $faker->address,
        'img' => $faker->imageUrl($width = 100, $height = 100),
       	'created_at' => $faker->dateTime(),
    	'updated_at' => $faker->dateTime()
    ];
});
