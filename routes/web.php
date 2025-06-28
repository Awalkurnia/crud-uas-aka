<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Jangan lupa import Auth!

// Login & Register
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Halaman yang butuh login
Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    });

    Route::get('/mahasiswa', function () {
        return view('mahasiswa');
    })->name('mahasiswa');

    // ✅ Hanya satu route logout, menggunakan metode POST
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/login');
    })->name('logout');
});