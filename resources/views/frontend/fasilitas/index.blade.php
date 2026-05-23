@extends('layouts.app')

@section('content')
<!-- Page Title -->
<section class="relative py-16 overflow-hidden text-center bg-white lg:py-20">
    <div class="container px-4 mx-auto">
        <h1 class="text-4xl font-bold sm:text-5xl" style="color: var(--gray-900)">
            Fasilitas <span style="color: var(--primary)">Sekolah</span>
        </h1>
        <div class="w-20 h-1 mx-auto mt-4 rounded-full" style="background-color: var(--primary)"></div>
        <p class="max-w-2xl mx-auto mt-4 text-lg text-gray-600">
            Fasilitas modern untuk mendukung proses belajar mengajar yang nyaman dan berkualitas
        </p>
    </div>
</section>

<!-- Fasilitas Grid -->
<section class="py-16 bg-white">
    <div class="container px-4 mx-auto">
        @if($fasilitas->count() > 0)
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach($fasilitas as $item)
                <div class="overflow-hidden transition-all duration-300 bg-white shadow-md group rounded-2xl hover:shadow-xl" style="border: 1px solid var(--primary-100)">
                    <!-- Gambar -->
                    <div class="h-56 overflow-hidden">
                        @if($item->gambar && file_exists(public_path('storage/' . $item->gambar)))
                            <img src="{{ asset('storage/' . $item->gambar) . '?v=' . time() }}"
                                 alt="{{ $item->nama_fasilitas }}"
                                 class="object-cover w-full h-full transition duration-500 group-hover:scale-110">
                        @else
                            <div class="flex items-center justify-center w-full h-full" style="background: linear-gradient(135deg, var(--primary-100) 0%, var(--primary-50) 100%)">
                                <svg class="w-20 h-20 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-5">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-xl font-bold transition group-hover:text-primary">{{ $item->nama_fasilitas }}</h3>
                            <span class="px-2 py-1 text-xs rounded-full" style="background-color: var(--primary-100); color: var(--primary)">
                                {{ $item->jumlah ?? '1' }} Unit
                            </span>
                        </div>
                        <p class="mb-3 text-sm text-gray-600">{{ Str::limit(strip_tags($item->deskripsi), 100) }}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-400">Kondisi: {{ $item->kondisi ?? 'Baik' }}</span>
                            <span class="px-2 py-1 text-xs rounded-full" style="background-color: var(--primary-100); color: var(--primary)">
                                {{ $item->status == 'aktif' ? 'Tersedia' : 'Tidak Tersedia' }}
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="py-12 text-center">
                <svg class="w-24 h-24 mx-auto mb-4" style="color: var(--primary-300)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"></path>
                </svg>
                <p class="text-gray-600">Belum ada data fasilitas</p>
            </div>
        @endif
    </div>
</section>
@endsection
