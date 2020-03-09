<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public $fillable = ['home_team_id', 'away_team_id', 'round_id', 'date', 'game_status'];

    public function homeTeam()
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam()
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    public function gameEvents()
    {
        return $this->hasMany(GameEvent::class);
    }

    public function round()
    {
        return $this->belongsTo(Round::class);
    }

    public function homeTeamLineup()
    {
        return $this->hasMany(Lineup::class);
    }

    public function awayTeamLineup()
    {
        return $this->hasMany(Lineup::class);
    }

    public static function fetchLiveGame($id)
    {
        $game = self::findOrFail($id);
        if($game->game_status != 2) {
            return response()->json(
                ['message' => 'Error', 'data' => ['error' => 'Game not started!']],
                404
            );
        }

        return self::with([
            'gameEvents',
            'homeTeam',
            'awayTeam',
            'homeTeamLineup' => function($query) use($game) {
                $query->where('team_id', '=', $game->home_team_id)->with('player');
            },
            'awayTeamLineup' => function($query) use($game) {
                $query->where('team_id', '=', $game->away_team_id)->with('player');
            },
        ])
        ->where('id', '=', $id)
        ->first();
    }
}
