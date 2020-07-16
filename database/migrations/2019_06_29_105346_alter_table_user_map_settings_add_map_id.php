<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUserMapSettingsAddMapId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_map_settings', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('map_id')->after('user_id');
            $table->foreign('map_id')->references('id')->on('map_masters');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_map_settings', function (Blueprint $table) {
            //
        });
    }
}
