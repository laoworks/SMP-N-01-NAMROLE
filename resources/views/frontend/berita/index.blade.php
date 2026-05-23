@extends('layouts.app')

@section('content')

<!-- Page Title Section -->
<section class="relative overflow-hidden bg-white">
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] rounded-full blur-3xl"
             style="background-color: var(--primary-50)">
        </div>

        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] rounded-full blur-3xl opacity-30"
             style="background-color: var(--primary-50)">
        </div>
    </div>

    <div class="relative container mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20 text-center">
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight"
            style="color: var(--gray-900)">
            Berita &
            <span style="color: var(--primary)">Pengumuman</span>
        </h1>

        <div class="w-20 h-1 mx-auto mt-4 rounded-full"
             style="background-color: var(--primary)">
        </div>

        <p class="mt-4 text-lg max-w-2xl mx-auto"
           style="color: var(--gray-600)">
            Informasi terbaru seputar kegiatan dan pengumuman sekolah
        </p>
    </div>
</section>

<!-- Filter -->
<section class="py-8 bg-white border-b"
         style="border-color: var(--gray-100)">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex flex-wrap items-center justify-between gap-4">

            <!-- Filter -->
            <div class="flex flex-wrap gap-2">

                <a href="{{ route('berita', ['jenis' => 'semua']) }}"
                   class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-300
                   {{ $jenis == 'semua'
                        ? 'text-white'
                        : 'bg-gray-100 text-gray-600 hover:bg-primary-100' }}"
                   style="{{ $jenis == 'semua'
                        ? 'background: linear-gradient(135deg, var(--primary), var(--primary-dark))'
                        : '' }}">
                    Semua
                </a>

                <a href="{{ route('berita', ['jenis' => 'berita']) }}"
                   class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-300
                   {{ $jenis == 'berita'
                        ? 'text-white'
                        : 'bg-gray-100 text-gray-600 hover:bg-primary-100' }}"
                   style="{{ $jenis == 'berita'
                        ? 'background: linear-gradient(135deg, var(--primary), var(--primary-dark))'
                        : '' }}">
                    Berita
                </a>

                <a href="{{ route('berita', ['jenis' => 'pengumuman']) }}"
                   class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-300
                   {{ $jenis == 'pengumuman'
                        ? 'text-white'
                        : 'bg-gray-100 text-gray-600 hover:bg-primary-100' }}"
                   style="{{ $jenis == 'pengumuman'
                        ? 'background: linear-gradient(135deg, var(--primary), var(--primary-dark))'
                        : '' }}">
                    Pengumuman
                </a>
            </div>

            <!-- Search -->
            <form method="GET"
                  action="{{ route('berita') }}"
                  class="flex gap-2">

                @if($jenis != 'semua')
                    <input type="hidden" name="jenis" value="{{ $jenis }}">
                @endif

                <input type="text"
                       name="search"
                       value="{{ $search }}"
                       placeholder="Cari berita..."
                       class="px-4 py-2 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary/30 w-64 text-sm">

                <button type="submit"
                        class="px-4 py-2 rounded-xl text-white transition-all duration-300 shadow-sm hover:shadow-md"
                        style="background: linear-gradient(135deg, var(--primary), var(--primary-dark))">

                    <svg class="w-5 h-5"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z">
                        </path>

                    </svg>
                </button>
            </form>
        </div>
    </div>
</section>

<!-- Content -->
<section class="py-16 lg:py-20 bg-white">

    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Main Content -->
            <div class="lg:col-span-2">

                @if($berita->count() > 0)

                    <div class="space-y-8">

                        @foreach($berita as $item)

                        <article class="bg-white rounded-3xl overflow-hidden border transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl"
                                 style="border-color: var(--primary-100)">

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                                <!-- Image -->
                                <div class="md:col-span-1 h-56 md:h-full overflow-hidden">

                                    @if($item->gambar_utama && file_exists(public_path('storage/' . $item->gambar_utama)))

                                        <img src="{{ asset('storage/' . $item->gambar_utama) . '?v=' . time() }}"
                                             alt="{{ $item->judul }}"
                                             class="w-full h-full object-cover hover:scale-105 transition duration-500">

                                    @else

                                        <div class="w-full h-full flex items-center justify-center"
                                             style="background: linear-gradient(135deg, var(--primary-100), var(--primary-50))">

                                            <svg class="w-12 h-12"
                                                 style="color: var(--primary-300)"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="1.5"
                                                      d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                        </div>

                                    @endif
                                </div>

                                <!-- Content -->
                                <div class="md:col-span-2 p-6">

                                    <!-- Meta -->
                                    <div class="flex flex-wrap items-center gap-2 mb-4">

                                        <span class="text-xs px-3 py-1 rounded-full font-medium"
                                              style="background-color: var(--primary-100); color: var(--primary)">

                                            {{ $item->jenis == 'berita' ? 'Berita' : 'Pengumuman' }}
                                        </span>

                                        @if($item->is_urgent)
                                            <span class="text-xs px-3 py-1 rounded-full bg-red-100 text-red-600 font-medium">
                                                Penting
                                            </span>
                                        @endif

                                        <div class="flex items-center gap-1 text-xs"
                                             style="color: var(--gray-400)">

                                            <svg class="w-4 h-4"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>

                                            {{ $item->published_at->format('d M Y') }}
                                        </div>
                                    </div>

                                    <!-- Title -->
                                    <h2 class="text-2xl font-bold mb-3 line-clamp-2"
                                        style="color: var(--gray-800)">

                                        <a href="{{ route('berita.show', $item->slug) }}"
                                           class="hover:text-primary transition">

                                            {{ $item->judul }}
                                        </a>
                                    </h2>

                                    <!-- Description -->
                                    <p class="text-sm leading-relaxed mb-5 line-clamp-3"
                                       style="color: var(--gray-600)">

                                        {{ strip_tags(Str::limit($item->konten, 140)) }}
                                    </p>

                                    <!-- Footer -->
                                    <div class="flex items-center justify-between">

                                        <div class="flex items-center gap-4 text-xs"
                                             style="color: var(--gray-500)">

                                            <div class="flex items-center gap-1">
                                                <svg class="w-4 h-4"
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

                                                {{ number_format($item->views) }}
                                            </div>

                                            <div class="flex items-center gap-1">
                                                <svg class="w-4 h-4"
                                                     fill="none"
                                                     stroke="currentColor"
                                                     viewBox="0 0 24 24">

                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z">
                                                    </path>
                                                </svg>

                                                {{ $item->penulis ?? 'Admin' }}
                                            </div>
                                        </div>

                                        <a href="{{ route('berita.show', $item->slug) }}"
                                           class="inline-flex items-center gap-2 text-sm font-semibold hover:gap-3 transition-all"
                                           style="color: var(--primary)">

                                            Baca

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
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </article>

                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-10">
                        {{ $berita->appends(request()->query())->links() }}
                    </div>

                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-6">

                <!-- Berita Terbaru -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border"
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

                        Berita Terbaru
                    </h3>

                    <div class="space-y-4">

                        @forelse($beritaTerbaru as $item)

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
                            Belum ada berita
                        </p>

                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
