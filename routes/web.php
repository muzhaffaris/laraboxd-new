<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

Route::get('/register', [AuthController::class, 'showRegister'])->name("show.register");
Route::get('/login', [AuthController::class, 'showLogin'])->name("show.login");

Route::get('/', [MovieController::class, 'home']);