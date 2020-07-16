<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeviceMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',255);
            $table->enum('status',['0','1']);
            $table->string('created_by', 100);
            $table->string('updated_by', 100);
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
         DB::statement('SET FOREIGN_KEY_CHECKS = 0');
         Schema::dropIfExists('device_masters');
         DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
