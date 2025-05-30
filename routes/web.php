<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewCarController;
use Illuminate\Support\Facades\Route;

Route::middleware(['authUser'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('loginForm');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

    Route::get('/register', [RegisteredUserController::class, 'create'])->name('registerForm');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/cars', [CarController::class, 'index'])->name('myCars');
    Route::get('/new-car', [NewCarController::class, 'index'])->name('addCar');
    Route::get('/cars/{id}', [CarController::class, 'show'])->name('carCart');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
