<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Models\Event;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $events = Event::all();
    return view('home', ['events' => $events]);
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);


Route::post('/create-event', [EventController::class, 'createEvent']);
Route::get('/edit-event/{event}', [EventController::class, 'showEventController']);
Route::put('/edit-event/{event}', [EventController::class, 'updateEvent']);
Route::delete('/delete-event/{event}', [EventController::class, 'deleteEvent']);



// Route::post('/register', [UserController::class, 'register'])->name('user.register');

// Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');

// Route::post('/login', [UserController::class, 'login'])->name('user.login');



