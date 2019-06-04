<?php

namespace App\Repositories\Contracts;

interface FilmRepositoryInterface
{
    public function all();

    public function getTotalView($id);

    public function getSingleFilm();

    public function getSeriesFilm();

    public function find($id);

    public function getGenreFilm($id);

    public function getFilmRelate($id, $genre_id);

    public function getComment($id);
}
