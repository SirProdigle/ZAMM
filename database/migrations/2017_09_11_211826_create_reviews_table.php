<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('briefing');
            $table->text('briefingDescription')->nullable();
            $table->integer('equipment');
            $table->text('equipmentDescription')->nullable();
            $table->integer('enemy');
            $table->text('enemyDescription')->nullable();
            $table->integer('location');
            $table->text('locationDescription')->nullable();
            $table->integer('objectives');
            $table->text('objectivesDescription')->nullable();
            $table->integer('enjoyment');
            $table->text('enjoymentDescription')->nullable();
            $table->integer('competency');
            $table->text('competencyDescription')->nullable();
            $table->string('ip');
            $table->string('mission_id');
            $table->string('user_id')->nullable();
            $table->string('missionVersion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
