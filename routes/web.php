<?php

use App\Http\Controllers\dropdownController;
use App\Http\Controllers\residentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('/register', [dropdownController::class, 'create'])->name('register');
Route::post('/register-resident', [residentController::class, 'insert'])->name('resident.store');

