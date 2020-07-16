<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUserAlertAddIsInOutColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_alerts', function (Blueprint $table) {
            //
            $table->enum('is_in',['0','1'])->nullable()->after('is_sms');
            $table->enum('is_out',['0','1'])->nullable()->after('is_sms');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
    }
}
