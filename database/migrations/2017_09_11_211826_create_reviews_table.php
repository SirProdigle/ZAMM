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
            $table->string('briefingDescription')->nullable();
            $table->integer('equipment');
            $table->string('equipmentDescription')->nullable();
            $table->integer('enemy');
            $table->string('enemyDescription')->nullable();
            $table->integer('location');
            $table->string('locationDescription')->nullable();
            $table->integer('objectives');
            $table->string('objectivesDescription')->nullable();
            $table->integer('enjoyment');
            $table->string('enjoymentDescription')->nullable();
            $table->integer('competency');
            $table->string('competencyDescription')->nullable();
            $table->string('ip');
            $table->string('mission_id');
            $table->string('user_id')->nullable();
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
