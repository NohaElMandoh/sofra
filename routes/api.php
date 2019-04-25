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

    ///client
    Route::group(['prefix' =>'client'],function(){
        Route::post('register_client', 'client\AuthController@register');
        Route::post('login', 'Client\AuthController@login');
        Route::post('reset', 'Client\AuthController@reset');
        Route::post('check_code', 'Client\AuthController@check_code');
        Route::post('update_password', 'Client\AuthController@update_password');


        Route::group(['middleware'=>'auth:restaurant'],function(){
            Route::post('profile', 'Client\AuthController@profile');
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

            Route::post('resturant_info', 'resturant\MainController@resturant_info');
            Route::post('add_product', 'resturant\MainController@add_product');
            Route::post('all_products', 'resturant\MainController@all_products');
            Route::post('edit_product', 'resturant\MainController@edit_product');
            Route::post('add_offer', 'resturant\MainController@add_offer');
            Route::post('all_offers', 'resturant\MainController@all_offers');


        });
    });


});




