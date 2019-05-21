<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAppSettingsTable extends Migration {

	public function up()
	{
		Schema::create('app_settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('about_text');
			$table->string('instagram_url', 100);
			$table->string('facebook_url', 100);
			$table->string('twitter_url', 100);
			$table->decimal('commission');
		});
	}

	public function down()
	{
		Schema::drop('app_settings');
	}
}