<?php

Route::group([
    'namespace' => 'User',
    'prefix'=> 'dashboard',
    'name' => 'user.',
    'middleware' => ['auth'],
], function () {

    Route::get('update-payment-methods', 'PaymentMethodController@update')->name('payment-methods.update');
    Route::post('update-payment-methods', 'PaymentMethodController@updateToken')->name('payment-methods.update-token');
    Route::delete('payment-methods/{id}', 'PaymentMethodController@destroy')->name('payment-methods.destroy');
});
