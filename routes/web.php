<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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
});

// Route::get('/', function () {
//     return view('welcome');
// });
