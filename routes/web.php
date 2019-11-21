<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
    return view('welcome');
});

Route::get('login', 'Auth\LoginController@getLogin')
    ->name('login');

Route::post('login', 'Auth\LoginController@postLogin');

Route::get('register', 'Auth\RegisterController@getRegister')
    ->name('register');
Route::post('register', 'Auth\RegisterController@postRegister');

Route::get('orders', 'OrderController@index')->name('order.index');

Route::get('order/create', 'OrderController@create')
    ->name('order.create')
    ->middleware('auth');
Route::post('order/store', 'OrderController@store')->name('order.store');


Route::get('vnpay/payment', 'OrderController@vnpay_return_url')
    ->name('order.vnpay.return')
    ->middleware('auth');
