<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


////User Route
//Route::prefix('user')->group(function () {
//    Route::post('login','UserController@login');
//});

//User Route
Route::prefix('user')->group(function () {
    Route::post('register','UserController@register');
    Route::post('login','UserController@login');
    Route::post('logout','UserController@logout');
});


//Task Route
Route::prefix('todo')->group(function () {
    Route::post('index', 'TaskController@index');
    Route::post('write', 'TaskController@write');
    Route::post('update', 'TaskController@update');
    Route::post('delete', 'TaskController@delete');
});
