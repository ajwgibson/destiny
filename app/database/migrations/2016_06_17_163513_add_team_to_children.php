<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTeamToChildren extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('children', function(Blueprint $table)
		{
			$table->tinyInteger('team')->unsigned()->nullable();

			$table->integer('friend_id')->unsigned()->nullable();
			$table->foreign('friend_id')->references('id')->on('children')->onDelete('set null');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('children', function(Blueprint $table)
		{
			$table->dropColumn('team');

			$table->dropForeign('friend_id');
			$table->dropColumn('friend_id');
		});
	}

}
