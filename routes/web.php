<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventBookingController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Models\Room;
use App\Http\Controllers\RoomController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider and all of them
| will be assigned to the "web" middleware group.
|
*/


Route::get('/', function () {
    return redirect()->route('login');
});

// Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('home', [
            "title" => "Home"
        ]);
    });

    Route::get('/peminjaman-ruangan', function () {
        return view('peminjaman', [
            "title" => "Peminjaman Ruangan"
        ]);
    });
});

// Registration routes
// Student registration routes
Route::get('/register/student', [RegisterController::class, 'showStudentRegisterForm'])->name('register.student');
Route::post('/register/student', [RegisterController::class, 'registerStudent'])->name('register.student.post');

// Professor registration routes
Route::get('/register/professor', [RegisterController::class, 'showProfessorRegisterForm'])->name('register.professor');
Route::post('/register/professor', [RegisterController::class, 'registerProfessor'])->name('register.professor.post');

// Dashboard and other existing routes...
Route::get('/dashboard', function () {
    return view('dashboardhome', [
        "title" => "Dashboard"
    ]);
});

Route::get('/booking-history', [EventBookingController::class, 'showBookingHistory'])->name('booking.history');

Route::get('/konfirmasi', function () {
    return view('dashboardkonfirmasi', [
        "title" => "Konfirmasi"
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

Route::get('/dashboard-register', function () {
    return view('dashboardregister', [
        "title" => "Register Admin"
    ]);
});

Route::get('/events/{id}', [EventController::class, 'show']);
Route::post('/event-booking', [EventBookingController::class, 'store']);
Route::get('/api/events', [EventBookingController::class, 'getEvents']);
Route::get('/konfirmasi', [EventBookingController::class, 'showDashboard'])->name('dashboard.konfirmasi');
Route::get('/users', [UserController::class, 'showUsers'])->name('users.index');
Route::post('/events/bulk-update', [EventBookingController::class, 'bulkUpdate'])->name('events.bulkUpdate');

Route::get('/api/rooms', function () {
    return Room::all();
});


Route::resource('rooms', RoomController::class)->middleware('auth');
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');
Route::get('/rooms/{room}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
Route::put('/rooms/{room}', [RoomController::class, 'update'])->name('rooms.update');
Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])->name('rooms.destroy');