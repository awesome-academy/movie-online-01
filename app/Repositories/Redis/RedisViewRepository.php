<?php

namespace App\Repositories\Redis;

use App\Film;
use App\Comment;
use App\Repositories\Contracts\FilmRepositoryInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redis;
use League\Flysystem\Exception;

/**
 * 
 */
class RedisViewRepository implements FilmRepositoryInterface
{
    
    public function all()
    {
        $ip = \Request::ip();
        $key = 'RedisViewRepository:list_film:' . $ip;
        if (Redis::keys($key)) {
            $data = json_decode(Redis::get($key));
        } else {
            $films = Film::withCount('episodes')->with('votes')->orderBy('created_at', 'DESC')->get();
            Redis::set($key, $films, 'EX', 10);
            $data = json_decode(Redis::get($key));
        }
        
        return collect($data);
    }

    public function getTotalView($id)
    {
        $redis = Redis::connection();
        $key = $redis->keys('view:film_id_' . $id . ':*');
        if (!$key) {
            $time = Carbon::now()->toDateString();
            $key[] = Redis::set('view:film_id_' . $id . ':' . $time, 0);
        }

        foreach ($key as $value) {
            $views[] = Redis::get($value);
        }
        
        return array_sum($views);
    }

    public function getSingleFilm()
    {
        $singleFilm = $this->all()->filter(function ($value) {

            return $value->episodes_count == 1;
        })->take(config('setting.take_film.homepage'));

        return $singleFilm;
    }

    public function getSeriesFilm()
    {
        $seriesFilm = $this->all()->filter(function ($value) {

            return $value->episodes_count > 1;
        })->take(config('setting.take_film.homepage'));

        return $seriesFilm;
    }

    public function find($id)
    {
        $films = Film::findOrFail($id);

        return $films;
    }

    public function getGenreFilm($id)
    {
        $genres = Film::findOrFail($id)->menus()
            ->distinct('menu_id')
            ->take(config('setting.take_genre.detail_page'))
            ->get();

        return $genres;
    }

    public function getFilmRelate($id, $genre_id)
    {
        $filmOfMenu = Film::with([
            'menus' => function ($query) use ($genre_id) {
                $query->whereIn('menu_id', $genre_id);
            }
        ])
            ->where('id', '<>', $id)
            ->take(config('setting.take_film.film_relate'))
            ->get();

        return $filmOfMenu;
    }

    public function getComment($id)
    {
        $comments = Comment::with('user')
            ->where('film_id', $id)
            ->orderBy('created_at', 'DESC')
            ->get();

        return $comments;
    }
}
