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

Route::get('/residence/limit/{id}/{qtReg}','ResidenceController@limit');

Route::get('residenceImage/residence/{idResidence}','ResidenceImageController@residence');

Route::get('residenceImage/residence/{idResidence}/top','ResidenceImageController@residenceTop');

Auth::routes();

Route::get('/home', 'HomeController@index');
