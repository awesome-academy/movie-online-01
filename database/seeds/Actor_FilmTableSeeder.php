<?php

use Illuminate\Database\Seeder;

class Actor_FilmTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 20;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('actor_film')->insert([
                'film_id' => $faker->numberBetween($min = 1, $max = 20),
                'actor_id' => $faker->numberBetween($min = 1, $max = 20)
            ]);
        }
    }
}
