<?php

use App\Models\Career;
use App\Models\Gallery;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PelamarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PendaftarController;
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
// Route::get('/', function () {
//     return view('landing.index');
// });

Route::get('/', function () {
    // Ambil data career yang dikelompokkan berdasarkan minimum_education
    $careersByEducation = Career::select('minimum_education', 'id', 'job_name', 'maximum_age', 'major', 'salary', 'open_date', 'close_date', 'job_desc', 'job_criteria')
        ->orderBy('minimum_education')
        ->get()
        ->groupBy('minimum_education');
    $allCareers = Career::all();

    $galleryItems = Gallery::all();

    return view('landing.index', compact('careersByEducation', 'allCareers', 'galleryItems'));
});

// Route::get('/', [HomeController::class, 'landing'])->name('landing.index');


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

        Route::name('gallery.')->group(function () {
            Route::get('/gallery', [GalleryController::class, 'index'])->name('index');
            Route::get('/gallery/create', [GalleryController::class, 'create'])->name('create');
            Route::post('/gallery', [GalleryController::class, 'store'])->name('store');
            Route::get('/gallery/{id}/edit', [GalleryController::class, 'edit'])->name('edit');
            Route::put('/gallery/{id}', [GalleryController::class, 'update'])->name('update');
            Route::delete('/gallery/{id}', [GalleryController::class, 'destroy'])->name('destroy');
        });

        //Pendaftar
        // Route::get('pendaftar', [PendaftarController::class, 'index'])->name('pendaftar.index');
        // Route::get('pendaftar/{careerId}', [PendaftarController::class, 'index'])->name('pendaftar.index');

        // Pendaftar Routes
        Route::controller(PendaftarController::class)->name('pendaftar.')->group(function () {
            Route::get('/pendaftar', 'index')->name('index');
            Route::get('/pendaftar/{id}', 'show')->name('show'); // Ini yang dimaksud
            Route::get('/cv/{id}', 'showCv')->name('showCv');

            Route::patch('/pendaftar/{id}/tes', 'tes')->name('tes');
            Route::patch('/pendaftar/{id}/interview', 'interview')->name('interview');
            Route::patch('/pendaftar/{id}/mcu', 'mcu')->name('mcu');

            Route::patch('/pendaftar/{id}/terima', 'terima')->name('terima');
            Route::patch('/pendaftar/{id}/tolak', 'tolak')->name('tolak');
        });

        //Arsip career
        Route::get('/arsip/data-diterima', [ArsipController::class, 'showAccepted'])->name('arsip.data-diterima');
        Route::get('/arsip/data-ditolak', [ArsipController::class, 'showRejected'])->name('arsip.data-ditolak');


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
    Route::get('/career/show/{id}', [CareeruserController::class, 'show'])->name('careeruser.show');

});

Route::get('/careeruser/applyjob', [CareeruserController::class, 'applyJob'])->name('careeruser.applyJob');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
