<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class DeviceMasterChangeNameLengthCreatedUpdatedByDataType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('device_masters', function (Blueprint $table) {
            // 
            // DB::statement('ALTER TABLE device_masters CHANGE created_by VARCHAR(200)');
            // DB::statement('ALTER TABLE device_masters CHANGE updated_by VARCHAR(200)');
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
