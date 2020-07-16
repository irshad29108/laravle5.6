<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableObjectMasterAddForeignKey extends Migration
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
            //
            $table->unsignedBigInteger('device_id')->after('company_branch_id');
            $table->foreign('device_id')->references('id')->on('device_masters')->onDelete('cascade');
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
         //Schema::dropIfExists('object_masters');
    }
}
