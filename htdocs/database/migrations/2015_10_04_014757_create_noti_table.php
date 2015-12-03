<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('notifi_id');
			$table->integer('type');
			$table->integer('user_id')->unsigned();
			$table->integer('receiver_id')->unsigned();
			$table->boolean('is_read');
			$table->integer('objectID')->unsigned()->nullable();
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
        Schema::table('notifications', function (Blueprint $table) {
            //
        });
    }
}
