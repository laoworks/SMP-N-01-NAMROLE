<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PengaturanWebsite;
use App\Models\ProfilSekolah;
use App\Models\Guru;
use App\Models\Fasilitas;
use App\Models\Prestasi;
use App\Models\StrukturOrganisasi;
use App\Models\Ekstrakurikuler;
use App\Models\Jurusan;
use App\Models\Alumni;

class ProfilController extends Controller
{
    public function index()
    {
        $settings = PengaturanWebsite::first();
        $profil = ProfilSekolah::first();
        $struktur = StrukturOrganisasi::where('is_active', true)->orderBy('tahun', 'desc')->first();
        $guru = Guru::where('is_active', true)->orderBy('nama_lengkap')->get();
        $fasilitas = Fasilitas::where('status', 'aktif')->get();
        $prestasi = Prestasi::orderBy('tahun', 'desc')->limit(9)->get();
        $ekskul = Ekstrakurikuler::where('is_active', true)->get();
        $jurusan = Jurusan::where('is_active', true)->get();
        $alumni = Alumni::where('is_verified', true)->orderBy('tahun_lulus', 'desc')->limit(6)->get();

        return view('frontend.profil.index', compact(
            'settings',
            'profil',
            'struktur',
            'guru',
            'fasilitas',
            'prestasi',
            'ekskul',
            'jurusan',
            'alumni'
        ));
    }
}
