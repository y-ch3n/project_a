<?php

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

Route::group([
    'namespace' => 'API',
    'prefix' => 'api',
    'middleware' => 'auth:api',
], function () {
    require __DIR__.'/api_routes/v1/user.php';
    require __DIR__.'/api_routes/v1/admin.php';
});
