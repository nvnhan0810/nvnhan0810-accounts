<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('login', [AuthController::class, 'login'])->name("login");
Route::get('/auth/callback', [AuthController::class, 'callback'])->name("callback");
Route::get('/auth/token', [AuthController::class, 'issueToken'])->name("token");
