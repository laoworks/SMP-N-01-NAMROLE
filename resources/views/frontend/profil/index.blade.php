@extends('layouts.app')

@section('content')

<!-- Page Title Section -->
<section class="relative overflow-hidden bg-white">
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] rounded-full blur-3xl" style="background-color: var(--primary-50)"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] rounded-full blur-3xl opacity-30" style="background-color: var(--primary-50)"></div>
    </div>

    <div class="container relative px-4 py-16 mx-auto text-center sm:px-6 lg:px-8 lg:py-20">
        <h1 class="text-4xl font-bold tracking-tight sm:text-5xl lg:text-6xl" style="color: var(--gray-900)">
            Profil Sekolah
        </h1>
        <div class="w-20 h-1 mx-auto mt-4 rounded-full" style="background-color: var(--primary)"></div>
        <p class="max-w-2xl mx-auto mt-4 text-lg" style="color: var(--gray-600)">
            Mengenal lebih dekat tentang identitas, visi, misi, dan keunggulan sekolah kami
        </p>
    </div>
</section>

<!-- Sejarah Sekolah -->
<section class="py-16 bg-white lg:py-20" id="sejarah">
    <div class="container px-4 mx-auto sm:px-6 lg:px-8">
        <div class="grid items-center grid-cols-1 gap-12 lg:grid-cols-2 lg:gap-16">
            <div data-aos="fade-right">
                <div class="relative">
                    <div class="overflow-hidden shadow-xl rounded-2xl">
                        @if(isset($profil) && $profil && $profil->gambar_ilustrasi && file_exists(public_path('storage/' . $profil->gambar_ilustrasi)))
                            <img src="{{ asset('storage/' . $profil->gambar_ilustrasi) . '?v=' . filemtime(public_path('storage/' . $profil->gambar_ilustrasi)) }}"
                                 alt="Sejarah Sekolah"
                                 class="w-full h-[400px] object-cover">
                        @elseif(isset($profil) && $profil && $profil->logo)
                            <img src="{{ asset('storage/' . $profil->logo) }}" alt="Logo Sekolah" class="w-full h-[400px] object-contain p-8">
                        @else
                            <div class="w-full h-[400px] flex items-center justify-center" style="background: linear-gradient(135deg, var(--primary-100) 0%, var(--primary-50) 100%)">
                                <svg class="w-32 h-32" style="color: var(--primary-300)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="absolute hidden p-4 bg-white shadow-lg -bottom-6 -right-6 rounded-xl lg:block">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center justify-center w-12 h-12 rounded-xl" style="background: linear-gradient(135deg, var(--primary), var(--primary-dark))">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-2xl font-bold" style="color: var(--gray-900)">{{ $profil->tahun_berdiri ?? '2000' }}</p>
                                <p class="text-sm" style="color: var(--gray-500)">Tahun Berdiri</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div data-aos="fade-left">
                <div class="inline-flex items-center gap-2 px-4 py-2 mb-6 bg-white border rounded-full shadow-sm" style="border-color: var(--primary-100)">
                    <span class="w-2 h-2 rounded-full" style="background-color: var(--primary)"></span>
                    <span class="text-sm font-medium" style="color: var(--primary)">Sejarah</span>
                </div>
                <h2 class="mb-4 text-3xl font-bold md:text-4xl" style="color: var(--gray-900)">
                    Sejarah <span style="color: var(--primary)">Sekolah</span>
                </h2>
                <div class="prose prose-lg max-w-none" style="color: var(--gray-600)">
                    {!! (isset($profil) && $profil && $profil->sejarah) ? $profil->sejarah : '<p>Kami adalah lembaga pendidikan yang berdedikasi untuk memberikan pendidikan berkualitas bagi generasi penerus bangsa. Dengan tenaga pendidik profesional dan fasilitas lengkap, kami siap mencetak siswa berprestasi.</p>' !!}
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Akreditasi Section -->
<section class="py-16 lg:py-20" style="background: linear-gradient(135deg, var(--primary-50) 0%, white 100%)">
    <div class="container px-4 mx-auto sm:px-6 lg:px-8">
        <div class="mb-12 text-center" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 mb-6 bg-white border rounded-full shadow-sm" style="border-color: var(--primary-100)">
                <span class="w-2 h-2 rounded-full" style="background-color: var(--primary)"></span>
                <span class="text-sm font-medium" style="color: var(--primary)">Akreditasi</span>
            </div>
            <h2 class="mb-4 text-3xl font-bold md:text-4xl" style="color: var(--gray-900)">
                Akreditasi <span style="color: var(--primary)">Sekolah</span>
            </h2>
            <div class="w-20 h-1 mx-auto rounded-full" style="background-color: var(--primary)"></div>
        </div>

        <div class="max-w-4xl mx-auto">
            <div class="overflow-hidden bg-white shadow-xl rounded-3xl">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="p-8 text-center md:p-12 md:text-left">
                        <div class="inline-flex items-center justify-center w-24 h-24 mb-6 rounded-2xl" style="background: linear-gradient(135deg, var(--primary), var(--primary-dark))">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="mb-2 text-5xl font-bold md:text-6xl" style="color: var(--primary)">
                            {{ (isset($profil) && $profil && $profil->akreditasi) ? $profil->akreditasi : 'A' }}
                        </h3>
                        <p class="text-lg font-semibold" style="color: var(--gray-700)">Terakreditasi Unggul</p>
                        <p class="mt-2 text-sm" style="color: var(--gray-500)">Tahun {{ (isset($profil) && $profil && $profil->tahun_akreditasi) ? $profil->tahun_akreditasi : '2024' }}</p>
                    </div>
                    <div class="p-8 md:p-12" style="background-color: var(--gray-50)">
                        <h4 class="mb-3 text-xl font-bold" style="color: var(--gray-800)">Penilaian Akreditasi</h4>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-3">
                                <span class="flex items-center justify-center w-8 h-8 rounded-full" style="background-color: var(--primary-100)">
                                    <svg class="w-4 h-4" style="color: var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span style="color: var(--gray-600)">Standar Isi & Proses</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="flex items-center justify-center w-8 h-8 rounded-full" style="background-color: var(--primary-100)">
                                    <svg class="w-4 h-4" style="color: var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span style="color: var(--gray-600)">Standar Kelulusan</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="flex items-center justify-center w-8 h-8 rounded-full" style="background-color: var(--primary-100)">
                                    <svg class="w-4 h-4" style="color: var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span style="color: var(--gray-600)">Standar Pendidik & Tenaga Kependidikan</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="flex items-center justify-center w-8 h-8 rounded-full" style="background-color: var(--primary-100)">
                                    <svg class="w-4 h-4" style="color: var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span style="color: var(--gray-600)">Standar Sarana & Prasarana</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="flex items-center justify-center w-8 h-8 rounded-full" style="background-color: var(--primary-100)">
                                    <svg class="w-4 h-4" style="color: var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                                <span style="color: var(--gray-600)">Standar Pengelolaan</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Visi & Misi - 3 Gambar -->
<section class="py-16 bg-white lg:py-20" id="visi-misi">
    <div class="container px-4 mx-auto sm:px-6 lg:px-8">
        <div class="mb-12 text-center" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 mb-6 bg-white border rounded-full shadow-sm" style="border-color: var(--primary-100)">
                <span class="w-2 h-2 rounded-full" style="background-color: var(--primary)"></span>
                <span class="text-sm font-medium" style="color: var(--primary)">Visi & Misi</span>
            </div>
            <h2 class="mb-4 text-3xl font-bold md:text-4xl" style="color: var(--gray-900)">
                Visi & <span style="color: var(--primary)">Misi</span>
            </h2>
            <div class="w-20 h-1 mx-auto rounded-full" style="background-color: var(--primary)"></div>
            <p class="max-w-2xl mx-auto mt-4 text-lg" style="color: var(--gray-600)">
                Visi dan misi kami dalam mencetak generasi unggul dan berprestasi
            </p>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <!-- Gambar 1 -->
            <div class="overflow-hidden transition-all duration-300 bg-white shadow-lg rounded-2xl hover:shadow-xl group" data-aos="fade-up" data-aos-delay="100" style="border: 1px solid var(--primary-100)">
                @if(isset($profil) && $profil && $profil->gambar_misi_1 && file_exists(public_path('storage/' . $profil->gambar_misi_1)))
                    <img src="{{ asset('storage/' . $profil->gambar_misi_1) . '?v=' . time() }}"
                         alt="Visi & Misi 1"
                         class="object-cover w-full transition duration-500 h-80 group-hover:scale-105">
                @else
                    <div class="flex items-center justify-center w-full h-80" style="background: linear-gradient(135deg, var(--primary-100) 0%, var(--primary-50) 100%)">
                        <div class="text-center">
                            <svg class="w-16 h-16 mx-auto mb-2" style="color: var(--primary-300)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <p class="text-sm" style="color: var(--gray-500)">Gambar 1</p>
                            <p class="text-xs" style="color: var(--gray-400)">Belum diupload</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Gambar 2 -->
            <div class="overflow-hidden transition-all duration-300 bg-white shadow-lg rounded-2xl hover:shadow-xl group" data-aos="fade-up" data-aos-delay="200" style="border: 1px solid var(--primary-100)">
                @if(isset($profil) && $profil && $profil->gambar_misi_2 && file_exists(public_path('storage/' . $profil->gambar_misi_2)))
                    <img src="{{ asset('storage/' . $profil->gambar_misi_2) . '?v=' . time() }}"
                         alt="Visi & Misi 2"
                         class="object-cover w-full transition duration-500 h-80 group-hover:scale-105">
                @else
                    <div class="flex items-center justify-center w-full h-80" style="background: linear-gradient(135deg, var(--primary-100) 0%, var(--primary-50) 100%)">
                        <div class="text-center">
                            <svg class="w-16 h-16 mx-auto mb-2" style="color: var(--primary-300)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            <p class="text-sm" style="color: var(--gray-500)">Gambar 2</p>
                            <p class="text-xs" style="color: var(--gray-400)">Belum diupload</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Gambar 3 -->
            <div class="overflow-hidden transition-all duration-300 bg-white shadow-lg rounded-2xl hover:shadow-xl group" data-aos="fade-up" data-aos-delay="300" style="border: 1px solid var(--primary-100)">
                @if(isset($profil) && $profil && $profil->gambar_misi_3 && file_exists(public_path('storage/' . $profil->gambar_misi_3)))
                    <img src="{{ asset('storage/' . $profil->gambar_misi_3) . '?v=' . time() }}"
                         alt="Visi & Misi 3"
                         class="object-cover w-full transition duration-500 h-80 group-hover:scale-105">
                @else
                    <div class="flex items-center justify-center w-full h-80" style="background: linear-gradient(135deg, var(--primary-100) 0%, var(--primary-50) 100%)">
                        <div class="text-center">
                            <svg class="w-16 h-16 mx-auto mb-2" style="color: var(--primary-300)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <p class="text-sm" style="color: var(--gray-500)">Gambar 3</p>
                            <p class="text-xs" style="color: var(--gray-400)">Belum diupload</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Struktur Organisasi Sekolah -->
<section class="py-16 lg:py-20" style="background-color: var(--gray-50)" id="struktur">
    <div class="container px-4 mx-auto sm:px-6 lg:px-8">
        <div class="mb-12 text-center" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 mb-6 bg-white border rounded-full shadow-sm" style="border-color: var(--primary-100)">
                <span class="w-2 h-2 rounded-full" style="background-color: var(--primary)"></span>
                <span class="text-sm font-medium" style="color: var(--primary)">Organisasi</span>
            </div>
            <h2 class="mb-4 text-3xl font-bold md:text-4xl" style="color: var(--gray-900)">
                Struktur <span style="color: var(--primary)">Organisasi</span>
            </h2>
            <div class="w-20 h-1 mx-auto rounded-full" style="background-color: var(--primary)"></div>
            <p class="max-w-2xl mx-auto mt-4 text-lg" style="color: var(--gray-600)">
                Susunan kepengurusan dan organisasi sekolah
            </p>
        </div>

        @php
            $hasStruktur = isset($struktur) && $struktur && $struktur->gambar;
            $gambarPath = $hasStruktur ? 'storage/' . $struktur->gambar : null;
            $fileExists = $gambarPath && file_exists(public_path($gambarPath));
        @endphp

        @if($hasStruktur && $fileExists)
            <div class="overflow-hidden transition-all duration-300 shadow-xl rounded-2xl hover:shadow-2xl" data-aos="fade-up">
                <img src="{{ asset('storage/' . $struktur->gambar) . '?v=' . ($fileExists ? filemtime(public_path('storage/' . $struktur->gambar)) : time()) }}"
                     alt="Struktur Organisasi {{ $struktur->tahun ?? '' }}"
                     class="w-full h-auto"
                     loading="lazy">
                @if($struktur->deskripsi)
                    <div class="p-4 text-center" style="background-color: var(--gray-100)">
                        <p class="text-sm" style="color: var(--gray-600)">{{ $struktur->deskripsi }}</p>
                    </div>
                @endif
            </div>
        @else
            <div class="p-12 text-center bg-white rounded-2xl" data-aos="fade-up" style="border: 1px solid var(--primary-100)">
                <svg class="w-24 h-24 mx-auto mb-4" style="color: var(--primary-300)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 11v3m0 3h.01M12 8h.01"/>
                </svg>
                <p class="mb-2 text-lg font-medium" style="color: var(--gray-700)">Struktur Organisasi</p>
                <p class="text-sm" style="color: var(--gray-500)">Belum ada data struktur organisasi. Silakan upload gambar struktur organisasi melalui admin panel.</p>
            </div>
        @endif
    </div>
</section>

<!-- ==================== STRUKTUR ORGANISASI PERPUSTAKAAN ==================== -->
@if(isset($profil) && $profil && $profil->struktur_perpustakaan)
<section class="py-16 bg-white lg:py-20" id="struktur-perpustakaan">
    <div class="container px-4 mx-auto sm:px-6 lg:px-8">
        <div class="mb-12 text-center" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 mb-6 bg-white border rounded-full shadow-sm" style="border-color: var(--primary-100)">
                <span class="w-2 h-2 rounded-full" style="background-color: var(--primary)"></span>
                <span class="text-sm font-medium" style="color: var(--primary)">Perpustakaan</span>
            </div>
            <h2 class="mb-4 text-3xl font-bold md:text-4xl" style="color: var(--gray-900)">
                Struktur Organisasi <span style="color: var(--primary)">Perpustakaan</span>
            </h2>
            <div class="w-20 h-1 mx-auto rounded-full" style="background-color: var(--primary)"></div>
            <p class="max-w-2xl mx-auto mt-4 text-lg" style="color: var(--gray-600)">
                Susunan organisasi pengelola perpustakaan sekolah
            </p>
        </div>

        <div class="overflow-hidden transition-all duration-300 shadow-xl rounded-2xl hover:shadow-2xl" data-aos="fade-up">
            @php
                $gambarPerpus = 'storage/' . $profil->struktur_perpustakaan;
                $fileExistsPerpus = file_exists(public_path($gambarPerpus));
                $imageUrlPerpus = asset($gambarPerpus) . ($fileExistsPerpus ? '?v=' . filemtime(public_path($gambarPerpus)) : '');
            @endphp
            <img src="{{ $imageUrlPerpus }}"
                 alt="Struktur Organisasi Perpustakaan"
                 class="w-full h-auto">
        </div>
    </div>
</section>
@endif

<!-- Guru & Staf -->
<section class="py-16 bg-white lg:py-20" id="guru">
    <div class="container px-4 mx-auto sm:px-6 lg:px-8">
        <div class="mb-12 text-center" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 mb-6 bg-white border rounded-full shadow-sm" style="border-color: var(--primary-100)">
                <span class="w-2 h-2 rounded-full" style="background-color: var(--primary)"></span>
                <span class="text-sm font-medium" style="color: var(--primary)">Tenaga Pendidik</span>
            </div>
            <h2 class="mb-4 text-3xl font-bold md:text-4xl" style="color: var(--gray-900)">
                Guru & <span style="color: var(--primary)">Staf</span>
            </h2>
            <div class="w-20 h-1 mx-auto rounded-full" style="background-color: var(--primary)"></div>
            <p class="max-w-2xl mx-auto mt-4 text-lg" style="color: var(--gray-600)">
                Tenaga pendidik profesional yang berdedikasi
            </p>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @forelse($guru as $item)
            <div class="overflow-hidden transition-all duration-300 bg-white shadow-md rounded-2xl hover:shadow-xl group" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}" style="border: 1px solid var(--primary-100)">
                <div class="relative h-64 overflow-hidden">
                    @if($item->foto)
                        <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_lengkap }}" class="object-cover w-full h-full transition duration-500 group-hover:scale-110">
                    @else
                        <div class="flex items-center justify-center w-full h-full" style="background: linear-gradient(135deg, var(--primary-100) 0%, var(--primary-50) 100%)">
                            <span class="text-6xl font-bold" style="color: var(--primary-300)">{{ substr($item->nama_lengkap, 0, 1) }}</span>
                        </div>
                    @endif
                </div>
                <div class="p-5 text-center">
                    <h3 class="mb-1 text-lg font-bold" style="color: var(--gray-900)">{{ $item->nama_lengkap }}</h3>
                    <p class="mb-2 text-sm" style="color: var(--primary)">{{ $item->jabatan ?? 'Guru' }}</p>
                    @if($item->mata_pelajaran)
                        <p class="text-xs" style="color: var(--gray-500)">{{ $item->mata_pelajaran }}</p>
                    @endif
                </div>
            </div>
            @empty
            <div class="py-12 text-center col-span-full">
                <p style="color: var(--gray-500)">Data guru dan staf sedang dalam proses update</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Fasilitas -->
<section class="py-16 lg:py-20" style="background-color: var(--gray-50)" id="fasilitas">
    <div class="container px-4 mx-auto sm:px-6 lg:px-8">
        <div class="mb-12 text-center" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 mb-6 bg-white border rounded-full shadow-sm" style="border-color: var(--primary-100)">
                <span class="w-2 h-2 rounded-full" style="background-color: var(--primary)"></span>
                <span class="text-sm font-medium" style="color: var(--primary)">Fasilitas</span>
            </div>
            <h2 class="mb-4 text-3xl font-bold md:text-4xl" style="color: var(--gray-900)">
                Fasilitas <span style="color: var(--primary)">Sekolah</span>
            </h2>
            <div class="w-20 h-1 mx-auto rounded-full" style="background-color: var(--primary)"></div>
            <p class="max-w-2xl mx-auto mt-4 text-lg" style="color: var(--gray-600)">
                Fasilitas modern untuk mendukung proses belajar mengajar
            </p>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @forelse($fasilitas as $item)
            <div class="overflow-hidden transition-all duration-300 bg-white shadow-md rounded-2xl hover:shadow-xl group" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}" style="border: 1px solid var(--primary-100)">
                <div class="relative h-48 overflow-hidden">
                    @if($item->gambar && file_exists(public_path('storage/' . $item->gambar)))
                        <img src="{{ asset('storage/' . $item->gambar) . '?v=' . filemtime(public_path('storage/' . $item->gambar)) }}"
                             alt="{{ $item->nama_fasilitas }}"
                             class="object-cover w-full h-full transition duration-500 group-hover:scale-110">
                    @else
                        <div class="flex items-center justify-center w-full h-full" style="background: linear-gradient(135deg, var(--primary-100) 0%, var(--primary-50) 100%)">
                            <svg class="w-16 h-16" style="color: var(--primary-300)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="p-5 text-center">
                    <h3 class="mb-1 text-lg font-bold" style="color: var(--gray-900)">{{ $item->nama_fasilitas }}</h3>
                    <p class="text-sm" style="color: var(--gray-500)">{{ $item->jumlah ?? '1' }} Unit • {{ $item->kondisi ?? 'Baik' }}</p>
                    @if($item->deskripsi)
                        <p class="mt-2 text-xs" style="color: var(--gray-400)">{{ Str::limit(strip_tags($item->deskripsi), 60) }}</p>
                    @endif
                </div>
            </div>
            @empty
            <div class="py-12 text-center col-span-full">
                <svg class="w-24 h-24 mx-auto mb-4" style="color: var(--primary-300)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/>
                </svg>
                <p style="color: var(--gray-500)">Data fasilitas sedang dalam proses update</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Prestasi -->
<section class="py-16 bg-white lg:py-20" id="prestasi">
    <div class="container px-4 mx-auto sm:px-6 lg:px-8">
        <div class="mb-12 text-center" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 mb-6 bg-white border rounded-full shadow-sm" style="border-color: var(--primary-100)">
                <span class="w-2 h-2 rounded-full" style="background-color: var(--primary)"></span>
                <span class="text-sm font-medium" style="color: var(--primary)">Prestasi</span>
            </div>
            <h2 class="mb-4 text-3xl font-bold md:text-4xl" style="color: var(--gray-900)">
                Prestasi <span style="color: var(--primary)">Kami</span>
            </h2>
            <div class="w-20 h-1 mx-auto rounded-full" style="background-color: var(--primary)"></div>
            <p class="max-w-2xl mx-auto mt-4 text-lg" style="color: var(--gray-600)">
                Berbagai prestasi membanggakan telah diraih oleh siswa-siswi kami
            </p>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse($prestasi as $item)
            <div class="overflow-hidden transition-all duration-300 bg-white shadow-md rounded-2xl hover:shadow-xl group" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}" style="border: 1px solid var(--primary-100)">
                @if($item->foto)
                    <div class="h-48 overflow-hidden">
                        <img src="{{ asset('storage/' . $item->foto) . '?v=' . time() }}" alt="{{ $item->judul }}" class="object-cover w-full h-full transition duration-500 group-hover:scale-110">
                    </div>
                @endif
                <div class="p-5">
                    <div class="flex items-center justify-between mb-2">
                        <span class="px-2 py-1 text-xs rounded-full" style="background-color: var(--primary-100); color: var(--primary)">{{ $item->tingkat ?? 'Umum' }}</span>
                        <span class="text-sm" style="color: var(--gray-400)">{{ $item->tahun }}</span>
                    </div>
                    <h3 class="mb-2 text-lg font-bold" style="color: var(--gray-900)">{{ $item->judul }}</h3>
                    <p class="text-sm" style="color: var(--gray-600)">{{ $item->deskripsi ?? Str::limit($item->judul, 100) }}</p>
                    @if($item->peserta_nama)
                        <p class="mt-3 text-sm font-semibold" style="color: var(--primary)">{{ $item->peserta_nama }}</p>
                    @endif
                </div>
            </div>
            @empty
            <div class="py-12 text-center col-span-full">
                <p style="color: var(--gray-500)">Data prestasi sedang dalam proses update</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

@endsection
