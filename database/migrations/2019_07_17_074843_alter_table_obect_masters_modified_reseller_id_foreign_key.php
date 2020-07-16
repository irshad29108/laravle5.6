<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableObectMastersModifiedResellerIdForeignKey extends Migration
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

            $table->unsignedBigInteger('company_branch_id')->after('company_id');
            $table->foreign('company_branch_id')->references('id')->on('branch_masters');
            $table->double('odometer',20,2)->after('installation_date');

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
