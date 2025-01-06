<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\IndexController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function() {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', [IndexController::class, 'index'])->name('index');

    Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
    Route::post('/clients', [ClientController::class, 'newStore'])->name('clients.store');
    // Route::get('/clients/:id/edit', [ClientController::class, 'edit'])->name('clients.edit');
    // Route::patch('/clients/:id/update', [ClientController::class, 'newUpdate'])->name('clients.update');
    // Route::delete('/clients/:id/delete', [ClientController::class, 'delete'])->name('clients.delete');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name("login");
Route::post('/login', [AuthController::class, 'adminLogin'])->name('admin.login.submit');

Route::get('/oauth/login', [AuthController::class, 'login'])->name('client.login');
Route::get('/auth/callback', [AuthController::class, 'callback'])->name("callback");

