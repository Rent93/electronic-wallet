<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('v1')->group(function() {
    Route::post('login', 'Api\AuthController@login');
    Route::post('register', 'Api\AuthController@register');


    /**
     * API for {user}
     */
    Route::get('users', 'Api\UserController@index');
    Route::get('user/{id}', 'Api\UserController@show');

    Route::middleware('auth:api')->group(function() {
        /**
         * USER API
         */
        Route::put('user/{id}', 'Api\UserController@update');
        Route::delete('user/{id}', 'Api\UserController@destroy');

        /**
         * ORDER API
         */
        Route::get('orders', 'Api\OrderController@index');
        Route::get('order/{id}', 'Api\OrderController@show');

    });
});
