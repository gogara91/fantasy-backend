<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamPlayerPivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::raw(
            "UPDATE team_player_pivot SET
            team_id = (
                SELECT id FROM teams WHERE team_player_pivot.team_id = teams.api_id
            )"
        );
    }
}
