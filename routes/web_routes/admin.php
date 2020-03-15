<?php

Route::group([
    'namespace' => 'Admin',
    'prefix' => 'admin', 
    'name' => 'admin.', 
    'middleware' => ['auth', 'admin']
], function () {
    Route::get('/', 'DashboardController@index')->name('index');
});