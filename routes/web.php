<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MollieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/dashboard', [DashboardController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
Route::get('/auth/google/redirect', [GoogleController::class, 'handleGoogleRedirect'])->name('google');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::get("/search",[HomeController::class,"search"])->name("search");


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('/reservations/book', [ReservationController::class, 'book'])->name('reservations.book');
    Route::get('/events/{event}/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/Myreservations', [ReservationController::class, 'myReservations'])->name('Myreservations');
    Route::post('mollie/{reservation}', [MollieController::class, 'mollie'])->name('mollie');
    Route::get('success', [MollieController::class, 'success'])->name('success');
    Route::get('cancel', [MollieController::class, 'cancel'])->name('cancel');
    Route::get('/ticket/{ticketCode}', [TicketController::class,'show'])->name('ticket.show');
    Route::put('/reservations/changeStatus/{reservation}', [ReservationController::class, 'changeStatus'])->name('reservations.changeStatus');
   
    Route::get('/events/archive', [EventController::class, 'archive'])->name('events.archive');
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::get('/users/archive', [UserController::class, 'archive'])->name('users.archive');
    
        Route::get('/events/allEvents', [EventController::class, 'allEvents'])->name('events.allEvents');
        Route::put('/events/changeStatus/{event}', [EventController::class, 'changeStatus'])->name('events.changeStatus');
    
        Route::get('/categories/archive', [CategoryController::class, 'archive'])->name('categories.archive');
        Route::resource("categories", CategoryController::class, [
            'names' => [
                'index' => 'categories'
            ]
        ]);
    });
    Route::resource("events", EventController::class, [
        'names' => [
            'index' => 'events'
        ]
    ]);
});

require __DIR__ . '/auth.php';
