<?php

Route::group([
    'namespace' => 'User',
    'prefix' => 'v1',
    'middleware' => []
], function() {
    Route::get('/user', 'UserController@index');
});