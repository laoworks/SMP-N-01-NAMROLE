<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\PengaturanWebsite;

class JurusanController extends Controller
{
    public function index()
    {
        $settings = PengaturanWebsite::first();
        $jurusans = Jurusan::where('is_active', true)->orderBy('urutan')->get();

        return view('frontend.jurusan.index', compact('settings', 'jurusans'));
    }

    public function show($id)
    {
        $settings = PengaturanWebsite::first();
        $jurusan = Jurusan::findOrFail($id);
        $jurusans = Jurusan::where('is_active', true)->orderBy('urutan')->get();

        return view('frontend.jurusan.show', compact('settings', 'jurusan', 'jurusans'));
    }
}
