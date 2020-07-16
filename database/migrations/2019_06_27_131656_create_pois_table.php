<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pois', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('user_masters');
            $table->unsignedBigInteger('company_branch_id');
            $table->foreign('company_branch_id')->references('id')->on('user_masters');
            $table->string('place_name',50);
            $table->string('lat_long',250)->nullable();
            $table->Integer('tolerance')->nullable();
            $table->unsignedBigInteger('poi_type');
            $table->foreign('poi_type')->references('id')->on('poi_type_masters');
            $table->text('description');

            $table->unsignedBigInteger('county_id');
            $table->foreign('county_id')->references('id')->on('countries');

            /*$table->unsignedBigInteger('state_id');
            $table->foreign('state_id')->references('id')->on('states');*/

            $table->dateTime('deleted_at')->nullable();
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
        Schema::dropIfExists('pois');
    }
}
