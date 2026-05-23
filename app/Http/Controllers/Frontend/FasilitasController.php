<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use App\Models\PengaturanWebsite;

class FasilitasController extends Controller
{
    public function index()
    {
        $settings = PengaturanWebsite::first();
        $fasilitas = Fasilitas::where('status', 'aktif')->get();

        return view('frontend.fasilitas.index', compact('settings', 'fasilitas'));
    }

    public function show($id)
    {
        $settings = PengaturanWebsite::first();
        $fasilitas = Fasilitas::findOrFail($id);

        return view('frontend.fasilitas.show', compact('settings', 'fasilitas'));
    }
}
