<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\SessionNoteController;

// Landing Page
Route::get('/', function () {
    if (Auth::check()) {
        return Auth::user()->role === 'registered psychometrician'
            ? redirect('/homepage')
            : redirect('/dashboard');
    }
    return view('welcome');
});

// Dashboard for Non-RPM Users
Route::get('/dashboard', function () {
    if (!Auth::check()) {
        return redirect('/login');
    }

    if (Auth::user()->role === 'registered psychometrician') {
        return redirect('/homepage');
    }

    return Response::view('dashboard')
        ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
        ->header('Pragma', 'no-cache')
        ->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated Routes
Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Users
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/view-accounts', [UserController::class, 'viewAccounts'])->name('users.index');

    // Clients
    Route::get('/clients/addclient', [ClientController::class, 'addClient'])->name('clients.addclient');
    Route::post('/clients/store', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');

    // Appointments
    Route::get('/appointments/create/{client}', [AppointmentController::class, 'create'])->name('appointments.create');
Route::get('/clients/{client}/addappointment', [AppointmentController::class, 'addappointment'])->name('clients.addappointment');;
    Route::post('/clients/storeappointment', [ClientController::class, 'storeAppointment'])->name('client.storeappointment');
    Route::get('/clients/{client}/appointments', [AppointmentController::class, 'view'])->name('appointments.view');

    // Session Notes
    Route::get('/clients/{client}/add-session-note', [ClientController::class, 'addSessionNoteForm'])->name('clients.addsessionnote');
    Route::post('/clients/store-session-note', [ClientController::class, 'storeSessionNote'])->name('clients.storesessionnote');
    Route::post('/clients/{client}/session-notes', [SessionNoteController::class, 'store'])->name('clients.sessionnotes.store');


    // Show form to set password
    Route::get('/clients/{client}/addaccount', [ClientController::class, 'addAccount'])->name('clients.addaccount');


    // Handle password submission
    Route::post('/clients/store-account/{id}', [ClientController::class, 'storeAccount'])->name('clients.storeaccount');


    // View all clients (this is your existing route for the index page)
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');

    Route::post('/clients/add-account/{id}', [ClientController::class, 'storeAccount'])->name('clients.storeaccount');



    Route::get('/clients/{client}/session-notes', [ClientController::class, 'viewSessionNotes'])->name('clients.viewsessionnotes');
    // Homepage for RPMs
    Route::get('/homepage', function () {
        return view('users.homepage');
    })->name('homepage');
});

// web.php
Route::get('/clients/dashboard', [ClientController::class, 'dashboard'])->name('client.dashboard');


// Auth Routes
require __DIR__ . '/auth.php';
