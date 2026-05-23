<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

// Public routes - for unauthenticated visitors only
Route::middleware('guest')->group(function (){
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');

});

// Protected routes - for authenticated users only
Route::middleware('auth')->group(function(){
    Route::post('/logout', [LogoutController::class, 'destroy'])->name('logout');
});