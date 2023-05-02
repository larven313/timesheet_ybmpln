<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PositionController;
use App\Models\Activity;
use App\Models\Notification;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [DashboardController::class, 'index'])->middleware('auth');

Route::group(['middleware' => ['admin', 'auth']], function () {
    Route::get('/pegawai', function () {
        $notif = Notification::all();

        return Redirect::route('pegawai.index')->with('notifications', $notif);
    });

    Route::resource('/departemen', DepartmentController::class)->except('show');
    Route::resource('/jabatan', PositionController::class)->except('show');
});

Route::resource('/pegawai', UserController::class)->except(['show', 'edit', 'update'])->middleware('validator');
Route::put('/pegawai/{username}', [UserController::class, 'update'])->middleware('auth')->name('user.show');
Route::get('/pegawai/{username}/edit', [UserController::class, 'edit'])->middleware('auth');
Route::get('/pegawai/{username}', [UserController::class, 'show'])->middleware('auth');

Route::put('/notification/edit/{id}', [NotificationController::class, 'update']);

Route::resource('/aktivitas', ActivityController::class)->except('show')->middleware('auth');
Route::get('aktivitas/{username}', [ActivityController::class, 'show']);
Route::resource('/notifikasi', NotificationController::class)->middleware('auth');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
