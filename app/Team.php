<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public $fillable = [
        'abbreviation',
        'city',
        'conference',
        'division',
        'full_name',
        'name',
        'api_id',
    ];

    public function players() {
        return $this->belongsToMany(Player::class, 'team_player_pivot');
    }
}
