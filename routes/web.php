<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\dropdownController;
use App\Http\Controllers\residentController;

// Login
Route::get('/', function () { return view('login'); })->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Registration
Route::get('/register', [dropdownController::class, 'create'])->name('register');
Route::post('/register-resident', [residentController::class, 'insert'])->name('resident.store');

// Admin Dashboard
Route::get('/admin/dashboard', function () { return view('dashboard'); })->name('admin.dashboard');
Route::get('/admin/residents', [dropdownController::class, 'adminCreate'])->name('admin.residents');
Route::get('/admin/officials', function () { return view('officials'); })->name('admin.officials');

// Resident Landing Page
Route::get('/resident/landing', function () { return view('landingPage'); })->name('resident.landing');

// Resident API Routes
Route::prefix('api')->group(function () {
    Route::get('/residents', [residentController::class, 'index']);
    Route::post('/residents', [residentController::class, 'store']);
    Route::get('/residents/{residentID}', [residentController::class, 'show']);
    Route::put('/residents/{residentID}', [residentController::class, 'update']);
    Route::delete('/residents/{residentID}', [residentController::class, 'destroy']);
});

// Test storage
Route::get('/test-storage', function() {
    $storagePath = storage_path('app/public');
    $publicPath = public_path('storage');
    
    return response()->json([
        'storage_path_exists' => file_exists($storagePath),
        'storage_path' => $storagePath,
        'public_link_exists' => file_exists($publicPath),
        'public_link' => $publicPath,
        'is_link' => is_link($publicPath),
        'profile_pictures_exists' => file_exists($storagePath . '/profile_pictures'),
        'verification_ids_exists' => file_exists($storagePath . '/verification_ids'),
    ]);
});
