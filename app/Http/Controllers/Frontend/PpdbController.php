<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PengaturanWebsite;
use App\Models\ProfilSekolah;
use App\Models\GelombangPpdb;
use App\Models\Pendaftar;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class PpdbController extends Controller
{
    public function index()
    {
        $settings = PengaturanWebsite::first();
        $profil = ProfilSekolah::first();
        $gelombangAktif = GelombangPpdb::where('is_active', true)
            ->where('periode_mulai', '<=', now())
            ->where('periode_selesai', '>=', now())
            ->first();

        $gelombangMendatang = GelombangPpdb::where('is_active', true)
            ->where('periode_mulai', '>', now())
            ->orderBy('periode_mulai', 'asc')
            ->get();

        $jurusan = Jurusan::where('is_active', true)->get();

        return view('frontend.ppdb.index', compact(
            'settings',
            'profil',
            'gelombangAktif',
            'gelombangMendatang',
            'jurusan'
        ));
    }

    public function store(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            // Data pribadi
            'nama_lengkap' => 'required|string|max:100',
            'nik' => 'nullable|string|max:20',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'agama' => 'nullable|string|max:20',
            'anak_ke' => 'nullable|integer',
            'jumlah_saudara' => 'nullable|integer',

            // Kontak
            'email' => 'nullable|email|max:100',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'nullable|string',
            'rt_rw' => 'nullable|string|max:20',
            'kelurahan' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'kota' => 'nullable|string|max:100',
            'provinsi' => 'nullable|string|max:100',

            // Pendidikan
            'asal_sekolah' => 'nullable|string|max:100',
            'nisn' => 'nullable|string|max:20',
            'tahun_lulus' => 'nullable|integer',

            // Orang tua
            'ayah_nama' => 'nullable|string|max:100',
            'ayah_pekerjaan' => 'nullable|string|max:100',
            'ayah_no_hp' => 'nullable|string|max:20',
            'ibu_nama' => 'nullable|string|max:100',
            'ibu_pekerjaan' => 'nullable|string|max:100',
            'ibu_no_hp' => 'nullable|string|max:20',

            // Jurusan
            'jurusan_pilihan_1' => 'required|exists:jurusans,id',
            'jurusan_pilihan_2' => 'nullable|exists:jurusans,id',

            // Dokumen
            'foto_kk' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_akte' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_ijazah' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_nilai' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Cek gelombang aktif
        $gelombang = GelombangPpdb::where('is_active', true)
            ->where('periode_mulai', '<=', now())
            ->where('periode_selesai', '>=', now())
            ->first();

        if (!$gelombang) {
            return redirect()->back()->with('error', 'Maaf, pendaftaran PPDB sedang tidak dibuka.');
        }

        // Upload dokumen
        $foto_kk = $request->file('foto_kk') ? $request->file('foto_kk')->store('ppdb/dokumen', 'public') : null;
        $foto_akte = $request->file('foto_akte') ? $request->file('foto_akte')->store('ppdb/dokumen', 'public') : null;
        $foto_ijazah = $request->file('foto_ijazah') ? $request->file('foto_ijazah')->store('ppdb/dokumen', 'public') : null;
        $foto_nilai = $request->file('foto_nilai') ? $request->file('foto_nilai')->store('ppdb/dokumen', 'public') : null;

        // Buat nomor pendaftaran
        $no_pendaftaran = 'PPDB-' . date('Y') . '-' . strtoupper(Str::random(8));

        // Simpan data
        $pendaftar = Pendaftar::create([
            'no_pendaftaran' => $no_pendaftaran,
            'gelombang_id' => $gelombang->id,
            'nama_lengkap' => $request->nama_lengkap,
            'nik' => $request->nik,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,
            'anak_ke' => $request->anak_ke,
            'jumlah_saudara' => $request->jumlah_saudara,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'rt_rw' => $request->rt_rw,
            'kelurahan' => $request->kelurahan,
            'kecamatan' => $request->kecamatan,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'asal_sekolah' => $request->asal_sekolah,
            'nisn' => $request->nisn,
            'tahun_lulus' => $request->tahun_lulus,
            'ayah_nama' => $request->ayah_nama,
            'ayah_pekerjaan' => $request->ayah_pekerjaan,
            'ayah_no_hp' => $request->ayah_no_hp,
            'ibu_nama' => $request->ibu_nama,
            'ibu_pekerjaan' => $request->ibu_pekerjaan,
            'ibu_no_hp' => $request->ibu_no_hp,
            'jurusan_pilihan_1' => $request->jurusan_pilihan_1,
            'jurusan_pilihan_2' => $request->jurusan_pilihan_2,
            'foto_kk' => $foto_kk,
            'foto_akte' => $foto_akte,
            'foto_ijazah' => $foto_ijazah,
            'foto_nilai' => $foto_nilai,
            'status_verifikasi' => 'pending',
            'tanggal_daftar' => now(),
        ]);

        return redirect()->route('ppdb.success', $pendaftar->no_pendaftaran)
            ->with('success', 'Pendaftaran berhasil! Nomor pendaftaran Anda: ' . $no_pendaftaran);
    }

    public function success($no_pendaftaran)
    {
        $settings = PengaturanWebsite::first();
        $pendaftar = Pendaftar::where('no_pendaftaran', $no_pendaftaran)->firstOrFail();

        return view('frontend.ppdb.success', compact('settings', 'pendaftar'));
    }
}
