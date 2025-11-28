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
use App\Http\Controllers\Apotek\ObatController as ApotekObat;
use App\Http\Controllers\Apotek\ResepController as ApotekResep;

// Tambahkan namespace untuk Middleware
use App\Http\Middleware\PetugasMiddleware;
use App\Http\Middleware\PerawatMiddleware;
use App\Http\Middleware\DokterMiddleware;
use App\Http\Middleware\ApotekerMiddleware;
use App\Http\Middleware\SuperAdminMiddleware;
use App\Http\Controllers\SuperAdmin\DashboardController as SuperAdminDashboard;
use App\Http\Controllers\SuperAdmin\DokterController as SuperAdminDokter;
use App\Http\Controllers\SuperAdmin\PetugasController as SuperAdminPetugas;
use App\Http\Controllers\SuperAdmin\PerawatController as SuperAdminPerawat;
use App\Http\Controllers\Petugas\PembayaranController;

// Landing page
// Landing page
Route::get('/', function () {
    return redirect()->route('login');
});

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Petugas Pendaftaran Routes
Route::middleware(['auth', PetugasMiddleware::class])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/dashboard', [PetugasDashboard::class, 'index'])->name('dashboard');
    
    // Pasien
    Route::resource('pasien', PetugasPasien::class);
    Route::get('pasien/{pasien}/print-card', [PetugasPasien::class, 'printCard'])->name('pasien.print-card');
    
    // Pendaftaran
    // Pendaftaran
    Route::resource('pendaftaran', PetugasPendaftaran::class);
    Route::get('pendaftaran/{pendaftaran}/print', [PetugasPendaftaran::class, 'print'])->name('pendaftaran.print');
    
    // Pembayaran / Kasir
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
    Route::get('/pembayaran/create/{pendaftaran}', [PembayaranController::class, 'create'])->name('pembayaran.create');
    Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
    Route::get('/pembayaran/{pembayaran}', [PembayaranController::class, 'show'])->name('pembayaran.show');
    Route::get('/pembayaran/{pembayaran}/print', [PembayaranController::class, 'print'])->name('pembayaran.print');
});

// Perawat Routes
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

// Apotek Routes
Route::middleware(['auth', ApotekerMiddleware::class])->prefix('apotek')->name('apotek.')->group(function () {
    Route::resource('obat', ApotekObat::class);
    
    // Resep
    Route::get('/resep', [ApotekResep::class, 'index'])->name('resep.index');
    Route::get('/resep/riwayat', [ApotekResep::class, 'riwayat'])->name('resep.riwayat');
    Route::get('/resep/{resep}', [ApotekResep::class, 'show'])->name('resep.show');
    Route::post('/resep/{resep}/process', [ApotekResep::class, 'process'])->name('resep.process');
});

// Super Admin Routes
Route::middleware(['auth', SuperAdminMiddleware::class])->prefix('super-admin')->name('super_admin.')->group(function () {
    Route::get('/dashboard', [SuperAdminDashboard::class, 'index'])->name('dashboard');
    
    // Master Data
    Route::resource('dokter', SuperAdminDokter::class)->except(['show']);
    Route::resource('petugas', SuperAdminPetugas::class)->except(['show']);
    Route::resource('perawat', SuperAdminPerawat::class)->except(['show']);
});