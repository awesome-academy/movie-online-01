<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Episode;
use App\Film;
use App\Menu;
use App\Repositories\Contracts\FilmRepositoryInterface;
use App\Save;
use App\User;
use App\Vote;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $viewRepository;

    public function __construct(FilmRepositoryInterface $viewRepository)
    {
        $this->viewRepository = $viewRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $singleFilm = $this->viewRepository->getSingleFilm();
        $seriesFilm = $this->viewRepository->getSeriesFilm();

        return view('client.homepage', compact('singleFilm', 'seriesFilm'));
    }

    public function showFilmByMenu($id)
    {
        $menu = Menu::select('name')->where('id', $id)->firstOrFail();
        $filmByMenu = Menu::find($id)->films()->orderBy('created_at', 'DESC')->groupBy('film_id')->paginate(config('app.pagination'));

        return view('client.filmbymenupage', compact('menu', 'filmByMenu'));
    }

    public function show($id)
    {
        $details = $this->viewRepository->find($id);
        $views = $this->viewRepository->getTotalView($id);
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
        $genres = $this->viewRepository->getGenreFilm($id);

        $genres_id = [];
        foreach ($genres as $genre) {
            array_push($genres_id, $genre->id);
        }

        // Get all film of menu in film details where film_id <> $details->id
        $filmOfMenu = $this->viewRepository->getFilmRelate($id, $genres_id);

        $countries = $details->country()->get();
        $comments = $this->viewRepository->getComment($id);

        return view('client.detail', compact('details', 'votes', 'actors', 'genres', 'countries', 'comments', 'filmOfMenu', 'slug', 'favorite', 'voteOfUser', 'views'));
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

        return redirect()->back()->with('msg', __('label.add_success'));
    }
    //remove favorite film
    public function removeFavoriteFilm($id)
    {
        $user_id = Auth::id();
        $filmsave = User::find($user_id)->saves->where('film_id', $id)->first();
        Save::find($filmsave->id)->delete();

        return redirect()->back()->with('msg', __('label.remove_success'));
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

    public function changeLanguage($language)
    {
        \Session::put('change_language', $language);

        return redirect()->back();
    }

}
