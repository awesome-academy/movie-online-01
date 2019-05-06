<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Film;
use App\Episode;
use \App\Comment;
use Auth;
use App\Http\Requests\CommentRequest;

class PlayerController extends Controller
{
    public function showEpisodes($id, $slug)
    {
        $epBySlug = Episode::with('film')->where('film_id', $id)->where('slug', $slug)->firstOrFail();
        $comments = Comment::with('user')->where('film_id', $id)->orderBy('created_at', 'DESC')->get();
        $epOfFilm = Film::findOrFail($id)->episodes()->orderBy('slug')->get();
        $film = Film::findOrFail($id);

        return view('client.player', compact('epBySlug', 'epOfFilm', 'comments', 'film'));
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
