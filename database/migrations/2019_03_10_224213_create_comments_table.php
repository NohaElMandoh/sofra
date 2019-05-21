<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommentsTable extends Migration {

	public function up()
	{
		Schema::create('comments', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('resturant_id');
			$table->string('desc', 150);
			$table->integer('stars');
		});
	}

	public function down()
	{
		Schema::drop('comments');
	}
}