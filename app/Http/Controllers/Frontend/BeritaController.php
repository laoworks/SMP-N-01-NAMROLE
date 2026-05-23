<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BeritaPengumuman;
use App\Models\PengaturanWebsite;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $settings = PengaturanWebsite::first();

        // Filter berdasarkan jenis
        $jenis = $request->get('jenis', 'semua');
        $kategoriSlug = $request->get('kategori');
        $search = $request->get('search');

        // Query berita
        $query = BeritaPengumuman::where('is_published', true)
            ->where(function ($q) {
                $q->whereNull('expired_at')->orWhere('expired_at', '>', now());
            });

        // Filter jenis
        if ($jenis != 'semua') {
            $query->where('jenis', $jenis);
        }

        // Filter kategori
        if ($kategoriSlug) {
            $kategori = KategoriBerita::where('slug', $kategoriSlug)->first();
            if ($kategori) {
                $query->whereHas('kategori', function ($q) use ($kategori) {
                    $q->where('kategori_beritas.id', $kategori->id);
                });
            }
        }

        // Filter search
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('konten', 'like', "%{$search}%");
            });
        }

        // Urutkan berdasarkan published_at terbaru
        $query->orderBy('is_urgent', 'desc')
            ->orderBy('published_at', 'desc');

        $berita = $query->paginate(9);

        // Ambil berita terbaru untuk sidebar
        $beritaTerbaru = BeritaPengumuman::where('is_published', true)
            ->where(function ($q) {
                $q->whereNull('expired_at')->orWhere('expired_at', '>', now());
            })
            ->orderBy('published_at', 'desc')
            ->limit(5)
            ->get();

        // Ambil pengumuman terbaru
        $pengumumanTerbaru = BeritaPengumuman::where('is_published', true)
            ->where('jenis', 'pengumuman')
            ->where(function ($q) {
                $q->whereNull('expired_at')->orWhere('expired_at', '>', now());
            })
            ->orderBy('is_urgent', 'desc')
            ->orderBy('published_at', 'desc')
            ->limit(5)
            ->get();

        // Ambil semua kategori
        $kategoriList = KategoriBerita::all();

        return view('frontend.berita.index', compact(
            'settings',
            'berita',
            'beritaTerbaru',
            'pengumumanTerbaru',
            'kategoriList',
            'jenis',
            'kategoriSlug',
            'search'
        ));
    }

    public function show($slug)
    {
        $settings = PengaturanWebsite::first();

        $berita = BeritaPengumuman::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        // Tambah views
        $berita->increment('views');

        // Ambil berita terkait (sama kategori)
        $beritaTerkait = BeritaPengumuman::where('is_published', true)
            ->where('id', '!=', $berita->id)
            ->where(function ($q) {
                $q->whereNull('expired_at')->orWhere('expired_at', '>', now());
            })
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        return view('frontend.berita.show', compact('settings', 'berita', 'beritaTerkait'));
    }
}
