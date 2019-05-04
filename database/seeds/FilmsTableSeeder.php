<?php

use Illuminate\Database\Seeder;

class FilmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Film::class, 20)->create([
	    	'trailer' => 'JIYRD7nWiSE',
	        'language' => 'english',
            'quality' => 'high',
            'slug' => 'slug_film'
    	]);
    }
}
