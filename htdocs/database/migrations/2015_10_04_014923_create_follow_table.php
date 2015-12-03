<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follow_event', function (Blueprint $table) {
            //
			$table->bigIncrements('follow_event_id');
			$table->integer('follower_id')->unsigned();
			$table->integer('following_id')->unsigned();
			$table->integer('follow_type')->unsigned();
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
        Schema::table('follow_event', function (Blueprint $table) {
            //
        });
    }
}
