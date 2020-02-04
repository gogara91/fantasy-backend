<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FantasyTeam extends Model
{
    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function fantasyTeamPlayers()
    {
        return $this->hasMany(FantasyTeamPlayer::class);
    }

    public function fantasyPlayerPoints()
    {
        return $this->hasMany(FantasyPlayerPoint::class);
    }
}
