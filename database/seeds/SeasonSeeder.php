<?php

use Illuminate\Database\Seeder;
use App\Season;
use App\Round;
use App\Game;
use App\Team;
class SeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $year = date('Y');
        $nextYear = $year+1;
        $season = Season::create([
            'year' => "{$year}/{$nextYear}"
        ]);
        $teams = Team::all()->toArray();
        $home = array_slice($teams, 0, count($teams)/2);
        $away = array_slice($teams, count($teams)/2);

        $rounds = [];
        for($i=0; $i < count($home)+count($away)-1; $i++) {
            for($j=0; $j < count($home); $j++) {
                $rounds[$i][$j] = [
                    'home_team' => $home[$j]['id'],
                    'away_team' => $away[$j]['id']
                ];
            }

            $array_splice = array_splice($home,1,1);
            array_unshift($away,array_shift($array_splice));
            array_push($home,array_pop($away));
        }

        $games = [];
        foreach($rounds as $key => $round) {
           $dbRound = Round::create([
               'season_id' => $season->id,
               'number' => $key+1
           ]);
           foreach($round as $game) {
               Game::create([
                    'home_team_id' => $game['home_team'],
                    'away_team_id' => $game['away_team'],
                    'round_id' => $dbRound->id
                ]);
           }
        }
        $ROUNDS = Round::with('games')->get()->toArray();
        $nextNumber = array_reverse($ROUNDS)[0]['number'] + 1;
        foreach($ROUNDS as $ROUND) {
            $dbRound = Round::create([
                'season_id' => $season->id,
                'number' => $nextNumber
            ]);

            foreach($ROUND['games'] as $game) {
                Game::create([
                    'home_team_id' => $game['away_team_id'],
                    'away_team_id' => $game['home_team_id'],
                    'round_id' => $dbRound->id
                ]);
            }
            $nextNumber += 1;
        }
    }
}
