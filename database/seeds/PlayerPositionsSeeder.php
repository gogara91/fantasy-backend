<?php

use Illuminate\Database\Seeder;

class PlayerPositionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $players = \App\Player::all();
        $positions= [
            'PG', 'SG', 'SF', 'PF', 'C'
        ];
        foreach($players as $player) {
            $player->position = $positions[rand(0,4)];
            $player->save();
        }
    }
}
