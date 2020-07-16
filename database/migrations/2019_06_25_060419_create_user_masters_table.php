<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
        public function up()
    {
        //
        Schema::create('user_masters',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_type');
            $table->foreign('user_type')->references('id')->on('user_type_masters');
            $table->string('password',250);
            $table->binary('photo')->nullable();    
            $table->string('name',100);
            $table->string('user_name',100)->unique();
            $table->string('city',50)->nullable();
            $table->string('zipcode',10)->nullable();
            $table->string('full_address',250)->nullable();
            $table->string('contact_number',15)->nullable();
            $table->string('contact_person',100)->nullable();
            $table->string('mobile_number',15)->nullable();
            $table->string('fax_number',15)->nullable();
            $table->smallInteger('is_disable_object')->nullable();
            $table->string('parent_id',50)->nullable();
            $table->string('timezone',50)->nullable();
            $table->dateTime('date_format')->nullable();
            $table->time('time_format')->nullable();
            $table->smallInteger('user_status')->nullable();
            $table->string('deactive_reason',100)->nullable();
            $table->smallInteger('is_immobilization')->nullable();
            $table->smallInteger('is_web_access')->nullable();
            $table->smallInteger('is_mobile_access')->nullable();
            $table->string('specific_imei_list',250)->nullable();
            $table->dateTime('created_by')->nullable();
            $table->dateTime('updated_by')->nullable();
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
        //
        Schema::dropIfExists('user_masters');
    }
}
