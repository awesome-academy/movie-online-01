<?php

namespace App\Http\Controllers;

use App\Episode;
use App\Film;
use App\Http\Requests\CommentRequest;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Redis;
use \App\Comment;

class PlayerController extends Controller
{
    public function showEpisodes($id, $slug)
    {
        $key = 'viewed_films' . $id;
        $value = md5($id);
        $time = Carbon::now()->toDateString();
        if (!Session::has($key)) {
            Session::put($key, $value);
            if (Redis::get('view:film_id_' . $id . ':' . $time)) {
                Redis::incr('view:film_id_' . $id . ':' . $time);
            } else {
                Redis::set('view:film_id_' . $id . ':' . $time, 1);
            }
        }
        $views_day = Redis::get('view:film_id_' . $id . ':' . $time);
        $epBySlug = Episode::with('film')->where('film_id', $id)->where('slug', $slug)->firstOrFail();
        $comments = Comment::with('user')->where('film_id', $id)->orderBy('created_at', 'DESC')->get();
        $epOfFilm = Film::findOrFail($id)->episodes()->orderBy('slug')->get();
        $film = Film::findOrFail($id);

        return view('client.player', compact('epBySlug', 'epOfFilm', 'comments', 'film', 'views_day'));
    }

    public function comment(CommentRequest $request)
    {
        $user = Auth::user();
        Comment::create(
            [
                'user_id' => $user->id,
                'film_id' => $request->film_id,
                'content' => $request->comment,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        return redirect()->back();;
    }
}
