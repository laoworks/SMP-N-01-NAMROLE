<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\GaleriFoto;
use App\Models\GaleriVideo;
use App\Models\PengaturanWebsite;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $settings = PengaturanWebsite::first();
        $type = $request->get('type', 'foto');

        if ($type == 'video') {
            // Tampilkan video
            $videos = GaleriVideo::where('is_active', true)
                ->orderBy('tanggal', 'desc')
                ->paginate(12);

            $albums = null;
            $fotos = null;
        } else {
            // Tampilkan album foto
            $albums = Album::where('is_active', true)
                ->orderBy('tanggal', 'desc')
                ->paginate(9);

            $fotos = null;
            $videos = null;
        }

        // Ambil album terbaru untuk sidebar
        $albumTerbaru = Album::where('is_active', true)
            ->orderBy('tanggal', 'desc')
            ->limit(5)
            ->get();

        // Ambil video terbaru untuk sidebar
        $videoTerbaru = GaleriVideo::where('is_active', true)
            ->orderBy('tanggal', 'desc')
            ->limit(5)
            ->get();

        return view('frontend.galeri.index', compact(
            'settings',
            'albums',
            'fotos',
            'videos',
            'type',
            'albumTerbaru',
            'videoTerbaru'
        ));
    }

    public function album($id)
    {
        $settings = PengaturanWebsite::first();

        $album = Album::where('is_active', true)
            ->where('id', $id)
            ->firstOrFail();

        $fotos = GaleriFoto::where('album_id', $id)
            ->orderBy('urutan', 'asc')
            ->paginate(24);

        // Ambil album lain
        $albumLain = Album::where('is_active', true)
            ->where('id', '!=', $id)
            ->orderBy('tanggal', 'desc')
            ->limit(4)
            ->get();

        return view('frontend.galeri.album', compact(
            'settings',
            'album',
            'fotos',
            'albumLain'
        ));
    }
}
