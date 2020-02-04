<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FantasyPlayerPoint extends Model
{
    public function player()
    {
        return $this->hasOne(Player::class);
    }

    public function round()
    {
        return $this->hasOne(Round::class);
    }

    public function fantasyTeam()
    {
        return $this->hasOne(FantasyTeam::class);
    }
}
