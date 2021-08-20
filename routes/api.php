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

Route::middleware('auth:api')->group(function() {
	Route::get('/auth/user', 'Api\AuthController@getUser');
	Route::prefix('files')->group(function() {
		Route::get('getAll', 'Api\FilesController@getAll');
		Route::post('upload', 'Api\FilesController@upload');
	});
});


Route::post('/auth/login', 'Api\AuthController@login');
Route::post('/auth/register', 'Api\AuthController@register');
