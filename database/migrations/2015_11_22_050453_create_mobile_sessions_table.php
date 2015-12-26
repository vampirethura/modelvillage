<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMobileSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobile_sessions', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('device_id');
          $table->integer('user_id');
          $table->string('device_key', 40);
          $table->string('session_id', 40);
          $table->datetime('session_expiry', 40);


          //Common to all table ----------------------------------------------
          $table->integer('data_owner_id')->nullable();
          $table->integer('loc_access_id')->nullable();
          $table->integer('created_by')->default(1);
          $table->integer('updated_by')->default(1);
          $table->integer('deleted_by')->nullable();
          $table->timestamps();
          $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('mobile_sessions');
    }
}
