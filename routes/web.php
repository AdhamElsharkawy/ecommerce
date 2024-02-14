<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::prefix('admin')->group(function () {
    Route::match(['get', 'post'], '/login', [DashboardController::class, 'login']);
    Route::group(['middleware' => 'admin'], function () {
        Route::get('/dashboard', [DashboardController::class, 'index']);
        Route::match(['get', 'post'], '/update-password', [DashboardController::class, 'updatePassword']);
        Route::get('/logout', [DashboardController::class, 'logout']);
        Route::post('/check-current-password', [DashboardController::class, 'checkCurrentPassword']);
    });
});
