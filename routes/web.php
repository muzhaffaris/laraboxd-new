<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

Route::middleware('guest')->controller(AuthController::class)->group(function () {
    Route::get('/register', 'showRegister')->name("show.register");
    Route::get('/login', 'showLogin')->name("show.login");
    Route::post('/register', 'register')->name("register");
    Route::post('/login', 'login')->name("login");
});

Route::post('/logout', [AuthController::class, 'logout'])->name("logout")->middleware('auth');

Route::get('/', [MovieController::class, 'home'])->name('home');
Route::get('/movie/{movieId}', [MovieController::class, 'movie'])->name('movie');
Route::get('/movie/{movieId}/addReview', [MovieController::class, 'addReviewPage'])->name('addReviewPage');
Route::post('/addReview/{movieId}', [MovieController::class, 'addReview'])->name('addReview');
Route::get('/movies', [MovieController::class, 'movies'])->name('movies');

Route::get('/api/movies', [MovieController::class, 'moviesApiProxy'])->name('moviesApiProxy');
Route::get('/api/movies/search', [MovieController::class, 'moviesSearchApiProxy'])->name('moviesSearchApiProxyy');
