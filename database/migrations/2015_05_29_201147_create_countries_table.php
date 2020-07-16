<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            //$table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('code', 3)->unique();
            $table->string('name', 52)->nullable();
            $table->enum('continent', ['Asia', 'Europe', 'North America', 'Africa', 'Oceania', 'Antarctica', 'South America']);
            $table->string('region', 26)->nullable();
            $table->decimal('surface_area', 10, 2)->nullable();
            $table->integer('indep_year')->length(4)->nullable();
            $table->integer('population')->length(11)->unsigned();
            $table->decimal('life_expectancy', 3, 1)->nullable();
            $table->decimal('gnp', 10, 2)->nullable();
            $table->decimal('gnp_old', 10, 2)->nullable();
            $table->string('local_name', 45)->nullable();
            $table->string('government_form', 45)->nullable();
            $table->string('head_of_state', 60)->nullable();
            //$table->integer('capital')->length(11)->unsigned();
            $table->string('code2', 2)->nullable();
            $table->unsignedBigInteger('capital')->nullable();
            $table->foreign('capital')->references('id')->on('cities');
            //$table->foreign('capital', 11)->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('countries');
    }
}
