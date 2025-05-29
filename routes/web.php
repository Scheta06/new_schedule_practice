<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::middleware(['guest'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('loginForm');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

    Route::get('/register', [RegisteredUserController::class, 'create'])->name('registerForm');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');
});

Route::middleware(['auth'])->group(function() {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::get('/cars')->name('cars');
});
