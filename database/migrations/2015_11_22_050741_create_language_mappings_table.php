<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguageMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('language_mappings', function (Blueprint $table) {
          $table->increments('id');
          $table->string('lang', 10);
          $table->string('key');
          $table->string('value');


          //Common to all table ----------------------------------------------
          $table->integer('created_by')->nullable();
          $table->integer('updated_by')->nullable();
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
        Schema::drop('language_mappings');
    }
}
