<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProfilController;
use App\Http\Controllers\Frontend\BeritaController;
use App\Http\Controllers\Frontend\GaleriController;
use App\Http\Controllers\Frontend\KontakController;
use App\Http\Controllers\Frontend\PpdbController;
use App\Http\Controllers\Frontend\JurusanController;
use App\Http\Controllers\Frontend\EkskulController;
use App\Http\Controllers\Frontend\AlumniController;
use Illuminate\Support\Facades\Route;

// Halaman Utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Profil Sekolah
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');

// Berita & Pengumuman
Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

// Galeri
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');
Route::get('/galeri/album/{album}', [GaleriController::class, 'album'])->name('galeri.album');

// Jurusan
Route::get('/jurusan', [JurusanController::class, 'index'])->name('jurusan.index');
Route::get('/jurusan/{id}', [JurusanController::class, 'show'])->name('jurusan.show');

// Ekstrakurikuler
Route::get('/ekskul', [EkskulController::class, 'index'])->name('ekskul.index');
Route::get('/ekskul/{id}', [EkskulController::class, 'show'])->name('ekskul.show');

// Kontak
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');

// PPDB
Route::get('/ppdb', [PpdbController::class, 'index'])->name('ppdb');
Route::post('/ppdb', [PpdbController::class, 'store'])->name('ppdb.store');

// Alumni
Route::get('/alumni', [AlumniController::class, 'index'])->name('alumni');
Route::get('/alumni/{id}', [AlumniController::class, 'show'])->name('alumni.show');

// PPDB Routes
Route::get('/ppdb', [PpdbController::class, 'index'])->name('ppdb');
Route::post('/ppdb', [PpdbController::class, 'store'])->name('ppdb.store');
Route::get('/ppdb/success/{no_pendaftaran}', [PpdbController::class, 'success'])->name('ppdb.success');
