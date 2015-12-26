<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeatureRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature_role', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('role_id');
          $table->integer('feature_id');
          $table->tinyInteger('order')->default(1);

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
        Schema::drop('feature_role');
    }
}
