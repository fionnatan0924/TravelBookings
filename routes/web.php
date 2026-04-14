<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ComboController;
use App\Http\Controllers\HotelController;


// Guest routes (no login needed)
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::get('/signup', [UserController::class, 'showSignupForm'])->name('register');
Route::post('/signup', [UserController::class, 'signup']);

Route::get('/', [FlightController::class, 'index'])->name('flights.index');
Route::get('/flight', [FlightController::class, 'index'])->name('flights.search');
Route::post('/flight/search', [FlightController::class, 'search'])->name('flights.results');

// Authenticated routes (require login)
Route::middleware(['auth'])->group(function () {

    // Logout
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    // Profile
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
    Route::post('/update-profile', [UserController::class, 'updateProfile'])->name('profile.update');

    // Admin routes (with role gate)
    Route::middleware(['can:admin'])->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
        Route::get('/admin/users', [UserController::class, 'manageUsers'])->name('admin.users');
        Route::post('/admin/users/add', [UserController::class, 'addUser']);
        Route::post('/admin/users/update/{id}', [UserController::class, 'updateUser']);
        Route::get('/admin/users/delete/{id}', [UserController::class, 'deleteUser']);
    });

    // ========== FLIGHT BOOKING ROUTES ==========
    Route::post('/booking/select', [BookingController::class, 'selectFlight'])->name('booking.select');
    Route::get('/booking/luggage', [BookingController::class, 'showLuggageForm'])->name('booking.luggage');
    Route::post('/booking/luggage', [BookingController::class, 'processLuggage'])->name('booking.process.luggage'); // note dot
    Route::get('/booking/passengers', [BookingController::class, 'showPassengerForm'])->name('booking.passengers');
    Route::post('/booking/passengers', [BookingController::class, 'processPassengers'])->name('booking.process.passengers');
    Route::get('/booking/confirmation', [BookingController::class, 'confirmation'])->name('booking.confirmation');
    Route::get('/bookings', [BookingController::class, 'index'])->name('booking.index');
    Route::get('/booking/{booking}', [BookingController::class, 'show'])->name('booking.show');
    Route::patch('/booking/{booking}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');
    Route::delete('/booking/{booking}', [BookingController::class, 'destroy'])->name('booking.destroy');
    
        // ========== COMBO ROUTES ==========
        Route::get('/combo', [ComboController::class, 'index'])->name('combo.index');
        Route::post('/combo/search', [ComboController::class, 'search'])->name('combo.search');
        Route::post('/combo/book', [ComboController::class, 'book'])->name('combo.book');
        Route::get('/combo/my-bookings', [ComboController::class, 'myBookings'])->name('combo.my-bookings');
        
        // !!! IMPORTANT: Passenger routes MUST come before any route with {parameter} !!!
        Route::get('/combo/passengers', [ComboController::class, 'showPassengerForm'])->name('combo.passengers');
        Route::post('/combo/passengers', [ComboController::class, 'processPassengers'])->name('combo.processPassengers');
        
        // Wildcard route (parameter) MUST be LAST
        Route::get('/combo/{comboBooking}', [ComboController::class, 'show'])->name('combo.show');
        Route::patch('/combo/{comboBooking}/cancel', [ComboController::class, 'cancel'])->name('combo.cancel');

        // Hotel routes (public or auth – your choice)
        Route::get('/hotels', [App\Http\Controllers\HotelController::class, 'index'])->name('hotels.index');
        Route::get('/hotels/{hotel}', [App\Http\Controllers\HotelController::class, 'show'])->name('hotels.show');
    
    });