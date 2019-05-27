<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['namespace'=>'Api','prefix' =>'v1'],function(){
///general
    Route::get('cities', 'MainController@cities');
    Route::get('neighborhoods', 'MainController@neighborhoods');
    Route::get('neighborhoods_to_city', 'MainController@neighborhoods_to_city');
    Route::post('resturant_info', 'resturant\MainController@resturant_info');
    Route::get('about', 'MainController@about');
    Route::get('contact_us', 'MainController@contact_us');
    Route::post('resturants', 'MainController@resturants');  ///////// how to search by city

 Route::get('restaurant_products', 'MainController@restaurant_products');
    ///client
    Route::group(['prefix' =>'client'],function(){
        Route::post('register_client', 'client\AuthController@register');
        Route::post('login', 'Client\AuthController@login');
        Route::post('reset', 'Client\AuthController@reset');
        Route::post('check_code', 'Client\AuthController@check_code');
        Route::post('update_password', 'Client\AuthController@update_password');

        Route::group(['middleware'=>'auth:client'],function(){
            Route::post('profile', 'Client\AuthController@profile');
            Route::post('new_order', 'Client\MaiController@new_order');
            Route::post('my_orders', 'Client\MaiController@my_orders');
            Route::post('order_details', 'Client\MaiController@order_details');
            Route::post('reject_order', 'Client\MaiController@reject_order');

            Route::post('confirm_order', 'Client\MaiController@confirm_order');
        });
    });

///resturant
    Route::group(['prefix' =>'restaurant'],function(){
        Route::post('register_resturant', 'resturant\AuthController@register_resturant');// why pass categories as array
        Route::post('login_res', 'resturant\AuthController@login');
        Route::post('reset', 'resturant\AuthController@reset');
        Route::post('check_code', 'resturant\AuthController@check_code');
        Route::post('update_password', 'resturant\AuthController@update_password');

        Route::group(['middleware'=>'auth:restaurant'],function(){

            Route::post('add_product', 'resturant\MainController@add_product');
            Route::post('all_products', 'resturant\MainController@all_products');
            Route::post('edit_product', 'resturant\MainController@edit_product');
            Route::post('add_offer', 'resturant\MainController@add_offer');
            Route::post('all_offers', 'resturant\MainController@all_offers');
            Route::post('my_orders', 'resturant\MainController@my_orders');
            Route::post('order_details', 'resturant\MainController@order_details');

            Route::post('accept_order', 'resturant\MainController@accept_order');
            Route::post('reject_order', 'resturant\MainController@reject_order');

            Route::post('confirm_order', 'resturant\MainController@confirm_order');


        });
    });


});




