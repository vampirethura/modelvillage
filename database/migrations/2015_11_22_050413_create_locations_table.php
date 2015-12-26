<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->string('type', 20);
          $table->text('descr');
          $table->string('country', 2)->nullable();
          $table->string('city')->nullable();
          $table->string('address')->nullable();

          //map related
          $table->decimal('lat', 10, 6)->nullable()->default(0.000000);
          $table->decimal('long', 10, 6)->nullable()->default(0.000000);
          $table->tinyInteger('min_zoom')->nullable()->default(4);
          $table->tinyInteger('max_zoom')->nullable()->default(14);
          $table->string('ref')->nullable();
          $table->string('pin')->nullable();


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
        Schema::drop('locations');
    }
}
