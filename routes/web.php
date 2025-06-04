<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExtenceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewCarController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('loginForm');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('registerForm');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');

Route::middleware(['auth'])->group(function () {
    Route::get('/cars', [CarController::class, 'index'])->name('myCars');
    Route::get('/profile/edit', [NewPasswordController::class, 'edit'])->name('editProfile');
    Route::patch('/profile/update', [NewPasswordController::class, 'update'])->name('updateProfile');

    Route::get('/new-car', [NewCarController::class, 'index'])->name('newCar');
    Route::get('/api/patterns', [NewCarController::class, 'getPatterns'])->name('api.patterns');
    Route::get('/api/generations', [NewCarController::class, 'getGenerations'])->name('api.generations');
    Route::post('/new-car', [NewCarController::class, 'store'])->name('newCar.store');

    Route::get('/cars/{id}', [CarController::class, 'show'])->name('carCart');

    Route::get('/cars/{id}/{category}', [CategoryController::class, 'index'])->name('CategoryCart');
    Route::post('/cars/{id}/add-category', [CategoryController::class, 'store'])->name('addCategory');
    Route::delete('/cars/{id}/{category}', [CategoryController::class, 'destroy'])->name('deleteCategory');

    Route::post('/cars/{id}/{category}', [ExtenceController::class, 'store'])->name('addExtence');

    Route::get('/cars/{id}/{category}/{extence}/edit', [ExtenceController::class, 'edit'])->name('editExtence');
    Route::patch('/cars/{id}/{category}/{extence}/update', [ExtenceController::class, 'update'])->name('updateExtence');
    Route::delete('/cars/{id}/{category}/{extence}', [ExtenceController::class, 'destroy'])->name('destroyExtence');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
