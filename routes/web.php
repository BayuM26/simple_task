<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
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
        Route::get('/logout','logout')->middleware('auth');
        Route::get('/changePassword','changePassword')->middleware('auth');
        Route::post('/changePassword','changePasswordUpdate')->middleware('auth');

        Route::post('/','authenticate')->middleware('guest');
    });
    
    Route::controller(DashboardController::class)->group(function(){
        Route::get('/beranda','dashboard')->middleware('auth');
    });

    Route::controller(ContactController::class)->group(function(){
        Route::get('/contact','index')->middleware('auth');
    });

    Route::controller(UserController::class)->group(function(){
        Route::get('/user','index')->middleware(['auth','checkHakAkses:admin']);
        Route::get('/update/user','show')->middleware(['auth','checkHakAkses:admin']);

        Route::post('/update/user/{id}','edit')->middleware(['auth','checkHakAkses:admin']);
        Route::post('/user','store')->middleware(['auth','checkHakAkses:admin']);
        Route::post('/user/d','destroy')->middleware(['auth','checkHakAkses:admin']);
    });

    Route::controller(TaskController::class)->group(function(){
        Route::get('/task','index')->middleware(['auth','checkHakAkses:admin,Employee']);
        Route::get('/detail/task','detail')->middleware(['auth','checkHakAkses:Employee']);
        Route::post('/detail/task','doneTask')->middleware(['auth','checkHakAkses:Employee']);
        Route::get('/update/task','show')->middleware(['auth','checkHakAkses:admin']);

        Route::post('/update/task/{id}','edit')->middleware(['auth','checkHakAkses:admin']);
        Route::post('/task','store')->middleware(['auth','checkHakAkses:admin']);
        Route::post('/task/d','destroy')->middleware(['auth','checkHakAkses:admin']);
    });

    Route::controller(MCategoryTaskController::class)->group(function(){
        Route::get('/category','index')->middleware(['auth','checkHakAkses:admin']);
        Route::get('/update/category','show')->middleware(['auth','checkHakAkses:admin']);

        Route::post('/update/category/{id}','edit')->middleware(['auth','checkHakAkses:admin']);
        Route::post('/category','store')->middleware(['auth','checkHakAkses:admin']);
        Route::post('/category/d','destroy')->middleware(['auth','checkHakAkses:admin']);
    });
});

// Route::get('/', function () {
//     return view('welcome');
// });
