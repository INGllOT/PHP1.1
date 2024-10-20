<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::post('/register', [UserController::class, 'register']);

Route::post('/logout', [UserController::class, 'logout']);

Route::post('/login', [UserController::class, 'login']);




// Route::post('/register', [UserController::class, 'register'])->name('user.register');

// Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');

// Route::post('/login', [UserController::class, 'login'])->name('user.login');



