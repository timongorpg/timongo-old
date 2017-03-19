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
    Route::get('/arena', 'ArenaController@index');
    Route::post('/arena', 'ArenaController@signUp');
    Route::get('/ranking', 'GameController@ranking');
    Route::get('/guild', 'GuildController@index');
    Route::post('guild', ['as' => 'guild.create', 'uses' => 'GuildController@create']);
    Route::post('guild/{guildId}', ['as' => 'guild.apply', 'uses' => 'GuildController@apply']);
    Route::post('/battle', 'GameController@battle');
    Route::post('/level-up', 'GameController@levelUp');
    Route::patch('/profession', 'GameController@profession');
    Route::post('/mastery', 'GameController@mastery');
    Route::post('/train', 'GameController@train');
    Route::post('/potion', 'GameController@potion');
    Route::post('/use-potion', 'GameController@usePotion');
    Route::post('/logout', 'Auth\LoginController@logout');
    Route::post('/change-theme', 'ThemesController@changeTheme');
});

Route::get('/home', 'HomeController@index');
Route::get('/privacy', 'HomeController@privacy');
Route::get('/login', 'Auth\LoginController@redirectToProvider');
Route::get('/facebook', 'Auth\LoginController@handleProviderCallback');
