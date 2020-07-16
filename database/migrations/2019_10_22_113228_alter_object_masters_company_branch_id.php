<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterObjectMastersCompanyBranchId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('object_masters', function (Blueprint $table) {
            $table->dropForeign(['company_branch_id']);
            $table->dropColumn('company_branch_id');
        });
        
        Schema::table('object_masters', function (Blueprint $table) {
            $table->unsignedBigInteger('company_branch_id')->after('device_id');
            $table->foreign('company_branch_id')->references('id')->on('user_masters')->onDelete('no action');
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
