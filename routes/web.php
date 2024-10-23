<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\PelamarController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\DashboardController;
use App\http\Controllers\Admin\AuthController;
use App\Http\Controllers\CareeruserController;


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
        // Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::name('career.')->group(function () {
            Route::get('/career', [CareerController::class, 'index'])->name('index');
            Route::get('/career/create', [CareerController::class, 'create'])->name('create');
            Route::post('/career', [CareerController::class, 'store'])->name('store');
            Route::get('/career/{id}/edit', [CareerController::class, 'edit'])->name('edit');
            Route::put('/career/{id}', [CareerController::class, 'update'])->name('update');
            Route::delete('/career/{id}', [CareerController::class, 'destroy'])->name('destroy');
        });

        //Pendaftar
        // Route::get('pendaftar', [PendaftarController::class, 'index'])->name('pendaftar.index');
        // Route::get('pendaftar/{careerId}', [PendaftarController::class, 'index'])->name('pendaftar.index');

        // Pendaftar Routes
        Route::controller(PendaftarController::class)->name('pendaftar.')->group(function () {
            Route::get('/pendaftar', 'index')->name('index');
            Route::get('/pendaftar/{id}', 'show')->name('show');
            Route::get('/cv/{id}', 'showCv')->name('showCv');

            Route::patch('/pendaftar/{id}/tes', 'tes')->name('tes');
            Route::patch('/pendaftar/{id}/interview', 'interview')->name('interview');
            Route::patch('/pendaftar/{id}/mcu', 'mcu')->name('mcu');

            Route::patch('/pendaftar/{id}/acc', 'acc')->name('acc');
            Route::patch('/pendaftar/{id}/tolak', 'tolak')->name('tolak');
        });
    });

});


Auth::routes(['verify' => true]);
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('verified');
Route::get('/profile', [HomeController::class, 'profile'])->name('profile')->middleware('verified');

Route::prefix('user')->middleware('verified')->group(function () {
    Route::resource('/pelamar', PelamarController::class);
    Route::resource('/careeruser', CareeruserController::class);
    Route::get('/cv/{id}', [PelamarController::class, 'showCv'])->name('cv.show');

    Route::post('/career/store/{id}', [CareeruserController::class, 'store'])->name('careeruser.store');

});

Route::get('/careeruser/applyjob', [CareeruserController::class, 'applyJob'])->name('careeruser.applyJob');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
