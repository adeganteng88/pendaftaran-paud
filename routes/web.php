<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\AdminPendaftaranController;
use App\Http\Middleware\CheckRole;

/*
|--------------------------------------------------------------------------
| Web Routes - Sistem Pendaftaran PAUD Online
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. PUBLIC ROUTES (Akses Pendaftaran Orang Tua / Wali)
// ==========================================
Route::get('/', [PendaftaranController::class, 'create'])->name('pendaftaran.form');
Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
Route::get('/pendaftaran/bukti/{id}', [PendaftaranController::class, 'bukti'])->name('pendaftaran.bukti');

// ==========================================
// 2. AUTHENTICATION ROUTES (Login & Logout)
// ==========================================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==========================================
// 3. ADMIN ROUTES (Hanya Role 'admin' yang bisa masuk)
// ==========================================
Route::middleware(['auth', CheckRole::class.':admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminPendaftaranController::class, 'index'])->name('admin.dashboard');
    Route::post('/pendaftaran/{id}/validasi', [AdminPendaftaranController::class, 'validasi'])->name('admin.validasi');
    Route::get('/laporan', [AdminPendaftaranController::class, 'laporan'])->name('admin.laporan');
});

// ==========================================
// 4. MULTI-ROLE ROUTES (Contoh jika ada Role lain seperti 'kepala')
// ==========================================
Route::middleware(['auth', CheckRole::class.':admin,kepala'])->prefix('laporan')->group(function () {
    // Route ini bisa diakses bersama oleh Admin & Kepala PAUD
    Route::get('/cetak-semua', [AdminPendaftaranController::class, 'laporan'])->name('laporan.cetak');
});