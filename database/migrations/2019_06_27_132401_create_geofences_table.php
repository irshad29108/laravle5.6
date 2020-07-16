<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeofencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geofences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('user_masters');
            $table->unsignedBigInteger('company_branch_id');
            $table->foreign('company_branch_id')->references('id')->on('user_masters');
            $table->string('name',50)->nullable();
            $table->text('description')->nullable();
            $table->enum('fence_type', ['start', 'end']);
            $table->string('range',250)->nullable();
            $table->Integer('tolerance')->nullable();
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
        Schema::dropIfExists('geofences');
    }
}
