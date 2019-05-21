<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOffersTable extends Migration {

	public function up()
	{
		Schema::create('offers', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('resturant_id')->unsigned();
			$table->string('title', 50);
			$table->string('desc', 100);
			$table->float('price');
			$table->string('from',50);
			$table->string('to',50);
			$table->string('img', 200);
		});
	}

	public function down()
	{
		Schema::drop('offers');
	}
}