<?php

use Illuminate\Database\Seeder;
Use App\StatType;

class StatTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ['name' => 'Minutes', 'abbreviation' => 'min'],
            ['name' => 'Points', 'abbreviation' => 'pts'],
            ['name' => 'Field goals attempted', 'abbreviation' => 'fga'],
            ['name' => 'Field goals made', 'abbreviation' => 'fgm'],
            ['name' => 'Free throws attempted', 'abbreviation' => 'fta'],
            ['name' => 'Free throws made', 'abbreviation' => 'ftm'],
            ['name' => '2 point field goals attempted', 'abbreviation' => '2fga'],
            ['name' => '2 point field goals made', 'abbreviation' => '2fgm'],
            ['name' => '3 point field goals attempted', 'abbreviation' => '3fga'],
            ['name' => '3 point field goals made', 'abbreviation' => '3fgm'],
            ['name' => 'Defensive rebounds', 'abbreviation' => 'dreb'],
            ['name' => 'Offensive rebounds', 'abbreviation' => 'oreb'],
            ['name' => 'Assists', 'abbreviation' => 'ast'],
            ['name' => 'Steals', 'abbreviation' => 'stl'],
            ['name' => 'Turnovres', 'abbreviation' => 'to'],
            ['name' => 'Blocked shots', 'abbreviation' => 'blk_fv'],
            ['name' => 'Blocks recieved', 'abbreviation' => 'blk_ag'],
            ['name' => 'Fouls commited', 'abbreviation' => 'pf_fv'],
            ['name' => 'Fouls recieved', 'abbreviation' => 'pf_rv'],
        ];

        foreach($types as $type) {
            StatType::create([
                'name' => $type['name'],
                'abbreviation' => strtoupper($type['abbreviation']),
            ]);
        }

    }
}
