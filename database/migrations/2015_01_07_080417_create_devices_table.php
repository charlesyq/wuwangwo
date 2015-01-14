<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('devices', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('user_id');
            $table->string('uuid')->nullable();
            $table->string('model');
            $table->string('os');
            $table->string('marketing_channel_id');
            $table->string('ext1')->nullable();
            $table->string('ext2')->nullable();

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
		Schema::drop('devices');
	}

}
