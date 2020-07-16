<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRuleSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_rule_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('user_masters');
            $table->string('rule_name',100);
            $table->text('description')->nullable();
            $table->date('valid_from');
            $table->integer('device_accuracy_tolerance')->nullable();
            $table->enum('device_distance_variation_sign',['0','1']);
            $table->integer('device_distance_variation')->nullable();
            $table->integer('poi_tolerance')->nullable();
            $table->integer('speed_tolerance')->nullable();
            $table->integer('inactive_time')->nullable();
            $table->integer('stoppage_time')->nullable();
            $table->integer('idle_time')->nullable();
            $table->enum('show_cluster',['0','1']);
            $table->integer('startup_screen');
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
        Schema::dropIfExists('user_rule_settings');
    }
}
