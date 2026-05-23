<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Buat Permission untuk setiap Resource
        $permissions = [
            // User Management
            'view_user',
            'create_user',
            'edit_user',
            'delete_user',

            // Profil Sekolah
            'view_profil',
            'edit_profil',

            // Guru
            'view_guru',
            'create_guru',
            'edit_guru',
            'delete_guru',

            // Jurusan
            'view_jurusan',
            'create_jurusan',
            'edit_jurusan',
            'delete_jurusan',

            // Berita
            'view_berita',
            'create_berita',
            'edit_berita',
            'delete_berita',

            // Fasilitas
            'view_fasilitas',
            'create_fasilitas',
            'edit_fasilitas',
            'delete_fasilitas',

            // Ekskul
            'view_ekskul',
            'create_ekskul',
            'edit_ekskul',
            'delete_ekskul',

            // Slider
            'view_slider',
            'create_slider',
            'edit_slider',
            'delete_slider',

            // Prestasi
            'view_prestasi',
            'create_prestasi',
            'edit_prestasi',
            'delete_prestasi',

            // Galeri
            'view_album',
            'create_album',
            'edit_album',
            'delete_album',
            'view_foto',
            'create_foto',
            'edit_foto',
            'delete_foto',

            // Video
            'view_video',
            'create_video',
            'edit_video',
            'delete_video',

            // Kalender
            'view_kalender',
            'create_kalender',
            'edit_kalender',
            'delete_kalender',

            // Struktur
            'view_struktur',
            'create_struktur',
            'edit_struktur',
            'delete_struktur',

            // Alumni
            'view_alumni',
            'create_alumni',
            'edit_alumni',
            'delete_alumni',

            // PPDB
            'view_gelombang',
            'create_gelombang',
            'edit_gelombang',
            'delete_gelombang',
            'view_pendaftar',
            'verifikasi_pendaftar',
            'delete_pendaftar',

            // Kontak
            'view_pesan',
            'delete_pesan',

            // Pengaturan
            'view_pengaturan',
            'edit_pengaturan',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Buat Role
        $superAdmin = Role::create(['name' => 'super_admin']);
        $admin = Role::create(['name' => 'admin']);
        $verifikator = Role::create(['name' => 'verifikator']);
        $guru = Role::create(['name' => 'guru']);

        // Assign Permission ke Role
        $superAdmin->givePermissionTo(Permission::all());

        $admin->givePermissionTo([
            'view_berita',
            'create_berita',
            'edit_berita',
            'delete_berita',
            'view_fasilitas',
            'create_fasilitas',
            'edit_fasilitas',
            'delete_fasilitas',
            'view_prestasi',
            'create_prestasi',
            'edit_prestasi',
            'delete_prestasi',
            'view_album',
            'create_album',
            'edit_album',
            'delete_album',
            'view_slider',
            'create_slider',
            'edit_slider',
            'delete_slider',
        ]);

        $verifikator->givePermissionTo(['view_pendaftar', 'verifikasi_pendaftar']);

        $guru->givePermissionTo(['view_berita', 'view_prestasi']);

        // Assign Role ke User yang sudah ada
        $user = User::first();
        if ($user) {
            $user->assignRole('super_admin');
        }
    }
}
