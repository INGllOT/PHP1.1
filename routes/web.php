<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserEventController;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // $events = Event::orderBy('event_date', 'asc')->get();
    $events = Event::get();

    $categories = Category::get();

    return view('home', ['events' => $events, 'categories' => $categories]);
});

Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/buy-ticket/{event}', [UserEventController::class, 'buyTicketView'])->name('buy.ticket');
Route::post('/buy-ticket', [UserEventController::class, 'buyTicket']);

Route::get('/user-tickets', [UserEventController::class, 'userTickets'])->name('user.tickets')->middleware('auth');


Route::put('/change-password', [UserController::class, 'change_password']);
Route::post('/create-event', [EventController::class, 'createEvent']);
Route::get('/edit-event/{event}', [EventController::class, 'showEventController']);
Route::get('/show-event/{event}', [EventController::class, 'showEvent']);

Route::put('/edit-event/{event}', [EventController::class, 'updateEvent']);
Route::delete('/delete-event/{event}', [EventController::class, 'deleteEvent']);

Route::post('/save-category', action: [CategoryController::class, 'createCategory']);
Route::delete('/delete-category/{category}', action: [CategoryController::class, 'deleteCategory']);
