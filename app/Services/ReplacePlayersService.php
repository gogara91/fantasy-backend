<?php

namespace App\Services;

use App\FantasyTeamPlayer;

class ReplacePlayersService {
    private $teamId, $request;
    public function __construct($teamId, $request)
    {
        $this->teamId = $teamId;
        $this->request = $request;
    }

    public function replace()
    {
        try {
            $player1 = FantasyTeamPlayer::getPlayer($this->teamId, $this->request->input('player_1'));
            $player2 = FantasyTeamPlayer::getPlayer($this->teamId, $this->request->input('player_2'));
            $player1CurrentPosition = $player1->first()->current_position;
            $player2CurrentPosition = $player2->first()->current_position;
            // if both players are bench players it should switch positions
            if($player1CurrentPosition === 'B' AND $player2CurrentPosition === 'B') {
                $this->replaceBenchPlayers();
            } else {
                if($player1CurrentPosition === 'B' OR $player2CurrentPosition === 'B') {
                    $this->replacePlayers($player1->first(), $player2->first());
                } else {
                    throw new \Exception('Players have to be the same position.');
                }
            }
            return FantasyTeamPlayer::with('player.team')
                ->where('fantasy_team_id', '=', $this->teamId)
                ->where('current_team', '=', '1')->get();
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }

    }

    public function replaceBenchPlayers()
    {
        $players = FantasyTeamPlayer::where('fantasy_team_id', '=', $this->teamId)
            ->where('current_team', '=', '1')
            ->get();
        $player1Index = 0;
        $player2Index = 0;

        foreach($players as $key => $player) {
            if($player->player_id == $this->request->input('player_1')) {
                $player1Index = $key;
            }
            if($player->player_id == $this->request->input('player_2')) {
                $player2Index = $key;
            }
        }

        $player1 = $players[$player1Index];
        $player2 = $players[$player2Index];
        $players[$player2Index] = $player1;
        $players[$player1Index] = $player2;

        foreach($players as $player) {
            $player = FantasyTeamPlayer::find($player->id);
            $player->delete();
        }
        foreach($players as $player) {
            FantasyTeamPlayer::create([
                'fantasy_team_id' => $player->fantasy_team_id,
                'player_id' => $player->player_id,
                'current_team' => $player->current_team,
                'current_position' => $player->current_position,
                'round_added' => $player->round_added,
                'round_removed' => $player->round_removed,
            ]);
        }
    }

    public function replacePlayers($player1, $player2)
    {
        // if player1 is comming from bench and player position isnt the position hes being put on, throw exception
        if($player1->current_position === 'B') {
            if($player1->player->position !== $player2->current_position) {
                throw new \Exception('Players have to be the same position.');
            }
            $startingLineupPlayer = FantasyTeamPlayer::find($player2->id);
            $benchPlayer = FantasyTeamPlayer::with('player')->find($player1->id);

            //move bench player to position in starting lineup and starter to bench

        }
        // if player2 is comming from bench and player position isnt the position hes being put on, throw exception
        if($player2->current_position === 'B') {
            if($player2->player->position !== $player1->current_position) {
                throw new \Exception('Players have to be the same position.');
            }
            $startingLineupPlayer = FantasyTeamPlayer::find($player1->id);
            $benchPlayer = FantasyTeamPlayer::with('player')->find($player2->id);
        }

        $benchPlayer->current_position = $benchPlayer->player->position;
        $startingLineupPlayer->current_position = 'B';
        $benchPlayer->save();
        $startingLineupPlayer->save();
    }
}
