<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableObjectMasterChangeOdometerColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('object_masters', function (Blueprint $table) {
            $table->dropColumn('odometer');
        });

        Schema::table('object_masters', function (Blueprint $table) {
            $table->double('odometer',20,6)->nullable()->after('installation_date');
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
