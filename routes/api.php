<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiCategoryController;
use App\Http\Controllers\ApiTaskController;
use App\Http\Controllers\ApiUserController;
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

Route::middleware('api')->group(function(){
    Route::controller(ApiAuthController::class)->group(function(){
        Route::post('/login', 'login');
        Route::post('/logout', 'logout');
        Route::post('/refresh', 'refresh');
        Route::post('/me', 'me');
    });

    Route::controller(ApiTaskController::class)->group(function(){
        Route::get('/getTask','getTaskdata');
    });

    Route::controller(ApiUserController::class)->group(function(){
        Route::get('/getUser','getUserData');
    });

    Route::controller(ApiCategoryController::class)->group(function(){
        Route::get('/getCategory','getCategoryData');
    });
});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
