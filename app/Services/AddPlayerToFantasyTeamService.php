<?php

namespace App\Services;

use App\FantasyTeam;
use App\FantasyTeamPlayer;
use App\Player;
use Illuminate\Support\Facades\DB;

class AddPlayerToFantasyTeamService {
    private $teamId, $playerId, $player, $team;

    public function __construct($teamId, $playerId)
    {
        $this->teamId = $teamId;
        $this->playerId = $playerId;
        $this->player = Player::findOrFail($this->playerId);
        $this->team = FantasyTeam::findOrFail($this->teamId);
    }

    public function add()
    {
        DB::beginTransaction();
        // declare playerPosition from $this->player, because it may be changed in following code
        // because if players position is occupied, it should add player to bench
        try {
            $playerPosition = $this->player->position;
            // deduct current budget
            $this->team->used_budget = $this->team->used_budget + $this->player->fantasy_cost;

            if($this->team->used_budget > $this->team->total_budget) {
                return response()->json(['error' => 'Not enough budget'], 422);
            }
            $numberOfPlayers = FantasyTeamPlayer::where('fantasy_team_id', '=', $this->teamId)
                ->where('current_team', '=', '1')
                ->count();
            if($numberOfPlayers == 12) {
                throw new \Exception('You already have 12 players in team.');
            }
            if($this->isPlayerPositionOccupied()) {
                $numberOfBenchPlayers = FantasyTeamPlayer::where('fantasy_team_id', '=', $this->teamId)
                    ->where('current_team', '=', '1')
                    ->where('current_position', '=', 'B')->count();
                if($numberOfBenchPlayers > 6) {
                    throw new \Exception('Bench is already full.');
                }
                $playerPosition = 'B';
            }

            // update team current_budget
            $this->team->update();

            // Add player to fantasy team
            $player = FantasyTeamPlayer::create([
                'player_id' => $this->player->id,
                'fantasy_team_id' => $this->team->id,
                'current_position' => $playerPosition,
                'current_team' => 1
            ]);
            DB::commit();
            // Return player in format required
            return [
                'player' => FantasyTeamPlayer::with('player.team')
                    ->findOrFail($player->id),
                'used_budget' => $this->team->used_budget
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function isPlayerPositionOccupied() : bool
    {
        return !empty(FantasyTeamPlayer::where('current_position', '=', $this->player->position)
            ->where('fantasy_team_id', '=', $this->teamId)
            ->where('current_team', '=', 1)
            ->first());
    }
}
