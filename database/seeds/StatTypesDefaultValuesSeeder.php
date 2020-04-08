<?php

use Illuminate\Database\Seeder;
use App\StatType;

class StatTypesDefaultValuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'PTS' => 1,
            'FGA' => 1,
            'FGM' => 1,
            'FTA' => 1,
            'FTM' => 1,
            '2FGA' => 1,
            '2FGM' => 1,
            '3FGA' => 1,
            '3FGM' => 1,
            'DREB' => 1,
            'OREB' => 1,
            'AST' => 1,
            'STL' => 1,
            'TO' => 1,
            'BLK_FV' => 1,
            'BLK_AG' => 1,
            'PF_FV' => 1,
            'PF_RV' => 1,
        ];
        foreach($data as $key => $val) {
           $type = StatType::where('abbreviation', '=', $key)->first();
           $type->default_value = $val;
           $type->update();
        }
    }
}
