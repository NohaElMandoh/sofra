<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 50);
			$table->string('email', 50);
			$table->string('phone', 50);
			$table->integer('neighborhood_id');
			$table->string('adderss_desc', 100);
			$table->string('password', 100);
			$table->string('api_token', 60)->nullable();
            $table->string('code',6)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}