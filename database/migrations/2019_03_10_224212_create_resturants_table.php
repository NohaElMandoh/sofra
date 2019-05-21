<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResturantsTable extends Migration {

	public function up()
	{
		Schema::create('resturants', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('neighborhood_id')->unsigned();
			$table->string('name', 50);
			$table->string('email', 50);
			$table->integer('delivery_way_id');
			$table->float('delivery_fee');
			$table->float('minimum_order');
			$table->string('phone', 25);
			$table->string('whatsapp_link', 100);
			$table->string('img', 100);
			$table->boolean('status');
			$table->string('password', 200);
			$table->string('api_token', 200)->nullable();
			$table->string('delivery_time', 50);
            $table->string('code',6)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('resturants');
	}
}