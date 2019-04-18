<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Film;
use App\Episode;
use\App\Comment;

class PlayerController extends Controller
{
    public function showEpisodes($id, $slug)
    {
    	$epBySlug = Episode::with('film')->where('film_id', $id)->where('slug', $slug)->firstOrFail();
    	$comments = Comment::with('user')->where('film_id', $id)->orderBy('created_at', 'DESC')->get();
    	$epOfFilm = Film::findOrFail($id)->episodes;

    	return view('client.player', compact('epBySlug', 'epOfFilm', 'comments'));
    }
}
