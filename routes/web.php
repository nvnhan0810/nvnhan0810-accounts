<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function() {
    Route::get('/', [IndexController::class, 'index'])->name('index');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name("login");
Route::post('/login', [AuthController::class, 'adminLogin'])->name('admin.login.submit');

Route::get('/oauth/login', [AuthController::class, 'login'])->name('client.login');
Route::get('/auth/callback', [AuthController::class, 'callback'])->name("callback");

