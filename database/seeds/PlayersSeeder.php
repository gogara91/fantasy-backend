<?php

use Illuminate\Database\Seeder;
use App\Player;
use Illuminate\Support\Facades\DB;

class PlayersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $content = $this->getPlayers(1,100);
        $totalPages = $content->meta->total_pages;

        $page = 1;
        while($page <= $totalPages) {
            $players = $this->getPlayers($page,  100);
            foreach($players->data as $key => $player) {
                $createdPlayer = Player::create([
                    'first_name' => $player->first_name,
                    'last_name' => $player->last_name,
                    'position' => $player->position,
                    'height_feet' => $player->height_feet,
                    'height_inches' => $player->height_inches,
                    'weight_pounds' => $player->weight_pounds,
                    'api_id' => $player->id
                ]);

                DB::table('team_player_pivot')->insert([
                    'team_id' => $player->team->id,
                    'player_id' => $createdPlayer->id,
                    'current_team' => 1
                ]);
            }
            $page++;
        }
    }

    private function getPlayers($page, $players)
    {
        $curl = curl_init();
        curl_setopt(
            $curl,
            CURLOPT_URL,
            'https://www.balldontlie.io/api/v1/players?page='.$page.'&per_page='.$players
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
