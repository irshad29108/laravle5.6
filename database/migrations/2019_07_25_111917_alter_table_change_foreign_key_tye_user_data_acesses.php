<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableChangeForeignKeyTyeUserDataAcesses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::table('user_data_acesses', function (Blueprint $table) {
            $table->dropForeign(['device_id']);
            $table->dropColumn('device_id');
        });

         Schema::table('user_data_acesses', function (Blueprint $table) {
            $table->unsignedBigInteger('device_id')->after('user_id');
            $table->foreign('device_id')->references('id')->on('device_masters')->onDelete('no action');
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
