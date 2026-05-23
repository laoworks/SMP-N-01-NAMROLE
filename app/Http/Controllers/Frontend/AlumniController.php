<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\PengaturanWebsite;

class AlumniController extends Controller
{
    public function index()
    {
        $settings = PengaturanWebsite::first();
        $alumnis = Alumni::where('is_verified', true)
            ->orderBy('tahun_lulus', 'desc')
            ->paginate(12);

        return view('frontend.alumni.index', compact('settings', 'alumnis'));
    }

    public function show($id)
    {
        $settings = PengaturanWebsite::first();
        $alumni = Alumni::with('jurusan')->findOrFail($id);

        return view('frontend.alumni.show', compact('settings', 'alumni'));
    }
}
