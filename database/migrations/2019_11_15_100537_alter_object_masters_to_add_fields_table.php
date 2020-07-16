<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterObjectMastersToAddFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('object_masters', function (Blueprint $table) {
            $table->string('copy_from', 50)->nullable();
            $table->string('server_address',50)->nullable();
            $table->BigInteger('distance_counter')->nullable();
            $table->BigInteger('object_type_master_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('object_masters', function (Blueprint $table) {
            $table->dropColumn('copy_from');
            $table->dropColumn('server_address');
            $table->dropColumn('distance_counter');
            $table->dropColumn('object_type_master_id');
        });
    }
}
