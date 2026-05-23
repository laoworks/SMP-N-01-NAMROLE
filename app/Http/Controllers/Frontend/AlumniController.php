<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\PengaturanWebsite;
use App\Models\Jurusan;

class AlumniController extends Controller
{
    public function index()
    {
        $settings = PengaturanWebsite::first();

        $alumnis = Alumni::where('is_verified', true)
            ->orderBy('tahun_lulus', 'desc')
            ->paginate(12);

        $jurusan = Jurusan::where('is_active', true)->get();

        $alumniTerbaru = Alumni::where('is_verified', true)
            ->orderBy('tahun_lulus', 'desc')
            ->limit(5)
            ->get();

        $totalAlumni = Alumni::where('is_verified', true)->count();
        $totalTahun = Alumni::where('is_verified', true)
            ->select('tahun_lulus')
            ->distinct()
            ->count();

        return view('frontend.alumni.index', compact(
            'settings',
            'alumnis',
            'jurusan',
            'alumniTerbaru',
            'totalAlumni',
            'totalTahun'
        ));
    }

    public function show($id)
    {
        $settings = PengaturanWebsite::first();
        $alumni = Alumni::with('jurusan')->findOrFail($id);

        $alumniLain = Alumni::where('is_verified', true)
            ->where('id', '!=', $id)
            ->orderBy('tahun_lulus', 'desc')
            ->limit(4)
            ->get();

        return view('frontend.alumni.show', compact('settings', 'alumni', 'alumniLain'));
    }

    public function jurusan($jurusanId)
    {
        $settings = PengaturanWebsite::first();

        $jurusan = Jurusan::findOrFail($jurusanId);

        $alumnis = Alumni::where('is_verified', true)
            ->where('jurusan_id', $jurusanId)
            ->orderBy('tahun_lulus', 'desc')
            ->paginate(12);

        $jurusanList = Jurusan::where('is_active', true)->get();

        return view('frontend.alumni.jurusan', compact(
            'settings',
            'alumnis',
            'jurusan',
            'jurusanList'
        ));
    }
}
