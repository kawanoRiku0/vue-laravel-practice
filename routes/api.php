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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/tweets', 'App\Http\Controllers\Tweet\GetController');
Route::post('/tweets', 'App\Http\Controllers\Tweet\PostController');
Route::delete('/tweets/{tweet_id}', 'App\Http\Controllers\Tweet\DeleteController');
