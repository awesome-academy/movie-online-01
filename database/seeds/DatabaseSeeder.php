<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	Model::unguard();
        $this->call(UsersTableSeeder::class);
        $this->call(FilmsTableSeeder::class);
        $this->call(Film_MenuTableSeeder::class);
        $this->call(EpisodesTableSeeder::class);
        $this->call(ActorsTableSeeder::class);
        $this->call(Actor_FilmTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        Model::reguard();
    }
}
