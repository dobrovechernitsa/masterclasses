<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MasterClassController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\InstructorController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/booking/confirm/{masterClass}', [BookingController::class, 'confirm'])->name('booking.confirm');
    Route::post('/booking/{masterClass}', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/deny/{masterClass}', [BookingController::class, 'deny'])->name('booking.deny');
    Route::delete('/booking/{booking}', [BookingController::class, 'cancel'])->name('booking.cancel');
    
    Route::prefix('instructor')->name('instructor.')->group(function () {
        Route::get('/cabinet', [InstructorController::class, 'cabinet'])->name('cabinet');
        Route::get('/master-classes/create', [MasterClassController::class, 'create'])->name('master-classes.create');
        Route::post('/master-classes', [MasterClassController::class, 'store'])->name('master-classes.store');
        Route::get('/master-classes/{masterClass}/edit', [MasterClassController::class, 'edit'])->name('master-classes.edit');
        Route::put('/master-classes/{masterClass}', [MasterClassController::class, 'update'])->name('master-classes.update');
    });
});