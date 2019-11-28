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

Route::prefix('v1')->group(function() {
    Route::post('login', 'Api\AuthController@login')
        ->name('api.login');
    Route::post('register', 'Api\AuthController@register')
        ->name('api.register');


    /**
     * API for {user}
     */
    Route::get('users', 'Api\UserController@index')
        ->name('api.user.index');
    Route::get('user/{id}', 'Api\UserController@show')
        ->name('api.user.show');

    Route::middleware('auth:api')->group(function() {
        /**
         * USER API
         */
        Route::put('user/{id}', 'Api\UserController@update')
            ->name('api.user.update');
        Route::delete('user/{id}', 'Api\UserController@destroy')
            ->name('api.user.delete');

        /**
         * ORDER API
         */
        Route::get('orders', 'Api\OrderController@index')
            ->name('api.order.index');
        Route::get('order/{id}', 'Api\OrderController@show')
            ->name('api.order.show');
        Route::post('order', 'Api\OrderController@store')
            ->name('api.order.store');
        Route::put('order/{id}', 'Api\OrderController@update')
            ->name('api.order.update');
        Route::delete('order/{id}', 'Api\OrderController@destroy')
            ->name('api.order.delete');

    });
});
