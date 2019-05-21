<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDeliveryDaysTable extends Migration {

	public function up()
	{
		Schema::create('delivery_days', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 50);
		});
	}

	public function down()
	{
		Schema::drop('delivery_days');
	}
}