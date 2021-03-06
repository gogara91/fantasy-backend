<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('register', 'AuthController@register');
});

Route::group(['middleware' => 'auth:api'], function($router) {
    Route::resource('/teams', 'TeamsController');
    Route::resource('/games', 'GamesController');
    Route::post('/games/start-game/{id}', 'GamesController@startGame');
    Route::get('/games/live-game/{id}', 'GamesController@liveGame');
    Route::resource('/rounds', 'RoundsController');
    Route::resource('/players', 'PlayersController');
    Route::get('/players', 'PlayersController@playerThatHasTeam');
    Route::resource('/teams/games', 'TeamGamesController');
    Route::resource('/game-events', 'GameEventsController');
    Route::resource('/stat-types', 'StatTypesController');
    Route::resource('/fantasy-teams', 'FantasyTeamsController');
    Route::resource('/users', 'UsersController');
    Route::post('fantasy-teams/{id}/add-player', 'FantasyTeamsController@addPlayer');
    Route::put('fantasy-teams/{id}/replace-players', 'FantasyTeamsController@replacePlayers');
});


