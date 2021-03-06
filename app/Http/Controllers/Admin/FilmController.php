<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Film;
use App\Country;
use App\Menu;
use App\Actor;
use Illuminate\Support\Str;
use Auth;
use App\Http\Requests\FilmRequest;
use DB;
use Storage;

class FilmController extends Controller
{
    public function index()
    {
        $films = Film::with('uploadByUser')->with('country')->orderBy('updated_at', 'DESC')->get();
        $updateLatest = Film::orderBy('updated_at', 'DESC')->firstOrFail();

        return view('backend.film.list', compact('films', 'updateLatest'));
    }

    public function create()
    {
        $countries = Country::all();
        $menus = Menu::where('parent_id', '>', 0)->orderBy('name', 'ASC')->get();
        $actors = Actor::orderBy('name_real', 'ASC')->get();

        return view('backend.film.create', compact('countries', 'menus', 'actors'));
    }

    public function store(FilmRequest $request, Film $films)
    {
        DB::beginTransaction();
        try {
            $films->fill($request->all());
            $userId = Auth::user()->id;
            $films->user_id = $userId;

            if ($request->title_en) {
                $slug = Str::slug(request()->title_en, '-');
            } else {
                $slug = Str::slug(request()->title_vn, '-');
            }
            $films->slug = $slug;

            $trailer = str_after(request()->trailer, '=');
            $films->trailer = $trailer;

            if ($request->hasFile('img')) {
                $extension = $request->img->getClientOriginalExtension();
                $name_original = $request->img->getClientOriginalName();
                $file = config('app.destination_file') . $name_original;
                $fileName = uniqid() . '.' . $extension;
                Storage::cloud()->put($fileName, fopen($file, 'r'));
                //get the id_image from google driver
                $filename = $fileName;
                $dir = '/';
                $recursive = false; // Get subdirectories also?
                $contents = collect(Storage::cloud()->listContents($dir, $recursive));
                $file = $contents
                    ->where('type', '=', 'file')
                    ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
                    ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
                    ->first(); // there can be duplicate file names!
                $films->thumb = $file['path']; // add id_image from google driver to film table
            }

            $films->save();

            // Insert menu_id from Create Film Page to table film_menu with latest film_id
            $film = Film::findOrFail($films->latest()->first()->id);
            if ($request->menu) {
                foreach ($request->menu as $menu) {
                    $film->menus()->attach($menu);
                }
            }

            // Insert actor_id from Create Film Page to table film_actor with latest film_id
            if ($request->actor) {
                foreach ($request->actor as $actor) {
                    $film->actors()->attach($actor);
                }
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new Exception($e->getMessage());
        }

        return redirect()->route('film.index');
    }

    public function show(Film $film)
    {
        $film = Film::with('episodes.user')->findOrFail($film->id);

        return view('backend.film.showEpisode', compact('film'));
    }

    public function edit(Film $film)
    {
        $defaultImg = $film->thumb == null ? asset(config('setting.client_image.placeholder') . 'placeholder.png') : config('setting.img_path_film') . $film->thumb;
        $countries = Country::all();
        $menus = Menu::where('parent_id', '>', 0)->orderBy('name', 'ASC')->get();
        $actors = Actor::orderBy('name_real', 'ASC')->get();

        return view('backend.film.edit', compact('film', 'countries', 'menus', 'actors', 'defaultImg'));
    }

    public function update(FilmRequest $request, Film $film)
    {
        DB::beginTransaction();
        try {
            $film->fill($request->all());
            $userId = Auth::user()->id;
            $film->user_id = $userId;

            if ($request->title_en) {
                $slug = Str::slug(request()->title_en, '-');
            } else {
                $slug = Str::slug(request()->title_vn, '-');
            }
            $film->slug = $slug;

            $trailer = str_after(request()->trailer, '=');
            $film->trailer = $trailer;

            if ($request->hasFile('img')) {
                $extension = $request->img->getClientOriginalExtension();
                $name_original = $request->img->getClientOriginalName();
                $file = config('app.destination_file') . $name_original;
                $fileName = uniqid() . '.' . $extension;
                Storage::cloud()->put($fileName, fopen($file, 'r'));
                //get the id_image from google driver
                $filename = $fileName;
                $dir = '/';
                $recursive = false; // Get subdirectories also?
                $contents = collect(Storage::cloud()->listContents($dir, $recursive));
                $file = $contents
                    ->where('type', '=', 'file')
                    ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
                    ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
                    ->first(); // there can be duplicate file names!
                $film->thumb = $file['path']; // add id_image from google driver to film table
            }
            $film->save();

            // Insert menu_id from Create Film Page to table film_menu with latest film_id
            $film = Film::findOrFail($film->id);
            if ($request->menu) {
                foreach ($request->menu as $menu) {
                    $film->menus()->syncWithoutDetaching($menu);
                }
            }

            // Insert actor_id from Create Film Page to table film_actor with latest film_id
            if ($request->actor) {
                foreach ($request->actor as $actor) {
                    $film->actors()->syncWithoutDetaching($actor);
                }
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new Exception($e->getMessage());
        }

        return redirect()->route('film.index');
    }

    public function destroy(Film $film)
    {
        $film->delete();

        return redirect()->route('film.index');
    }
}
