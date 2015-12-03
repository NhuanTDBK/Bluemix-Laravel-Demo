<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_event', function (Blueprint $table) {
            //
			$table->bigIncrements('comment_event_id');
			$table->integer('post_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->string('text');
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
        Schema::table('comment_event', function (Blueprint $table) {
            //
        });
    }
}
