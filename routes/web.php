<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// unauthenticated routes
Route::prefix('auth-custom')->group(function () {
    Route::post('/login',  [AuthController::class, 'login'])->name('login');
    Route::post('/register',  [AuthController::class, 'register'])->name('register');
});

// authenticated routes
Route::get('/home', [HomeController::class, 'index']);
Route::get('/logout',  [AuthController::class, 'logout'])->name('logout');
Route::delete('/user',  [UserController::class, 'destroy'])->name('user.destroy');
