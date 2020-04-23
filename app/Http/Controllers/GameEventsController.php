<?php

namespace App\Http\Controllers;

use App\GameEvent;
use Illuminate\Http\Request;
use App\Http\Requests\GameEventsRequest;

class GameEventsController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GameEventsRequest $request)
    {
        $stats = [];
        foreach($request->all()['stats'] as $event) {
            $event = GameEvent::create($event);
            // this is added because sometimes it would return string for field "player_id".
            $stats[] = [
                'id' => (int) $event->id,
                'game_id' => (int) $event->game_id,
                'player_id' => (int) $event->player_id,
                'stat_type_id' => (int) $event->stat_type_id,
                'value' => (int) $event->value,
                'created_at' => $event->created_at,
                'updated_at' => $event->updated_at,
            ];

        }
        return $stats;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
