<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Team;
class TeamPlayerPivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::update(
            "UPDATE team_player_pivot SET
                contract_signed = NULL,
                contract_ended = NULL,
                current_team = NULL"
        );
        DB::update(
            "UPDATE team_player_pivot SET
            team_id = (
                SELECT id FROM teams WHERE team_player_pivot.team_id = teams.api_id
            )"
        );
        $teams = Team::all();
        foreach($teams as $team) {
            $res = DB::update(
                "UPDATE team_player_pivot SET
                contract_signed = NOW() WHERE team_id = {$team->id} ORDER BY RAND() LIMIT 15"
            );
        }

        DB::update(
            "UPDATE team_player_pivot SET
            contract_ended = NOW() WHERE contract_signed IS NULL"
        );

        DB::update(
            "UPDATE team_player_pivot SET
            contract_signed = NOW() WHERE contract_ended IS NOT NULL"
        );

        DB::update(
            "UPDATE team_player_pivot SET current_team = 0 WHERE contract_ended IS NOT NULL"
        );

        DB::update(
            "UPDATE team_player_pivot SET current_team = 1 WHERE contract_ended IS NULL"
        );
    }
}
