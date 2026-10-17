<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

// Public routes - for unauthenticated visitors only
Route::middleware(['guest'])->group(function (){
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::get('/forgot-password', [ForgotPasswordController::class , 'index'])->name('password.request');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'index'])->name('password.reset');
    
    Route::middleware('throttle:10,1')->group(function() {
        Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
        Route::post('/login', [LoginController::class, 'store'])->name('login.store');
        Route::post('/forgot-password', [ForgotPasswordController::class , 'store'])->name('password.email');
        Route::post('/reset-password', [ResetPasswordController::class, 'store'])->name('password.update');

    });

}); 

// Protected routes - for authenticated users only
Route::middleware('auth')->group(function(){
    Route::post('/logout', [LogoutController::class, 'destroy'])->name('logout');
   
});