@extends('layouts.app')

@section('content')
<!-- Page Title -->
<section class="relative py-16 overflow-hidden text-center bg-white lg:py-20">
    <div class="container px-4 mx-auto">
        <h1 class="text-4xl font-bold sm:text-5xl" style="color: var(--gray-900)">
            Ekstrakurikuler <span style="color: var(--primary)">Sekolah</span>
        </h1>
        <div class="w-20 h-1 mx-auto mt-4 rounded-full" style="background-color: var(--primary)"></div>
        <p class="max-w-2xl mx-auto mt-4 text-lg text-gray-600">
            Wadah mengembangkan minat, bakat, dan kreativitas siswa
        </p>
    </div>
</section>

<!-- Ekskul Grid -->
<section class="py-16 bg-white">
    <div class="container px-4 mx-auto">
        @if($ekskuls->count() > 0)
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach($ekskuls as $ekskul)
                <a href="{{ route('ekskul.show', $ekskul->id) }}" class="group">
                    <div class="overflow-hidden transition-all duration-300 bg-white shadow-md rounded-2xl hover:shadow-xl" style="border: 1px solid var(--primary-100)">
                        <!-- Gambar Ekskul -->
                        <div class="h-48 overflow-hidden">
                            @if($ekskul->gambar && file_exists(public_path('storage/' . $ekskul->gambar)))
                                <img src="{{ asset('storage/' . $ekskul->gambar) . '?v=' . filemtime(public_path('storage/' . $ekskul->gambar)) }}"
                                     alt="{{ $ekskul->nama_ekskul }}"
                                     class="object-cover w-full h-full transition duration-500 group-hover:scale-110">
                            @else
                                <div class="flex items-center justify-center w-full h-full" style="background: linear-gradient(135deg, var(--primary-100) 0%, var(--primary-50) 100%)">
                                    <svg class="w-20 h-20 transition text-primary group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-5 text-center">
                            <h3 class="text-lg font-bold transition group-hover:text-primary">{{ $ekskul->nama_ekskul }}</h3>
                            @if($ekskul->pembina)
                                <p class="mt-1 text-sm text-gray-500">Pembina: {{ $ekskul->pembina->nama_lengkap }}</p>
                            @endif
                            @if($ekskul->jadwal_latihan)
                                <p class="mt-2 text-xs text-primary">📅 {{ $ekskul->jadwal_latihan }}</p>
                            @endif
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        @else
            <div class="py-12 text-center">
                <svg class="w-24 h-24 mx-auto mb-4" style="color: var(--primary-300)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <p class="text-gray-600">Belum ada data ekstrakurikuler</p>
            </div>
        @endif
    </div>
</section>
@endsection
