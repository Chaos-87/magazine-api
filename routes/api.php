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

Route::get('authorize', 'UsersController@login');

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('/publishers/list', 'PublishersController@allOrderByName');
    Route::get('/magazines/search', 'MagazinesController@search');
    Route::get('/magazines/{id}', 'MagazinesController@show');
});
