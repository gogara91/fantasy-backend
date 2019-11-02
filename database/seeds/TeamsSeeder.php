<?php

use Illuminate\Database\Seeder;
use App\Team;

class TeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $content = $this->getTeams(1,100);
        $totalPages = $content->meta->total_pages;

        $page = 1;
        while($page <= $totalPages) {
            $teams = $this->getTeams($page,  100);
            foreach($teams->data as $key => $team) {
                Team::create([
                    'abbreviation' => $team->abbreviation,
                    'city' => $team->city,
                    'conference' => $team->conference,
                    'division' => $team->division,
                    'full_name' => $team->full_name,
                    'name' => $team->name,
                    'api_id' => $team->id,
                ]);
            }
            $page++;
        }
    }


    private function getTeams($page, $teams)
    {
        $curl = curl_init();
        curl_setopt(
            $curl,
            CURLOPT_URL,
            'https://www.balldontlie.io/api/v1/teams?page='.$page.'&per_page='.$teams
        );
        curl_setopt(
            $curl,
            CURLOPT_RETURNTRANSFER,
            TRUE
        );
        $content = curl_exec($curl);
        curl_close($curl);
        return json_decode($content);
    }
}

