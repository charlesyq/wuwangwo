<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpenUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('open_users', function(Blueprint $table)
		{
            $table->integer('user_id');
            $table->string('provider');
            $table->string('open_id');
            $table->unique(array('provider', 'open_id'));
            $table->primary('user_id');
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
		Schema::drop('open_users');
	}

}
