<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(FilmsTableSeeder::class);
        $this->call(Film_MenuTableSeeder::class);
        $this->call(EpisodesTableSeeder::class);
        $this->call(ActorsTableSeeder::class);
        $this->call(Actor_FilmTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
    }
}
