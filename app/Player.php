<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function team()
    {
        return $this->belongsToMany(Team::class, 'team_player_pivot')
            ->withPivot(['jersey_number'])
            ->where('current_team', '=', '1');
    }

    public function fantasy_players()
    {
        return $this->belongsTo(FantasyTeamPlayer::class);
    }

    public static function playersWithTeam()
    {
        // fetch all teams that have current team
        $players = DB::table('team_player_pivot')
            ->where('current_team', 1)
            ->get()->toArray();
        // map all ids into array
        $playerIds = array_map(function($player) {
            return $player->player_id;
        }, $players);
        // fetch players with ids fetched from table
        return self::with('team')
            ->whereIn('id', $playerIds)
            ->get();
    }
}
