<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Film;
use App\User;
use App\Episode;
use App\Menu;
use App\Vote;
use App\Actor;
use App\Comment;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $films = Film::withCount('episodes')->orderBy('created_at', 'DESC')->get();
        $singleFilm = $films->filter(function ($value) {
            
            return $value->episodes_count == 1;
        })->take(config('setting.take_film.homepage'));
        $seriesFilm = $films->filter(function ($value) {
            
            return $value->episodes_count > 1;
        })->take(config('setting.take_film.homepage'));

        return view('client.homepage', compact('singleFilm', 'seriesFilm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $details = Film::with('episodes')->findOrFail($id);
        // return $details;
        $slug = $details->episodes->first();
        if ($slug) {
            $slug = $details->episodes->first()->slug;
        } else {
            $slug = Null;
        }
        $votes = round($details->votes->avg('point'), 1);
        $actors = $details->actors;

        // Get menus of film
        $genres = $details->menus;

        // Get all film of menu in film details where film_id <> $details->id
        $filmOfMenu = [];
        foreach ($genres as $genre) {
            array_push($filmOfMenu, Menu::find($genre->id)->films->where('id', '<>', $details->id));
        }
        $countries = $details->country()->get();
        $comments = Comment::with('user')->where('film_id', $id)->orderBy('created_at', 'DESC')->get();

        return view('client.detail', compact('details', 'votes', 'actors', 'genres', 'countries', 'comments', 'filmOfMenu', 'slug'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
