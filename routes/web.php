<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

Route::get('/register', [AuthController::class, 'showRegister'])->name("show.register");
Route::get('/login', [AuthController::class, 'showLogin'])->name("show.login");
Route::post('/register', [AuthController::class, 'register'])->name("register");
Route::post('/login', [AuthController::class, 'login'])->name("login");
Route::post('/logout', [AuthController::class, 'logout'])->name("logout");

Route::get('/', [MovieController::class, 'home'])->name('home');