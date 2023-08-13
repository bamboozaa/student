<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;

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

Route::get('/mockup01', function () {
    return view('mockup01');
});

Route::get('/mockup02', function () {
    return view('mockup02');
});

Route::get('/mockup03', function () {
    return view('mockup03');
});

Route::get('/radio01', function () {
    return view('radio01');
});

Route::resource('students', StudentController::class);
Route::resource('rooms', RoomController::class);
Route::resource('reservations', ReservationController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
