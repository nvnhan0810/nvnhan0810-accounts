<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index']);

Route::get('/login', [AuthController::class, 'showLoginForm']);

Route::get('/oauth/login', [AuthController::class, 'login'])->name("login");
Route::get('/auth/callback', [AuthController::class, 'callback'])->name("callback");

