<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PengaturanWebsite;
use App\Models\PesanKontak;
use App\Models\ProfilSekolah;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        $settings = PengaturanWebsite::first();
        $profil = ProfilSekolah::first();

        return view('frontend.kontak.index', compact('settings', 'profil'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'no_hp' => 'nullable|string|max:20',
            'subjek' => 'nullable|string|max:200',
            'pesan' => 'required|string',
        ]);

        PesanKontak::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'subjek' => $request->subjek,
            'pesan' => $request->pesan,
        ]);

        return redirect()->back()->with('success', 'Pesan Anda telah terkirim. Terima kasih!');
    }
}
