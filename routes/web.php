<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MCategoryTaskController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('web')->group(function(){
    Route::controller(AuthController::class)->group(function(){
        Route::get('/','ViewLogin')->middleware('guest')->name('login');
        Route::post('/','authenticate')->middleware('guest');
        Route::get('/logout','logout')->middleware('auth');
    });
    
    Route::controller(DashboardController::class)->group(function(){
        Route::get('/beranda','dashboard')->middleware('auth');
    });

    Route::controller(UserController::class)->group(function(){
        Route::get('/user','index')->middleware(['auth','checkHakAkses:admin']);
        Route::post('/user/d','destroy')->middleware(['auth','checkHakAkses:admin']);
    });

    Route::controller(TaskController::class)->group(function(){
        Route::get('/task','index')->middleware(['auth','checkHakAkses:admin']);
        Route::post('/task/d','destroy')->middleware(['auth','checkHakAkses:admin']);
    });

    Route::controller(MCategoryTaskController::class)->group(function(){
        Route::get('/category','index')->middleware(['auth','checkHakAkses:admin']);
        Route::post('/category/d','destroy')->middleware(['auth','checkHakAkses:admin']);
    });
});

// Route::get('/', function () {
//     return view('welcome');
// });
