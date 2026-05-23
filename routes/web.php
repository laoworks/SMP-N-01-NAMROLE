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
use App\Http\Controllers\Frontend\PrestasiController;
use App\Http\Controllers\Frontend\FasilitasController;
use App\Http\Controllers\Frontend\KalenderController;
use App\Http\Controllers\Frontend\SearchController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Profil Sekolah - PASTIKAN INI ADA
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');

// Berita & Pengumuman
Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

// Prestasi
Route::get('/prestasi', [PrestasiController::class, 'index'])->name('prestasi');
Route::get('/prestasi/{id}', [PrestasiController::class, 'show'])->name('prestasi.show');

// Fasilitas
Route::get('/fasilitas', [FasilitasController::class, 'index'])->name('fasilitas');
Route::get('/fasilitas/{id}', [FasilitasController::class, 'show'])->name('fasilitas.show');

// Galeri
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');
Route::get('/galeri/album/{id}', [GaleriController::class, 'album'])->name('galeri.album');

// Kalender Akademik
Route::get('/kalender', [KalenderController::class, 'index'])->name('kalender');

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
Route::get('/ppdb/success/{no_pendaftaran}', [PpdbController::class, 'success'])->name('ppdb.success');

// Alumni
Route::get('/alumni', [AlumniController::class, 'index'])->name('alumni');
Route::get('/alumni/{id}', [AlumniController::class, 'show'])->name('alumni.show');
Route::get('/alumni/jurusan/{jurusanId}', [AlumniController::class, 'jurusan'])->name('alumni.jurusan');

// Search
Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::get('/storage-link', function () {

    $target = storage_path('app/public');
    $link = public_path('storage');

    // Jika link belum ada
    if (!file_exists($link)) {

        // Coba symlink native PHP
        symlink($target, $link);

        return 'Symlink berhasil dibuat.';
    }

    return 'Symlink sudah ada.';
});
