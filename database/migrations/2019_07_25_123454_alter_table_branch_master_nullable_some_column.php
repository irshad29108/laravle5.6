<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableBranchMasterNullableSomeColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('branch_masters', function (Blueprint $table) {
            
            $table->dropColumn('branch_name');
            $table->dropColumn('zipcode');
            $table->dropColumn('email_id');

        });

        Schema::table('branch_masters', function (Blueprint $table) {

            $table->string('branch_name')->nullable()->after('company_id');
            $table->string('zipcode',10)->nullable()->after('city_id');
            $table->string('email_id',250)->nullable()->after('city_id');

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
