<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Film;
use App\Episode;
use Auth;
use Illuminate\Support\Str;
use App\Http\Requests\EpisodeRequest;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
    	$film = Film::findOrFail($id);

        return view('backend.episode.create', compact('film'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EpisodeRequest $request, $film_id)
    {
        $url = str_after(request()->url, '=');
        $slug = Str::slug(request()->name, '-');
        $user_id = Auth::user()->id;

        Episode::create([
            'name' => request('name'),
            'url' => $url,
            'slug' => $slug,
            'user_id' => $user_id,
            'film_id' => $film_id,
        ]);
        
        return redirect()->route('film.show', $film_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Episode $episode)
    {
        return view('backend.episode.edit', compact('episode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EpisodeRequest $request, $film_id, $episode)
    {
        $url = str_after(request()->url, '=');
        $slug = Str::slug(request()->name, '-');
        $user_id = Auth::user()->id;

        Episode::whereId($episode)->update([
            'name' => request('name'),
            'url' => $url,
            'slug' => $slug,
            'user_id' => $user_id,
            'film_id' => $film_id,
        ]);

        return redirect()->route('film.show', $film_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($film_id, Episode $episode)
    {
        $episode->delete();

        return redirect()->route('film.show', $film_id);
    }
}
