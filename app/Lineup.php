<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lineup extends Model
{
    public function player()
    {
        return $this->hasOne(Player::class);
    }

    public function team()
    {
        return $this->hasOne(Team::class);
    }

    public function game()
    {
        return $this->hasOne(Game::class);
    }
}
