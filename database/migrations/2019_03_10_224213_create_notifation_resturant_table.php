<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotifationResturantTable extends Migration {

	public function up()
	{
		Schema::create('notifation_resturant', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('resturant_id');
			$table->integer('notification_id');
		});
	}

	public function down()
	{
		Schema::drop('notifation_resturant');
	}
}