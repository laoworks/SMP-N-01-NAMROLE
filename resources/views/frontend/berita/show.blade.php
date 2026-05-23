@extends('layouts.app')

@section('content')

<!-- Page Title -->
<section class="relative overflow-hidden bg-white">

    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] rounded-full blur-3xl"
             style="background-color: var(--primary-50)">
        </div>

        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] rounded-full blur-3xl opacity-30"
             style="background-color: var(--primary-50)">
        </div>
    </div>

    <div class="relative container mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">

        <div class="max-w-4xl mx-auto">

            <!-- Breadcrumb -->
            <nav class="flex flex-wrap items-center gap-2 mb-8 text-sm"
                 style="color: var(--gray-500)">

                <a href="{{ route('home') }}"
                   class="hover:text-primary transition">
                    Beranda
                </a>

                <svg class="w-4 h-4"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M9 5l7 7-7 7">
                    </path>
                </svg>

                <a href="{{ route('berita') }}"
                   class="hover:text-primary transition">
                    Berita
                </a>

                <svg class="w-4 h-4"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M9 5l7 7-7 7">
                    </path>
                </svg>

                <span class="line-clamp-1"
                      style="color: var(--gray-700)">
                    {{ $berita->judul }}
                </span>
            </nav>

            <!-- Header -->
            <div class="text-center">

                <div class="flex items-center justify-center gap-3 mb-5">

                    <span class="text-xs px-4 py-1.5 rounded-full font-medium"
                          style="background-color: var(--primary-100); color: var(--primary)">

                        {{ $berita->jenis == 'berita' ? 'Berita' : 'Pengumuman' }}
                    </span>

                    @if($berita->is_urgent)
                        <span class="text-xs px-4 py-1.5 rounded-full bg-red-100 text-red-600 font-medium">
                            Penting
                        </span>
                    @endif
                </div>

                <h1 class="text-3xl md:text-5xl font-bold leading-tight mb-6"
                    style="color: var(--gray-900)">

                    {{ $berita->judul }}
                </h1>

                <!-- Meta -->
                <div class="flex flex-wrap items-center justify-center gap-6 text-sm"
                     style="color: var(--gray-500)">

                    <!-- Date -->
                    <div class="flex items-center gap-2">

                        <div class="w-9 h-9 rounded-xl flex items-center justify-center"
                             style="background-color: var(--primary-50)">

                            <svg class="w-4 h-4"
                                 style="color: var(--primary)"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>

                        <span>{{ $berita->published_at->format('d F Y') }}</span>
                    </div>

                    <!-- Author -->
                    <div class="flex items-center gap-2">

                        <div class="w-9 h-9 rounded-xl flex items-center justify-center"
                             style="background-color: var(--primary-50)">

                            <svg class="w-4 h-4"
                                 style="color: var(--primary)"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z">
                                </path>
                            </svg>
                        </div>

                        <span>{{ $berita->penulis ?? 'Admin' }}</span>
                    </div>

                    <!-- Views -->
                    <div class="flex items-center gap-2">

                        <div class="w-9 h-9 rounded-xl flex items-center justify-center"
                             style="background-color: var(--primary-50)">

                            <svg class="w-4 h-4"
                                 style="color: var(--primary)"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                </path>

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                        </div>

                        <span>{{ number_format($berita->views) }} views</span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- Content -->
<section class="py-10 lg:py-14 bg-white">

    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Main -->
            <div class="lg:col-span-2">

                <div class="bg-white rounded-3xl overflow-hidden border shadow-sm"
                     style="border-color: var(--primary-100)">

                    <!-- Featured -->
                    @if($berita->gambar_utama && file_exists(public_path('storage/' . $berita->gambar_utama)))

                        <img src="{{ asset('storage/' . $berita->gambar_utama) . '?v=' . time() }}"
                             alt="{{ $berita->judul }}"
                             class="w-full h-auto object-cover">
                    @endif

                    <!-- Content -->
                    <div class="p-6 lg:p-10">

                        <div class="prose prose-lg max-w-none"
                             style="color: var(--gray-700)">

                            {!! $berita->konten !!}
                        </div>

                        <!-- Share -->
                        <div class="mt-10 pt-6 border-t"
                             style="border-color: var(--gray-100)">

                            <p class="text-sm font-semibold mb-4"
                               style="color: var(--gray-600)">
                                Bagikan Artikel
                            </p>

                            <div class="flex items-center gap-3">

                                <!-- Facebook -->
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                   target="_blank"
                                   class="w-11 h-11 rounded-2xl flex items-center justify-center bg-blue-600 text-white hover:scale-105 transition">

                                    <svg class="w-5 h-5"
                                         fill="currentColor"
                                         viewBox="0 0 24 24">

                                        <path d="M22 12a10 10 0 10-11.5 9.9v-7H8v-3h2.5V9.5c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.5H15.3c-1.2 0-1.6.8-1.6 1.5V12H17l-.5 3h-2.8v7A10 10 0 0022 12z"/>
                                    </svg>
                                </a>

                                <!-- X -->
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($berita->judul) }}"
                                   target="_blank"
                                   class="w-11 h-11 rounded-2xl flex items-center justify-center bg-black text-white hover:scale-105 transition">

                                    <svg class="w-5 h-5"
                                         fill="currentColor"
                                         viewBox="0 0 24 24">

                                        <path d="M18.244 2H21l-6.56 7.5L22.5 22h-6.7l-5.25-6.8L4.5 22H1.7l7-8L1.5 2h6.9l4.8 6.2L18.244 2z"/>
                                    </svg>
                                </a>

                                <!-- WhatsApp -->
                                <a href="https://wa.me/?text={{ urlencode($berita->judul . ' - ' . url()->current()) }}"
                                   target="_blank"
                                   class="w-11 h-11 rounded-2xl flex items-center justify-center bg-green-500 text-white hover:scale-105 transition">

                                    <svg class="w-5 h-5"
                                         fill="currentColor"
                                         viewBox="0 0 24 24">

                                        <path d="M20.5 3.5A11.8 11.8 0 0012.1 0C5.6 0 .3 5.3.3 11.8c0 2.1.5 4.1 1.5 5.9L0 24l6.5-1.7a11.8 11.8 0 005.6 1.4h.1c6.5 0 11.8-5.3 11.8-11.8 0-3.1-1.2-6.1-3.5-8.4z"/>
                                    </svg>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">

                <div class="bg-white rounded-3xl p-6 border shadow-sm"
                     style="border-color: var(--primary-100)">

                    <h3 class="text-lg font-bold mb-5 flex items-center gap-3"
                        style="color: var(--gray-800)">

                        <div class="w-10 h-10 rounded-2xl flex items-center justify-center"
                             style="background: linear-gradient(135deg, var(--primary-100), var(--primary-50))">

                            <svg class="w-5 h-5"
                                 style="color: var(--primary)"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.8"
                                      d="M19 5H5a2 2 0 00-2 2v10a2 2 0 002 2h14a2 2 0 002-2V7a2 2 0 00-2-2z">
                                </path>
                            </svg>
                        </div>

                        Berita Terkait
                    </h3>

                    <div class="space-y-4">

                        @forelse($beritaTerkait as $item)

                        <a href="{{ route('berita.show', $item->slug) }}"
                           class="flex gap-3 group">

                            <div class="w-20 h-20 rounded-2xl overflow-hidden flex-shrink-0">

                                @if($item->gambar_utama)

                                    <img src="{{ asset('storage/' . $item->gambar_utama) }}"
                                         alt="{{ $item->judul }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition">

                                @endif
                            </div>

                            <div class="flex-1">

                                <p class="text-xs mb-1"
                                   style="color: var(--gray-500)">

                                    {{ $item->published_at->format('d M Y') }}
                                </p>

                                <h4 class="text-sm font-semibold line-clamp-2 group-hover:text-primary transition"
                                    style="color: var(--gray-700)">

                                    {{ $item->judul }}
                                </h4>
                            </div>
                        </a>

                        @empty

                        <p class="text-sm text-center"
                           style="color: var(--gray-500)">
                            Tidak ada berita terkait
                        </p>

                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
