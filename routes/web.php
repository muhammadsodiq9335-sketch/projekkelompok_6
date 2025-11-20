<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboard;
use App\Http\Controllers\Petugas\PasienController as PetugasPasien;
use App\Http\Controllers\Petugas\PendaftaranController as PetugasPendaftaran;
use App\Http\Controllers\Perawat\DashboardController as PerawatDashboard;
use App\Http\Controllers\Perawat\PemeriksaanController as PerawatPemeriksaan;
use App\Http\Controllers\Dokter\DashboardController as DokterDashboard;
use App\Http\Controllers\Dokter\PemeriksaanController as DokterPemeriksaan;

// Tambahkan namespace untuk Middleware
use App\Http\Middleware\PetugasMiddleware;
use App\Http\Middleware\PerawatMiddleware;
use App\Http\Middleware\DokterMiddleware;

// Landing page
Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
Route::get('/login/petugas', [AuthController::class, 'showLoginPetugas'])->name('login.petugas');
Route::get('/login/perawat', [AuthController::class, 'showLoginPerawat'])->name('login.perawat');
Route::get('/login/dokter', [AuthController::class, 'showLoginDokter'])->name('login.dokter');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Petugas Pendaftaran Routes
// MELINDUNGI RUTE: Menambahkan middleware 'auth' dan 'petugas'
// 'auth' memastikan pengguna login, 'petugas' memastikan perannya adalah petugas.
Route::middleware(['auth', PetugasMiddleware::class])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/dashboard', [PetugasDashboard::class, 'index'])->name('dashboard');
    
    // Pasien
    Route::resource('pasien', PetugasPasien::class);
    Route::get('pasien/{pasien}/print-card', [PetugasPasien::class, 'printCard'])->name('pasien.print-card');
    
    // Pendaftaran
    Route::resource('pendaftaran', PetugasPendaftaran::class);
    Route::get('pendaftaran/{pendaftaran}/print', [PetugasPendaftaran::class, 'print'])->name('pendaftaran.print');
});

// Perawat Routes
// MELINDUNGI RUTE: Menambahkan middleware 'auth' dan 'perawat'
Route::middleware(['auth', PerawatMiddleware::class])->prefix('perawat')->name('perawat.')->group(function () {
    Route::get('/dashboard', [PerawatDashboard::class, 'index'])->name('dashboard');
    
    // Pemeriksaan / Vital Signs
    Route::get('/pemeriksaan', [PerawatPemeriksaan::class, 'index'])->name('pemeriksaan.index');
    Route::get('/pemeriksaan/create/{pendaftaran}', [PerawatPemeriksaan::class, 'create'])->name('pemeriksaan.create');
    Route::post('/pemeriksaan', [PerawatPemeriksaan::class, 'store'])->name('pemeriksaan.store');
    Route::get('/pemeriksaan/{vitalSign}', [PerawatPemeriksaan::class, 'show'])->name('pemeriksaan.show');
    Route::get('/pemeriksaan/{vitalSign}/edit', [PerawatPemeriksaan::class, 'edit'])->name('pemeriksaan.edit');
    Route::put('/pemeriksaan/{vitalSign}', [PerawatPemeriksaan::class, 'update'])->name('pemeriksaan.update');
    Route::get('/riwayat', [PerawatPemeriksaan::class, 'riwayat'])->name('pemeriksaan.riwayat');
});

// Dokter Routes
// MELINDUNGI RUTE: Menambahkan middleware 'auth' dan 'dokter'
Route::middleware(['auth', DokterMiddleware::class])->prefix('dokter')->name('dokter.')->group(function () {
    Route::get('/dashboard', [DokterDashboard::class, 'index'])->name('dashboard');
    
    // Pemeriksaan
    Route::get('/pemeriksaan', [DokterPemeriksaan::class, 'index'])->name('pemeriksaan.index');
    Route::get('/pemeriksaan/create/{pendaftaran}', [DokterPemeriksaan::class, 'create'])->name('pemeriksaan.create');
    Route::post('/pemeriksaan', [DokterPemeriksaan::class, 'store'])->name('pemeriksaan.store');
    Route::get('/pemeriksaan/{pemeriksaan}', [DokterPemeriksaan::class, 'show'])->name('pemeriksaan.show');
    Route::get('/pemeriksaan/{pemeriksaan}/edit', [DokterPemeriksaan::class, 'edit'])->name('pemeriksaan.edit');
    Route::put('/pemeriksaan/{pemeriksaan}', [DokterPemeriksaan::class, 'update'])->name('pemeriksaan.update');
    Route::get('/pemeriksaan/{pemeriksaan}/print', [DokterPemeriksaan::class, 'print'])->name('pemeriksaan.print');
    Route::get('/riwayat', [DokterPemeriksaan::class, 'riwayat'])->name('pemeriksaan.riwayat');
    
    // Pasien
    Route::get('/pasien', [DokterPemeriksaan::class, 'cariPasien'])->name('pasien.index');
    Route::get('/pasien/{pendaftaran}/riwayat', [DokterPemeriksaan::class, 'riwayatPasien'])->name('pasien.riwayat');
});