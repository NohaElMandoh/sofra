<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDeliveryDaysResturantsTable extends Migration {

	public function up()
	{
		Schema::create('delivery_days_resturants', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('delivery_day_id')->unsigned();
			$table->integer('resturant_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('delivery_days_resturants');
	}
}