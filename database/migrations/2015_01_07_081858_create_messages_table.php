<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('messages', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('sender_id');
            $table->smallInteger('recipient_type');
            $table->integer('recipient_id');
            $table->smallInteger('type');
            $table->smallInteger('sub_type')->nullable();
            $table->string('mime_type')->nullable();
            $table->string('content');
            $table->string('associate_object')->nullable();
            $table->smallInteger('ack'); // 应答状态 0: 未应答 1: 应答1, 2: 应答2 ...
            $table->smallInteger('status');

            $table->index('sender_id');
            $table->index('recipient_type');
            $table->index('recipient_id');

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
		Schema::drop('messages');
	}

}
