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
            Hubungi <span style="color: var(--primary)">Kami</span>
        </h1>
        <div class="w-20 h-1 mx-auto mt-4 rounded-full" style="background-color: var(--primary)"></div>
        <p class="max-w-2xl mx-auto mt-4 text-lg" style="color: var(--gray-600)">
            Silakan hubungi kami jika ada pertanyaan atau informasi lebih lanjut
        </p>
    </div>
</section>

<!-- Contact Info Cards -->
<section class="py-12 bg-white">
    <div class="container px-4 mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <!-- Alamat -->
            <div class="p-6 text-center transition-all duration-300 bg-white shadow-md rounded-2xl hover:shadow-xl group" style="border: 1px solid var(--primary-100)">
                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 transition-all duration-300 rounded-full group-hover:scale-110" style="background: linear-gradient(135deg, var(--primary-100) 0%, var(--primary-50) 100%)">
                    <svg class="w-8 h-8" style="color: var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h3 class="mb-2 text-lg font-bold" style="color: var(--gray-800)">Alamat</h3>
                <p class="text-sm" style="color: var(--gray-600)">
                    {{ $profil->alamat ?? 'Jl. Pendidikan No. 123, Namrole, Buru Selatan' }}
                </p>
            </div>

            <!-- Telepon -->
            <div class="p-6 text-center transition-all duration-300 bg-white shadow-md rounded-2xl hover:shadow-xl group" style="border: 1px solid var(--primary-100)">
                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 transition-all duration-300 rounded-full group-hover:scale-110" style="background: linear-gradient(135deg, var(--primary-100) 0%, var(--primary-50) 100%)">
                    <svg class="w-8 h-8" style="color: var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                </div>
                <h3 class="mb-2 text-lg font-bold" style="color: var(--gray-800)">Telepon</h3>
                <p class="text-sm" style="color: var(--gray-600)">
                    {{ $profil->telepon ?? '(0911) 123456' }}
                </p>
            </div>

            <!-- Email -->
            <div class="p-6 text-center transition-all duration-300 bg-white shadow-md rounded-2xl hover:shadow-xl group" style="border: 1px solid var(--primary-100)">
                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 transition-all duration-300 rounded-full group-hover:scale-110" style="background: linear-gradient(135deg, var(--primary-100) 0%, var(--primary-50) 100%)">
                    <svg class="w-8 h-8" style="color: var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="mb-2 text-lg font-bold" style="color: var(--gray-800)">Email</h3>
                <p class="text-sm" style="color: var(--gray-600)">
                    {{ $profil->email ?? 'info@smpn01namrole.sch.id' }}
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form & Map -->
<section class="py-16 bg-white lg:py-20">
    <div class="container px-4 mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-12 lg:grid-cols-2">
            <!-- Contact Form -->
            <div>
                <div class="p-6 bg-white shadow-lg rounded-2xl lg:p-8" style="border: 1px solid var(--primary-100)">
                    <h2 class="mb-2 text-2xl font-bold" style="color: var(--gray-800)">Kirim Pesan</h2>
                    <p class="mb-6 text-sm" style="color: var(--gray-500)">Isi form di bawah untuk mengirim pesan kepada kami</p>

                    @if(session('success'))
                        <div class="p-4 mb-6 border border-green-200 rounded-lg bg-green-50">
                            <p class="text-sm text-green-700">{{ session('success') }}</p>
                        </div>
                    @endif

                    <form action="{{ route('kontak.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-2">
                            <div>
                                <label class="block mb-1 text-sm font-medium" style="color: var(--gray-700)">Nama Lengkap *</label>
                                <input type="text" name="nama" required
                                       class="w-full px-4 py-2 transition border rounded-lg focus:outline-none focus:border-primary"
                                       style="border-color: var(--gray-200)"
                                       value="{{ old('nama') }}">
                                @error('nama')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block mb-1 text-sm font-medium" style="color: var(--gray-700)">Email *</label>
                                <input type="email" name="email" required
                                       class="w-full px-4 py-2 transition border rounded-lg focus:outline-none focus:border-primary"
                                       style="border-color: var(--gray-200)"
                                       value="{{ old('email') }}">
                                @error('email')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-2">
                            <div>
                                <label class="block mb-1 text-sm font-medium" style="color: var(--gray-700)">No. Telepon</label>
                                <input type="tel" name="no_hp"
                                       class="w-full px-4 py-2 transition border rounded-lg focus:outline-none focus:border-primary"
                                       style="border-color: var(--gray-200)"
                                       value="{{ old('no_hp') }}">
                            </div>

                            <div>
                                <label class="block mb-1 text-sm font-medium" style="color: var(--gray-700)">Subjek</label>
                                <input type="text" name="subjek"
                                       class="w-full px-4 py-2 transition border rounded-lg focus:outline-none focus:border-primary"
                                       style="border-color: var(--gray-200)"
                                       value="{{ old('subjek') }}">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block mb-1 text-sm font-medium" style="color: var(--gray-700)">Pesan *</label>
                            <textarea name="pesan" rows="5" required
                                      class="w-full px-4 py-2 transition border rounded-lg resize-none focus:outline-none focus:border-primary"
                                      style="border-color: var(--gray-200)">{{ old('pesan') }}</textarea>
                            @error('pesan')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                                class="w-full py-3 font-semibold text-white transition-all duration-300 rounded-lg hover:-translate-y-1 hover:shadow-lg"
                                style="background: linear-gradient(135deg, var(--primary), var(--primary-dark))">
                            Kirim Pesan
                            <svg class="inline-block w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Map & Info -->
            <div>
                <!-- Google Maps - Lokasi SMP Negeri 01 Namrole -->
                <div class="mb-6 overflow-hidden bg-white shadow-lg rounded-2xl" style="border: 1px solid var(--primary-100)">
                    <div class="w-full h-80">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3980.8480028331683!2d126.72497447497445!3d-3.8427875961309956!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d72dda65ce588af%3A0x4b2ba53982d11fbb!2sSMP%20NEGERI%2001%20NAMROLE!5e0!3m2!1sid!2sid!4v1779537918342!5m2!1sid!2sid"
                            width="100%"
                            height="100%"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

                <!-- Jam Operasional -->
                <div class="p-6 bg-white shadow-lg rounded-2xl" style="border: 1px solid var(--primary-100)">
                    <h3 class="pb-2 mb-4 text-lg font-bold border-b" style="color: var(--gray-800); border-color: var(--primary-100)">
                        🕒 Jam Operasional
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between py-2">
                            <span style="color: var(--gray-600)">Senin - Jumat</span>
                            <span class="font-semibold" style="color: var(--gray-800)">07:00 - 16:00</span>
                        </div>
                        <div class="flex items-center justify-between py-2 border-t border-gray-100">
                            <span style="color: var(--gray-600)">Sabtu</span>
                            <span class="font-semibold" style="color: var(--gray-800)">08:00 - 12:00</span>
                        </div>
                        <div class="flex items-center justify-between py-2 border-t border-gray-100">
                            <span style="color: var(--gray-600)">Minggu / Libur Nasional</span>
                            <span class="font-semibold" style="color: var(--gray-800)">Tutup</span>
                        </div>
                    </div>
                </div>

                <!-- Informasi Tambahan -->
                <div class="p-6 mt-6 bg-white shadow-lg rounded-2xl" style="border: 1px solid var(--primary-100)">
                    <h3 class="pb-2 mb-4 text-lg font-bold border-b" style="color: var(--gray-800); border-color: var(--primary-100)">
                        📌 Informasi Lainnya
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-primary mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <div>
                                <p class="text-sm font-semibold" style="color: var(--gray-700">NPSN</p>
                                <p class="text-sm" style="color: var(--gray-600)">{{ $profil->npsn ?? '69801234' }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-primary mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <div>
                                <p class="text-sm font-semibold" style="color: var(--gray-700)">Akreditasi</p>
                                <p class="text-sm" style="color: var(--gray-600)">{{ $profil->akreditasi ?? 'A' }} (Unggul)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Social Media Section -->
<section class="py-16 lg:py-20" style="background-color: var(--gray-50)">
    <div class="container px-4 mx-auto sm:px-6 lg:px-8">
        <div class="mb-10 text-center" data-aos="fade-up">
            <h2 class="mb-4 text-2xl font-bold md:text-3xl" style="color: var(--gray-800)">
                Ikuti <span style="color: var(--primary)">Media Sosial</span> Kami
            </h2>
            <div class="w-20 h-1 mx-auto rounded-full" style="background-color: var(--primary)"></div>
            <p class="mt-4 text-gray-600">Dapatkan informasi terbaru melalui media sosial kami</p>
        </div>

        <div class="flex flex-wrap justify-center gap-4">
            <a href="#" class="flex items-center justify-center w-12 h-12 transition-all duration-300 rounded-full hover:-translate-y-1 hover:shadow-lg" style="background: #1877F2">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95z"/>
                </svg>
            </a>
            <a href="#" class="flex items-center justify-center w-12 h-12 transition-all duration-300 rounded-full hover:-translate-y-1 hover:shadow-lg" style="background: #1DA1F2">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 0021.968-12.374 8.983 8.983 0 01-2.065-2.142z"/>
                </svg>
            </a>
            <a href="#" class="flex items-center justify-center w-12 h-12 transition-all duration-300 rounded-full hover:-translate-y-1 hover:shadow-lg" style="background: #E4405F">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12.48 10.92v3.28h7.84c-.24 1.84-.853 3.187-1.787 4.133-1.147 1.147-2.933 2.4-6.053 2.4-4.827 0-8.6-3.893-8.6-8.72s3.773-8.72 8.6-8.72c2.6 0 4.507 1.027 5.907 2.347l2.307-2.307C18.747 1.44 16.133 0 12.48 0 5.867 0 .307 5.387.307 12s5.56 12 12.173 12c3.573 0 6.267-1.173 8.373-3.36 2.16-2.16 2.84-5.213 2.84-7.667 0-.76-.053-1.467-.173-2.053H12.48z"/>
                </svg>
            </a>
            <a href="#" class="flex items-center justify-center w-12 h-12 transition-all duration-300 rounded-full hover:-translate-y-1 hover:shadow-lg" style="background: #0A66C2">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451c.979 0 1.771-.773 1.771-1.729V1.729C24 .774 23.204 0 22.225 0z"/>
                </svg>
            </a>
            <a href="#" class="flex items-center justify-center w-12 h-12 transition-all duration-300 rounded-full hover:-translate-y-1 hover:shadow-lg" style="background: #FF0000">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.073 0 12 0 12s0 3.927.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.927 24 12 24 12s0-3.927-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                </svg>
            </a>
        </div>
    </div>
</section>

<style>
    /* Responsive Map */
    .map-container {
        position: relative;
        overflow: hidden;
        padding-bottom: 56.25%; /* 16:9 aspect ratio */
        height: 0;
    }

    .map-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }

    @media (max-width: 768px) {
        .map-container {
            padding-bottom: 75%; /* Taller aspect ratio for mobile */
        }
    }
</style>
@endsection
