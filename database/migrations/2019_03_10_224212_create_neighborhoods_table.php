<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNeighborhoodsTable extends Migration {

	public function up()
	{
		Schema::create('neighborhoods', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('city_id')->unsigned();
			$table->string('name', 50);
		});
	}

	public function down()
	{
		Schema::drop('neighborhoods');
	}
}