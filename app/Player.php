<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    public $fillable = [
        'first_name',
        'last_name',
        'position',
        'height_feet',
        'height_inches',
        'weight_pounds',
        'created_at',
        'updated_at',
    ];

    public function teams() {
        return $this->belongsToMany(Team::class, 'team_player_pivot');
    }
}
