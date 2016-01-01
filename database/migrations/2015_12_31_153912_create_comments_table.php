<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id');
            $table->string('comment_text');
            $table->integer('customer_id');
            //Common to all table ----------------------------------------------
      			$table->integer('data_owner_id')->nullable();
      			$table->integer('loc_access_id')->nullable();
      			$table->integer('created_by')->default(1);
      			$table->integer('updated_by')->default(1);
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
        Schema::drop('comments');
    }
}
