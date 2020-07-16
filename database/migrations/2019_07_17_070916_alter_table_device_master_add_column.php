<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableDeviceMasterAddColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
          Schema::table('device_masters', function (Blueprint $table) {
            //
            $table->string('serial_number',50)->after('name');
            $table->string('registration_number',50)->unique()->after('name');
            $table->BigInteger('imei')->unique()->after('name');
            $table->BigInteger('sim_number')->unique()->after('name');
            $table->BigInteger('mobile_number')->after('name')->nullable();
 
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
