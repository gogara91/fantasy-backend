<?php

namespace App\Http\Controllers;

use App\FantasyTeamDefault;
use App\Http\Requests\CreateFantasyTeamRequest;
use Illuminate\Http\Request;
use App\FantasyTeam;

class FantasyTeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //TODO: create a table with fantasy team settings

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
        return FantasyTeam::with([
            'fantasyTeamPlayers' => function($query) {
                $query->with('player')->where('current_team', '=', 1);
            }
            ])->findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
