<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('feature_id')->nullable();
          $table->string('name')->nullable();
          //$table->string('label')->nullable();
          $table->string('descr')->nullable();
          $table->string('module', 100)->nullable();
          $table->string('position')->nullable();
          $table->string('url')->nullable();
          $table->string('icon')->nullable();
          $table->string('icon_bg')->nullable();
          $table->string('page')->nullable()->default('index');
          $table->string('prompt_type')->default('none');
          $table->string('prompt_title')->nullable();
          $table->string('prompt_content')->nullable();


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
        Schema::drop('permissions');
    }
}
