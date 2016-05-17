<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('transaction_id', 13)->unique();
			$table->integer('status')->default(0);

			$table->decimal('amount_due', 5, 2);
			$table->decimal('amount_extra', 5, 2)->default(0);
			$table->decimal('amount_paid', 5, 2);
			
			$table->string('first_name', 100);
			$table->string('last_name', 100);
			$table->string('email', 254);
			$table->string('phone', 50);
			$table->boolean('photos_permitted')->nullable();
			$table->boolean('outings_permitted')->nullable();

			$table->text('notes')->nullable();

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
		Schema::drop('orders');
	}

}
