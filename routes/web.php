<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\AttractionController;

Route::resource('attractions', AttractionController::class)->only(['index', 'show']);
Route::get('/attractions/search', [AttractionController::class, 'search'])->name('attractions.search');

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Destinations
Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations.index');
Route::get('/destinations/{id}', [DestinationController::class, 'show'])->name('destinations.show');

Route::get('/combos', [PackageController::class, 'index'])->name('combos.index');
Route::get('/combos/search', [PackageController::class, 'search'])->name('combos.search');
Route::get('/combos/{id}', [PackageController::class, 'show'])->name('combos.show');

// Flights
Route::get('/flights', [FlightController::class, 'index'])->name('flights.index');
Route::post('/flights/search', [FlightController::class, 'search'])->name('flights.search');

Route::get('/attractions/book/{attraction}', function ($id) {
    return redirect()->route('attractions.index')->with('info', 'Booking feature coming soon.');
})->name('attractions.book');
Route::get('/hotels', [App\Http\Controllers\HomeHotelController::class, 'index'])->name('hotels.index');