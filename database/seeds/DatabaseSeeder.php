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
        $this->call(TeamPlayerPivotSeeder::class);
        $this->call(ConferencesSeeder::class);
        $this->call(DivisionsSeeder::class);
        $this->call(SeasonSeeder::class);
        $this->call(StatTypesSeeder::class);
        $this->call(StatTypesDefaultValuesSeeder::class);
        $this->call(FantasyTeamDefaultsSeeder::class);
        $this->call(PlayerJerseyNumberSeeder::class);
        $this->call(PlayerPositionsSeeder::class);
        $this->call(PlayerFantasyCostsSeeder::class);
    }
}
