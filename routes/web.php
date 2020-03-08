<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=> 'auth'], function()
{
    Route::get('update-payment-methods', 'PaymentMethodController@update')->name('payment-methods.update');
    Route::post('update-payment-methods', 'PaymentMethodController@updateToken')->name('payment-methods.update-token');
    Route::delete('payment-methods/{id}', 'PaymentMethodController@destroy')->name('payment-methods.destroy');
});
