<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\PengaturanWa;
use App\Models\KategoriBerita;
use App\Models\Jurusan;
use App\Models\Fasilitas;
use App\Models\Ekstrakurikuler;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ==================== USER ADMIN ====================
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@sekolah.sch.id',
            'password' => Hash::make('admin123'),
            'role' => 'superadmin',
            'is_active' => true,
        ]);

        // ==================== PENGATURAN WEBSITE ====================
        $this->call(PengaturanWebsiteSeeder::class);

        // ==================== PENGATURAN WHATSAPP ====================
        PengaturanWa::create([
            'nomor_wa' => '6281234567890',
            'pesan_otomatis' => 'Halo, terima kasih telah menghubungi kami. Silakan kirim pertanyaan Anda dan kami akan segera merespon.',
            'is_active' => true,
        ]);

        // ==================== KATEGORI BERITA ====================
        $kategoris = ['Akademik', 'Non-Akademik', 'Pengumuman', 'Prestasi', 'Kegiatan'];
        foreach ($kategoris as $kategori) {
            KategoriBerita::create([
                'nama_kategori' => $kategori,
                'slug' => strtolower(str_replace(' ', '-', $kategori)),
            ]);
        }

        // ==================== JURUSAN ====================
        $jurusans = [
            ['kode_jurusan' => 'RPL', 'nama_jurusan' => 'Rekayasa Perangkat Lunak', 'singkatan' => 'RPL', 'deskripsi' => 'Mempelajari pengembangan software, web, dan mobile app', 'is_active' => true],
            ['kode_jurusan' => 'TKJ', 'nama_jurusan' => 'Teknik Komputer dan Jaringan', 'singkatan' => 'TKJ', 'deskripsi' => 'Mempelajari jaringan komputer dan administrasi server', 'is_active' => true],
            ['kode_jurusan' => 'MM', 'nama_jurusan' => 'Multimedia', 'singkatan' => 'MM', 'deskripsi' => 'Mempelajari desain grafis, animasi, dan editing video', 'is_active' => true],
        ];
        foreach ($jurusans as $jurusan) {
            Jurusan::create($jurusan);
        }

        // ==================== FASILITAS ====================
        $fasilitas = [
            ['nama_fasilitas' => 'Laboratorium Komputer', 'deskripsi' => 'Lab dengan 40 unit PC spesifikasi tinggi', 'jumlah' => 1, 'kondisi' => 'Baik', 'status' => 'aktif'],
            ['nama_fasilitas' => 'Perpustakaan', 'deskripsi' => 'Koleksi 5000+ buku dan area baca nyaman', 'jumlah' => 1, 'kondisi' => 'Baik', 'status' => 'aktif'],
            ['nama_fasilitas' => 'Lapangan Olahraga', 'deskripsi' => 'Lapangan serbaguna untuk futsal, basket, voli', 'jumlah' => 1, 'kondisi' => 'Baik', 'status' => 'aktif'],
            ['nama_fasilitas' => 'Mushola', 'deskripsi' => 'Tempat ibadah dengan kapasitas 100 jamaah', 'jumlah' => 1, 'kondisi' => 'Baik', 'status' => 'aktif'],
            ['nama_fasilitas' => 'Kantin Sehat', 'deskripsi' => 'Area makan dengan menu bergizi', 'jumlah' => 1, 'kondisi' => 'Baik', 'status' => 'aktif'],
        ];
        foreach ($fasilitas as $item) {
            Fasilitas::create($item);
        }

        // ==================== EKSTRAKURIKULER ====================
        $ekskuls = [
            ['nama_ekskul' => 'Pramuka', 'deskripsi' => 'Kegiatan kepramukaan untuk membentuk karakter', 'jadwal_latihan' => 'Sabtu, 07:00 - 10:00', 'is_active' => true],
            ['nama_ekskul' => 'Futsal', 'deskripsi' => 'Olahraga futsal untuk mengembangkan bakat sepakbola', 'jadwal_latihan' => 'Rabu & Jumat, 15:00 - 17:00', 'is_active' => true],
            ['nama_ekskul' => 'Paduan Suara', 'deskripsi' => 'Pengembangan bakat vokal dan seni suara', 'jadwal_latihan' => 'Kamis, 14:00 - 16:00', 'is_active' => true],
            ['nama_ekskul' => 'PMR', 'deskripsi' => 'Palang Merah Remaja - pertolongan pertama', 'jadwal_latihan' => 'Selasa, 14:00 - 16:00', 'is_active' => true],
        ];
        foreach ($ekskuls as $ekskul) {
            Ekstrakurikuler::create($ekskul);
        }

        // ==================== ROLE & PERMISSION ====================
        $this->call(RolePermissionSeeder::class);

        $this->command->info('✅ Database seeding completed!');
        $this->command->info('📝 Login email: admin@sekolah.sch.id');
        $this->command->info('🔑 Password: admin123');
    }
}
