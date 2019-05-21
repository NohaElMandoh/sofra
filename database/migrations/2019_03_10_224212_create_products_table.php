<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('resturant_id')->unsigned();
			$table->string('name', 50);
			$table->string('desc', 100);
			$table->float('price');
			$table->string('preparation_time', 50);
			$table->string('product_img', 100);
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}