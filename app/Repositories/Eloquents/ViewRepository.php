<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\FilmRepositoryInterface;
use App\Film;

/**
 * 
 */
class ViewRepository implements FilmRepositoryInterface
{
    
    public function all()
    {
        # code...
    }

    public function getTotalView($id)
    {
        $views = Film::findOrFail($id)->views()->get()->sum('views');

        return $views;
    }
}
