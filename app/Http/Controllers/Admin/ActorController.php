<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actor;
use Illuminate\Support\Str;
use App\Http\Requests\ActorRequest;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actors = Actor::orderBy('updated_at', 'DESC')->get();
        $updateLatest = Actor::orderBy('updated_at', 'DESC')->firstOrFail();

        return view('backend.actor.list', compact('actors', 'updateLatest'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.actor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActorRequest $request, Actor $actor)
    {
        if ($request->real_name) {
            $slug = Str::slug(request()->real_name, '-');
        } else {
            $slug = Str::slug(request()->stage_name, '-');
        }
        
        if ($request->hasFile('img')) {
            $fileName = uniqid() . '.' . $request->img->extension();
            $path = $request->img->storeAs('images/actor', $fileName);
        }

        Actor::create([
            'name_vn' => request('stage_name'),
            'name_real' => request('real_name'),
            'birthday' => request('birthday'),
            'location' => request('location'),
            'slug' => $slug,
            'img' => $path,
        ]);

        return redirect()->route('actor.index')->with('msg', __('Actor created successfully.'));
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
    public function edit(Actor $actor)
    {
        $defaultImg = $actor->img == null ? asset(config('setting.client_image.placeholder') . 'placeholder.png') : $actor->img;
        
        return view('backend.actor.edit', compact('defaultImg', 'actor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ActorRequest $request, Actor $actor)
    {
        if ($request->real_name) {
            $slug = Str::slug(request()->real_name, '-');
        } else {
            $slug = Str::slug(request()->stage_name, '-');
        }

        if ($request->hasFile('img')) {
            $fileName = uniqid() . '.' . $request->img->extension();
            $path = $request->img->storeAs('images/actor', $fileName);
            $actor->update(['img' => $path]);
        }

        $actor->update([
            'name_vn' => request('stage_name'),
            'name_real' => request('real_name'),
            'birthday' => request('birthday'),
            'location' => request('location'),
            'slug' => $slug,
        ]);

        return redirect()->route('actor.index')->with('msg', __('Actor ' . $actor->id . ' updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Actor $actor)
    {
        $actor->delete();

        return redirect()->route('actor.index')->with('msg', __('Actor ' . $actor->id . ' deleted successfully.'));
    }
}
