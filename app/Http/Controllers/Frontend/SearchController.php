<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BeritaPengumuman;
use App\Models\Prestasi;
use App\Models\Fasilitas;
use App\Models\Ekstrakurikuler;
use App\Models\PengaturanWebsite;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $settings = PengaturanWebsite::first();
        $query = $request->get('q');

        $results = [];

        if ($query) {
            // Cari di Berita
            $berita = BeritaPengumuman::where('is_published', true)
                ->where(function ($q) use ($query) {
                    $q->where('judul', 'like', "%{$query}%")
                        ->orWhere('konten', 'like', "%{$query}%");
                })
                ->limit(5)
                ->get();

            // Cari di Prestasi
            $prestasi = Prestasi::where('judul', 'like', "%{$query}%")
                ->orWhere('deskripsi', 'like', "%{$query}%")
                ->limit(5)
                ->get();

            // Cari di Fasilitas
            $fasilitas = Fasilitas::where('nama_fasilitas', 'like', "%{$query}%")
                ->orWhere('deskripsi', 'like', "%{$query}%")
                ->limit(5)
                ->get();

            // Cari di Ekstrakurikuler
            $ekskul = Ekstrakurikuler::where('nama_ekskul', 'like', "%{$query}%")
                ->orWhere('deskripsi', 'like', "%{$query}%")
                ->limit(5)
                ->get();

            $results = [
                'berita' => $berita,
                'prestasi' => $prestasi,
                'fasilitas' => $fasilitas,
                'ekskul' => $ekskul,
            ];
        }

        return view('frontend.search.index', compact('settings', 'results', 'query'));
    }
}
