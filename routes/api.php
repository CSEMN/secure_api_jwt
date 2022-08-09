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

Route::group(['middleware' => 'api'], function($router) {
    Route::post('/register', [\App\Http\Controllers\JWTController::class, 'register']);
    Route::post('/login', [\App\Http\Controllers\JWTController::class, 'login']);
    Route::post('/logout', [\App\Http\Controllers\JWTController::class, 'logout']);
    Route::post('/refresh', [\App\Http\Controllers\JWTController::class, 'refresh']);
    Route::post('/profile', [\App\Http\Controllers\JWTController::class, 'profile']);
    Route::put('/update', [\App\Http\Controllers\JWTController::class, 'update']);
});

Route::apiResource('product',\App\Http\Controllers\ProductController::class);
