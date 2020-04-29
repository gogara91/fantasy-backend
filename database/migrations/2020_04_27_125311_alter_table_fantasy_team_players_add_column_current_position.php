<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableFantasyTeamPlayersAddColumnCurrentPosition extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fantasy_team_players', function($table) {
            $table->string('current_position', 2);
            $table->integer('round_added');
            $table->integer('round_removed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fantasy_team_players', function($table) {
            $table->dropColumn('current_position');
            $table->dropColumn('round_added');
            $table->dropColumn('round_removed');
        });
    }
}
