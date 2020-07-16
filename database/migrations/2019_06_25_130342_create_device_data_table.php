<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateDevicedataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('DeviceType',50)->nullable();
            $table->BigInteger('IMEI')->nullable();
            $table->string('VehicleNumber')->nullable();
            $table->string('VendorId')->nullable();
            $table->string('FirmWareVersion',25)->nullable();
            $table->string('PacketType',8)->nullable();
            $table->integer('MessageID')->nullable();
            $table->integer('PacketStatus')->nullable();
            $table->smallInteger('GPSStatus')->nullable();
            $table->dateTime('PacketDateTime')->nullable();
            $table->double('Lattitude',8,2)->nullable();
            $table->double('Longitude',8,2)->nullable();
            $table->double('Speed',8,2)->nullable();
            $table->double('Heading',8,2)->nullable();
            $table->integer('NoOfSatelites')->nullable();
            $table->double('Altitude',8,2)->nullable();
            $table->double('PDOP',8,2)->nullable();
            $table->double('HDOP',8,2)->nullable();
            $table->string('NetworkOperatorName',50)->nullable();
            $table->double('IgnitionStatus',8,2)->nullable();
            $table->smallInteger('MainPowerStatus')->nullable();
            $table->double('MainInputVoltage',8,2)->nullable();
            $table->double('InternalBatteryVoltage',8,2)->nullable();
            $table->smallInteger('EmergencyStatus')->nullable();
            $table->smallInteger('TamperAlert')->nullable();
            $table->integer('GSMSignalStrength')->nullable();
            $table->integer('MCC')->nullable();
            $table->integer('MNC')->nullable();
            $table->integer('LAC')->nullable();
            $table->integer('CellID')->nullable();
            $table->smallInteger('DigitalInput1')->nullable();
            $table->smallInteger('DigitalInput2')->nullable();
            $table->smallInteger('DigitalInput3')->nullable();
            $table->smallInteger('DigitalInput4')->nullable();
            $table->smallInteger('DigitalOutput1')->nullable();
            $table->smallInteger('DigitalOutput2')->nullable();
            $table->double('AnalogInput1',8,2)->nullable();
            $table->double('AnalogInput2',8,2)->nullable();
            $table->double('DeltaDistance',8,2)->nullable();
            $table->string('OTAResponse',101)->nullable();
            $table->dateTime('message_time')->nullable();
            $table->BigInteger('FrameNumber')->nullable();
            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('device_data');
    }
}
