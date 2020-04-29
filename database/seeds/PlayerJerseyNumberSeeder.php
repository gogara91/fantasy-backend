<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlayerJerseyNumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement(
            'UPDATE team_player_pivot SET
            jersey_number = FLOOR(RAND()*100)'
        );

    }
}
