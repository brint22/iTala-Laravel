<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController; // ✅ import this

Route::get('/', function () {
    return view('welcome');
});

Route::resource('clients', ClientController::class)->middleware('auth');
