<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameEvent extends Model
{
    public function game()
    {
        return $this->hasOne(Game::class);
    }

    public function player()
    {
        return $this->hasOne(Player::class);
    }

    public function team()
    {
        return $this->hasOne(Team::class);
    }
}
