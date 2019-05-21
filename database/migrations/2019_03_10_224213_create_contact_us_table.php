<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactUsTable extends Migration {

	public function up()
	{
		Schema::create('contact_us', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 50);
			$table->string('email', 100);
			$table->string('phone', 25);
			$table->text('msg');
			$table->enum('msg_category', array('inquiry', 'suggestion', 'complaint'));
		});
	}

	public function down()
	{
		Schema::drop('contact_us');
	}
}