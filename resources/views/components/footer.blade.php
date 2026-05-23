<!-- resources/views/components/footer.blade.php -->
@php
    use App\Models\PengaturanWebsite;
    use App\Models\ProfilSekolah;

    $settings = $settings ?? PengaturanWebsite::first();
    $profil = $profil ?? ProfilSekolah::first();
@endphp

<footer class="bg-gray-900 text-white">
    <!-- Main Footer -->
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- About -->
            <div>
                <div class="flex items-center gap-3 mb-4">
                    @if(isset($settings) && $settings && $settings->logo_small)
                        <img src="{{ asset('storage/' . $settings->logo_small) }}" alt="Logo" class="h-10 w-auto">
                    @else
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background-color: var(--primary, #4361ee)">
                            <span class="text-white font-bold">S</span>
                        </div>
                    @endif
                    <span class="font-bold text-lg">{{ isset($settings) && $settings ? $settings->nama_website : 'Website Sekolah' }}</span>
                </div>
                <p class="text-gray-400 text-sm mb-4 leading-relaxed">
                    {{ isset($profil) && $profil && $profil->deskripsi_singkat ?? 'Menciptakan generasi unggul, berprestasi, dan berakhlak mulia menuju masa depan yang cerah.' }}
                </p>
                <div class="flex gap-3">
                    <a href="#" class="w-9 h-9 bg-gray-800 rounded-full flex items-center justify-center hover:bg-primary transition group">
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95z"/>
                        </svg>
                    </a>
                    <a href="#" class="w-9 h-9 bg-gray-800 rounded-full flex items-center justify-center hover:bg-primary transition group">
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 0021.968-12.374 8.983 8.983 0 01-2.065-2.142z"/>
                        </svg>
                    </a>
                    <a href="#" class="w-9 h-9 bg-gray-800 rounded-full flex items-center justify-center hover:bg-primary transition group">
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.48 10.92v3.28h7.84c-.24 1.84-.853 3.187-1.787 4.133-1.147 1.147-2.933 2.4-6.053 2.4-4.827 0-8.6-3.893-8.6-8.72s3.773-8.72 8.6-8.72c2.6 0 4.507 1.027 5.907 2.347l2.307-2.307C18.747 1.44 16.133 0 12.48 0 5.867 0 .307 5.387.307 12s5.56 12 12.173 12c3.573 0 6.267-1.173 8.373-3.36 2.16-2.16 2.84-5.213 2.84-7.667 0-.76-.053-1.467-.173-2.053H12.48z"/>
                        </svg>
                    </a>
                    <a href="#" class="w-9 h-9 bg-gray-800 rounded-full flex items-center justify-center hover:bg-primary transition group">
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.5 0C5.6 0 0 5.6 0 12.5c0 5.5 3.6 10.2 8.6 11.8.6.1.9-.3.9-.6v-2.1c-3.5.8-4.3-1.7-4.3-1.7-.6-1.5-1.4-1.9-1.4-1.9-1.1-.8.1-.8.1-.8 1.3.1 1.9 1.3 1.9 1.3 1.1 1.9 2.9 1.4 3.6 1 .1-.8.4-1.4.8-1.7-2.8-.3-5.7-1.4-5.7-6.2 0-1.4.5-2.5 1.3-3.4-.1-.3-.6-1.6.1-3.3 0 0 1.1-.3 3.5 1.3 1-.3 2.1-.4 3.2-.4 1.1 0 2.1.1 3.2.4 2.4-1.6 3.5-1.3 3.5-1.3.7 1.7.2 3 .1 3.3.8.9 1.3 2 1.3 3.4 0 4.8-2.9 5.9-5.7 6.2.5.4.9 1.1.9 2.2v3.3c0 .3.3.7.9.6 5-1.6 8.6-6.3 8.6-11.8C24 5.6 18.4 0 12.5 0z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="font-semibold text-lg mb-4">Tautan Cepat</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition flex items-center gap-2">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 5l7 7-7 7"></path>
                        </svg>
                        Beranda
                    </a></li>
                    <li><a href="{{ route('profil') }}" class="text-gray-400 hover:text-white transition flex items-center gap-2">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 5l7 7-7 7"></path>
                        </svg>
                        Profil Sekolah
                    </a></li>
                    <li><a href="{{ route('berita') }}" class="text-gray-400 hover:text-white transition flex items-center gap-2">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 5l7 7-7 7"></path>
                        </svg>
                        Berita & Pengumuman
                    </a></li>
                    <li><a href="{{ route('galeri') }}" class="text-gray-400 hover:text-white transition flex items-center gap-2">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 5l7 7-7 7"></path>
                        </svg>
                        Galeri
                    </a></li>
                    <li><a href="{{ route('ppdb') }}" class="text-gray-400 hover:text-white transition flex items-center gap-2">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 5l7 7-7 7"></path>
                        </svg>
                        PPDB Online
                    </a></li>
                </ul>
            </div>

            <!-- Layanan -->
            <div>
                <h3 class="font-semibold text-lg mb-4">Layanan</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white transition flex items-center gap-2">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 5l7 7-7 7"></path>
                        </svg>
                        E-Learning
                    </a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition flex items-center gap-2">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 5l7 7-7 7"></path>
                        </svg>
                        Perpustakaan Digital
                    </a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition flex items-center gap-2">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 5l7 7-7 7"></path>
                        </svg>
                        Raport Online
                    </a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition flex items-center gap-2">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 5l7 7-7 7"></path>
                        </svg>
                        Kalender Akademik
                    </a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition flex items-center gap-2">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 5l7 7-7 7"></path>
                        </svg>
                        Pengaduan Online
                    </a></li>
                </ul>
            </div>

            <!-- Kontak -->
            <div>
                <h3 class="font-semibold text-lg mb-4">Kontak Kami</h3>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="text-gray-400 text-sm">Jl. Pendidikan No. 123, Kota Contoh</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span class="text-gray-400 text-sm">info@sekolah.sch.id</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span class="text-gray-400 text-sm">(021) 1234567</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-gray-400 text-sm">Senin - Sabtu, 07:00 - 16:00</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Bottom Footer -->
    <div class="border-t border-gray-800">
        <div class="container mx-auto px-4 py-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-gray-400 text-sm">
                    &copy; {{ date('Y') }} {{ isset($settings) && $settings ? $settings->nama_website : 'Website Sekolah' }}.
                    All rights reserved.
                </p>
                <div class="flex gap-4 text-sm">
                    <a href="#" class="text-gray-400 hover:text-white transition">Privacy Policy</a>
                    <span class="text-gray-600">|</span>
                    <a href="#" class="text-gray-400 hover:text-white transition">Terms of Service</a>
                    <span class="text-gray-600">|</span>
                    <a href="#" class="text-gray-400 hover:text-white transition">Cookie Policy</a>
                </div>
            </div>
        </div>
    </div>
</footer>
