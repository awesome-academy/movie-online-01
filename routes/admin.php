<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'DashboardController@index')->name('dashboard');
Route::group(['prefix' => 'menu'], function () {
    Route::get('menulist', 'MenuController@index')->name('menu.index');
    Route::get('addmenu', 'MenuController@create')->name('addmenu');
    Route::post('addmenu', 'MenuController@store');
    Route::get('menulist/{slug?}', 'MenuController@show')->name('showdetail');
    Route::get('menulist/{id?}/edit', 'MenuController@edit')->name('editmenu');
    Route::post('menulist/{id?}/edit', 'MenuController@update')->name('editmenu');   
    Route::post('menulist/{slug?}/delete', 'MenuController@destroy')->name('deletemenu');
});
//Film Manage
Route::resource('film', 'FilmController');
