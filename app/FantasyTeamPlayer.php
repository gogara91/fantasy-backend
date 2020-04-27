<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FantasyTeamPlayer extends Model
{
    public function FantasyTeam()
    {
        return $this->hasOne(FantasyTeam::class);
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
