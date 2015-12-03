<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            //
			$table->increments('post_id');
            $table->string('title')->nullable();
			$table->string('description')->nullable();
			$table->string('photo_link');
			$table->integer('user_id')->unsigned();
			$table->integer('board_id')->unsigned();
			$table->foreign('user_id')->references('user_id')->on('users');
			$table->foreign('board_id')->references('board_id')->on('boards')->onDelete('cascade')->onUpdate('cascade');
			$table->string('place_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            //
        });
    }
}
