<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('client_id')->unsigned();
			$table->time('delivery_time');
			$table->string('delivery_date');
			$table->string('delivery_address', 100);
			$table->string('notes', 100);
			$table->float('total_price');
			$table->boolean('delivery_status_resturant');
			$table->boolean('status');
			$table->boolean('delivery_status_client');
			$table->integer('payment_method_id');
            $table->integer('resturant_id');

		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}