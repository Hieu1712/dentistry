<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // staff
    Route::resource('staff', \App\Http\Controllers\StaffController::class);

    // doctor
    Route::resource('doctor', \App\Http\Controllers\DoctorController::class);

    // patient
    Route::resource('patient', \App\Http\Controllers\PatientController::class);

    // appointment
    Route::resource('appointment', \App\Http\Controllers\AppointmentController::class);

    // service
    Route::resource('service', \App\Http\Controllers\ServiceController::class);
});

require __DIR__.'/auth.php';
