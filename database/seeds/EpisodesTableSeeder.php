<?php

use Illuminate\Database\Seeder;

class EpisodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Episode::class, 20)->create([
            'url' => 'https://www.youtube.com/watch?v=ZIr3hTJDo8s&t=0s',
            'slug' => 'slug_film'
    	]);
    }
}
