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
use App\Save;
use Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $films = Film::withCount('episodes')->with('votes')->orderBy('created_at', 'DESC')->get();
        $singleFilm = $films->filter(function ($value) {

            return $value->episodes_count == 1;
        })->take(config('setting.take_film.homepage'));
        $seriesFilm = $films->filter(function ($value) {

            return $value->episodes_count > 1;
        })->take(config('setting.take_film.homepage'));

        return view('client.homepage', compact('singleFilm', 'seriesFilm'));
    }

    public function showFilmByMenu($id)
    {
        $menu = Menu::select('name')->where('id', $id)->firstOrFail();
        $filmByMenu = Menu::find($id)->films()->orderBy('created_at', 'DESC')->paginate(config('app.pagination'));

        return view('client.filmbymenupage', compact('menu', 'filmByMenu'));
    }

    public function show($id)
    {
        $details = Film::with('episodes')->findOrFail($id);
        $favorite = false;
        if (Auth::check()) {
            if (Save::where([
                ['film_id', '=', $details->id],
                ['user_id', '=', Auth::id()],
            ])->first()) {
                $favorite = true;
            };
        }
        $slug = $details->episodes->first();
        if ($slug) {
            $slug = $details->episodes->first()->slug;
        } else {
            $slug = Null;
        }
        $votes = round($details->votes->avg('point'), 1);
        $voteOfUser = [];
        if (Auth::check()) {
            $voteOfUser = Vote::where('user_id', Auth::id())->where('film_id', $details->id)->first();
        }
        if (request()->ajax()) {
            return response()->json($votes);
        }
        
        $actors = $details->actors;

        // Get genres of film
        $genres = Film::findOrFail($id)->menus()
            ->distinct('menu_id')
            ->take(config('setting.take_genre.detail_page'))
            ->get();

        $genres_id = [];
        foreach ($genres as $genre) {
            array_push($genres_id, $genre->id);
        }

        // Get all film of menu in film details where film_id <> $details->id
        $filmOfMenu = Film::with([
            'menus' => function ($query) use ($genres_id) {
                $query->whereIn('menu_id', $genres_id);
            }
        ])
            ->where('id', '<>', $id)
            ->take(config('setting.take_film.film_relate'))
            ->get();

        $countries = $details->country()->get();
        $comments = Comment::with('user')
            ->where('film_id', $id)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('client.detail', compact('details', 'votes', 'actors', 'genres', 'countries', 'comments', 'filmOfMenu', 'slug', 'favorite', 'voteOfUser'));
    }

    //save favorite film
    public function saveFavoriteFilm($id)
    {
        $user_id = Auth::id();
        Save::create(
            [
                'user_id' => $user_id,
                'film_id' => $id,
            ]
        );

        return redirect()->back()->with('msg', __('Add favourite successfully'));
    }
    //remove favorite film
    public function removeFavoriteFilm($id)
    {
        $user_id = Auth::id();
        $filmsave = User::find($user_id)->saves->where('film_id', $id)->first();
        Save::find($filmsave->id)->delete();

        return redirect()->back()->with('msg', __('Remove favourite successfully'));
    }

    //Vote
    public function vote(Request $request)
    {
        if ($request->ajax()) {
            Vote::updateOrCreate([
                'user_id' => Auth::id(),
                'film_id' => $request->film_id,
            ],
            [
                'point' => $request->point,
                'user_id' => Auth::id(),
                'film_id' => $request->film_id,
            ]
        );
        }

        return response()->json();
    }

    //Actor detail
    public function actorDetail(Actor $actor)
    {
        $data = $actor->films;
        $defaultImg = $actor->img == null ? asset(config('setting.client_image.placeholder') . 'placeholder.png') : $actor->img;

        return view('client.actor', compact('data', 'actor', 'defaultImg'));
    }

}
