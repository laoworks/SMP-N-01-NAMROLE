@extends('layouts.app')

@section('content')
<section class="relative overflow-hidden bg-white">
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] rounded-full blur-3xl" style="background-color: var(--primary-50)"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] rounded-full blur-3xl opacity-30" style="background-color: var(--primary-50)"></div>
    </div>

    <div class="container relative px-4 py-16 mx-auto sm:px-6 lg:px-8 lg:py-20">
        <div class="max-w-5xl mx-auto">
            <nav class="flex mb-6 text-sm" style="color: var(--gray-500)">
                <a href="{{ route('home') }}" class="transition hover:text-primary">Beranda</a>
                <span class="mx-2">/</span>
                <a href="{{ route('jurusan.index') }}" class="transition hover:text-primary">Jurusan</a>
                <span class="mx-2">/</span>
                <span style="color: var(--gray-700)">{{ $jurusan->nama_jurusan }}</span>
            </nav>

            <div class="overflow-hidden bg-white shadow-xl rounded-2xl" style="border: 1px solid var(--primary-100)">
                <!-- Header -->
                @if($jurusan->gambar && file_exists(public_path('storage/' . $jurusan->gambar)))
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset('storage/' . $jurusan->gambar) . '?v=' . time() }}"
                             alt="{{ $jurusan->nama_jurusan }}"
                             class="object-cover w-full h-full">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <div class="inline-block px-3 py-1 mb-2 text-sm font-semibold rounded-full" style="background-color: var(--primary); color: white">
                                {{ $jurusan->kode_jurusan }}
                            </div>
                            <h1 class="text-3xl font-bold text-white">{{ $jurusan->nama_jurusan }}</h1>
                        </div>
                    </div>
                @else
                    <div class="relative h-48 overflow-hidden" style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%)">
                        <div class="absolute inset-0 bg-black/20"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <div class="inline-block px-3 py-1 mb-2 text-sm font-semibold rounded-full" style="background-color: white; color: var(--primary)">
                                {{ $jurusan->kode_jurusan }}
                            </div>
                            <h1 class="text-3xl font-bold text-white">{{ $jurusan->nama_jurusan }}</h1>
                        </div>
                    </div>
                @endif

                <div class="p-8">
                    <!-- Deskripsi -->
                    <div class="mb-8">
                        <h2 class="mb-4 text-xl font-bold" style="color: var(--gray-800)">📖 Deskripsi Jurusan</h2>
                        <div class="prose max-w-none" style="color: var(--gray-600)">
                            {!! $jurusan->deskripsi !!}
                        </div>
                    </div>

                    <!-- Kurikulum -->
                    @if($jurusan->kurikulum)
                    <div class="mb-8">
                        <h2 class="mb-4 text-xl font-bold" style="color: var(--gray-800)">📚 Kurikulum</h2>
                        <div class="prose max-w-none" style="color: var(--gray-600)">
                            {!! $jurusan->kurikulum !!}
                        </div>
                    </div>
                    @endif

                    <!-- Prospek Karir -->
                    @if($jurusan->prospek_karir)
                    <div class="mb-8">
                        <h2 class="mb-4 text-xl font-bold" style="color: var(--gray-800)">💼 Prospek Karir</h2>
                        <div class="prose max-w-none" style="color: var(--gray-600)">
                            {!! $jurusan->prospek_karir !!}
                        </div>
                    </div>
                    @endif

                    <!-- Fasilitas Jurusan -->
                    @if($jurusan->fasilitas)
                    <div class="mb-8">
                        <h2 class="mb-4 text-xl font-bold" style="color: var(--gray-800)">🏫 Fasilitas Jurusan</h2>
                        <div class="prose max-w-none" style="color: var(--gray-600)">
                            {!! $jurusan->fasilitas !!}
                        </div>
                    </div>
                    @endif

                    <!-- Tombol Daftar -->
                    <div class="pt-4 text-center">
                        <a href="{{ route('ppdb') }}" class="inline-flex items-center gap-2 px-8 py-3 font-semibold text-white transition rounded-lg hover:shadow-lg" style="background: linear-gradient(135deg, var(--primary), var(--primary-dark))">
                            Daftar Sekarang
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Jurusan Lainnya -->
            @if($jurusanLain->count() > 0)
            <div class="mt-12">
                <h3 class="mb-6 text-xl font-bold text-center" style="color: var(--gray-800)">Jurusan Lainnya</h3>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                    @foreach($jurusanLain as $item)
                    <a href="{{ route('jurusan.show', $item->id) }}" class="p-4 text-center transition bg-white shadow-md rounded-xl hover:shadow-lg group" style="border: 1px solid var(--primary-100)">
                        <div class="flex items-center justify-center w-16 h-16 mx-auto mb-3 rounded-full" style="background: linear-gradient(135deg, var(--primary-100) 0%, var(--primary-50) 100%)">
                            <span class="font-bold text-primary">{{ $item->singkatan }}</span>
                        </div>
                        <h4 class="text-sm font-semibold transition group-hover:text-primary">{{ $item->nama_jurusan }}</h4>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection
