<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventBookingController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController; // Import the RegisterController

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider and all of them
| will be assigned to the "web" middleware group. Make something great!
|
*/

// Existing routes...
Route::get('/', function () {
    return view('home', [
        "title" => "Home"
    ]);
});

// Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration routes
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Dashboard and other existing routes...
Route::get('/dashboard', function () {
    return view('dashboardhome', [
        "title" => "Dashboard"
    ]);
});

Route::get('/konfirmasi', function () {
    return view('dashboardkonfirmasi', [
        "title" => "Konfirmasi"
    ]);
});

Route::get('/peminjaman-ruangan', function () {
    return view('peminjaman', [
        "title" => "Peminjaman Ruangan"
    ]);
});

Route::get('/status-ruangan', function () {
    return view('statusruang', [
        "title" => "Status Ruangan"
    ]);
});

Route::get('/users', function () {
    return view('users', [
        "title" => "Users"
    ]);
});

Route::get('/events/{id}', [EventController::class, 'show']);
Route::post('/event-booking', [EventBookingController::class, 'store']);
Route::get('/api/events', [EventBookingController::class, 'getEvents']);