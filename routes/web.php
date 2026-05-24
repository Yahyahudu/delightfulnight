<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/register', function () {
    return view('register');
})->name('register');

// API-like endpoints for registration flow
Route::post('/api/register/store', [RegistrationController::class, 'store']);
Route::post('/api/register/finalize/{id}', [RegistrationController::class, 'finalize']);

Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/confirm/{id}', [AdminController::class, 'confirm'])->name('admin.confirm');
    Route::post('/admin/reminder', [AdminController::class, 'sendReminder'])->name('admin.reminder.send');
});

