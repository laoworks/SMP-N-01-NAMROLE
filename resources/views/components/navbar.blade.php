<!-- resources/views/components/navbar.blade.php -->
@php
    use App\Models\Jurusan;
    use App\Models\Ekstrakurikuler;
    use App\Models\PengaturanWebsite;
    use App\Models\ProfilSekolah;

    $settings = $settings ?? PengaturanWebsite::first();
    $profil = $profil ?? ProfilSekolah::first();
    $jurusanList = Jurusan::where('is_active', true)->get();
    $ekskulList = Ekstrakurikuler::where('is_active', true)->limit(8)->get();
@endphp

<nav x-data="{ mobileMenuOpen: false, dropdownOpen: null }" class="bg-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo Area -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    @if(isset($settings) && $settings && $settings->logo)
                        <img src="{{ asset('storage/' . $settings->logo) }}" alt="Logo" class="h-9 w-auto">
                    @else
                        <div class="w-9 h-9 rounded-lg flex items-center justify-center" style="background-color: var(--primary, #4361ee)">
                            <span class="text-white font-bold text-base">S</span>
                        </div>
                    @endif
                    <span class="font-semibold text-gray-800 text-base hidden sm:block">
                        {{ Str::limit(isset($settings) && $settings ? $settings->nama_website : 'Website Sekolah', 20) }}
                    </span>
                </a>
            </div>

            <!-- Desktop Navigation - Center -->
            <div class="hidden md:flex items-center space-x-1">
                <a href="{{ route('home') }}" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('home') ? 'text-primary bg-primary/10' : 'text-gray-700 hover:text-primary hover:bg-gray-50' }} transition">
                    Beranda
                </a>

                <!-- Profil Dropdown -->
                <div class="relative"
                     @mouseenter="dropdownOpen = 'profil'"
                     @mouseleave="dropdownOpen = null">
                    <button class="px-3 py-2 rounded-md text-sm font-medium inline-flex items-center gap-1 {{ request()->routeIs('profil*') ? 'text-primary bg-primary/10' : 'text-gray-700 hover:text-primary hover:bg-gray-50' }} transition">
                        Profil
                        <svg class="w-3 h-3" :class="{'rotate-180': dropdownOpen === 'profil'}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="dropdownOpen === 'profil'"
                         x-transition
                         class="absolute left-0 mt-1 w-48 bg-white rounded-md shadow-lg border border-gray-100 z-50"
                         style="display: none;">
                        <div class="py-1">
                            <a href="{{ route('profil') }}#sejarah" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary">Sejarah</a>
                            <a href="{{ route('profil') }}#visi-misi" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary">Visi & Misi</a>
                            <a href="{{ route('profil') }}#struktur" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary">Struktur Organisasi</a>
                            <a href="{{ route('profil') }}#guru" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary">Guru & Staf</a>
                            <a href="{{ route('profil') }}#fasilitas" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary">Fasilitas</a>
                            <a href="{{ route('profil') }}#prestasi" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary">Prestasi</a>
                        </div>
                    </div>
                </div>

                <a href="{{ route('berita') }}" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('berita*') ? 'text-primary bg-primary/10' : 'text-gray-700 hover:text-primary hover:bg-gray-50' }} transition">
                    Berita
                </a>

                <!-- Galeri Dropdown -->
                <div class="relative"
                     @mouseenter="dropdownOpen = 'galeri'"
                     @mouseleave="dropdownOpen = null">
                    <button class="px-3 py-2 rounded-md text-sm font-medium inline-flex items-center gap-1 {{ request()->routeIs('galeri*') ? 'text-primary bg-primary/10' : 'text-gray-700 hover:text-primary hover:bg-gray-50' }} transition">
                        Galeri
                        <svg class="w-3 h-3" :class="{'rotate-180': dropdownOpen === 'galeri'}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="dropdownOpen === 'galeri'"
                         x-transition
                         class="absolute left-0 mt-1 w-48 bg-white rounded-md shadow-lg border border-gray-100 z-50"
                         style="display: none;">
                        <div class="py-1">
                            <a href="{{ route('galeri') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary">Semua Album</a>
                            <a href="{{ route('galeri') }}?type=foto" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary">Galeri Foto</a>
                            <a href="{{ route('galeri') }}?type=video" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary">Galeri Video</a>
                        </div>
                    </div>
                </div>

                @if($jurusanList->count() > 0)
                <div class="relative"
                     @mouseenter="dropdownOpen = 'jurusan'"
                     @mouseleave="dropdownOpen = null">
                    <button class="px-3 py-2 rounded-md text-sm font-medium inline-flex items-center gap-1 text-gray-700 hover:text-primary hover:bg-gray-50 transition">
                        Jurusan
                        <svg class="w-3 h-3" :class="{'rotate-180': dropdownOpen === 'jurusan'}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="dropdownOpen === 'jurusan'"
                         x-transition
                         class="absolute left-0 mt-1 w-56 bg-white rounded-md shadow-lg border border-gray-100 z-50"
                         style="display: none;">
                        <div class="py-1">
                            @foreach($jurusanList as $jurusan)
                            <a href="{{ route('jurusan.show', $jurusan->id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary">
                                {{ $jurusan->nama_jurusan }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                @if($ekskulList->count() > 0)
                <div class="relative"
                     @mouseenter="dropdownOpen = 'ekskul'"
                     @mouseleave="dropdownOpen = null">
                    <button class="px-3 py-2 rounded-md text-sm font-medium inline-flex items-center gap-1 text-gray-700 hover:text-primary hover:bg-gray-50 transition">
                        Ekskul
                        <svg class="w-3 h-3" :class="{'rotate-180': dropdownOpen === 'ekskul'}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="dropdownOpen === 'ekskul'"
                         x-transition
                         class="absolute left-0 mt-1 w-56 bg-white rounded-md shadow-lg border border-gray-100 z-50"
                         style="display: none;">
                        <div class="py-1">
                            @foreach($ekskulList as $ekskul)
                            <a href="{{ route('ekskul.show', $ekskul->id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary">
                                {{ $ekskul->nama_ekskul }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <a href="{{ route('kontak') }}" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('kontak') ? 'text-primary bg-primary/10' : 'text-gray-700 hover:text-primary hover:bg-gray-50' }} transition">
                    Kontak
                </a>

                <a href="{{ route('alumni') }}" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('alumni') ? 'text-primary bg-primary/10' : 'text-gray-700 hover:text-primary hover:bg-gray-50' }} transition">
                    Alumni
                </a>
            </div>

            <!-- Right Section -->
            <div class="flex items-center gap-3">
                <!-- PPDB Button -->
                <a href="{{ route('ppdb') }}" class="hidden md:inline-flex px-5 py-2 rounded-full text-white text-sm font-semibold transition-all duration-300 hover:shadow-md hover:-translate-y-0.5" style="background: linear-gradient(135deg, var(--primary, #4361ee) 0%, var(--primary-dark, #3050c4) 100%)">
                    Pendaftaran
                </a>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 rounded-md text-gray-600 hover:bg-gray-100 transition">
                    <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen"
             x-transition
             class="md:hidden py-4 border-t border-gray-100"
             style="display: none;">
            <div class="space-y-1">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('home') ? 'text-primary bg-primary/10' : 'text-gray-700 hover:bg-gray-50' }}" @click="mobileMenuOpen = false">
                    Beranda
                </a>

                <div x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex justify-between items-center px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">
                        <span>Profil Sekolah</span>
                        <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="pl-4 space-y-1">
                        <a href="{{ route('profil') }}#sejarah" class="block px-3 py-2 rounded-md text-sm text-gray-600 hover:bg-gray-50" @click="mobileMenuOpen = false">Sejarah</a>
                        <a href="{{ route('profil') }}#visi-misi" class="block px-3 py-2 rounded-md text-sm text-gray-600 hover:bg-gray-50" @click="mobileMenuOpen = false">Visi & Misi</a>
                        <a href="{{ route('profil') }}#struktur" class="block px-3 py-2 rounded-md text-sm text-gray-600 hover:bg-gray-50" @click="mobileMenuOpen = false">Struktur Organisasi</a>
                        <a href="{{ route('profil') }}#guru" class="block px-3 py-2 rounded-md text-sm text-gray-600 hover:bg-gray-50" @click="mobileMenuOpen = false">Guru & Staf</a>
                        <a href="{{ route('profil') }}#fasilitas" class="block px-3 py-2 rounded-md text-sm text-gray-600 hover:bg-gray-50" @click="mobileMenuOpen = false">Fasilitas</a>
                    </div>
                </div>

                <a href="{{ route('berita') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('berita*') ? 'text-primary bg-primary/10' : 'text-gray-700 hover:bg-gray-50' }}" @click="mobileMenuOpen = false">
                    Berita & Pengumuman
                </a>

                <div x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex justify-between items-center px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">
                        <span>Galeri</span>
                        <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="pl-4 space-y-1">
                        <a href="{{ route('galeri') }}" class="block px-3 py-2 rounded-md text-sm text-gray-600 hover:bg-gray-50" @click="mobileMenuOpen = false">Semua Album</a>
                        <a href="{{ route('galeri') }}?type=foto" class="block px-3 py-2 rounded-md text-sm text-gray-600 hover:bg-gray-50" @click="mobileMenuOpen = false">Galeri Foto</a>
                        <a href="{{ route('galeri') }}?type=video" class="block px-3 py-2 rounded-md text-sm text-gray-600 hover:bg-gray-50" @click="mobileMenuOpen = false">Galeri Video</a>
                    </div>
                </div>

                @if($jurusanList->count() > 0)
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex justify-between items-center px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">
                        <span>Jurusan</span>
                        <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="pl-4 space-y-1">
                        @foreach($jurusanList as $jurusan)
                        <a href="{{ route('jurusan.show', $jurusan->id) }}" class="block px-3 py-2 rounded-md text-sm text-gray-600 hover:bg-gray-50" @click="mobileMenuOpen = false">
                            {{ $jurusan->nama_jurusan }}
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                <a href="{{ route('kontak') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('kontak') ? 'text-primary bg-primary/10' : 'text-gray-700 hover:bg-gray-50' }}" @click="mobileMenuOpen = false">
                    Kontak
                </a>

                <a href="{{ route('alumni') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('alumni') ? 'text-primary bg-primary/10' : 'text-gray-700 hover:bg-gray-50' }}" @click="mobileMenuOpen = false">
                    Alumni
                </a>

                <div class="pt-4 mt-2 border-t border-gray-100">
                    <a href="{{ route('ppdb') }}" class="block w-full text-center px-4 py-3 rounded-lg font-semibold text-white" style="background: linear-gradient(135deg, var(--primary, #4361ee) 0%, var(--primary-dark, #3050c4) 100%)" @click="mobileMenuOpen = false">
                        Pendaftaran PPDB Online
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
