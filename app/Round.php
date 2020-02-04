<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    public $fillable = ['season_id', 'number'];

    public function season()
    {
        return $this->hasOne(Season::class);
    }

    public function games()
    {
        return $this->hasMany(Game::class);
    }
}
