<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;

require __DIR__.'/auth.php';
Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function (){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Resource gera automaticamente as rotas para as ações do controller, como index, create, store, edit, update e destroy.
    Route::resource('categories', CategoryController::class)
    ->except(['show']);

    Route::resource('transactions', \App\Http\Controllers\TransactionController::class)
    ->except(['show']);
});