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

    <div class="container relative px-4 py-12 mx-auto sm:px-6 lg:px-8 lg:py-24 md:py-16">
        <div class="grid items-center grid-cols-1 gap-8 lg:grid-cols-2 lg:gap-20 md:gap-12">
            <!-- LEFT CONTENT -->
            <div data-aos="fade-right" data-aos-duration="600" data-aos-delay="0">
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 px-3 py-1.5 mb-4 bg-white border rounded-full shadow-sm md:px-4 md:py-2 md:mb-6" style="border-color: var(--primary-100)">
                    <span class="w-1.5 h-1.5 rounded-full animate-pulse md:w-2 md:h-2" style="background-color: var(--primary)"></span>
                    <span class="text-xs font-medium md:text-sm" style="color: var(--gray-700)">
                        @if(isset($profil) && $profil && $profil->akreditasi)
                            Sekolah Terakreditasi {{ $profil->akreditasi }}
                        @else
                            Sekolah Modern & Berprestasi
                        @endif
                    </span>
                </div>

                <!-- Heading -->
                <h1 class="text-2xl font-bold leading-tight tracking-tight sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl" style="color: var(--gray-900)">
                    @if($sliders->count() > 0 && $sliders->first()->judul)
                        {{ $sliders->first()->judul }}
                    @else
                        Membangun Generasi Hebat <span style="color: var(--primary)">Untuk Masa Depan</span>
                    @endif
                </h1>

                <!-- Description -->
                <p class="max-w-xl mt-4 text-sm leading-relaxed md:text-base lg:text-lg" style="color: var(--gray-600)">
                    @if($sliders->count() > 0 && $sliders->first()->deskripsi)
                        {{ $sliders->first()->deskripsi }}
                    @else
                        Kami menghadirkan lingkungan belajar yang modern, nyaman, dan berkualitas untuk
                        membentuk generasi unggul, berkarakter, dan siap menghadapi tantangan masa depan.
                    @endif
                </p>

                <!-- Buttons -->
                <div class="flex flex-wrap gap-3 mt-6 md:gap-4 md:mt-8 lg:mt-10">
                    <a href="{{ route('ppdb') }}" class="group inline-flex items-center gap-1.5 px-5 py-2.5 rounded-xl text-white font-semibold transition-all duration-300 hover:-translate-y-1 hover:shadow-lg text-sm md:text-base md:px-7 md:py-3.5 md:gap-2"
                       style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%)">
                        Daftar Sekarang
                        <svg class="w-3 h-3 transition-transform duration-300 group-hover:translate-x-1 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                    <a href="{{ route('profil') }}" class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-xl bg-white border font-semibold transition-all duration-300 hover:-translate-y-1 text-sm md:text-base md:px-7 md:py-3.5 md:gap-2"
                       style="border-color: var(--gray-200); color: var(--gray-700)"
                       onmouseover="this.style.borderColor='var(--primary)'; this.style.color='var(--primary)'"
                       onmouseout="this.style.borderColor='var(--gray-200)'; this.style.color='var(--gray-700)'">
                        Tentang Sekolah
                    </a>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-3 pt-6 mt-8 sm:gap-4 md:gap-6 md:pt-8 md:mt-12 lg:mt-14" style="border-top-color: var(--gray-100)">
                    <div class="cursor-pointer group">
                        <h3 class="text-lg font-bold transition-colors sm:text-xl md:text-2xl lg:text-3xl" style="color: var(--gray-900)"
                            onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--gray-900)'">
                            {{ (isset($profil) && $profil && $profil->tahun_berdiri) ? (date('Y') - $profil->tahun_berdiri) . '+' : '20+' }}
                        </h3>
                        <p class="text-xs mt-0.5 md:text-sm md:mt-1" style="color: var(--gray-500)">Tahun Pengalaman</p>
                    </div>
                    <div class="cursor-pointer group">
                        <h3 class="text-lg font-bold transition-colors sm:text-xl md:text-2xl lg:text-3xl" style="color: var(--gray-900)"
                            onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--gray-900)'">
                            {{ $statistik->siswa_aktif ?? '500+' }}
                        </h3>
                        <p class="text-xs mt-0.5 md:text-sm md:mt-1" style="color: var(--gray-500)">Siswa Aktif</p>
                    </div>
                    <div class="cursor-pointer group">
                        <h3 class="text-lg font-bold transition-colors sm:text-xl md:text-2xl lg:text-3xl" style="color: var(--gray-900)"
                            onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--gray-900)'">
                            {{ $statistik->lulusan_berkualitas ?? '100%' }}
                        </h3>
                        <p class="text-xs mt-0.5 md:text-sm md:mt-1" style="color: var(--gray-500)">Lulusan Berkualitas</p>
                    </div>
                </div>
            </div>

            <!-- RIGHT CONTENT -->
            <div class="relative" data-aos="fade-left" data-aos-duration="600" data-aos-delay="0">
                <div class="relative rounded-2xl md:rounded-[32px] overflow-hidden shadow-xl transition-all duration-500 hover:shadow-2xl">
                    @if($sliders->count() > 0 && $sliders->first()->gambar)
                        <img src="{{ asset('storage/' . $sliders->first()->gambar) . '?v=' . time() }}"
                             alt="Hero Image" class="w-full h-[300px] sm:h-[400px] md:h-[500px] lg:h-[620px] object-cover transition-transform duration-700 hover:scale-105">
                    @else
                        <div class="w-full h-[300px] sm:h-[400px] md:h-[500px] lg:h-[620px] flex items-center justify-center" style="background: linear-gradient(135deg, var(--primary-100) 0%, var(--primary-50) 100%)">
                            <svg class="w-20 h-20 sm:w-24 sm:h-24 md:w-32 md:h-32" style="color: var(--primary-300)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif
                    <div class="absolute inset-0 pointer-events-none bg-gradient-to-t from-black/10 via-transparent to-transparent"></div>
                </div>

                <!-- Floating Card -->
                <div class="absolute p-3 transition-all duration-300 border shadow-xl bottom-3 left-3 right-3 bg-white/95 backdrop-blur-md rounded-xl border-white/50 hover:shadow-2xl sm:bottom-4 sm:left-4 sm:right-4 sm:p-4 md:bottom-5 md:left-5 md:right-5 md:p-5 lg:bottom-6 lg:left-6 lg:right-6 lg:rounded-2xl">
                    <div class="flex items-center justify-between gap-3 sm:gap-5">
                        <div class="flex items-center gap-2 sm:gap-3 md:gap-4">
                            <div class="flex items-center justify-center w-10 h-10 text-white shadow-md rounded-xl sm:w-12 sm:h-12 sm:rounded-2xl md:w-14 md:h-14"
                                 style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%)">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold sm:text-base md:text-lg" style="color: var(--gray-900)">
                                    @if(isset($profil) && $profil && $profil->akreditasi) Akreditasi {{ $profil->akreditasi }} @else Akreditasi A @endif
                                </h4>
                                <p class="text-xs sm:text-sm" style="color: var(--gray-500)">
                                    @if(isset($profil) && $profil && $profil->akreditasi) Sekolah Terakreditasi {{ $profil->akreditasi }} @else Sekolah Terakreditasi Unggul @endif
                                </p>
                            </div>
                        </div>
                        <div class="hidden text-right sm:block">
                            <h4 class="text-lg font-bold sm:text-xl md:text-2xl" style="color: var(--gray-900)">{{ $prestasiCount ?? '350+' }}</h4>
                            <p class="text-xs sm:text-sm" style="color: var(--gray-500)">Prestasi Akademik</p>
                        </div>
                    </div>
                </div>

                <div class="absolute hidden px-3 py-2 transition-all duration-300 bg-white border shadow-lg -top-3 -right-3 rounded-xl lg:block hover:scale-105 hover:shadow-xl sm:-top-4 sm:-right-4 sm:px-4 sm:py-3 sm:rounded-2xl md:-top-5 md:-right-5 md:px-5 md:py-4" style="border-color: var(--gray-100)">
                    <h3 class="text-lg font-bold sm:text-xl md:text-2xl" style="color: var(--gray-900)">
                        @if(isset($profil) && $profil && $profil->tahun_berdiri) {{ date('Y') - $profil->tahun_berdiri }}+ @else 20+ @endif
                    </h3>
                    <p class="text-xs sm:text-sm" style="color: var(--gray-500)">Tahun Berpengalaman</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Scroll Indicator - Responsive -->
<div class="relative -mt-10 md:-mt-12 lg:-mt-16">
    <div class="flex justify-center">
        <div class="flex flex-col items-center gap-1 md:gap-2">
            <span class="text-[10px] tracking-wider md:text-xs" style="color: var(--gray-400)">SCROLL</span>
            <div class="flex justify-center w-4 h-6 border-2 rounded-full md:w-5 md:h-8" style="border-color: var(--gray-300)">
                <div class="w-0.5 h-1.5 mt-1 rounded-full animate-bounce md:w-1 md:h-2" style="background-color: var(--primary)"></div>
            </div>
        </div>
    </div>
</div>

<!-- ==================== SAMBUTAN KEPALA SEKOLAH ==================== -->
@if(isset($sambutan) || isset($fotoKepalaSekolah))
<section class="py-12 md:py-16 lg:py-20" style="background: linear-gradient(135deg, var(--primary-50) 0%, white 100%)">
    <div class="container px-4 mx-auto sm:px-6 lg:px-8">
        <div class="mb-8 text-center md:mb-12" data-aos="fade-up" data-aos-duration="600" data-aos-delay="0">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 mb-4 bg-white border rounded-full shadow-sm md:px-4 md:py-2 md:mb-6" style="border-color: var(--primary-100)">
                <span class="w-1.5 h-1.5 rounded-full md:w-2 md:h-2" style="background-color: var(--primary)"></span>
                <span class="text-xs font-medium md:text-sm" style="color: var(--primary)">Sambutan</span>
            </div>
            <h2 class="text-2xl font-bold md:text-3xl lg:text-4xl" style="color: var(--gray-900)">
                Sambutan <span style="color: var(--primary)">Kepala Sekolah</span>
            </h2>
            <div class="w-16 h-0.5 mx-auto mt-2 rounded-full md:w-20 md:h-1 md:mt-4" style="background-color: var(--primary)"></div>
        </div>

        <div class="grid items-center grid-cols-1 gap-8 lg:grid-cols-2 md:gap-12 lg:gap-12">
            <!-- Foto Kepala Sekolah -->
            <div class="relative order-2 lg:order-1" data-aos="fade-right" data-aos-duration="600" data-aos-delay="0">
                <div class="relative max-w-xs mx-auto md:max-w-sm">
                    <div class="relative overflow-hidden shadow-xl rounded-xl md:rounded-2xl">
                        @if(isset($fotoKepalaSekolah) && $fotoKepalaSekolah && file_exists(public_path('storage/' . $fotoKepalaSekolah)))
                            <img src="{{ asset('storage/' . $fotoKepalaSekolah) . '?v=' . time() }}"
                                 alt="Kepala Sekolah"
                                 class="object-cover w-full h-auto">
                        @else
                            <div class="flex items-center justify-center w-full h-64 md:h-80" style="background: linear-gradient(135deg, var(--primary-100) 0%, var(--primary-50) 100%)">
                                <div class="text-center">
                                    <div class="flex items-center justify-center w-20 h-20 mx-auto mb-3 rounded-full bg-white/30 md:w-24 md:h-24">
                                        <svg class="w-10 h-10 text-primary md:w-12 md:h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <p class="font-semibold text-primary">Kepala Sekolah</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sambutan Content -->
            <div class="order-1 lg:order-2" data-aos="fade-left" data-aos-duration="600" data-aos-delay="0">
                <div class="relative">
                    <svg class="absolute w-8 h-8 -top-4 -left-4 text-primary/20 md:w-10 md:h-10 md:-top-5 md:-left-5 lg:w-12 lg:h-12 lg:-top-6 lg:-left-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                    </svg>

                    <div class="p-5 bg-white shadow-lg rounded-xl md:p-6 lg:p-8 md:rounded-2xl" style="border: 1px solid var(--primary-100)">
                        <div class="prose-sm prose max-w-none md:prose lg:prose-lg" style="color: var(--gray-700)">
                            @if(isset($sambutan) && $sambutan)
                                {!! $sambutan !!}
                            @else
                                <p class="mb-3 text-sm leading-relaxed md:text-base md:mb-4 lg:text-lg">
                                    Assalamu'alaikum Warahmatullahi Wabarakatuh.
                                </p>
                                <p class="mb-3 text-sm leading-relaxed md:text-base md:mb-4 lg:text-lg">
                                    Puji syukur kehadirat Allah SWT, atas rahmat dan karunia-Nya website resmi
                                    <span class="font-semibold" style="color: var(--primary)">{{ $settings->nama_website ?? 'Sekolah Kami' }}</span>
                                    dapat hadir di tengah masyarakat.
                                </p>
                                <p class="mb-3 text-sm leading-relaxed md:text-base md:mb-4 lg:text-lg">
                                    Website ini kami hadirkan sebagai jembatan informasi antara sekolah dengan
                                    orang tua siswa, alumni, dan masyarakat luas.
                                </p>
                                <p class="text-sm leading-relaxed md:text-base lg:text-lg">
                                    Wassalamu'alaikum Warahmatullahi Wabarakatuh.
                                </p>
                            @endif
                        </div>

                        <div class="pt-3 mt-4 border-t md:pt-4 md:mt-5 lg:pt-4 lg:mt-6" style="border-color: var(--primary-100)">
                            <p class="text-sm font-bold text-gray-800 md:text-base lg:text-lg">{{ $namaKepalaSekolah ?? 'Kepala Sekolah' }}</p>
                            <p class="text-xs md:text-sm" style="color: var(--primary)">Kepala Sekolah</p>
                        </div>
                    </div>

                    <svg class="absolute w-8 h-8 -bottom-4 -right-4 text-primary/20 md:w-10 md:h-10 md:-bottom-5 md:-right-5 lg:w-12 lg:h-12 lg:-bottom-6 lg:-right-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- ==================== PROFIL SECTION (RINGKASAN) ==================== -->
<section class="py-12 bg-white md:py-16 lg:py-20">
    <div class="container px-4 mx-auto sm:px-6 lg:px-8">
        <div class="mb-8 text-center md:mb-12" data-aos="fade-up" data-aos-duration="600" data-aos-delay="0">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 mb-4 bg-white border rounded-full shadow-sm md:px-4 md:py-2 md:mb-6" style="border-color: var(--primary-100)">
                <span class="w-1.5 h-1.5 rounded-full md:w-2 md:h-2" style="background-color: var(--primary)"></span>
                <span class="text-xs font-medium md:text-sm" style="color: var(--primary)">Profil</span>
            </div>
            <h2 class="text-2xl font-bold md:text-3xl lg:text-4xl" style="color: var(--gray-900)">
                Tentang <span style="color: var(--primary)">Sekolah Kami</span>
            </h2>
            <div class="w-16 h-0.5 mx-auto mt-2 rounded-full md:w-20 md:h-1 md:mt-4" style="background-color: var(--primary)"></div>
        </div>

        <div class="grid items-center grid-cols-1 gap-8 lg:grid-cols-2 md:gap-12 lg:gap-16">
            <div data-aos="fade-right" data-aos-duration="600" data-aos-delay="0">
                <div class="relative overflow-hidden shadow-lg rounded-xl md:rounded-2xl">
                    @if(isset($profil) && $profil && $profil->logo)
                        <img src="{{ asset('storage/' . $profil->logo) }}" alt="Profil" class="object-cover w-full">
                    @else
                        <div class="flex items-center justify-center w-full h-56 md:h-64 lg:h-80" style="background: linear-gradient(135deg, var(--primary-100) 0%, var(--primary-50) 100%)">
                            <svg class="w-20 h-20 md:w-24 md:h-24 lg:w-32 lg:h-32" style="color: var(--primary-300)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                    @endif
                </div>
            </div>
            <div data-aos="fade-left" data-aos-duration="600" data-aos-delay="0">
                <h3 class="mb-3 text-xl font-bold md:text-2xl lg:text-3xl" style="color: var(--gray-800)">Tentang Kami</h3>
                <p class="mb-4 text-sm leading-relaxed text-gray-600 md:text-base lg:text-lg">
                    {{ (isset($profil) && $profil && $profil->sejarah) ? strip_tags(Str::limit($profil->sejarah, 300)) : 'Kami adalah lembaga pendidikan yang berdedikasi untuk memberikan pendidikan berkualitas bagi generasi penerus bangsa.' }}
                </p>
                <div class="grid grid-cols-2 gap-2 mb-4 md:gap-4 md:mb-6">
                    <div class="flex items-center gap-1.5 md:gap-2">
                        <svg class="w-4 h-4 md:w-5 md:h-5" style="color: var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <span class="text-xs text-gray-600 md:text-sm">Kurikulum Merdeka</span>
                    </div>
                    <div class="flex items-center gap-1.5 md:gap-2">
                        <svg class="w-4 h-4 md:w-5 md:h-5" style="color: var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        <span class="text-xs text-gray-600 md:text-sm">Lingkungan Aman</span>
                    </div>
                    <div class="flex items-center gap-1.5 md:gap-2">
                        <svg class="w-4 h-4 md:w-5 md:h-5" style="color: var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <span class="text-xs text-gray-600 md:text-sm">Sertifikasi Internasional</span>
                    </div>
                    <div class="flex items-center gap-1.5 md:gap-2">
                        <svg class="w-4 h-4 md:w-5 md:h-5" style="color: var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="text-xs text-gray-600 md:text-sm">Guru Profesional</span>
                    </div>
                </div>
                <a href="{{ route('profil') }}" class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold text-white transition-all duration-300 rounded-lg hover:shadow-lg md:px-5 md:py-2.5 md:text-base lg:px-6 lg:py-3" style="background: linear-gradient(135deg, var(--primary), var(--primary-dark))">
                    Profil Lengkap
                    <svg class="w-3 h-3 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ==================== BERITA SECTION ==================== -->
@if($beritaTerbaru->count() > 0)
<section class="py-12 md:py-16 lg:py-20" style="background-color: var(--gray-50)">
    <div class="container px-4 mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-col items-center justify-between gap-4 mb-8 sm:flex-row md:mb-12">
            <div data-aos="fade-right" data-aos-duration="600" data-aos-delay="0" class="text-center sm:text-left">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 mb-3 bg-white border rounded-full shadow-sm md:px-4 md:py-2 md:mb-4" style="border-color: var(--primary-100)">
                    <span class="w-1.5 h-1.5 rounded-full md:w-2 md:h-2" style="background-color: var(--primary)"></span>
                    <span class="text-xs font-medium md:text-sm" style="color: var(--primary)">Berita</span>
                </div>
                <h2 class="text-2xl font-bold md:text-3xl lg:text-4xl" style="color: var(--gray-900)">
                    Berita <span style="color: var(--primary)">Terbaru</span>
                </h2>
                <div class="w-16 h-0.5 mt-2 rounded-full md:w-20 md:h-1" style="background-color: var(--primary)"></div>
            </div>
            <a href="{{ route('berita') }}" class="flex items-center gap-1 text-sm text-primary hover:underline md:text-base" data-aos="fade-left" data-aos-duration="600" data-aos-delay="0">
                Lihat Semua
                <svg class="w-3 h-3 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 md:gap-8">
            @foreach($beritaTerbaru as $berita)
            <div class="overflow-hidden transition-all duration-300 bg-white shadow-md rounded-xl hover:shadow-xl group" data-aos="fade-up" data-aos-duration="600" data-aos-delay="{{ $loop->iteration * 50 }}">
                @if($berita->gambar_utama)
                    <div class="overflow-hidden h-44 md:h-48 lg:h-52">
                        <img src="{{ asset('storage/' . $berita->gambar_utama) }}" alt="{{ $berita->judul }}" class="object-cover w-full h-full transition duration-500 group-hover:scale-110">
                    </div>
                @endif
                <div class="p-4 md:p-5">
                    <div class="flex items-center gap-2 mb-2 md:mb-3">
                        <span class="px-2 py-0.5 text-xs rounded-full md:px-2 md:py-1" style="background-color: var(--primary-100); color: var(--primary)">
                            {{ ucfirst($berita->jenis) }}
                        </span>
                        <span class="text-xs" style="color: var(--gray-400)">{{ $berita->published_at->format('d M Y') }}</span>
                    </div>
                    <h3 class="text-base font-bold line-clamp-2 md:text-lg" style="color: var(--gray-800)">{{ $berita->judul }}</h3>
                    <p class="mt-2 text-xs text-gray-600 line-clamp-3 md:text-sm">{{ strip_tags(Str::limit($berita->konten, 100)) }}</p>
                    <a href="{{ route('berita.show', $berita->slug) }}" class="inline-flex items-center gap-1 mt-3 text-xs font-semibold transition-all md:text-sm text-primary hover:gap-2">
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
<section class="py-12 bg-white md:py-16 lg:py-20">
    <div class="container px-4 mx-auto sm:px-6 lg:px-8">
        <div class="mb-8 text-center md:mb-12" data-aos="fade-up" data-aos-duration="600" data-aos-delay="0">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 mb-4 bg-white border rounded-full shadow-sm md:px-4 md:py-2 md:mb-6" style="border-color: var(--primary-100)">
                <span class="w-1.5 h-1.5 rounded-full md:w-2 md:h-2" style="background-color: var(--primary)"></span>
                <span class="text-xs font-medium md:text-sm" style="color: var(--primary)">Galeri</span>
            </div>
            <h2 class="text-2xl font-bold md:text-3xl lg:text-4xl" style="color: var(--gray-900)">
                Galeri <span style="color: var(--primary)">Kegiatan</span>
            </h2>
            <div class="w-16 h-0.5 mx-auto mt-2 rounded-full md:w-20 md:h-1 md:mt-4" style="background-color: var(--primary)"></div>
            <p class="max-w-2xl mx-auto mt-3 text-sm text-gray-600 md:text-base">Dokumentasi kegiatan dan fasilitas sekolah</p>
        </div>

        <!-- Album Foto -->
        @if($albums->count() > 0)
        <div class="mb-8 md:mb-12">
            <div class="flex flex-wrap items-center justify-between gap-3 mb-4 md:mb-6">
                <h3 class="text-base font-bold md:text-xl" style="color: var(--gray-800)">📸 Album Foto</h3>
                <a href="{{ route('galeri') }}?type=foto" class="text-xs text-primary hover:underline md:text-sm">Lihat Semua →</a>
            </div>
            <div class="grid grid-cols-2 gap-3 md:grid-cols-3 lg:grid-cols-6 md:gap-4">
                @foreach($albums as $album)
                <a href="{{ route('galeri.album', $album->id) }}" class="group">
                    <div class="overflow-hidden transition bg-white shadow-md rounded-xl hover:shadow-xl">
                        @php $cover = $album->foto->first(); @endphp
                        <div class="h-24 overflow-hidden md:h-28 lg:h-32">
                            @if($cover && $cover->foto)
                                <img src="{{ asset('storage/' . $cover->foto) }}" alt="{{ $album->nama_album }}" class="object-cover w-full h-full transition group-hover:scale-110">
                            @else
                                <div class="flex items-center justify-center w-full h-full" style="background-color: var(--primary-100)">
                                    <svg class="w-6 h-6 md:w-8 md:h-8" style="color: var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-1 text-center md:p-2">
                            <p class="text-[10px] font-semibold line-clamp-1 md:text-xs">{{ $album->nama_album }}</p>
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
            <div class="flex flex-wrap items-center justify-between gap-3 mb-4 md:mb-6">
                <h3 class="text-base font-bold md:text-xl" style="color: var(--gray-800)">🎬 Video Kegiatan</h3>
                <a href="{{ route('galeri') }}?type=video" class="text-xs text-primary hover:underline md:text-sm">Lihat Semua →</a>
            </div>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 md:gap-6">
                @foreach($videos as $video)
                <div class="overflow-hidden transition bg-white shadow-md rounded-xl hover:shadow-xl">
                    <div class="bg-black aspect-video">
                        @if($video->url_youtube)
                            @php
                                preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([\w-]+)/', $video->url_youtube, $matches);
                                $youtubeId = $matches[1] ?? '';
                            @endphp
                            <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $youtubeId }}" frameborder="0" allowfullscreen></iframe>
                        @else
                            <div class="flex items-center justify-center w-full h-full" style="background-color: var(--primary-100)">
                                <svg class="w-10 h-10 md:w-12 md:h-12" style="color: var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-2 md:p-3">
                        <h4 class="text-xs font-semibold line-clamp-1 md:text-sm">{{ $video->judul }}</h4>
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
<section class="py-12 md:py-16 lg:py-20" style="background-color: var(--gray-50)">
    <div class="container px-4 mx-auto sm:px-6 lg:px-8">
        <div class="mb-8 text-center md:mb-12" data-aos="fade-up" data-aos-duration="600" data-aos-delay="0">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 mb-4 bg-white border rounded-full shadow-sm md:px-4 md:py-2 md:mb-6" style="border-color: var(--primary-100)">
                <span class="w-1.5 h-1.5 rounded-full md:w-2 md:h-2" style="background-color: var(--primary)"></span>
                <span class="text-xs font-medium md:text-sm" style="color: var(--primary)">Kontak</span>
            </div>
            <h2 class="text-2xl font-bold md:text-3xl lg:text-4xl" style="color: var(--gray-900)">
                Hubungi <span style="color: var(--primary)">Kami</span>
            </h2>
            <div class="w-16 h-0.5 mx-auto mt-2 rounded-full md:w-20 md:h-1 md:mt-4" style="background-color: var(--primary)"></div>
            <p class="max-w-2xl mx-auto mt-3 text-sm text-gray-600 md:text-base">Hubungi kami untuk informasi lebih lanjut</p>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 md:gap-8">
            <!-- Info Kontak -->
            <div class="p-5 bg-white shadow-lg rounded-xl md:p-6 md:rounded-2xl" style="border: 1px solid var(--primary-100)" data-aos="fade-right" data-aos-duration="600" data-aos-delay="0">
                <div class="space-y-3 md:space-y-4">
                    <div class="flex items-center gap-3 md:gap-4">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full md:w-12 md:h-12" style="background-color: var(--primary-100)">
                            <svg class="w-5 h-5 md:w-6 md:h-6" style="color: var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold md:text-sm" style="color: var(--gray-700)">Alamat</p>
                            <p class="text-xs md:text-sm" style="color: var(--gray-600)">{{ (isset($profil) && $profil && $profil->alamat) ? $profil->alamat : 'Jl. Pendidikan No. 123, Kota Contoh' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 md:gap-4">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full md:w-12 md:h-12" style="background-color: var(--primary-100)">
                            <svg class="w-5 h-5 md:w-6 md:h-6" style="color: var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold md:text-sm" style="color: var(--gray-700)">Telepon</p>
                            <p class="text-xs md:text-sm" style="color: var(--gray-600)">{{ (isset($profil) && $profil && $profil->telepon) ? $profil->telepon : '(021) 1234567' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 md:gap-4">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full md:w-12 md:h-12" style="background-color: var(--primary-100)">
                            <svg class="w-5 h-5 md:w-6 md:h-6" style="color: var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold md:text-sm" style="color: var(--gray-700)">Email</p>
                            <p class="text-xs md:text-sm" style="color: var(--gray-600)">{{ (isset($profil) && $profil && $profil->email) ? $profil->email : 'info@sekolah.sch.id' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Kontak Singkat -->
            <div class="p-5 bg-white shadow-lg rounded-xl md:p-6 md:rounded-2xl" style="border: 1px solid var(--primary-100)" data-aos="fade-left" data-aos-duration="600" data-aos-delay="0">
                <h3 class="mb-3 text-base font-bold md:text-lg md:mb-4" style="color: var(--gray-800)">Kirim Pesan</h3>
                <form action="{{ route('kontak.store') }}" method="POST">
                    @csrf
                    <div class="mb-2 md:mb-3">
                        <input type="text" name="nama" placeholder="Nama Lengkap" required
                               class="w-full px-3 py-2 text-sm transition border rounded-lg md:px-4 md:py-2 focus:outline-none focus:border-primary"
                               style="border-color: var(--gray-200)">
                    </div>
                    <div class="mb-2 md:mb-3">
                        <input type="email" name="email" placeholder="Email" required
                               class="w-full px-3 py-2 text-sm transition border rounded-lg md:px-4 md:py-2 focus:outline-none focus:border-primary"
                               style="border-color: var(--gray-200)">
                    </div>
                    <div class="mb-3 md:mb-4">
                        <textarea name="pesan" rows="3" placeholder="Pesan" required
                                  class="w-full px-3 py-2 text-sm transition border rounded-lg resize-none focus:outline-none focus:border-primary md:px-4 md:py-2"
                                  style="border-color: var(--gray-200)"></textarea>
                    </div>
                    <button type="submit" class="w-full py-2 text-sm font-semibold text-white transition-all duration-300 rounded-lg hover:-translate-y-1 md:text-base md:py-2.5"
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
    50% { transform: translateY(-6px); }
}
@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(4px); }
}
.animate-float { animation: float 3s ease-in-out infinite; }
.animate-bounce { animation: bounce 1.5s ease-in-out infinite; }

/* Smooth scroll untuk semua device */
html {
    scroll-behavior: smooth;
}

/* Mobile touch optimasi */
* {
    -webkit-tap-highlight-color: transparent;
}

/* Responsive font adjustment */
@media (max-width: 640px) {
    .prose {
        font-size: 0.875rem;
    }
}

/* Hover effect yang lebih halus */
.transition-all {
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}

/* Optimasi AOS untuk performa */
[data-aos] {
    pointer-events: none;
}
[data-aos].aos-animate {
    pointer-events: auto;
}
</style>

@endsection
