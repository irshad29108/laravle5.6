<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAlertTableToAddFewFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alert_masters', function (Blueprint $table) { // Table alert_masters
            $table->text('object_id')->nullable()->change();
            $table->boolean('enabled')->nullable()->default(true)->after('os_notification_sound');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alert_masters', function (Blueprint $table) { // Table alert_masters
            //
        });
    }
}
