<?php

namespace App\Http\Controllers;

use App\FantasyTeamDefault;
use App\FantasyTeamPlayer;
use App\Http\Requests\CreateFantasyTeamRequest;
use App\Services\AddPlayerToFantasyTeamService;
use Illuminate\Http\Request;
use App\FantasyTeam;
use App\Services\ReplacePlayersService;

class FantasyTeamsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(CreateFantasyTeamRequest $request)
    {
        $budget = FantasyTeamDefault::where('name', '=', 'starting_budget')->first();
        return FantasyTeam::create(
            array_merge($request->all(),['total_budget' => $budget->value])
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return FantasyTeam::with(['players' => function($query) {
            $query->with('player.team')->where('current_team', '=', '1');
        }])->findOrFail($id);
    }

    public function addPlayer($id, Request $request)
    {
        $service = new AddPlayerToFantasyTeamService($id, $request->input('player_id'));
        return $service->add();
    }


    /**
     * @param int $id is primary key fantasy_team_players.
     * TODO: later when rounds are implemented, this update to 0
     * if player is added in some of previous rounds. If he's added in current round
     * it should delete instead.
     * Why: Because if there is going to be limit of adding or removing players,
     * players that are added and removed in current round shouldn't
     * deduct from available changes
     */
    public function destroy($id)
    {
        $player = FantasyTeamPlayer::with('player')->findOrFail($id);
        $player->current_team = 0;
        $player->update();
        $team = FantasyTeam::findOrFail($player->fantasy_team_id);
        $team->used_budget = $team->used_budget - $player->player->fantasy_cost;
        $team->update();
        return ['used_budget' => $team->used_budget];
    }

    public function replacePlayers($id, Request $request)
    {
        $service = new ReplacePlayersService($id, $request);
        return $service->replace();
    }


}
