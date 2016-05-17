<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVouchersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vouchers', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('code', 13)->unique();
			$table->integer('discount')->default(50);
			$table->integer('child_limit')->default(3);

			$table->integer('order_id')->unsigned()->nullable();
			$table->foreign('order_id')->references('id')->on('orders')->onDelete('set null');

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
		Schema::drop('vouchers');
	}

}
