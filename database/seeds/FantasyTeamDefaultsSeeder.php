<?php

use Illuminate\Database\Seeder;

class FantasyTeamDefaultsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'starting_budget', 'value' => 100]
        ];
        foreach($data as $item) {
            \App\FantasyTeamDefault::create($item);
        }
    }
}
