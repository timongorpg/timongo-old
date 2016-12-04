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

Route::group(['middleware' => 'auth'], function(){
    Route::get('/me', 'GameController@profile');
    Route::get('/adventures', 'GameController@adventures');
    Route::get('/inventory', 'GameController@inventory');
    Route::get('/arena', 'GameController@arena');
    Route::post('/battle', 'GameController@battle');
    Route::post('/level-up', 'GameController@levelUp');
    Route::patch('/profession', 'GameController@profession');
    Route::post('/mastery', 'GameController@mastery');
    Route::post('/train', 'GameController@train');
    Route::post('/logout', 'Auth\LoginController@logout');
});

Route::get('/home', 'HomeController@index');
Route::get('/login', 'Auth\LoginController@redirectToProvider');
Route::get('/facebook', 'Auth\LoginController@handleProviderCallback');
