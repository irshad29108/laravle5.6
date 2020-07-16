<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlertMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alert_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('reseller_id')->nullable();
            // $table->foreign('reseller_id')->references('id')->on('user_masters')->onDelete('cascade');
            $table->bigInteger('company_id')->nullable();
            // $table->foreign('company_id')->references('id')->on('user_masters')->onDelete('cascade');
            $table->bigInteger('branch_id')->nullable();
            // $table->foreign('branch_id')->references('id')->on('user_masters')->onDelete('cascade');
            $table->bigInteger('object_id')->nullable();
            // $table->foreign('object_id')->references('id')->on('object_masters')->onDelete('cascade');

            $table->string('alert_name')->nullable();
            $table->bigInteger('alert_type')->nullable()->default(0);
            
            $table->longText('power_message')->nullable();
            $table->string('power_alert_method')->nullable();
            $table->smallInteger('power_status')->nullable();
            $table->string('power_email_addresses', 255)->nullable();
            $table->string('power_mobile_number', 255)->nullable();
            $table->smallInteger('power_notification_sound')->nullable();
            
            $table->longText('sos_message')->nullable();
            $table->string('sos_alert_method')->nullable();
            $table->string('sos_email_addresses', 255)->nullable();
            $table->string('sos_mobile_numbers', 255)->nullable();
            $table->smallInteger('sos_notification_sound')->nullable();
            
            $table->longText('ign_message')->nullable();
            $table->string('ign_alert_method')->nullable();
            $table->string('ign_email_addresses', 255)->nullable();
            $table->string('ign_mobile_numbers', 255)->nullable();
            $table->smallInteger('ign_notification_sound')->nullable();
            
            $table->bigInteger('os_parameter')->nullable();
            $table->bigInteger('os_duration')->nullable();
            $table->longText('os_message')->nullable();
            $table->string('os_alert_method')->nullable();
            $table->string('os_email_addresses', 255)->nullable();
            $table->string('os_mobile_numbers', 255)->nullable();
            $table->smallInteger('os_notification_sound')->nullable();
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
        Schema::dropIfExists('alert_masters');
    }
}
