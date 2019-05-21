<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDeliveryWaysTable extends Migration {

	public function up()
	{
		Schema::create('delivery_ways', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 50);
		});
	}

	public function down()
	{
		Schema::drop('delivery_ways');
	}
}