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
Route::get('showallfilms/{id}', 'HomeController@showfilmbymenu')->name('showfilmbymenu');

Auth::routes();

Route::post('comment', 'PlayerController@comment')->name('comment')->middleware('comment');

//Search
Route::get('/search', 'SearchController@searchFullText')->name('search');
