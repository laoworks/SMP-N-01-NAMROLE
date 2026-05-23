<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use App\Models\PengaturanWebsite;

class PrestasiController extends Controller
{
    public function index()
    {
        $settings = PengaturanWebsite::first();
        $prestasis = Prestasi::orderBy('tahun', 'desc')->paginate(12);

        return view('frontend.prestasi.index', compact('settings', 'prestasis'));
    }

    public function show($id)
    {
        $settings = PengaturanWebsite::first();
        $prestasi = Prestasi::findOrFail($id);

        $prestasiLain = Prestasi::where('id', '!=', $id)
            ->orderBy('tahun', 'desc')
            ->limit(4)
            ->get();

        return view('frontend.prestasi.show', compact('settings', 'prestasi', 'prestasiLain'));
    }
}
