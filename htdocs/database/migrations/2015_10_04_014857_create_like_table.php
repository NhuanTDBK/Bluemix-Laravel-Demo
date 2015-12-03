<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('like_event', function (Blueprint $table) {
            //
			$table->bigIncrements('like_event_id');
			$table->integer('post_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('like_event', function (Blueprint $table) {
            //
        });
    }
}
