<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Game::with('homeTeam', 'awayTeam', 'round')->get();
    }

    public function show($id)
    {
        return Game::with([
            'homeTeam.players' => function($query) {
                $query->where('current_team', '=', '1');
            },
            'awayTeam.players'  => function($query) {
                $query->where('current_team', '=', '1');
            }
        ])
        ->where('id', '=', $id)
        ->first();
    }


    public function startGame($id)
    {
        $game = Game::where('id', '=', $id)->update(['game_status' => 2]);
    }

}
