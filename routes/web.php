<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventBookingController;
use App\Http\Controllers\EventController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home',[
        "title" => "Home"
    ]);
});

Route::get('/login', function(){
    return view('login',[
        "title" => "Login"
    ]);
});


Route::get('/dashboard',function(){
    return view('dashboardhome',[
        "title" => "Dashboard"
    ]);
});

Route::get('/konfirmasi',function(){
    return view('dashboardkonfirmasi',[
        "title" => "Konfirmasi"
    ]);
});

Route::get('/peminjaman-ruangan',function(){
    return view('peminjaman',[
        "title" => "Peminjaman Ruangan"
    ]);
});

Route::get('/status-ruangan',function(){
    return view('statusruang',[
        "title" => "Status Ruangan"
    ]);
});

Route::get('/users',function(){
    return view('users',[
        "title" => "Users"
    ]);
});


Route::get('/events/{id}', [\App\Http\Controllers\EventController::class, 'show']);

Route::post('/event-booking', [EventBookingController::class, 'store']);

Route::get('/api/events', [EventBookingController::class, 'getEvents']);


Route::post('/event-booking', [EventBookingController::class, 'store']);

Route::get('/api/events', [EventBookingController::class, 'getEvents']);
