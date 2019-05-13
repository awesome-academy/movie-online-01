<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('index');
Route::get('details/{id}', 'HomeController@show')->name('show');
Route::get('watch/{id}-{slug}.html', 'PlayerController@showEpisodes')->name('episode');
Route::get('showallfilms/{id}', 'HomeController@showFilmByMenu')->name('showfilmbymenu');

Auth::routes();
//Comment
Route::post('comment', 'PlayerController@comment')->name('comment')->middleware('comment');
//Search
Route::get('/search', 'SearchController@searchFullText')->name('search');
//Save favorite film
Route::get('/savefavoritefilm/{id}', 'HomeController@saveFavoriteFilm')->name('savefavoritefilm');
//Remove favorite film
Route::get('/removefavoritefilm/{id}', 'HomeController@removeFavoriteFilm')->name('removefavoritefilm');
//Profile
Route::resource('profile', 'ProfileController')
->except([
	'index',
	'store',
	'create',
	'destroy',
	'edit',
]);
