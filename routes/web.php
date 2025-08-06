<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AppointmentController;

// Landing Page
Route::get('/', function () {
    // Redirect based on authentication and role
    if (Auth::check()) {
        return Auth::user()->role === 'registered psychometrician'
            ? redirect('/homepage')
            : redirect('/dashboard');
    }

    return view('welcome');
});

// Dashboard (only for non-RPM users)
Route::get('/dashboard', function () {
    if (!Auth::check()) {
        return redirect('/login');
    }

    if (Auth::user()->role === 'registered psychometrician') {
        return redirect('/homepage');
    }

    // Prevent caching (blocks browser back access)
    return Response::view('dashboard')
        ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
        ->header('Pragma', 'no-cache')
        ->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated Routes
Route::middleware('auth')->group(function () {

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User Accounts
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/view-accounts', [UserController::class, 'viewAccounts'])->name('users.index');

    // Clients
    Route::get('/clients/addclient', [ClientController::class, 'addClient'])->name('clients.addclient');
    Route::post('/clients/store', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');

    // Appointments
    Route::get('/appointments/create/{client}', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::get('/clients/{client}/addappointment', [ClientController::class, 'addappointment'])->name('clients.addappointment');
    Route::post('/clients/storeappointment', [ClientController::class, 'storeAppointment'])->name('client.storeappointment');

    // ✅ ADD THIS: View Appointments Route (fixes the error)
    Route::get('/clients/{client}/appointments', [AppointmentController::class, 'view'])->name('appointments.view');


    // Homepage (for RPMs)
    Route::get('/homepage', function () {
        return view('users.homepage');
    })->name('homepage');
});

// Auth Routes
require __DIR__ . '/auth.php';
