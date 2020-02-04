<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public $fillable = ['home_team_id', 'away_team_id', 'round_id'];

    public function homeTeam()
    {
        return $this->hasOne(Team::class);
    }

    public function awayTeam()
    {
        return $this->hasOne(Team::class);
    }

    public function gameEvents()
    {
        return $this->hasMany(GameEvent::class);
    }

    public function round()
    {
        return $this->hasOne(Round::class);
    }
}
