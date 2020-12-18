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

Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');


Route::middleware('auth:api')->group(function () {
    Route::get('this_month', 'Api\HomeController@index');
    Route::get('report/{year?}/{month?}', 'Api\HomeController@report');
    Route::post('new', 'Api\HomeController@store');


    Route::prefix('user')->group(function () {
        Route::post('update/password', 'Api\UserController@updatePassword');
        Route::post('update/profile', 'Api\UserController@updateProfile');
    });
});
