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

    /**
     * @param $teamId integer FANTASY TEAM ID
     * @param $playerId integer Player id - id of original player from table "players"
     */
    public static function getPlayer($teamId, $playerId)
    {
        return FantasyTeamPlayer::with('player')->where('current_team', '=', '1')
            ->where('fantasy_team_id', '=', $teamId)
            ->where('player_id', '=', $playerId);
    }

}
