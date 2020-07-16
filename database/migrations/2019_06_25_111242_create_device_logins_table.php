<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateDeviceloginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_logins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('message_time')->nullable();
            $table->string('device_type',50)->nullable();
            $table->string('vendor_Id')->nullable();
            $table->string('vehicle_number')->nullable();
            $table->BigInteger('imei')->nullable();
            $table->string('firmware_version',25)->nullable();
            $table->string('protocol_version',25)->nullable();
            $table->double('lattitude',8,2)->nullable();
            $table->double('longitude',8,2)->nullable();
            $table->dateTime('packet_date_time')->nullable();
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
        Schema::dropIfExists('device_logins');
    }
}
