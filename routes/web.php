<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

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