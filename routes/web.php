<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParkingLot\ParkingTypeController;
use App\Http\Controllers\Reservations\ReservationController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('reservations', ReservationController::class);
    Route::name('reservations.')->prefix('reservations')->group(function () {
        Route::post('open', [ReservationController::class, 'open'])->name('open');
        Route::put('finalize/{reservation}', [ReservationController::class, 'finalize'])->name('finalize');
    });

    Route::resource('parking-types', ParkingTypeController::class);

    Route::get('/clients', function () {
        return Inertia::render('Dashboard');
    })->name('clients');

    Route::get('/vehicles', function () {
        return Inertia::render('Dashboard');
    })->name('vehicles');

    Route::get('/account', function () {
        return Inertia::render('Dashboard');
    })->name('account');
});

Route::get('/offline', function () {
    return "Offline";
});
