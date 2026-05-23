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

<nav x-data="{ mobileMenuOpen: false, dropdownOpen: null, searchOpen: false }" class="sticky top-0 z-50 bg-white shadow-md">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 lg:h-20">
            <!-- Logo dan Nama Sekolah -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    @if(isset($settings) && $settings && $settings->logo)
                        <img src="{{ asset('storage/' . $settings->logo) }}" alt="Logo" class="w-auto h-8 sm:h-9 lg:h-11">
                    @else
                        <div class="flex items-center justify-center w-8 h-8 rounded-lg sm:w-9 sm:h-9 lg:w-11 lg:h-11" style="background-color: var(--primary, #4361ee)">
                            <span class="text-sm font-bold text-white sm:text-base lg:text-lg">S</span>
                        </div>
                    @endif
                    <!-- Nama Sekolah - Selalu tampil di semua device -->
                    <div class="flex-col">
                        <span class="text-xs font-bold leading-tight text-gray-800 sm:text-sm lg:text-base">SMP Negeri 01</span>
                        <span class="text-[10px] leading-tight text-gray-500 sm:text-xs lg:text-sm">Namrole</span>
                    </div>
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="items-center hidden space-x-1 lg:flex">
                <a href="{{ route('home') }}" class="px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:text-primary hover:bg-gray-50 {{ request()->routeIs('home') ? 'text-primary' : '' }}">
                    Beranda
                </a>

                <!-- Tentang Sekolah -->
                <div class="relative" @mouseenter="dropdownOpen = 'tentang'" @mouseleave="dropdownOpen = null">
                    <button class="px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:text-primary hover:bg-gray-50">
                        Tentang Sekolah
                    </button>
                    <div x-show="dropdownOpen === 'tentang'" x-transition class="absolute left-0 z-50 w-48 mt-1 bg-white border rounded-md shadow-lg" style="display: none;">
                        <div class="py-1">
                            <a href="{{ route('profil') }}#sejarah" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary">Sejarah</a>
                            <a href="{{ route('profil') }}#visi-misi" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary">Visi & Misi</a>
                            <a href="{{ route('profil') }}#struktur" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary">Struktur Organisasi</a>
                            <a href="{{ route('profil') }}#struktur-perpustakaan" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary">Struktur Perpustakaan</a>
                            <a href="{{ route('profil') }}#guru" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary">Guru & Staf</a>
                            <a href="{{ route('profil') }}#fasilitas" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary">Fasilitas</a>
                            <a href="{{ route('prestasi') }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary">Prestasi</a>
                        </div>
                    </div>
                </div>

                <a href="{{ route('berita') }}" class="px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:text-primary hover:bg-gray-50 {{ request()->routeIs('berita*') ? 'text-primary' : '' }}">
                    Berita
                </a>

                <!-- Galeri -->
                <div class="relative" @mouseenter="dropdownOpen = 'galeri'" @mouseleave="dropdownOpen = null">
                    <button class="px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:text-primary hover:bg-gray-50">
                        Galeri
                    </button>
                    <div x-show="dropdownOpen === 'galeri'" x-transition class="absolute left-0 z-50 w-40 mt-1 bg-white border rounded-md shadow-lg" style="display: none;">
                        <div class="py-1">
                            <a href="{{ route('galeri') }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary">Semua Album</a>
                            <a href="{{ route('galeri') }}?type=foto" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary">Galeri Foto</a>
                            <a href="{{ route('galeri') }}?type=video" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary">Galeri Video</a>
                        </div>
                    </div>
                </div>

                <!-- Akademik -->
                <div class="relative" @mouseenter="dropdownOpen = 'akademik'" @mouseleave="dropdownOpen = null">
                    <button class="px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:text-primary hover:bg-gray-50">
                        Akademik
                    </button>
                    <div x-show="dropdownOpen === 'akademik'" x-transition class="absolute left-0 z-50 w-48 mt-1 bg-white border rounded-md shadow-lg" style="display: none;">
                        <div class="py-1">
                            <a href="{{ route('kalender') }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary">Kalender Akademik</a>
                            @if($jurusanList->count() > 0)
                            <div class="my-1 border-t border-gray-100"></div>
                            @foreach($jurusanList as $jurusan)
                            <a href="{{ route('jurusan.show', $jurusan->id) }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary">
                                {{ $jurusan->nama_jurusan }}
                            </a>
                            @endforeach
                            @endif
                            @if($ekskulList->count() > 0)
                            <div class="my-1 border-t border-gray-100"></div>
                            @foreach($ekskulList as $ekskul)
                            <a href="{{ route('ekskul.show', $ekskul->id) }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary">
                                {{ $ekskul->nama_ekskul }}
                            </a>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Layanan Digital -->
                <div class="relative" @mouseenter="dropdownOpen = 'layanan'" @mouseleave="dropdownOpen = null">
                    <button class="px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:text-primary hover:bg-gray-50">
                        Layanan Digital
                    </button>
                    <div x-show="dropdownOpen === 'layanan'" x-transition class="absolute left-0 z-50 w-48 mt-1 bg-white border rounded-md shadow-lg" style="display: none;">
                        <div class="py-1">
                            <a href="https://cbt.smpnegeri01namrole.sch.id/login" target="_blank" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary">CBT Sekolah</a>
                            <a href="https://asesmen.erlanggaonline.co.id/" target="_blank" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary">Asesmen</a>
                            <a href="https://saranaguru.erlanggaonline.co.id/user/login" target="_blank" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary">Sarana Guru</a>
                            <a href="https://e-library.erlanggaonline.co.id/user/TWpVMk56RT0" target="_blank" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary">E-Library</a>
                        </div>
                    </div>
                </div>

                <!-- Info -->
                <div class="relative" @mouseenter="dropdownOpen = 'info'" @mouseleave="dropdownOpen = null">
                    <button class="px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:text-primary hover:bg-gray-50">
                        Info
                    </button>
                    <div x-show="dropdownOpen === 'info'" x-transition class="absolute left-0 z-50 mt-1 bg-white border rounded-md shadow-lg w-36" style="display: none;">
                        <div class="py-1">
                            <a href="{{ route('kontak') }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary">Kontak Kami</a>
                            <a href="{{ route('alumni') }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary">Alumni</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Section -->
            <div class="flex items-center gap-2 lg:gap-3">
                <!-- Search Button Desktop -->
                <button @click="searchOpen = !searchOpen" class="hidden p-2 text-gray-500 rounded-md lg:block hover:text-primary hover:bg-gray-50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>

                <!-- Login Button -->
                <a href="{{ url('/admin') }}" target="_blank" class="hidden px-3 py-1.5 text-sm font-medium border rounded-md lg:inline-block hover:bg-gray-50" style="border-color: var(--gray-300); color: var(--gray-700)">
                    Login
                </a>

                <!-- PPDB Button -->
                <a href="{{ route('ppdb') }}" class="hidden px-4 py-1.5 text-sm font-medium text-white rounded-full lg:inline-block hover:opacity-90" style="background-color: var(--primary, #4361ee)">
                    Pendaftaran
                </a>

                <!-- Search Button Mobile -->
                <button @click="searchOpen = !searchOpen" class="p-2 text-gray-500 rounded-md lg:hidden hover:text-primary hover:bg-gray-50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 text-gray-600 rounded-md lg:hidden hover:bg-gray-100">
                    <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Search Bar Desktop -->
        <div x-show="searchOpen" x-transition class="hidden pb-4 lg:block" style="display: none;">
            <form action="{{ route('search') }}" method="GET" class="relative">
                <input type="text" name="q" placeholder="Cari berita, prestasi, fasilitas, ekskul..."
                       class="w-full px-5 py-2 pr-12 border rounded-lg focus:outline-none focus:border-primary"
                       style="border-color: var(--gray-200)">
                <button type="submit" class="absolute p-2 text-gray-400 transform -translate-y-1/2 right-2 top-1/2 hover:text-primary">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </form>
        </div>

        <!-- Search Bar Mobile -->
        <div x-show="searchOpen" x-transition class="pb-3 lg:hidden" style="display: none;">
            <form action="{{ route('search') }}" method="GET" class="relative">
                <input type="text" name="q" placeholder="Cari..."
                       class="w-full px-3 py-2 pr-8 text-sm border rounded-lg focus:outline-none focus:border-primary"
                       style="border-color: var(--gray-200)">
                <button type="submit" class="absolute p-1 text-gray-400 transform -translate-y-1/2 right-2 top-1/2 hover:text-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </form>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-transition class="py-3 border-t lg:hidden" style="display: none;">
            <div class="flex flex-col space-y-1">
                <a href="{{ route('home') }}" class="px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-50" @click="mobileMenuOpen = false">Beranda</a>

                <div x-data="{ open: false }">
                    <button @click="open = !open" class="flex justify-between w-full px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-50">
                        <span>Tentang Sekolah</span>
                        <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="pl-4 space-y-1">
                        <a href="{{ route('profil') }}#sejarah" class="block px-3 py-1.5 text-sm text-gray-600 rounded-md hover:bg-gray-50" @click="mobileMenuOpen = false">Sejarah</a>
                        <a href="{{ route('profil') }}#visi-misi" class="block px-3 py-1.5 text-sm text-gray-600 rounded-md hover:bg-gray-50" @click="mobileMenuOpen = false">Visi & Misi</a>
                        <a href="{{ route('profil') }}#struktur" class="block px-3 py-1.5 text-sm text-gray-600 rounded-md hover:bg-gray-50" @click="mobileMenuOpen = false">Struktur</a>
                        <a href="{{ route('profil') }}#struktur-perpustakaan" class="block px-3 py-1.5 text-sm text-gray-600 rounded-md hover:bg-gray-50" @click="mobileMenuOpen = false">Struktur Perpustakaan</a>
                        <a href="{{ route('profil') }}#guru" class="block px-3 py-1.5 text-sm text-gray-600 rounded-md hover:bg-gray-50" @click="mobileMenuOpen = false">Guru & Staf</a>
                        <a href="{{ route('profil') }}#fasilitas" class="block px-3 py-1.5 text-sm text-gray-600 rounded-md hover:bg-gray-50" @click="mobileMenuOpen = false">Fasilitas</a>
                        <a href="{{ route('prestasi') }}" class="block px-3 py-1.5 text-sm text-gray-600 rounded-md hover:bg-gray-50" @click="mobileMenuOpen = false">Prestasi</a>
                    </div>
                </div>

                <a href="{{ route('berita') }}" class="px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-50" @click="mobileMenuOpen = false">Berita</a>

                <div x-data="{ open: false }">
                    <button @click="open = !open" class="flex justify-between w-full px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-50">
                        <span>Galeri</span>
                        <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="pl-4 space-y-1">
                        <a href="{{ route('galeri') }}" class="block px-3 py-1.5 text-sm text-gray-600 rounded-md hover:bg-gray-50" @click="mobileMenuOpen = false">Semua Album</a>
                        <a href="{{ route('galeri') }}?type=foto" class="block px-3 py-1.5 text-sm text-gray-600 rounded-md hover:bg-gray-50" @click="mobileMenuOpen = false">Galeri Foto</a>
                        <a href="{{ route('galeri') }}?type=video" class="block px-3 py-1.5 text-sm text-gray-600 rounded-md hover:bg-gray-50" @click="mobileMenuOpen = false">Galeri Video</a>
                    </div>
                </div>

                <div x-data="{ open: false }">
                    <button @click="open = !open" class="flex justify-between w-full px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-50">
                        <span>Akademik</span>
                        <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="pl-4 space-y-1">
                        <a href="{{ route('kalender') }}" class="block px-3 py-1.5 text-sm text-gray-600 rounded-md hover:bg-gray-50" @click="mobileMenuOpen = false">Kalender Akademik</a>
                        @foreach($jurusanList as $jurusan)
                        <a href="{{ route('jurusan.show', $jurusan->id) }}" class="block px-3 py-1.5 text-sm text-gray-600 rounded-md hover:bg-gray-50" @click="mobileMenuOpen = false">
                            {{ $jurusan->nama_jurusan }}
                        </a>
                        @endforeach
                        @foreach($ekskulList as $ekskul)
                        <a href="{{ route('ekskul.show', $ekskul->id) }}" class="block px-3 py-1.5 text-sm text-gray-600 rounded-md hover:bg-gray-50" @click="mobileMenuOpen = false">
                            {{ $ekskul->nama_ekskul }}
                        </a>
                        @endforeach
                    </div>
                </div>

                <div x-data="{ open: false }">
                    <button @click="open = !open" class="flex justify-between w-full px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-50">
                        <span>Layanan Digital</span>
                        <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="pl-4 space-y-1">
                        <a href="https://cbt.smpnegeri01namrole.sch.id/login" target="_blank" class="block px-3 py-1.5 text-sm text-gray-600 rounded-md hover:bg-gray-50" @click="mobileMenuOpen = false">CBT Sekolah</a>
                        <a href="https://asesmen.erlanggaonline.co.id/" target="_blank" class="block px-3 py-1.5 text-sm text-gray-600 rounded-md hover:bg-gray-50" @click="mobileMenuOpen = false">Asesmen</a>
                        <a href="https://saranaguru.erlanggaonline.co.id/user/login" target="_blank" class="block px-3 py-1.5 text-sm text-gray-600 rounded-md hover:bg-gray-50" @click="mobileMenuOpen = false">Sarana Guru</a>
                        <a href="https://e-library.erlanggaonline.co.id/user/TWpVMk56RT0" target="_blank" class="block px-3 py-1.5 text-sm text-gray-600 rounded-md hover:bg-gray-50" @click="mobileMenuOpen = false">E-Library</a>
                    </div>
                </div>

                <div x-data="{ open: false }">
                    <button @click="open = !open" class="flex justify-between w-full px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-50">
                        <span>Info</span>
                        <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="pl-4 space-y-1">
                        <a href="{{ route('kontak') }}" class="block px-3 py-1.5 text-sm text-gray-600 rounded-md hover:bg-gray-50" @click="mobileMenuOpen = false">Kontak Kami</a>
                        <a href="{{ route('alumni') }}" class="block px-3 py-1.5 text-sm text-gray-600 rounded-md hover:bg-gray-50" @click="mobileMenuOpen = false">Alumni</a>
                    </div>
                </div>

                <a href="{{ url('/admin') }}" target="_blank" class="px-3 py-2 text-sm font-medium text-center text-gray-700 border rounded-md hover:bg-gray-50" style="border-color: var(--gray-300)" @click="mobileMenuOpen = false">
                    Login Admin
                </a>

                <div class="pt-2 mt-1">
                    <a href="{{ route('ppdb') }}" class="block w-full px-4 py-2 text-sm font-medium text-center text-white rounded-md" style="background-color: var(--primary, #4361ee)" @click="mobileMenuOpen = false">
                        Pendaftaran PPDB
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
