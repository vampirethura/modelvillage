<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
          $table->increments('id');
          $table->string('code',2);
          $table->string('name',100);
          $table->string('currency',30)->nullable();
          $table->string('currency_code',4)->nullable();
          $table->string('region_code', 4)->nullable();
          $table->string('sub_region_code', 4)->nullable();
          $table->integer('map_id')->nullable();

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
        Schema::drop('countries');
    }
}
