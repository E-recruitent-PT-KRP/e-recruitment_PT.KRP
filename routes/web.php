<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\Admin\AuthController;
use App\Http\Controllers\DashboardController;


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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('landing.index');
});


Route::prefix('admin')->group(function () {

    // Routes without authentication (login routes)
    Route::get('/login-admin', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login-admin', [AuthController::class, 'login'])->name('admin.login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    // Routes that require authentication with 'auth:admin' guard
    Route::middleware('auth:admin')->group(function () {

        // Admin Dashboard
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    });

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
