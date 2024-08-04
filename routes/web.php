<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('login', [AuthController::class, 'login'])->name("login");
Route::get('/auth/callback', [AuthController::class, 'callback'])->name("callback");

