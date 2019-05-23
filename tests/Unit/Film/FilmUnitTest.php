<?php

namespace Tests\Unit\Film;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use \App\Film;

class FilmUnitTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    
    /**
     * @test  
    */
    public function it_can_create_a_film()
    {
        $data = [
            'user_id' => $this->faker->randomDigit,
            'title_en' => $this->faker->word,
            'title_vn' => $this->faker->word,
            'thumb' => $this->faker->imageUrl(600, 800, 'cats'),
            'director' => $this->faker->name,
            'country_id' => $this->faker->randomDigit,
            'year' => $this->faker->year,
            'duration' => $this->faker->numberBetween(100, 300),
            'description' => $this->faker->text,
            'trailer' => 'k3MgSWyWsvI',
            'slug' => $this->faker->word,
            'language' => 'English',
            'quality' => 'HD 720p',
        ];
        $film = Film::create($data);
        $this->assertInstanceOf(Film::class, $film);
        $this->assertEquals($data['user_id'], $film->user_id);
        $this->assertEquals($data['title_en'], $film->title_en);
        $this->assertEquals($data['title_vn'], $film->title_vn);
        $this->assertEquals($data['thumb'], $film->thumb);
        $this->assertEquals($data['director'], $film->director);
        $this->assertEquals($data['country_id'], $film->country_id);
        $this->assertEquals($data['year'], $film->year);
        $this->assertEquals($data['duration'], $film->duration);
        $this->assertEquals($data['description'], $film->description);
        $this->assertEquals($data['trailer'], $film->trailer);
        $this->assertEquals($data['slug'], $film->slug);
        $this->assertEquals($data['language'], $film->language);
        $this->assertEquals($data['quality'], $film->quality);
    }

    /**
     * @test  
    */
    public function it_can_show_the_film()
    {
        $film = factory(Film::class)->create();
        $found = Film::findOrFail($film->id);

        $this->assertInstanceOf(Film::class, $found);
        $this->assertEquals($found->user_id, $film->user_id);
        $this->assertEquals($found->title_en, $film->title_en);
        $this->assertEquals($found->title_vn, $film->title_vn);
        $this->assertEquals($found->thumb, $film->thumb);
        $this->assertEquals($found->director, $film->director);
        $this->assertEquals($found->country_id, $film->country_id);
        $this->assertEquals($found->year, $film->year);
        $this->assertEquals($found->duration, $film->duration);
        $this->assertEquals($found->description, $film->description);
        $this->assertEquals($found->trailer, $film->trailer);
        $this->assertEquals($found->slug, $film->slug);
        $this->assertEquals($found->language, $film->language);
        $this->assertEquals($found->quality, $film->quality);
    }

    /**
     * @test  
    */
    public function it_can_update_the_film()
    {
        $film = factory(Film::class)->create();
        $data = [
            'user_id' => $this->faker->randomDigit,
            'title_en' => $this->faker->word,
            'title_vn' => $this->faker->word,
            'thumb' => $this->faker->imageUrl(600, 800, 'cats'),
            'director' => $this->faker->name,
            'country_id' => $this->faker->randomDigit,
            'year' => $this->faker->year,
            'duration' => $this->faker->numberBetween(100, 300),
            'description' => $this->faker->text,
            'trailer' => 'k3MgSWyWsvI',
            'slug' => $this->faker->word,
            'language' => 'English',
            'quality' => 'HD 720p',
        ];
        $this->assertInstanceOf(Film::class, $film);
        $film = Film::findOrFail($film->id);
        $success = $film->update($data);
        $this->assertTrue($success);
        $this->assertEquals($data['user_id'], $film->user_id);
        $this->assertEquals($data['title_en'], $film->title_en);
        $this->assertEquals($data['title_vn'], $film->title_vn);
        $this->assertEquals($data['thumb'], $film->thumb);
        $this->assertEquals($data['director'], $film->director);
        $this->assertEquals($data['country_id'], $film->country_id);
        $this->assertEquals($data['year'], $film->year);
        $this->assertEquals($data['duration'], $film->duration);
        $this->assertEquals($data['description'], $film->description);
        $this->assertEquals($data['trailer'], $film->trailer);
        $this->assertEquals($data['slug'], $film->slug);
        $this->assertEquals($data['language'], $film->language);
        $this->assertEquals($data['quality'], $film->quality);
    }

    /**
     * @test  
    */
    public function it_can_delete_the_film()
    {
        $film = factory(Film::class)->create();
        $film = Film::findOrFail($film->id);
        $delete = $film->delete();
        $this->assertTrue($delete);
    }
}
