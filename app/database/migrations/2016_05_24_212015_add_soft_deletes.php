<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftDeletes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('orders', function(Blueprint $table)
		{
			$table->softDeletes();
		});

		Schema::table('children', function(Blueprint $table)
		{
			$table->softDeletes();
			$table->dropForeign('children_order_id_foreign');
			$table->foreign('order_id')->references('id')->on('orders');
		});

		Schema::table('vouchers', function(Blueprint $table)
		{
			$table->softDeletes();
			$table->dropForeign('vouchers_order_id_foreign');
			$table->foreign('order_id')->references('id')->on('orders');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('orders', function(Blueprint $table)
		{
			$table->dropSoftDeletes();
		});

		Schema::table('children', function(Blueprint $table)
		{
			$table->dropSoftDeletes();
			$table->dropForeign('children_order_id_foreign');
			$table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
		});

		Schema::table('vouchers', function(Blueprint $table)
		{
			$table->dropSoftDeletes();
			$table->dropForeign('vouchers_order_id_foreign');
			$table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
		});
	}

}
