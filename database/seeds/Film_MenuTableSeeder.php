<?php

use Illuminate\Database\Seeder;

class Film_MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 500;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('film_menu')->insert([
                'film_id' => $faker->numberBetween($min = 1, $max = 20),
                'menu_id' => $faker->numberBetween($min = 1, $max = 20)
            ]);
        }
    }
}
