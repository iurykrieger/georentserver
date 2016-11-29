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

//Route::group(['middleware' => 'auth'],function() {
	Route::get('/residence/limit/{id}/{qtReg}','ResidenceController@limit');

	Route::get('residenceImage/residence/{idResidence}','ResidenceImageController@residence');

	Route::get('residenceImage/top','ResidenceImageController@topAllResidences');

	Route::get('residenceImage/top/limit/{id}/{qtReg}','ResidenceImageController@topAllResidencesLimit');

	Route::get('residenceImage/residence/{idResidence}/top','ResidenceImageController@residenceTop');


	Route::get('residence/distance/{distance}','ResidenceController@residenceDisp');

	Route::get('residence/{idResidence}/residenceImage','ResidenceController@residenceImages');

	Route::get('residence/{idResidence}/residenceImage/top','ResidenceController@top');

	Route::get('residence/{idResidence}/eager','ResidenceController@eager');

	Route::get('userImage/{idUserImage}/high','UserImageController@high');

	Route::get('userImage/{idUserImage}/medium','UserImageController@medium');

	Route::get('userImage/{idUserImage}/low','UserImageController@low');

	Route::get('user/{idUser}/eager','UserController@eager');

	Route::get('residenceImage/{idResidenceImage}/high','ResidenceImageController@high');

	Route::get('residenceImage/{idResidenceImage}/medium','ResidenceImageController@medium');

	Route::get('residenceImage/{idResidenceImage}/low','ResidenceImageController@low');

	Route::get('city/state/{idState}','CityController@state');

	Route::resource('city', 'CityController');

	Route::resource('location', 'LocationController');

	Route::resource('residence', 'ResidenceController');

	Route::resource('residenceImage', 'ResidenceImageController');

	Route::resource('userImage', 'UserImageController');

	Route::resource('match', 'MatchController');

	Route::resource('message', 'MessageController');

	Route::resource('preference', 'PreferenceController');

	//Auth::routes();

	Route::get('/home', 'HomeController@index');

	Route::get('/', function () {
    return view('welcome');
});
//});

//Route::post('login/{$email}/{$password}','UserController@authenticate');

//Route::resource('user', 'UserController');

//Route::get('city/state/{idState}','CityController@state');

Route::get('/home', 'HomeController@index');
