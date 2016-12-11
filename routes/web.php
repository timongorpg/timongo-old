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

Route::get('/', 'HomeController@index');

Route::group(['middleware' => 'auth:web'], function(){
    Route::get('/me', 'GameController@profile');
    Route::get('/donations', 'GameController@donations');
    Route::patch('/pick-nickname', 'GameController@pickNickname');
    Route::get('/adventures', 'GameController@adventures');
    Route::get('/treasures', 'GameController@treasures');
    Route::get('/arena', 'GameController@arena');
    Route::post('/battle', 'GameController@battle');
    Route::post('/level-up', 'GameController@levelUp');
    Route::patch('/profession', 'GameController@profession');
    Route::post('/mastery', 'GameController@mastery');
    Route::post('/train', 'GameController@train');
    Route::post('/potion', 'GameController@potion');
    Route::post('/use-potion', 'GameController@usePotion');
    Route::post('/logout', 'Auth\LoginController@logout');
});

Route::get('/home', 'HomeController@index');
Route::get('/privacy', 'HomeController@privacy');
Route::get('/login', 'Auth\LoginController@redirectToProvider');
Route::get('/facebook', 'Auth\LoginController@handleProviderCallback');
