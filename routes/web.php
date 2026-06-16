<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminVehicleController;
use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\CustomerController;

/*
|--------------------------------------------------------------------------
| Home Page
|--------------------------------------------------------------------------
*/

Route::get('/', [CustomerController::class, 'vehicles'])->name('home');

/*
|--------------------------------------------------------------------------
| Customer Authentication
|--------------------------------------------------------------------------
*/

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Authentication
|--------------------------------------------------------------------------
*/

Route::get('/admin', function () {
    return redirect('/admin/login');
});

Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login.submit');

/*
|--------------------------------------------------------------------------
| Customer Panel
|--------------------------------------------------------------------------
*/
/*
|--------------------------------------------------------------------------
| Public Customer Pages
|--------------------------------------------------------------------------
*/

Route::get('/vehicles', [CustomerController::class, 'vehicles'])->name('vehicles.index');
Route::get('/vehicles/{vehicle}', [CustomerController::class, 'show'])->name('vehicles.show');
Route::get('/vehicles/{vehicle}/booking', [CustomerController::class, 'bookingForm'])->name('vehicles.booking');

/*
|--------------------------------------------------------------------------
| Auth Required Customer Actions
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
     Route::get('/vehicles/{vehicle}/booking', [CustomerController::class, 'bookingForm'])->name('vehicles.booking');
    Route::post('/vehicles/{vehicle}/book', [CustomerController::class, 'book'])->name('vehicles.book');
    Route::get('/my-bookings', [CustomerController::class, 'myBookings'])->name('my.bookings');
});

/*
|--------------------------------------------------------------------------
| Admin Panel
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminVehicleController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/vehicles', [AdminVehicleController::class, 'index'])->name('admin.vehicles.index');
    Route::get('/vehicles/create', [AdminVehicleController::class, 'create'])->name('admin.vehicles.create');
    Route::post('/vehicles', [AdminVehicleController::class, 'store'])->name('admin.vehicles.store');
    Route::delete('/vehicles/{vehicle}', [AdminVehicleController::class, 'destroy'])->name('admin.vehicles.destroy');

    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings.index');
    Route::post('/bookings/{booking}/approve', [AdminBookingController::class, 'approve'])->name('admin.bookings.approve');
    Route::post('/bookings/{booking}/reject', [AdminBookingController::class, 'reject'])->name('admin.bookings.reject');
});