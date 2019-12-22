<?php

use Illuminate\Database\Seeder;
use App\Team;
use App\Division;
use App\Conference;
use Illuminate\Support\Facades\DB;
class DivisionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teams = Team::groupBy('division')->get();

        foreach($teams as $team) {
            $conference = Conference::where('name', $team->conference)->first();
            Division::create(['name' => $team->division,'conference_id' => $conference->id])->each(function($division) {
                DB::table('teams')
                    ->where('division', $division->name)
                    ->update([
                        'division_id' => $division->id
                    ]);
            });
        }
    }
}
