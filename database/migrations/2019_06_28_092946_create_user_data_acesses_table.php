<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDataAcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_data_acesses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('user_masters')->onDelete('cascade');
            $table->unsignedBigInteger('alert_id');
            $table->foreign('alert_id')->references('id')->on('alerts')->onDelete('cascade');
            $table->unsignedBigInteger('device_id');
            $table->foreign('device_id')->references('id')->on('device_masters')->onDelete('cascade');
            $table->unsignedBigInteger('language_id');
            $table->foreign('language_id')->references('id')->on('language_masters')->onDelete('cascade');
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
       /* Schema::table('user_data_acesses', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['alert_id']);
            $table->dropForeign(['device_id']);
            $table->dropForeign(['language_id']);
            //$table->dropColumn(['user_id','alert_id','device_id','language_id']);
        });*/
        Schema::dropIfExists('user_data_acesses');
    }
}
