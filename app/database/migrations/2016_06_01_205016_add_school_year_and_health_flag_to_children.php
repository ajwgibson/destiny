<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSchoolYearAndHealthFlagToChildren extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('children', function(Blueprint $table)
		{
			$table->dropColumn('school_year'); // Wrong type first time around
			$table->dropColumn('notes');       // Wrong type first time around
		});

		Schema::table('children', function(Blueprint $table)
		{
			$table->tinyInteger('school_year')->unsigned();
			$table->boolean('health_warning')->default(0);
			$table->text('notes')->nullable();
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
			$table->dropColumn('health_warning');
		});
	}

}
