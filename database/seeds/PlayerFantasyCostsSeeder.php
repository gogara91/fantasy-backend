<?php

use Illuminate\Database\Seeder;

class PlayerFantasyCostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $players = \App\Player::all();
        foreach($players as $player) {
            $player->fantasy_cost = rand(30,270) / 10;
            $player->update();
        }
    }
}
