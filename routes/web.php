<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CmsPageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SocialiteController;
use Illuminate\Support\Facades\Route;


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

//when enter / or /admin it will redirect to /admin/login
Route::get('/', function () {
    return redirect('/admin/login');
});

Route::get('login/{provider}/callback', [SocialiteController::class, 'handleProviderCallback']);
Route::prefix('admin')->group(function () {
    Route::match (['get', 'post'], '/login', [DashboardController::class, 'login']);

    // provide social login
    Route::get('login/{provider}', [SocialiteController::class, 'redirectToProvider']);

    Route::group(['middleware' => 'admin'], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::match (['get', 'post'], '/update-password', [DashboardController::class, 'updatePassword']);
        Route::match (['get', 'post'], '/update-admin-details', [DashboardController::class, 'updateAdminDetails']);
        Route::post('/check-current-password', [DashboardController::class, 'checkCurrentPassword']);
        Route::get('/logout', [DashboardController::class, 'logout']);
        //Cms Pages
        Route::prefix('cms-pages')->group(function () {
            Route::get('/', [CmsPageController::class, 'index']);
            Route::post('update-cms-page-status', [CmsPageController::class, 'updateCmsPageStatus']);
            Route::match (['get', 'post'], 'add-edit-cms-page/{id?}', [CmsPageController::class, 'edit']);
            Route::get('delete-cms-page/{id}', [CmsPageController::class, 'destroy']);
        });

        Route::get('trashed/categories', [CategoryController::class, 'trash'])->name('categories.trash');
        Route::put('categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
        Route::delete('categories/{id}/force-delete', [CategoryController::class, 'forceDelete'])->name('categories.force-delete');


        Route::resource('categories', CategoryController::class)->except(['show']);
    });
});
