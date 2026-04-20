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

Route::get('/flights', [FlightController::class, 'index'])->name('flights.index');
Route::get('/flight', [FlightController::class, 'index'])->name('flights.search');
Route::post('/flight/search', [FlightController::class, 'search'])->name('flights.results');

// Authenticated routes (require login)
Route::middleware(['auth'])->group(function () {

    // Logout
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/my-bookings', [App\Http\Controllers\UserController::class, 'myBookings'])->name('my-bookings');
    // Profile
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
    Route::post('/update-profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/password', [UserController::class, 'updatePassword'])->name('profile.password');

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
    Route::get('/booking/{booking}', [BookingController::class, 'show'])->name('booking.show');
    Route::get('/bookings', [BookingController::class, 'index'])->name('booking.index');
    Route::patch('/booking/{booking}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');
    Route::delete('/booking/{booking}', [BookingController::class, 'destroy'])->name('booking.destroy');
    
        // ========== COMBO ROUTES ==========
    Route::get('/combo', [ComboController::class, 'index'])->name('combo.index');
    Route::post('/combo/search', [ComboController::class, 'search'])->name('combo.search');
    Route::post('/combo/book', [ComboController::class, 'book'])->name('combo.book');
    Route::get('/combo/my-bookings', [ComboController::class, 'myBookings'])->name('combo.my-bookings');

        // Passenger routes (must come before wildcard)
    Route::get('/combo/passengers', [ComboController::class, 'showPassengerForm'])->name('combo.passengers');
    Route::post('/combo/passengers', [ComboController::class, 'processPassengers'])->name('combo.processPassengers');

        // Payment routes (must also come before wildcard)
    Route::get('/combo/payment', [App\Http\Controllers\PaymentController::class, 'comboPaymentForm'])->name('payment.combo.form');
    Route::post('/combo/payment', [App\Http\Controllers\PaymentController::class, 'processComboPayment'])->name('payment.combo.process');

        // Wildcard route (parameter) MUST be LAST
    Route::get('/combo/{comboBooking}', [ComboController::class, 'show'])->name('combo.show');
    Route::patch('/combo/{comboBooking}/cancel', [ComboController::class, 'cancel'])->name('combo.cancel');

    // Hotel routes (public or auth – your choice)
    Route::get('/hotels', [App\Http\Controllers\HotelController::class, 'index'])->name('hotels.index');
    Route::get('/hotels/{hotel}', [App\Http\Controllers\HotelController::class, 'show'])->name('hotels.show');
    // Hotel booking routes
    Route::post('/hotel/{hotel}/book', [App\Http\Controllers\HotelBookingController::class, 'bookForm'])->name('hotel.book.form');
    Route::get('/hotel/booking/confirm', [App\Http\Controllers\HotelBookingController::class, 'confirmBooking'])->name('hotel.booking.confirm');
    Route::post('/hotel/booking/payment', [App\Http\Controllers\HotelBookingController::class, 'proceedToPayment'])->name('hotel.booking.payment');
    Route::get('/hotel/payment', [App\Http\Controllers\HotelBookingController::class, 'paymentForm'])->name('payment.hotel.form');
    Route::post('/hotel/payment', [App\Http\Controllers\HotelBookingController::class, 'processPayment'])->name('payment.hotel.process');
    Route::get('/hotel/receipt/{hotelBooking}', [App\Http\Controllers\HotelBookingController::class, 'receipt'])->name('hotel.receipt');
    Route::get('/hotel/my-bookings', [App\Http\Controllers\HotelBookingController::class, 'myBookings'])->name('hotel.my-bookings');
    Route::patch('/hotel/booking/{hotelBooking}/cancel', [App\Http\Controllers\HotelBookingController::class, 'cancel'])->name('hotel.booking.cancel');

    // Flight payment routes
    Route::get('/flight/payment', [App\Http\Controllers\PaymentController::class, 'flightPaymentForm'])->name('payment.flight.form');
    Route::post('/flight/payment', [App\Http\Controllers\PaymentController::class, 'processFlightPayment'])->name('payment.flight.process');

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    });

    Route::resource('attractions', AttractionController::class)->only(['index', 'show']);
    Route::get('/attractions/search', [AttractionController::class, 'search'])->name('attractions.search');

    // Destinations
    Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations.index');
    Route::get('/destinations/{id}', [DestinationController::class, 'show'])->name('destinations.show');

    Route::get('/combos', [PackageController::class, 'index'])->name('combos.index');
    Route::get('/combos/search', [PackageController::class, 'search'])->name('combos.search');
    Route::get('/combos/{id}', [PackageController::class, 'show'])->name('combos.show');

    Route::get('/attractions/book/{attraction}', function ($id) {
        return redirect()->route('attractions.index')->with('info', 'Booking feature coming soon.');
    })->name('attractions.book');
    Route::get('/hotels', [App\Http\Controllers\HomeHotelController::class, 'index'])->name('hotels.index');


// Hotels
Route::get('/hotels', [App\Http\Controllers\HotelController::class, 'index'])->name('hotels.index');

Route::get('/combos', [App\Http\Controllers\ComboController::class, 'index'])->name('combos.index');

// Destinations
Route::get('/destinations', [App\Http\Controllers\DestinationController::class, 'index'])->name('destinations.index');
Route::get('/destinations/{destination}', [App\Http\Controllers\DestinationController::class, 'show'])->name('destinations.show');

// Attractions
Route::get('/attractions', [App\Http\Controllers\AttractionController::class, 'index'])->name('attractions.index');
Route::get('/attractions/book/{attraction}', [App\Http\Controllers\AttractionController::class, 'book'])->name('attractions.book');
