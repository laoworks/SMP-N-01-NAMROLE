<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilSekolah extends Model
{
    protected $table = 'profil_sekolahs';

    protected $fillable = [
        'nama_sekolah',
        'npsn',
        'nss',
        'alamat',
        'desa',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'kode_pos',
        'telepon',
        'email',
        'website',
        'tahun_berdiri',
        'pendiri',
        'sejarah',
        'visi',
        'misi',
        'akreditasi',
        'tahun_akreditasi',
        'logo',
        'favicon',
        'gambar_visi',
        'gambar_misi_1',
        'judul_misi_1',
        'deskripsi_misi_1',
        'gambar_misi_2',
        'judul_misi_2',
        'deskripsi_misi_2',
        'gambar_misi_3',
        'judul_misi_3',
        'deskripsi_misi_3'
    ];
}
