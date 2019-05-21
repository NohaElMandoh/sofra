<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('neighborhoods', function(Blueprint $table) {
			$table->foreign('city_id')->references('id')->on('cities')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('resturants', function(Blueprint $table) {
			$table->foreign('neighborhood_id')->references('id')->on('neighborhoods')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('products', function(Blueprint $table) {
			$table->foreign('resturant_id')->references('id')->on('resturants')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->foreign('client_id')->references('id')->on('clients')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('order_product', function(Blueprint $table) {
			$table->foreign('order_id')->references('id')->on('orders')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('order_product', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('offers', function(Blueprint $table) {
			$table->foreign('resturant_id')->references('id')->on('resturants')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('category_resturant', function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('categories')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('category_resturant', function(Blueprint $table) {
			$table->foreign('resturant_id')->references('id')->on('resturants')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('payments', function(Blueprint $table) {
			$table->foreign('resturant_id')->references('id')->on('resturants')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('delivery_days_resturants', function(Blueprint $table) {
			$table->foreign('delivery_day_id')->references('id')->on('delivery_days')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('delivery_days_resturants', function(Blueprint $table) {
			$table->foreign('resturant_id')->references('id')->on('resturants')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('neighborhoods', function(Blueprint $table) {
			$table->dropForeign('neighborhoods_city_id_foreign');
		});
		Schema::table('resturants', function(Blueprint $table) {
			$table->dropForeign('resturants_neighborhood_id_foreign');
		});
		Schema::table('products', function(Blueprint $table) {
			$table->dropForeign('products_resturant_id_foreign');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->dropForeign('orders_client_id_foreign');
		});
		Schema::table('order_product', function(Blueprint $table) {
			$table->dropForeign('order_product_order_id_foreign');
		});
		Schema::table('order_product', function(Blueprint $table) {
			$table->dropForeign('order_product_product_id_foreign');
		});
		Schema::table('offers', function(Blueprint $table) {
			$table->dropForeign('offers_resturant_id_foreign');
		});
		Schema::table('category_resturant', function(Blueprint $table) {
			$table->dropForeign('category_resturant_category_id_foreign');
		});
		Schema::table('category_resturant', function(Blueprint $table) {
			$table->dropForeign('category_resturant_resturant_id_foreign');
		});
		Schema::table('payments', function(Blueprint $table) {
			$table->dropForeign('payments_resturant_id_foreign');
		});
		Schema::table('delivery_days_resturants', function(Blueprint $table) {
			$table->dropForeign('delivery_days_resturants_delivery_day_id_foreign');
		});
		Schema::table('delivery_days_resturants', function(Blueprint $table) {
			$table->dropForeign('delivery_days_resturants_resturant_id_foreign');
		});
	}
}