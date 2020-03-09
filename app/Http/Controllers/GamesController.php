<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lineup;
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


    public function startGame(Request $request, $id)
    {
        Game::where('id', '=', $id)->update(['game_status' => 2]);
        $game = Game::findOrFail($id);
        $lineups = $request->all();
        Lineup::createLineup($lineups['homeTeamLineup'], $lineups['homeTeamStarters'], $game, 'home_team_id');
        Lineup::createLineup($lineups['awayTeamLineup'], $lineups['awayTeamStarters'], $game, 'away_team_id');
    }

    public function liveGame($id)
    {
        return Game::fetchLiveGame($id);
    }

}
