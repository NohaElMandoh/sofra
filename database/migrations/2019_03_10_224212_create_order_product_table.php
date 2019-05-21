<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderProductTable extends Migration {

	public function up()
	{
		Schema::create('order_product', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('order_id')->unsigned();
			$table->integer('product_id')->unsigned();
			$table->integer('count');
			$table->string('special_order', 100);
			$table->float('total_price');
		});
	}

	public function down()
	{
		Schema::drop('order_product');
	}
}