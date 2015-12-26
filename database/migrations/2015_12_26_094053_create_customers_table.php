<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
      			$table->string('password');
      			$table->string('email')->unique();
      			$table->string('mobile')->nullable();
      			$table->string('display_name');
      			$table->string('device_token');
      			$table->char('platform', 1);
      			$table->tinyInteger('status')->default(1);
      			$table->string('reset_password')->nullable();
      			$table->dateTime('reset_password_expiry')->nullable();
      			$table->dateTime('last_access');

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
        Schema::drop('customers');
    }
}
