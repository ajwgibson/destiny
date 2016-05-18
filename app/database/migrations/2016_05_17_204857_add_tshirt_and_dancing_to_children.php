<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTshirtAndDancingToChildren extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('children', function(Blueprint $table)
		{
			$table->string('tshirt', 20)->default('MEDIUM');
			$table->boolean('dancing')->default(0);
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
			$table->dropColumn('tshirt');
			$table->dropColumn('dancing');
		});
	}

}
