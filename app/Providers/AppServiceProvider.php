<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Menu;
use App\Film;

class AppServiceProvider extends ServiceProvider
{
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
            $filmHot = Film::withCount('episodes')->orderBy('viewed_day', 'DESC')->get();
            $singleFilmHot = $filmHot->filter(function ($value) {
                
                return $value->episodes_count == 1;
            })->take(config('setting.take_film.sidebar'));
            $seriesFilmHot = $filmHot->filter(function ($value) {
                
                return $value->episodes_count > 1;
            })->take(config('setting.take_film.sidebar'));
            $menus = Menu::with('childMenu')->where('parent_id', 0)->get();
            $view->with('menus', $menus);
            $view->with('singleFilmHot', $singleFilmHot);
            $view->with('seriesFilmHot', $seriesFilmHot);
        });
    }
}
