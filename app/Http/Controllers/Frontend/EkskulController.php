<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakurikuler;
use App\Models\PengaturanWebsite;

class EkskulController extends Controller
{
    public function index()
    {
        $settings = PengaturanWebsite::first();
        $ekskuls = Ekstrakurikuler::where('is_active', true)->get();

        return view('frontend.ekskul.index', compact('settings', 'ekskuls'));
    }

    public function show($id)
    {
        $settings = PengaturanWebsite::first();
        $ekskul = Ekstrakurikuler::with('pembina')->findOrFail($id);
        $ekskuls = Ekstrakurikuler::where('is_active', true)->limit(6)->get();

        return view('frontend.ekskul.show', compact('settings', 'ekskul', 'ekskuls'));
    }
}
