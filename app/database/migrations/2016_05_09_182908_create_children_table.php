<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildrenTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('children', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('order_id')->unsigned();

			$table->string('first_name', 100);
			$table->string('last_name', 100);
			$table->date('date_of_birth');
			$table->string('school_year', 10)->nullable();
			$table->boolean('sleepover')->default(0);
			$table->string('notes')->nullable();

			$table->string('group_name', 25)->nullable();

			$table->timestamps();

			$table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('children');
	}

}
