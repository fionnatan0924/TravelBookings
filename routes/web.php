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
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Public routes (only login/signup)
|--------------------------------------------------------------------------
*/
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::get('/signup', [UserController::class, 'showSignupForm'])->name('register');
Route::post('/signup', [UserController::class, 'signup']);

/*
|--------------------------------------------------------------------------
| Authenticated routes (everything else requires login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Homepage (now requires login)
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Flight search & results
    Route::get('/flights', [FlightController::class, 'index'])->name('flights.index');
    Route::get('/flight', [FlightController::class, 'index'])->name('flights.search');
    Route::post('/flight/search', [FlightController::class, 'search'])->name('flights.results');

    // Public listings now also require login
    Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
    Route::get('/hotels/{hotel}', [HotelController::class, 'show'])->name('hotels.show');
    Route::get('/combos', [ComboController::class, 'index'])->name('combos.index');
    Route::get('/attractions', [AttractionController::class, 'index'])->name('attractions.index');
    Route::get('/attractions/{id}', [AttractionController::class, 'show'])->name('attractions.show');
    Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations.index');
    Route::get('/destinations/{id}', [DestinationController::class, 'show'])->name('destinations.show');

    // Logout & Profile
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/my-bookings', [UserController::class, 'myBookings'])->name('my-bookings');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/update-profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/password', [UserController::class, 'updatePassword'])->name('profile.password');

    // Admin routes (with role gate)
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
    Route::get('/bookings', [BookingController::class, 'index'])->name('booking.index');

    // Flight payment
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
    Route::get('/attractions/book/{attraction}', [AttractionController::class, 'book'])->name('attractions.book');
    Route::post('/attractions/book-form', [AttractionController::class, 'bookForm'])->name('attraction.book.form');
    Route::get('/attractions/booking/confirm', [AttractionController::class, 'confirmBooking'])->name('attraction.booking.confirm');
    Route::post('/attractions/booking/payment', [AttractionController::class, 'proceedToPayment'])->name('attraction.booking.payment');
    Route::get('/attractions/payment', [PaymentController::class, 'attractionPaymentForm'])->name('payment.attraction.form');
    Route::post('/attractions/payment', [PaymentController::class, 'processAttractionPayment'])->name('payment.attraction.process');
    Route::get('/attractions/receipt/{id}', [AttractionController::class, 'receipt'])->name('attraction.receipt');
    Route::get('/attractions/{attraction}', [AttractionController::class, 'show'])->name('attractions.show');

    // Admin attraction management
    Route::get('/admin/attractions/{attraction}/edit', [AttractionController::class, 'edit'])->name('admin.attractions.edit');
    Route::put('/admin/attractions/{attraction}', [AttractionController::class, 'update'])->name('admin.attractions.update');
    Route::delete('/admin/attractions/{attraction}', [AttractionController::class, 'destroy'])->name('admin.attractions.destroy');

    // Payment attraction form (alternative)
    Route::get('/payment/attraction', [AttractionController::class, 'paymentForm'])->name('payment.attraction.form');


    //Admin 
    // Admin routes (protected by role gate)
Route::middleware(['can:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');

    // Users Management
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');

    // Flights Management
    Route::get('/flights', [AdminController::class, 'flights'])->name('flights');
    Route::post('/flights', [AdminController::class, 'storeFlight'])->name('flights.store');
    Route::get('/flights/{flight}/edit', [AdminController::class, 'editFlight'])->name('flights.edit');
    Route::put('/flights/{flight}', [AdminController::class, 'updateFlight'])->name('flights.update');
    Route::delete('/flights/{flight}', [AdminController::class, 'deleteFlight'])->name('flights.delete');
    Route::get('/flights/create', [AdminController::class, 'createFlight'])->name('flights.create'); 

    // Hotels Management
    Route::get('/hotels', [AdminController::class, 'hotels'])->name('hotels');
    Route::get('/hotels/create', [AdminController::class, 'createHotel'])->name('hotels.create');
    Route::post('/hotels', [AdminController::class, 'storeHotel'])->name('hotels.store');
    Route::get('/hotels/{hotel}/edit', [AdminController::class, 'editHotel'])->name('hotels.edit');
    Route::put('/hotels/{hotel}', [AdminController::class, 'updateHotel'])->name('hotels.update');
    Route::delete('/hotels/{hotel}', [AdminController::class, 'deleteHotel'])->name('hotels.delete');

    // Packages (Combos) Management
    Route::get('/packages', [AdminController::class, 'packages'])->name('packages');
    Route::get('/packages/create', [AdminController::class, 'createPackage'])->name('packages.create');
    Route::post('/packages', [AdminController::class, 'storePackage'])->name('packages.store');
    Route::get('/packages/{package}/edit', [AdminController::class, 'editPackage'])->name('packages.edit');
    Route::put('/packages/{package}', [AdminController::class, 'updatePackage'])->name('packages.update');
    Route::delete('/packages/{package}', [AdminController::class, 'deletePackage'])->name('packages.delete');

    // All Bookings Overview
    Route::get('/bookings', [AdminController::class, 'allBookings'])->name('bookings');
});
});