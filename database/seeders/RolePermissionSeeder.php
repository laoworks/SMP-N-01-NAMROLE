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
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // ========== BUAT PERMISSIONS ==========
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

            // Ekstrakurikuler
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

            // Album & Galeri
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
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $this->command->info('✅ ' . count($permissions) . ' permissions created.');

        // ========== BUAT ROLE ==========
        // Super Admin
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        $superAdmin->syncPermissions(Permission::all());
        $this->command->info('✅ Super Admin role created with all permissions.');

        // Admin
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $adminPermissions = Permission::whereIn('name', [
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
        ])->get();
        $admin->syncPermissions($adminPermissions);
        $this->command->info('✅ Admin role created.');

        // Verifikator
        $verifikator = Role::firstOrCreate(['name' => 'verifikator', 'guard_name' => 'web']);
        $verifikator->syncPermissions(['view_pendaftar', 'verifikasi_pendaftar']);
        $this->command->info('✅ Verifikator role created.');

        // Guru
        $guru = Role::firstOrCreate(['name' => 'guru', 'guard_name' => 'web']);
        $guru->syncPermissions(['view_berita', 'view_prestasi']);
        $this->command->info('✅ Guru role created.');

        // ========== ASSIGN ROLE KE USER ==========
        $user = User::where('email', 'admin@sekolah.sch.id')->first();

        if ($user) {
            $user->assignRole('super_admin');
            $user->is_active = true;
            $user->save();
            $this->command->info('✅ Super Admin role assigned to ' . $user->email);
        } else {
            $this->command->warn('⚠️ Admin user not found. Run database seeder first.');
        }

        $this->command->info('🎉 Role and Permission seeding completed!');
    }
}
