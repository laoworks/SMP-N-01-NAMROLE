@extends('layouts.app')

@section('content')
<!-- Page Title Section -->
<section class="relative overflow-hidden bg-white">
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] rounded-full blur-3xl" style="background-color: var(--primary-50)"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] rounded-full blur-3xl opacity-30" style="background-color: var(--primary-50)"></div>
    </div>

    <div class="container relative px-4 py-16 mx-auto sm:px-6 lg:px-8 lg:py-20">
        <div class="max-w-4xl mx-auto">
            <nav class="flex mb-6 text-sm" style="color: var(--gray-500)">
                <a href="{{ route('home') }}" class="transition hover:text-primary">Beranda</a>
                <span class="mx-2">/</span>
                <a href="{{ route('ekskul.index') }}" class="transition hover:text-primary">Ekstrakurikuler</a>
                <span class="mx-2">/</span>
                <span style="color: var(--gray-700)">{{ $ekskul->nama_ekskul }}</span>
            </nav>

            <div class="overflow-hidden bg-white shadow-xl rounded-2xl" style="border: 1px solid var(--primary-100)">
                <!-- Header dengan Gambar -->
                @if($ekskul->gambar && file_exists(public_path('storage/' . $ekskul->gambar)))
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset('storage/' . $ekskul->gambar) . '?v=' . filemtime(public_path('storage/' . $ekskul->gambar)) }}"
                             alt="{{ $ekskul->nama_ekskul }}"
                             class="object-cover w-full h-full">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <h1 class="text-3xl font-bold text-white">{{ $ekskul->nama_ekskul }}</h1>
                            @if($ekskul->pembina)
                                <p class="mt-1 text-white/80">Pembina: {{ $ekskul->pembina->nama_lengkap }}</p>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="relative h-48 overflow-hidden" style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%)">
                        <div class="absolute inset-0 bg-black/20"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-24 h-24 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <h1 class="text-3xl font-bold text-white">{{ $ekskul->nama_ekskul }}</h1>
                            @if($ekskul->pembina)
                                <p class="mt-1 text-white/80">Pembina: {{ $ekskul->pembina->nama_lengkap }}</p>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Content -->
                <div class="p-8">
                    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2">
                        @if($ekskul->jadwal_latihan)
                        <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl">
                            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <p class="text-sm text-gray-500">Jadwal Latihan</p>
                                <p class="font-semibold">{{ $ekskul->jadwal_latihan }}</p>
                            </div>
                        </div>
                        @endif

                        @if($ekskul->tempat_latihan)
                        <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl">
                            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <div>
                                <p class="text-sm text-gray-500">Tempat Latihan</p>
                                <p class="font-semibold">{{ $ekskul->tempat_latihan }}</p>
                            </div>
                        </div>
                        @endif

                        @if($ekskul->kuota)
                        <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl">
                            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <div>
                                <p class="text-sm text-gray-500">Kuota</p>
                                <p class="font-semibold">{{ $ekskul->kuota }} Siswa</p>
                            </div>
                        </div>
                        @endif
                    </div>

                    @if($ekskul->deskripsi)
                    <div class="mb-8">
                        <h2 class="mb-4 text-xl font-bold" style="color: var(--gray-800)">Deskripsi</h2>
                        <div class="prose max-w-none" style="color: var(--gray-600)">
                            {!! $ekskul->deskripsi !!}
                        </div>
                    </div>
                    @endif

                    @if($ekskul->prestasi)
                    <div class="mb-8">
                        <h2 class="mb-4 text-xl font-bold" style="color: var(--gray-800)">🏆 Prestasi</h2>
                        <div class="prose max-w-none" style="color: var(--gray-600)">
                            {!! $ekskul->prestasi !!}
                        </div>
                    </div>
                    @endif

                    <!-- Tombol Kembali -->
                    <div class="pt-4 text-center">
                        <a href="{{ route('ekskul.index') }}" class="inline-flex items-center gap-2 px-6 py-3 text-white transition rounded-lg hover:shadow-lg" style="background: linear-gradient(135deg, var(--primary), var(--primary-dark))">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali ke Daftar Ekskul
                        </a>
                    </div>
                </div>
            </div>

            <!-- Ekskul Lainnya -->
            @if($ekskulLain->count() > 0)
            <div class="mt-12">
                <h3 class="mb-6 text-xl font-bold text-center" style="color: var(--gray-800)">Ekskul Lainnya</h3>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
                    @foreach($ekskulLain as $item)
                    <a href="{{ route('ekskul.show', $item->id) }}" class="overflow-hidden transition bg-white shadow-md rounded-xl hover:shadow-lg group" style="border: 1px solid var(--primary-100)">
                        <div class="h-32 overflow-hidden">
                            @if($item->gambar && file_exists(public_path('storage/' . $item->gambar)))
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_ekskul }}" class="object-cover w-full h-full transition group-hover:scale-110">
                            @else
                                <div class="flex items-center justify-center w-full h-full" style="background: linear-gradient(135deg, var(--primary-100) 0%, var(--primary-50) 100%)">
                                    <svg class="w-10 h-10 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-3 text-center">
                            <h4 class="text-sm font-semibold transition group-hover:text-primary">{{ $item->nama_ekskul }}</h4>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection
