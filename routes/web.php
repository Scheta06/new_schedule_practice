<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewCarController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('loginForm');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('registerForm');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');

Route::middleware(['auth'])->group(function () {
    Route::get('/cars', [CarController::class, 'index'])->name('myCars');
    Route::delete('/cars', [NewCarController::class, 'destroy'])->name('myCars.destroy');

    Route::get('/new-car', [NewCarController::class, 'index'])->name('newCar');
    Route::get('/api/patterns', [NewCarController::class, 'getPatterns'])->name('api.patterns');
    Route::get('/api/generations', [NewCarController::class, 'getGenerations'])->name('api.generations');
    Route::post('/new-car', [NewCarController::class, 'store'])->name('newCar.store');

    Route::get('/cars/{id}', [CarController::class, 'show'])->name('carCart');
    Route::post('/cars/{id}', [CarController::class, 'storeCategory'])->name('addCategory');
    Route::get('/cars/{id}/{category}', [CategoryController::class, 'index'])->name('CategoryCart');
    Route::post('/cars/{id}/{category}', [CategoryController::class, 'store'])->name('addExtence');
    Route::post('/cars/{id}/{category}', [CategoryController::class, 'destroy'])->name('destroyExtence');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
