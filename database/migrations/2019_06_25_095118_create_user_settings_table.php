<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('user_masters');
            $table->unsignedBigInteger('timezone_id');
            $table->foreign('timezone_id')->references('id')->on('timezone_masters');
            $table->string('date_formate')->nullable();
            $table->string('time_formate')->nullable();
            $table->enum('status',['0','1'])->default('0')->comment('0 for active 1 for inative');
            $table->enum('store_action',['0','1'])->default('0')->comment('0 for on 1 for off');
            $table->enum('filter_option',['0','1'])->default('0')->comment('0 for on 1 for off');
            $table->enum('live_tracking',['0','1'])->default('0');
            $table->enum('country_border',['0','1'])->default('0');
            $table->unsignedBigInteger('dispute_region');
            $table->foreign('dispute_region')->references('id')->on('countries');
            $table->enum('immobilization',['0','1'])->default('0');
            $table->enum('web_access',['0','1'])->default('0');
            $table->enum('mobile_access',['all','none','specific']);
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
        Schema::dropIfExists('user_settings');
    }
}
