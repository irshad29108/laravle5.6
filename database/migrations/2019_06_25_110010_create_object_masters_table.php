<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjectMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('object_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reseller_id');
            $table->foreign('reseller_id')->references('id')->on('user_masters');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('user_masters');
            $table->unsignedBigInteger('company_branch_id');
            $table->foreign('company_branch_id')->references('id')->on('user_masters');
            $table->string('name',50);
            $table->string('registration_number',50)->nullable();
            $table->string('device_type',50);
            $table->BigInteger('imei');
            $table->BigInteger('sim_number')->nullable();
            $table->string('device_timezone',50)->nullable();
            $table->string('plate_number',50)->nullable();
            $table->string('object_type',50)->nullable();
            $table->dateTime('manufacture_date')->nullable();
            $table->dateTime('purchase_date')->nullable();
            $table->dateTime('installation_date')->nullable();
            $table->dateTime('odometer')->nullable();
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
        Schema::dropIfExists('object_masters');
    }
}
