<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('abbreviation', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('conference', 255)->nullable();
            $table->string('division', 255)->nullable();
            $table->string('full_name', 255)->nullable();
            $table->string('name', 255)->nullable();
            $table->integer('api_id')->nullable();
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
        Schema::dropIfExists('teams');
    }
}
