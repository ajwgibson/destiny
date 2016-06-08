<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActivityChoicesToChildren extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('children', function(Blueprint $table)
		{
			$table->string('activity_choice_1', 100);
			$table->string('activity_choice_2', 100);
			$table->string('activity_choice_3', 100);
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
			$table->dropColumn('activity_choice_1');
			$table->dropColumn('activity_choice_2');
			$table->dropColumn('activity_choice_3');
		});
	}

}
