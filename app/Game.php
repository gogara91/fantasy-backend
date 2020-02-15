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
}
