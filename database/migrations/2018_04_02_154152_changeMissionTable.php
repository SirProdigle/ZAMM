<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeMissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('missions', function($table)
        {
            $table->renameColumn('orbitalType','friendlyOrbatType');
            $table->renameColumn('supportAssets','friendlySupportAssets');
            $table->string('friendlyFaction');
            $table->string('enemyOrbatType');
            $table->string('enemySupportAssets');
            $table->string('enemyFaction');
            $table->string('whoCanRevive');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
