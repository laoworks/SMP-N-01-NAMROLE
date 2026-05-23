<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BeritaPengumuman;
use App\Models\Slider;
use App\Models\Prestasi;
use App\Models\Ekstrakurikuler;
use App\Models\Alumni;
use App\Models\Fasilitas;
use App\Models\PengaturanWebsite;
use App\Models\Guru;
use App\Models\ProfilSekolah;
use App\Models\Pendaftar;
use App\Models\Album;
use App\Models\GaleriFoto;
use App\Models\GaleriVideo;
use App\Models\PesanKontak;

class HomeController extends Controller
{
    public function index()
    {
        $settings = PengaturanWebsite::first();
        $profil = ProfilSekolah::first();

        // Slider
        $sliders = Slider::where('is_active', true)->orderBy('urutan')->get();

        // Statistik
        $statistik = (object) [
            'siswa_aktif' => Pendaftar::where('status_verifikasi', 'diterima')->count() . '+',
            'lulusan_berkualitas' => '100%',
        ];

        // Prestasi count
        $prestasiCount = Prestasi::count();

        // Berita & Pengumuman
        $beritaTerbaru = BeritaPengumuman::where('is_published', true)
            ->where('jenis', 'berita')
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        $pengumuman = BeritaPengumuman::where('is_published', true)
            ->where('jenis', 'pengumuman')
            ->where(function ($q) {
                $q->whereNull('expired_at')->orWhere('expired_at', '>', now());
            })
            ->orderBy('is_urgent', 'desc')
            ->orderBy('published_at', 'desc')
            ->limit(5)
            ->get();

        // Prestasi
        $prestasi = Prestasi::orderBy('tahun', 'desc')->limit(6)->get();

        // Ekstrakurikuler
        $ekskul = Ekstrakurikuler::where('is_active', true)->limit(8)->get();

        // Alumni
        $alumniFeatured = Alumni::where('is_verified', true)
            ->where('is_featured', true)
            ->orderBy('tahun_lulus', 'desc')
            ->limit(3)
            ->get();

        // Fasilitas
        $fasilitas = Fasilitas::where('status', 'aktif')->limit(6)->get();

        // Kepala Sekolah
        $kepalaSekolah = Guru::where('jabatan', 'like', '%Kepala Sekolah%')
            ->orWhere('jabatan', 'like', '%Kepala%')
            ->first();

        // Album Foto untuk Galeri
        $albums = Album::where('is_active', true)
            ->orderBy('tanggal', 'desc')
            ->limit(6)
            ->get();

        // Video untuk Galeri
        $videos = GaleriVideo::where('is_active', true)
            ->orderBy('tanggal', 'desc')
            ->limit(3)
            ->get();

        return view('frontend.home', compact(
            'settings',
            'profil',
            'sliders',
            'beritaTerbaru',
            'pengumuman',
            'prestasi',
            'ekskul',
            'alumniFeatured',
            'fasilitas',
            'kepalaSekolah',
            'statistik',
            'prestasiCount',
            'albums',
            'videos'
        ));
    }
}
