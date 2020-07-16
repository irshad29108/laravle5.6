<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableObjectMasterDropColumn extends Migration
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
            $table->dropColumn('registration_number');
            $table->dropColumn('imei');
            $table->dropForeign('object_masters_company_branch_id_foreign');
            $table->dropColumn('company_branch_id');
            $table->dropColumn('odometer');
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
