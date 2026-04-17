<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\AttractionController;
use App\Http\Controllers\HotelController;

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

// Hotels
Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{id}', [HotelController::class, 'show'])->name('hotels.show');
