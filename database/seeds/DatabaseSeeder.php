<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TeamsSeeder::class);
        $this->call(PlayersSeeder::class);
        $this->call(TeamPlayerPivotSeeder::class);
    }
}
