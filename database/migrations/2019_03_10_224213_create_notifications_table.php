<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('notifications', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title', 100);
			$table->string('content', 100);
			$table->integer('order_id');
			$table->string('title_en', 100);
			$table->string('content_en', 200);
		});
	}

	public function down()
	{
		Schema::drop('notifications');
	}
}