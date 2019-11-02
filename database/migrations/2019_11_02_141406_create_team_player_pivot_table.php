<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamPlayerPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_player_pivot', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('team_id')->unsigned()->nullable();
            $table->bigInteger('player_id')->unsigned()->nullable();
            $table->date('contract_signed')->nullable();
            $table->date('contract_ends')->nullable();
            $table->date('contract_ended')->nullable();
            $table->date('date_traded')->nullable();
            $table->boolean('current_team')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_player_pivot');
    }
}
