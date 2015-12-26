<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('role_id')->nullable();
          $table->string('username', 255);
          $table->string('password', 64);
          $table->string('email', 255);
          $table->string('display_name')->nullable();
          $table->string('display_image')->nullable()->default('/assets/images/generals/image_user_dp_default.png');
          $table->text('about_me');
          $table->string('reset_password', 64)->nullable();
          $table->datetime('reset_password_expiry')->nullable();
          $table->string('activation_code')->nullable();
          $table->string('activation_status', 1)->default('N'); //N - Not active, A - Active
          $table->datetime('activation_expiry')->nullable();

          $table->boolean('super_admin')->default(0);
          $table->string('country',2)->default('SG');
          $table->string('language',10)->default('en');
          $table->datetime('last_access')->nullable();
          $table->rememberToken();

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
        Schema::drop('users');
    }
}
