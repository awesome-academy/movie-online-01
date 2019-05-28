<?php
namespace App\Providers;

use App\Film;
use App\Menu;
use App\Save;
use App\Traits\GetViewRedis;
use App\User;
use Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    use GetViewRedis;
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        View::composer(['client.layouts.header', 'client.layouts.sidebar'], function ($view) {
            $filmHot = Film::withCount('episodes')->with('votes')->get();
            $views = $this->getViewsOfWeek();
            $singleFilm = $filmHot->filter(function ($value) {

                return $value->episodes_count == 1;
            })->toArray();

            $singleFilmHot = $this->mergeFilmWithView($singleFilm, $views)->take(config('setting.take_film.sidebar'));

            $seriesFilm = $filmHot->filter(function ($value) {

                return $value->episodes_count > 1;
            })->toArray();

            $seriesFilmHot = $this->mergeFilmWithView($seriesFilm, $views)->take(config('setting.take_film.sidebar'));

            $menus = Menu::with('childMenu')->where('parent_id', 0)->get();
            if (Auth::check()) {
                $user_id = Auth::id();
                $film_save = User::find($user_id)->saves;
                $favorite = array();
                if ($film_save->count() > 0) {
                    foreach ($film_save as $single) {
                        $singleFilm = Film::where('id', $single->film_id)
                            ->with('votes')
                            ->first()
                            ->toArray();
                        array_push($favorite, $singleFilm);
                    }

                    $favoriteFilms = $this->mergeFilmWithView($favorite, $views);
                } else {
                    $favoriteFilms = [];
                }
                
                $view->with('favoriteFilms', $favoriteFilms);
            }

            $view->with('menus', $menus);
            $view->with('singleFilmHot', $singleFilmHot);
            $view->with('seriesFilmHot', $seriesFilmHot);
        });
    }
}
