<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ComboController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () { //login page
    return view('login');
});

Route::get('/signup', function () { //signup page
    return view('signup');
});

//form submit
Route::post('/login', [UserController::class, 'login']);
Route::post('/signup', [UserController::class, 'signup']); 

//Admin
Route::get('/admin/dashboard', function () {
    return "Welcome Admin";
})->middleware('role:admin');

Route::get('/admin/users', [UserController::class, 'manageUsers'])->middleware('role:admin');

Route::post('/admin/users/add', [UserController::class, 'addUser'])->middleware('role:admin');

Route::post('/admin/users/update/{id}', [UserController::class, 'updateUser'])->middleware('role:admin');

Route::get('/admin/users/delete/{id}', [UserController::class, 'deleteUser'])->middleware('role:admin');

//User
Route::get('/user/dashboard', function () {
    return "Welcome User";
})->middleware('role:user');

Route::get('/profile', function () {

    if (!session()->has('user')) {
        return redirect('/login');
    }

    return view('profile');
});

Route::post('/update-profile', [UserController::class, 'updateProfile']);

Route::post('/logout', function () {
    session()->forget('user');   
    return redirect('/login');   
});

// Flight search routes
Route::get('/flight', [FlightController::class, 'index'])->name('flights.search'); // shows the search form (flight.blade.php)
Route::post('/flight/search', [FlightController::class, 'search'])->name('flights.results'); // handles search form submission

// Home page (your flight search page)
Route::get('/', function () {
    return view('flight'); // adjust to your actual flight search view
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/combo', [ComboController::class, 'index'])->name('combo.index');
    Route::post('/combo/search', [ComboController::class, 'search'])->name('combo.search');
    Route::post('/combo/book', [ComboController::class, 'book'])->name('combo.book');
    Route::get('/combo/my-bookings', [ComboController::class, 'myBookings'])->name('combo.my-bookings');
    Route::get('/combo/{comboBooking}', [ComboController::class, 'show'])->name('combo.show');
    Route::patch('/combo/{comboBooking}/cancel', [ComboController::class, 'cancel'])->name('combo.cancel');
});