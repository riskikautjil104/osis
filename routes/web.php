<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\PengurusTerdahuluController;
use App\Http\Controllers\VisiMisiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SambutanController;

// ==================== FRONTEND ROUTES (PUBLIC) ====================
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/pengurus', [PublicController::class, 'pengurus'])->name('public.pengurus');
Route::get('/agenda', [PublicController::class, 'agenda'])->name('public.agenda');
Route::get('/berita', [PublicController::class, 'berita'])->name('public.berita');
Route::get('/berita/{id}/{slug}', [PublicController::class, 'beritaDetail'])->name('public.berita.detail');
Route::get('/galeri', [PublicController::class, 'galeri'])->name('public.galeri');
Route::get('/pengurus-terdahulu', [PublicController::class, 'pengurusTerdahulu'])->name('public.pengurus_terdahulu');
Route::get('/one-data', [PublicController::class, 'dokumen'])->name('public.dokumen');
Route::get('/one-data/{id}/{slug}', [PublicController::class, 'dokumenDetail'])->name('public.dokumen.detail');
Route::get('/one-data/download/{id}', [PublicController::class, 'dokumenDownload'])->name('public.dokumen.download');
Route::get('/one-data/export/{format}', [PublicController::class, 'dokumenExport'])->name('public.dokumen.export');

// ==================== AUTH ROUTES (Custom URL) ====================
Route::prefix('osis/login/mu')->group(function () {
    Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/', [LoginController::class, 'login'])->name('login.submit');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// ==================== DASHBOARD ROUTES (Protected) ====================
Route::prefix('dashboard')->middleware(['admin'])->group(function () {
    // Dashboard Home
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Pengurus Routes
    Route::get('/pengurus', [PengurusController::class, 'index'])->name('dashboard.pengurus');
    Route::get('/pengurus/create', [PengurusController::class, 'create'])->name('dashboard.pengurus.create');
    Route::post('/pengurus', [PengurusController::class, 'store'])->name('dashboard.pengurus.store');
    Route::get('/pengurus/{id}/edit', [PengurusController::class, 'edit'])->name('dashboard.pengurus.edit');
    Route::put('/pengurus/{id}', [PengurusController::class, 'update'])->name('dashboard.pengurus.update');
    Route::delete('/pengurus/{id}', [PengurusController::class, 'destroy'])->name('dashboard.pengurus.destroy');
    
    // Agenda Routes
    Route::get('/agenda', [AgendaController::class, 'index'])->name('dashboard.agenda');
    Route::get('/agenda/create', [AgendaController::class, 'create'])->name('dashboard.agenda.create');
    Route::post('/agenda', [AgendaController::class, 'store'])->name('dashboard.agenda.store');
    Route::get('/agenda/{id}/edit', [AgendaController::class, 'edit'])->name('dashboard.agenda.edit');
    Route::put('/agenda/{id}', [AgendaController::class, 'update'])->name('dashboard.agenda.update');
    Route::delete('/agenda/{id}', [AgendaController::class, 'destroy'])->name('dashboard.agenda.destroy');
    
    // Berita Routes
    Route::get('/berita', [BeritaController::class, 'index'])->name('dashboard.berita');
    Route::get('/berita/create', [BeritaController::class, 'create'])->name('dashboard.berita.create');
    Route::post('/berita', [BeritaController::class, 'store'])->name('dashboard.berita.store');
    Route::get('/berita/{id}/edit', [BeritaController::class, 'edit'])->name('dashboard.berita.edit');
    Route::put('/berita/{id}', [BeritaController::class, 'update'])->name('dashboard.berita.update');
    Route::delete('/berita/{id}', [BeritaController::class, 'destroy'])->name('dashboard.berita.destroy');
    
    // Galeri Routes
    Route::get('/galeri', [GaleriController::class, 'index'])->name('dashboard.galeri');
    Route::get('/galeri/create', [GaleriController::class, 'create'])->name('dashboard.galeri.create');
    Route::post('/galeri', [GaleriController::class, 'store'])->name('dashboard.galeri.store');
    Route::get('/galeri/{id}/edit', [GaleriController::class, 'edit'])->name('dashboard.galeri.edit');
    Route::put('/galeri/{id}', [GaleriController::class, 'update'])->name('dashboard.galeri.update');
    Route::delete('/galeri/{id}', [GaleriController::class, 'destroy'])->name('dashboard.galeri.destroy');
    
    // Pengurus Terdahulu Routes
    Route::get('/pengurus-terdahulu', [PengurusTerdahuluController::class, 'index'])->name('dashboard.pengurus_terdahulu');
    Route::get('/pengurus-terdahulu/{id}/edit', [PengurusTerdahuluController::class, 'edit'])->name('dashboard.pengurus_terdahulu.edit');
    Route::post('/pengurus-terdahulu', [PengurusTerdahuluController::class, 'store'])->name('dashboard.pengurus_terdahulu.store');
    Route::put('/pengurus-terdahulu/{id}', [PengurusTerdahuluController::class, 'update'])->name('dashboard.pengurus_terdahulu.update');
    Route::delete('/pengurus-terdahulu/{id}', [PengurusTerdahuluController::class, 'destroy'])->name('dashboard.pengurus_terdahulu.destroy');
    
    // Visi Misi Routes
    Route::get('/visi-misi', [VisiMisiController::class, 'index'])->name('dashboard.visimisi');
    Route::put('/visi-misi', [VisiMisiController::class, 'update'])->name('dashboard.visimisi.update');
    // Di dalam group dashboard, tambahkan:
Route::get('/sambutan', [SambutanController::class, 'index'])->name('dashboard.sambutan');
Route::get('/sambutan/create', [SambutanController::class, 'create'])->name('dashboard.sambutan.create');
Route::post('/sambutan', [SambutanController::class, 'store'])->name('dashboard.sambutan.store');
Route::get('/sambutan/{id}/edit', [SambutanController::class, 'edit'])->name('dashboard.sambutan.edit');
Route::put('/sambutan/{id}', [SambutanController::class, 'update'])->name('dashboard.sambutan.update');
Route::delete('/sambutan/{id}', [SambutanController::class, 'destroy'])->name('dashboard.sambutan.destroy');
Route::get('/dokumen', [DokumenController::class, 'index'])->name('dashboard.dokumen');
Route::get('/dokumen/create', [DokumenController::class, 'create'])->name('dashboard.dokumen.create');
Route::post('/dokumen', [DokumenController::class, 'store'])->name('dashboard.dokumen.store');
Route::get('/dokumen/{id}/edit', [DokumenController::class, 'edit'])->name('dashboard.dokumen.edit');
Route::put('/dokumen/{id}', [DokumenController::class, 'update'])->name('dashboard.dokumen.update');
Route::delete('/dokumen/{id}', [DokumenController::class, 'destroy'])->name('dashboard.dokumen.destroy');
});