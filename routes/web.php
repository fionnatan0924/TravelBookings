<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ComboController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\HotelBookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AttractionController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Guest / Public routes (no login required)
|--------------------------------------------------------------------------
*/
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::get('/signup', [UserController::class, 'showSignupForm'])->name('register');
Route::post('/signup', [UserController::class, 'signup']);

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/flights', [FlightController::class, 'index'])->name('flights.index');
Route::get('/flight', [FlightController::class, 'index'])->name('flights.search');
Route::post('/flight/search', [FlightController::class, 'search'])->name('flights.results');

// Public listings (viewing only, no booking)
Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{hotel}', [HotelController::class, 'show'])->name('hotels.show');
Route::get('/combos', [ComboController::class, 'index'])->name('combos.index');
Route::get('/attractions', [AttractionController::class, 'index'])->name('attractions.index');
Route::get('/attractions/{id}', [AttractionController::class, 'show'])->name('attractions.show');
Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations.index');
Route::get('/destinations/{id}', [DestinationController::class, 'show'])->name('destinations.show');

/*
|--------------------------------------------------------------------------
| Authenticated routes (login required for all actions that make a booking)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Logout & Profile
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/my-bookings', [UserController::class, 'myBookings'])->name('my-bookings');
    Route::get('/profile', function () { return view('profile'); })->name('profile');
    Route::post('/update-profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/password', [UserController::class, 'updatePassword'])->name('profile.password');

    // ========== ADMIN ROUTES (protected by role gate) ==========
    Route::middleware(['can:admin'])->group(function () {
        Route::get('/admin/dashboard', function () { return view('admin.dashboard'); })->name('admin.dashboard');
        Route::get('/admin/users', [UserController::class, 'manageUsers'])->name('admin.users');
        Route::post('/admin/users/add', [UserController::class, 'addUser']);
        Route::post('/admin/users/update/{id}', [UserController::class, 'updateUser']);
        Route::get('/admin/users/delete/{id}', [UserController::class, 'deleteUser']);
    });

    // ========== FLIGHT BOOKING ==========
    Route::post('/booking/select', [BookingController::class, 'selectFlight'])->name('booking.select');
    Route::get('/booking/luggage', [BookingController::class, 'showLuggageForm'])->name('booking.luggage');
    Route::post('/booking/luggage', [BookingController::class, 'processLuggage'])->name('booking.process.luggage');
    Route::get('/booking/passengers', [BookingController::class, 'showPassengerForm'])->name('booking.passengers');
    Route::post('/booking/passengers', [BookingController::class, 'processPassengers'])->name('booking.process.passengers');
    Route::get('/booking/confirmation', [BookingController::class, 'confirmation'])->name('booking.confirmation');
    Route::get('/booking/{booking}', [BookingController::class, 'show'])->name('booking.show');
    Route::patch('/booking/{booking}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');
    Route::delete('/booking/{booking}', [BookingController::class, 'destroy'])->name('booking.destroy');
    Route::get('/bookings', [BookingController::class, 'index'])->name('booking.index'); // optional listing

    // Flight payment (using PaymentController)
    Route::get('/flight/payment', [PaymentController::class, 'flightPaymentForm'])->name('payment.flight.form');
    Route::post('/flight/payment', [PaymentController::class, 'processFlightPayment'])->name('payment.flight.process');

    // ========== COMBO BOOKING ==========
    Route::post('/combo/search', [ComboController::class, 'search'])->name('combo.search');
    Route::post('/combo/book', [ComboController::class, 'book'])->name('combo.book');
    Route::get('/combo/my-bookings', [ComboController::class, 'myBookings'])->name('combo.my-bookings');
    Route::get('/combo/passengers', [ComboController::class, 'showPassengerForm'])->name('combo.passengers');
    Route::post('/combo/passengers', [ComboController::class, 'processPassengers'])->name('combo.processPassengers');
    Route::get('/combo/payment', [PaymentController::class, 'comboPaymentForm'])->name('payment.combo.form');
    Route::post('/combo/payment', [PaymentController::class, 'processComboPayment'])->name('payment.combo.process');
    Route::get('/combo/{comboBooking}', [ComboController::class, 'show'])->name('combo.show');
    Route::patch('/combo/{comboBooking}/cancel', [ComboController::class, 'cancel'])->name('combo.cancel');
    Route::get('/combo', [ComboController::class, 'index'])->name('combo.index');

    // ========== HOTEL BOOKING ==========
    Route::post('/hotel/{hotel}/book', [HotelBookingController::class, 'bookForm'])->name('hotel.book.form');
    Route::get('/hotel/booking/confirm', [HotelBookingController::class, 'confirmBooking'])->name('hotel.booking.confirm');
    Route::post('/hotel/booking/payment', [HotelBookingController::class, 'proceedToPayment'])->name('hotel.booking.payment');
    Route::get('/hotel/payment', [PaymentController::class, 'hotelPaymentForm'])->name('payment.hotel.form');
    Route::post('/hotel/payment', [PaymentController::class, 'processHotelPayment'])->name('payment.hotel.process');
    Route::get('/hotel/receipt/{hotelBooking}', [HotelBookingController::class, 'receipt'])->name('hotel.receipt');
    Route::get('/hotel/my-bookings', [HotelBookingController::class, 'myBookings'])->name('hotel.my-bookings');
    Route::patch('/hotel/booking/{hotelBooking}/cancel', [HotelBookingController::class, 'cancel'])->name('hotel.booking.cancel');

    // ========== ATTRACTION BOOKING ==========
    Route::get('/attractions/book/{attraction}', [AttractionController::class, 'show'])->name('attractions.show');
    Route::post('/attractions/book-form', [AttractionController::class, 'bookForm'])->name('attraction.book.form');
    Route::get('/attractions/booking/confirm', [AttractionController::class, 'confirmBooking'])->name('attraction.booking.confirm');
    Route::get('/attractions/payment', [PaymentController::class, 'attractionPaymentForm'])->name('payment.attraction.form');
    Route::post('/attractions/payment', [PaymentController::class, 'processAttractionPayment'])->name('payment.attraction.process');
    Route::get('/attractions/receipt/{id}', [AttractionController::class, 'receipt'])->name('attraction.receipt');
    Route::post('/attractions/booking/payment', [AttractionController::class, 'proceedToPayment'])->name('attraction.booking.payment');

    Route::get('/attractions/{attraction}', [AttractionController::class, 'show'])->name('attractions.show');
Route::get('/attractions/{attraction}/book', [AttractionController::class, 'book'])->name('attractions.book');
Route::get('/admin/attractions/{attraction}/edit', [AttractionController::class, 'edit'])->name('admin.attractions.edit');
Route::put('/admin/attractions/{attraction}', [AttractionController::class, 'update'])->name('admin.attractions.update');
Route::delete('/admin/attractions/{attraction}', [AttractionController::class, 'destroy'])->name('admin.attractions.destroy');

Route::get('/payment/attraction', [AttractionController::class, 'paymentForm'])->name('payment.attraction.form');

});