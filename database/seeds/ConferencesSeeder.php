<?php

use Illuminate\Database\Seeder;
use App\Conference;
use App\Team;
use Illuminate\Support\Facades\DB;

class ConferencesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teams = Team::groupBy('conference')->get();
        foreach($teams as $team) {
            Conference::create(['name' => $team->conference])->each(function($conference){
                DB::table('teams')
                    ->where('conference', $conference->name)
                    ->update(['conference_id' => $conference->id]);
            });
        }
    }
}
