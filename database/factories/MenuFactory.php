<?php

use App\Menu;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Menu::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'slug' => Str::slug($faker->name, '-'),
        'parent_id' => $faker->numberBetween($min = 1, $max = 3),
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime(),
    ];
});
