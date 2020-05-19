<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FantasyTeamPlayer extends Model
{
    protected $fillable = [
        'fantasy_team_id',
        'player_id',
        'current_team',
        'current_position',
        'round_added',
        'round_removed',
    ];

    public function FantasyTeam()
    {
        return $this->hasOne(FantasyTeam::class);
    }

    public function player() {
        return $this->belongsTo(Player::class);
    }
}
