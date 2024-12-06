<?php

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

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MoodDiaryController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\UploadController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/appointments', [AppointmentController::class, 'adminIndex'])->name('admin.appointments.index');
    Route::post('/admin/appointments/{appointment}/status', [AppointmentController::class, 'updateStatus'])->name('admin.appointments.updateStatus');
    Route::get('/admin/uploads', [UploadController::class, 'adminIndex'])->name('admin.uploads.index');
    Route::get('/uploads/{upload}/download', [UploadController::class, 'download'])->name('uploads.download');

    //分类
    Route::resource('categories', CategoryController::class);
    //文章
    Route::resource('articles', ArticleController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/mood-diaries/chart', function () {
        return view('mood_diaries.chart');
    });
    Route::resource('articles', ArticleController::class);

    Route::get('/mood-diaries/chart-data', [MoodDiaryController::class, 'chartData']);
    Route::get('/uploads', [UploadController::class, 'index'])->name('uploads.index');
    Route::post('/uploads', [UploadController::class, 'store'])->name('uploads.store');
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::resource('mood-diaries', MoodDiaryController::class);
});



