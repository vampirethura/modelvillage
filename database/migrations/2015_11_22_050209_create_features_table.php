<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('features', function (Blueprint $table) {
          $table->increments('id');
          $table->string('group')->nullable()->default(NULL);
          $table->string('group_icon')->nullable();
          $table->string('name');
          $table->string('url')->nullable();
          $table->string('descr')->nullable();
          $table->string('icon', 100)->nullable();
          $table->boolean('display')->default(1);
          $table->boolean('admin')->nullable();
          $table->boolean('crud')->nullable();
          $table->string('module')->nullable();



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
        Schema::drop('features');
    }
}
