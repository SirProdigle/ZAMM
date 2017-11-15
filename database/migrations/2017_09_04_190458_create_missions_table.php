<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('fileName');
            $table->string('displayName');
            $table->string('island');
            $table->integer('version');
            $table->dateTime('lastPlayed')->nullable();
            $table->string('status')->default('Pending Details');
            $table->string('gameType');
            $table->string('respawn')->nullable();
            $table->integer('min')->default('0');
            $table->integer('max')->nullable();
            $table->integer('user_id')->nullable();
            $table->dateTime('lastUpdated')->default(now());
            $table->string('notes')->nullable();
            $table->string('orbitalType')->nullable();
            $table->string('supportAssets')->nullable();
            $table->string('objectives')->nullable();
            $table->boolean('revive')->nullable();
            $table->integer('bleedOut')->nullable();
            $table->string('winLoseConditions')->nullable();
            $table->string('misc')->nullable();
            $table->boolean('completed')->default(false);
            $table->string('minimumRequirements')->nullable();
            $table->integer('serverNumber');
            $table->unique(['fileName', 'serverNumber']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('missions');
    }
}
