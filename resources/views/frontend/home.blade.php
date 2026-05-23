@extends('layouts.app')

@section('content')

<!-- HERO SECTION -->
<section class="relative overflow-hidden bg-white">
    <!-- Soft Background -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] rounded-full blur-3xl" style="background-color: var(--primary-50)"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] rounded-full blur-3xl opacity-30" style="background-color: var(--primary-50)"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full blur-3xl" style="background-color: var(--primary-100)"></div>
    </div>

    <div class="relative container mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-14 lg:gap-20 items-center">
            <!-- LEFT CONTENT -->
            <div data-aos="fade-right" data-aos-duration="800">
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white border shadow-sm mb-6" style="border-color: var(--primary-100)">
                    <span class="w-2 h-2 rounded-full animate-pulse" style="background-color: var(--primary)"></span>
                    <span class="text-sm font-medium" style="color: var(--gray-700)">
                        @if($profil && $profil->akreditasi)
                            Sekolah Terakreditasi {{ $profil->akreditasi }}
                        @else
                            Sekolah Modern & Berprestasi
                        @endif
                    </span>
                </div>

                <!-- Heading -->
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight tracking-tight" style="color: var(--gray-900)">
                    @if($sliders->count() > 0 && $sliders->first()->judul)
                        {{ $sliders->first()->judul }}
                    @else
                        Membangun Generasi Hebat <span style="color: var(--primary)">Untuk Masa Depan</span>
                    @endif
                </h1>

                <!-- Description -->
                <p class="mt-6 text-base md:text-lg leading-relaxed max-w-xl" style="color: var(--gray-600)">
                    @if($sliders->count() > 0 && $sliders->first()->deskripsi)
                        {{ $sliders->first()->deskripsi }}
                    @else
                        Kami menghadirkan lingkungan belajar yang modern, nyaman, dan berkualitas untuk
                        membentuk generasi unggul, berkarakter, dan siap menghadapi tantangan masa depan.
                    @endif
                </p>

                <!-- Buttons -->
                <div class="flex flex-wrap gap-4 mt-10">
                    <a href="{{ route('ppdb') }}" class="group inline-flex items-center gap-2 px-7 py-3.5 rounded-2xl text-white font-semibold transition-all duration-300 hover:-translate-y-1 hover:shadow-lg"
                       style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%)">
                        Daftar Sekarang
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                    <a href="{{ route('profil') }}" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-2xl bg-white border font-semibold transition-all duration-300 hover:-translate-y-1"
                       style="border-color: var(--gray-200); color: var(--gray-700)"
                       onmouseover="this.style.borderColor='var(--primary)'; this.style.color='var(--primary)'"
                       onmouseout="this.style.borderColor='var(--gray-200)'; this.style.color='var(--gray-700)'">
                        Tentang Sekolah
                    </a>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-6 mt-14 pt-8" style="border-top-color: var(--gray-100)">
                    <div class="group cursor-pointer">
                        <h3 class="text-2xl md:text-3xl font-bold transition-colors" style="color: var(--gray-900)"
                            onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--gray-900)'">
                            {{ $profil && $profil->tahun_berdiri ? (date('Y') - $profil->tahun_berdiri) . '+' : '20+' }}
                        </h3>
                        <p class="text-sm mt-1" style="color: var(--gray-500)">Tahun Pengalaman</p>
                    </div>
                    <div class="group cursor-pointer">
                        <h3 class="text-2xl md:text-3xl font-bold transition-colors" style="color: var(--gray-900)"
                            onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--gray-900)'">
                            {{ $statistik->siswa_aktif ?? '500+' }}
                        </h3>
                        <p class="text-sm mt-1" style="color: var(--gray-500)">Siswa Aktif</p>
                    </div>
                    <div class="group cursor-pointer">
                        <h3 class="text-2xl md:text-3xl font-bold transition-colors" style="color: var(--gray-900)"
                            onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--gray-900)'">
                            {{ $statistik->lulusan_berkualitas ?? '100%' }}
                        </h3>
                        <p class="text-sm mt-1" style="color: var(--gray-500)">Lulusan Berkualitas</p>
                    </div>
                </div>
            </div>

            <!-- RIGHT CONTENT -->
            <div class="relative" data-aos="fade-left" data-aos-duration="800">
                <div class="relative rounded-[32px] overflow-hidden shadow-xl transition-all duration-500 hover:shadow-2xl">
                    @if($sliders->count() > 0 && $sliders->first()->gambar)
                        <img src="{{ asset('storage/' . $sliders->first()->gambar) . '?v=' . time() }}"
                             alt="Hero Image" class="w-full h-[500px] lg:h-[620px] object-cover transition-transform duration-700 hover:scale-105">
                    @else
                        <div class="w-full h-[500px] lg:h-[620px] flex items-center justify-center" style="background: linear-gradient(135deg, var(--primary-100) 0%, var(--primary-50) 100%)">
                            <svg class="w-32 h-32" style="color: var(--primary-300)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/10 via-transparent to-transparent pointer-events-none"></div>
                </div>

                <!-- Floating Card -->
                <div class="absolute bottom-6 left-6 right-6 bg-white/95 backdrop-blur-md rounded-2xl border border-white/50 shadow-xl p-5 transition-all duration-300 hover:shadow-2xl">
                    <div class="flex items-center justify-between gap-5">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-white shadow-md"
                                 style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%)">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold" style="color: var(--gray-900)">
                                    @if($profil && $profil->akreditasi) Akreditasi {{ $profil->akreditasi }} @else Akreditasi A @endif
                                </h4>
                                <p class="text-sm" style="color: var(--gray-500)">
                                    @if($profil && $profil->akreditasi) Sekolah Terakreditasi {{ $profil->akreditasi }} @else Sekolah Terakreditasi Unggul @endif
                                </p>
                            </div>
                        </div>
                        <div class="hidden sm:block text-right">
                            <h4 class="text-2xl font-bold" style="color: var(--gray-900)">{{ $prestasiCount ?? '350+' }}</h4>
                            <p class="text-sm" style="color: var(--gray-500)">Prestasi Akademik</p>
                        </div>
                    </div>
                </div>

                <div class="absolute -top-5 -right-5 bg-white rounded-2xl shadow-lg px-5 py-4 border hidden lg:block transition-all duration-300 hover:scale-105 hover:shadow-xl" style="border-color: var(--gray-100)">
                    <h3 class="text-2xl font-bold" style="color: var(--gray-900)">
                        @if($profil && $profil->tahun_berdiri) {{ date('Y') - $profil->tahun_berdiri }}+ @else 20+ @endif
                    </h3>
                    <p class="text-sm" style="color: var(--gray-500)">Tahun Berpengalaman</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Scroll Indicator -->
<div class="relative -mt-16">
    <div class="flex justify-center">
        <div class="flex flex-col items-center gap-2">
            <span class="text-xs tracking-wider" style="color: var(--gray-400)">SCROLL</span>
            <div class="w-5 h-8 border-2 rounded-full flex justify-center" style="border-color: var(--gray-300)">
                <div class="w-1 h-2 rounded-full mt-1 animate-bounce" style="background-color: var(--primary)"></div>
            </div>
        </div>
    </div>
</div>

<!-- ==================== PROFIL SECTION (RINGKASAN) ==================== -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white border shadow-sm mb-6" style="border-color: var(--primary-100)">
                <span class="w-2 h-2 rounded-full" style="background-color: var(--primary)"></span>
                <span class="text-sm font-medium" style="color: var(--primary)">Profil</span>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold mb-4" style="color: var(--gray-900)">
                Tentang <span style="color: var(--primary)">Sekolah Kami</span>
            </h2>
            <div class="w-20 h-1 mx-auto rounded-full" style="background-color: var(--primary)"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div data-aos="fade-right">
                <div class="relative rounded-2xl overflow-hidden shadow-xl">
                    @if($profil && $profil->logo)
                        <img src="{{ asset('storage/' . $profil->logo) }}" alt="Profil" class="w-full object-cover">
                    @else
                        <div class="w-full h-80 flex items-center justify-center" style="background: linear-gradient(135deg, var(--primary-100) 0%, var(--primary-50) 100%)">
                            <svg class="w-32 h-32" style="color: var(--primary-300)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                    @endif
                </div>
            </div>
            <div data-aos="fade-left">
                <h3 class="text-2xl font-bold mb-4" style="color: var(--gray-800)">Tentang Kami</h3>
                <p class="text-gray-600 leading-relaxed mb-6">
                    {{ $profil->sejarah ? strip_tags(Str::limit($profil->sejarah, 300)) : 'Kami adalah lembaga pendidikan yang berdedikasi untuk memberikan pendidikan berkualitas bagi generasi penerus bangsa.' }}
                </p>
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" style="color: var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <span class="text-gray-600 text-sm">Kurikulum Merdeka</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" style="color: var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        <span class="text-gray-600 text-sm">Lingkungan Aman</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" style="color: var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <span class="text-gray-600 text-sm">Sertifikasi Internasional</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" style="color: var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="text-gray-600 text-sm">Guru Profesional</span>
                    </div>
                </div>
                <a href="{{ route('profil') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-semibold text-white transition-all duration-300 hover:shadow-lg" style="background: linear-gradient(135deg, var(--primary), var(--primary-dark))">
                    Profil Lengkap
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ==================== BERITA SECTION ==================== -->
@if($beritaTerbaru->count() > 0)
<section class="py-20" style="background-color: var(--gray-50)">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-12">
            <div data-aos="fade-right">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white border shadow-sm mb-4" style="border-color: var(--primary-100)">
                    <span class="w-2 h-2 rounded-full" style="background-color: var(--primary)"></span>
                    <span class="text-sm font-medium" style="color: var(--primary)">Berita</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold" style="color: var(--gray-900)">
                    Berita <span style="color: var(--primary)">Terbaru</span>
                </h2>
                <div class="w-20 h-1 mt-4 rounded-full" style="background-color: var(--primary)"></div>
            </div>
            <a href="{{ route('berita') }}" class="text-primary hover:underline flex items-center gap-1" data-aos="fade-left">
                Lihat Semua
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($beritaTerbaru as $berita)
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 group" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                @if($berita->gambar_utama)
                    <div class="h-52 overflow-hidden">
                        <img src="{{ asset('storage/' . $berita->gambar_utama) }}" alt="{{ $berita->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    </div>
                @endif
                <div class="p-5">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-xs px-2 py-1 rounded-full" style="background-color: var(--primary-100); color: var(--primary)">
                            {{ ucfirst($berita->jenis) }}
                        </span>
                        <span class="text-xs" style="color: var(--gray-400)">{{ $berita->published_at->format('d M Y') }}</span>
                    </div>
                    <h3 class="font-bold text-lg line-clamp-2" style="color: var(--gray-800)">{{ $berita->judul }}</h3>
                    <p class="text-sm text-gray-600 line-clamp-3 mt-2">{{ strip_tags(Str::limit($berita->konten, 100)) }}</p>
                    <a href="{{ route('berita.show', $berita->slug) }}" class="text-primary font-semibold text-sm inline-flex items-center gap-1 mt-3 hover:gap-2 transition-all">
                        Baca Selengkapnya →
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- ==================== GALERI SECTION ==================== -->
@if($albums->count() > 0 || $videos->count() > 0)
<section class="py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white border shadow-sm mb-6" style="border-color: var(--primary-100)">
                <span class="w-2 h-2 rounded-full" style="background-color: var(--primary)"></span>
                <span class="text-sm font-medium" style="color: var(--primary)">Galeri</span>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold mb-4" style="color: var(--gray-900)">
                Galeri <span style="color: var(--primary)">Kegiatan</span>
            </h2>
            <div class="w-20 h-1 mx-auto rounded-full" style="background-color: var(--primary)"></div>
            <p class="mt-4 text-gray-600 max-w-2xl mx-auto">Dokumentasi kegiatan dan fasilitas sekolah</p>
        </div>

        <!-- Album Foto -->
        @if($albums->count() > 0)
        <div class="mb-12">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold" style="color: var(--gray-800)">📸 Album Foto</h3>
                <a href="{{ route('galeri') }}?type=foto" class="text-primary text-sm hover:underline">Lihat Semua →</a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                @foreach($albums as $album)
                <a href="{{ route('galeri.album', $album->id) }}" class="group">
                    <div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                        @php $cover = $album->foto->first(); @endphp
                        <div class="h-32 overflow-hidden">
                            @if($cover && $cover->foto)
                                <img src="{{ asset('storage/' . $cover->foto) }}" alt="{{ $album->nama_album }}" class="w-full h-full object-cover group-hover:scale-110 transition">
                            @else
                                <div class="w-full h-full flex items-center justify-center" style="background-color: var(--primary-100)">
                                    <svg class="w-8 h-8" style="color: var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-2 text-center">
                            <p class="text-xs font-semibold line-clamp-1">{{ $album->nama_album }}</p>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Video -->
        @if($videos->count() > 0)
        <div>
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold" style="color: var(--gray-800)">🎬 Video Kegiatan</h3>
                <a href="{{ route('galeri') }}?type=video" class="text-primary text-sm hover:underline">Lihat Semua →</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($videos as $video)
                <div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                    <div class="aspect-video bg-black">
                        @if($video->url_youtube)
                            <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $video->embed_url ?? extractYouTubeId($video->url_youtube) }}" frameborder="0" allowfullscreen></iframe>
                        @else
                            <div class="w-full h-full flex items-center justify-center" style="background-color: var(--primary-100)">
                                <svg class="w-12 h-12" style="color: var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-3">
                        <h4 class="font-semibold text-sm line-clamp-1">{{ $video->judul }}</h4>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endif

<!-- ==================== KONTAK SECTION ==================== -->
<section class="py-20" style="background-color: var(--gray-50)">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white border shadow-sm mb-6" style="border-color: var(--primary-100)">
                <span class="w-2 h-2 rounded-full" style="background-color: var(--primary)"></span>
                <span class="text-sm font-medium" style="color: var(--primary)">Kontak</span>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold mb-4" style="color: var(--gray-900)">
                Hubungi <span style="color: var(--primary)">Kami</span>
            </h2>
            <div class="w-20 h-1 mx-auto rounded-full" style="background-color: var(--primary)"></div>
            <p class="mt-4 text-gray-600 max-w-2xl mx-auto">Hubungi kami untuk informasi lebih lanjut</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Info Kontak -->
            <div class="bg-white rounded-2xl p-6 shadow-lg" style="border: 1px solid var(--primary-100)" data-aos="fade-right">
                <div class="space-y-4">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center" style="background-color: var(--primary-100)">
                            <svg class="w-6 h-6" style="color: var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold" style="color: var(--gray-700)">Alamat</p>
                            <p class="text-sm" style="color: var(--gray-600)">{{ $profil->alamat ?? 'Jl. Pendidikan No. 123, Kota Contoh' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center" style="background-color: var(--primary-100)">
                            <svg class="w-6 h-6" style="color: var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold" style="color: var(--gray-700)">Telepon</p>
                            <p class="text-sm" style="color: var(--gray-600)">{{ $profil->telepon ?? '(021) 1234567' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center" style="background-color: var(--primary-100)">
                            <svg class="w-6 h-6" style="color: var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold" style="color: var(--gray-700)">Email</p>
                            <p class="text-sm" style="color: var(--gray-600)">{{ $profil->email ?? 'info@sekolah.sch.id' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Kontak Singkat -->
            <div class="bg-white rounded-2xl p-6 shadow-lg" style="border: 1px solid var(--primary-100)" data-aos="fade-left">
                <h3 class="text-lg font-bold mb-4" style="color: var(--gray-800)">Kirim Pesan</h3>
                <form action="{{ route('kontak.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="nama" placeholder="Nama Lengkap" required
                               class="w-full px-4 py-2 rounded-lg border focus:outline-none focus:border-primary transition"
                               style="border-color: var(--gray-200)">
                    </div>
                    <div class="mb-3">
                        <input type="email" name="email" placeholder="Email" required
                               class="w-full px-4 py-2 rounded-lg border focus:outline-none focus:border-primary transition"
                               style="border-color: var(--gray-200)">
                    </div>
                    <div class="mb-3">
                        <textarea name="pesan" rows="3" placeholder="Pesan" required
                                  class="w-full px-4 py-2 rounded-lg border focus:outline-none focus:border-primary transition resize-none"
                                  style="border-color: var(--gray-200)"></textarea>
                    </div>
                    <button type="submit" class="w-full py-2 rounded-lg text-white font-semibold transition-all duration-300 hover:-translate-y-1"
                            style="background: linear-gradient(135deg, var(--primary), var(--primary-dark))">
                        Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<style>
@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-8px); }
}
.animate-float { animation: float 3s ease-in-out infinite; }
</style>

@endsection
