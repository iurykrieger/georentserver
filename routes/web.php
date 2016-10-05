<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('city', 'CityController');

Route::resource('location', 'LocationController');

Route::resource('residence', 'ResidenceController');

Route::resource('residenceImage', 'ResidenceImageController');

Route::resource('user', 'UserController');

Route::resource('userImage', 'UserImageController');

Route::resource('match', 'MatchController');

Route::resource('message', 'MessageController');

Route::resource('preference', 'PreferenceController');

Auth::routes();

Route::get('/home', 'HomeController@index');
