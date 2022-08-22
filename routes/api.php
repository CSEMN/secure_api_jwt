<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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
    Route::post('/login', [\App\Http\Controllers\JWTController::class, 'login']);
    Route::post('/logout', [\App\Http\Controllers\JWTController::class, 'logout']);
    Route::post('/refresh', [\App\Http\Controllers\JWTController::class, 'refresh']);
    Route::get('/profile', [\App\Http\Controllers\UserController::class, 'profile']);
    Route::post('/register', [\App\Http\Controllers\UserController::class, 'register']);
    Route::put('/update', [\App\Http\Controllers\UserController::class, 'update']);
});

Route::apiResource('products',\App\Http\Controllers\ProductController::class);

//Github OAuth
Route::group(['middleware' => ['web']], function () {

    Route::get('/{provider}/redirect', [\App\Http\Controllers\AuthController::class,'redirect']);
    Route::get('/{provider}/callback',[\App\Http\Controllers\AuthController::class,'callback']);
    Route::get('/{provider}/auth',[\App\Http\Controllers\AuthController::class,'handel_oauth']);

});
