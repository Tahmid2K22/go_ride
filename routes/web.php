<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverApplicationController;
use App\Http\Controllers\DriverDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RideController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/about', 'about')->name('about');

Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);

Route::get('register', [AuthController::class, 'showRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);

// Public Driver Application Routes
Route::get('/apply-to-drive', [DriverApplicationController::class, 'create'])->name('driver-apply.create');
Route::post('/apply-to-drive/step1', [DriverApplicationController::class, 'storeStep1'])->name('driver-apply.step1');
Route::get('/apply-to-drive/step2', [DriverApplicationController::class, 'step2'])->name('driver-apply.step2');
Route::post('/apply-to-drive/step2', [DriverApplicationController::class, 'storeStep2'])->name('driver-apply.step2.store');
Route::get('/apply-to-drive/step3', [DriverApplicationController::class, 'step3'])->name('driver-apply.step3');
Route::post('/apply-to-drive/step3', [DriverApplicationController::class, 'storeStep3'])->name('driver-apply.submit');
Route::get('/apply-to-drive/success', [DriverApplicationController::class, 'success'])->name('driver-apply.success');

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::put('password', [AuthController::class, 'updatePassword'])->name('password.update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('role:rider')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/book-ride', [RideController::class, 'create'])->name('rides.create');
        Route::post('/rides', [RideController::class, 'store'])->name('rides.store');
        // AJAX alias used by the JS booking flow (returns JSON 201)
        Route::post('/ride-requests', [RideController::class, 'store'])->name('ride-requests.store');
    });

    Route::middleware('role:driver')->prefix('driver')->name('driver.')->group(function () {
        Route::get('/dashboard', [DriverDashboardController::class, 'index'])->name('dashboard');
        Route::patch('/ride/{ride}/accept', [DriverDashboardController::class, 'acceptRide'])->name('accept-ride');
        Route::patch('/ride/{ride}/start', [DriverDashboardController::class, 'startRide'])->name('start-ride');
        Route::patch('/ride/{ride}/complete', [DriverDashboardController::class, 'completeRide'])->name('complete-ride');
        Route::patch('/ride/{ride}/cancel', [DriverDashboardController::class, 'cancelRide'])->name('cancel-ride');
        Route::post('/toggle-online', [DriverDashboardController::class, 'toggleOnline'])->name('toggle-online');
    });
});