<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alerts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('user_masters');
            $table->unsignedBigInteger('company_branch_id');
            $table->foreign('company_branch_id')->references('id')->on('user_masters');
            $table->string('vehicle_id',11);
            $table->string('alert_name',50)->nullable();
            $table->unsignedBigInteger('alert_type');
            $table->foreign('alert_type')->references('id')->on('alert_type_masters');
            $table->string('alert_operator',50)->nullable();
            $table->string('alertValue',50)->nullable();
            $table->string('alert_message_text',50)->nullable();
            $table->smallInteger('is_sms')->nullable();
            $table->smallInteger('is_email')->nullable();
            $table->smallInteger('is_notification');
            $table->BigInteger('mobile_number')->nullable();
            $table->string('email_id',250)->nullable();
            $table->string('user_id',50)->nullable();
            $table->string('notification_dound',250)->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alerts');
    }
}
