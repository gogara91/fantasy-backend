<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lineup extends Model
{
    public $fillable = ['player_id', 'team_id', 'game_id', 'starter', 'currently_on_court'];

    public function player()
    {
        return $this->hasOne(Player::class, 'id','player_id');
    }

    public function team()
    {
        return $this->hasOne(Team::class);
    }

    public function game()
    {
        return $this->hasOne(Game::class);
    }

    public static function createLineup($lineup, $starters, $game, $teamIdRefference)
    {
        foreach($lineup as $player) {
            $playerData = [
                'player_id' => $player,
                'game_id' => $game->id,
                'team_id' => $game->$teamIdRefference,
                'starter' => 0,
                'currently_on_court' => 0
            ];
            if(in_array($player, $starters)) {
                $playerData['starter'] = 1;
                $playerData['currently_on_court'] = 1;
            }
            self::create($playerData);
        }
    }
}
