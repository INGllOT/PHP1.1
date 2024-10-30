<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Models\Event;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $events = Event::orderBy('start_date', 'asc')->get();
    $categories = Event::$categories;

    return view('home', ['events' => $events, 'categories' => $categories]);
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);
Route::put('/change-password', [UserController::class, 'change_password']);



Route::post('/create-event', [EventController::class, 'createEvent']);

Route::get('/edit-event/{event}', [EventController::class, 'showEventController']);
Route::get('/show-event/{event}', [EventController::class, 'showEvent']);
Route::get('/print-view', function () {
    $events = Event::orderBy('start_date', 'asc')->get();
    return view('print', ['events' => $events]);
});

Route::put('/edit-event/{event}', [EventController::class, 'updateEvent']);
Route::delete('/delete-event/{event}', [EventController::class, 'deleteEvent']);
