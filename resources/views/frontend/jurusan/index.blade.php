@extends('layouts.app')

@section('content')
<!-- Page Title -->
<section class="relative py-16 overflow-hidden text-center bg-white lg:py-20">
    <div class="container px-4 mx-auto">
        <h1 class="text-4xl font-bold sm:text-5xl" style="color: var(--gray-900)">
            Jurusan <span style="color: var(--primary))">Kami</span>
        </h1>
        <div class="w-20 h-1 mx-auto mt-4 rounded-full" style="background-color: var(--primary)"></div>
        <p class="max-w-2xl mx-auto mt-4 text-lg text-gray-600">
            Pilih jurusan yang sesuai dengan minat dan bakat Anda
        </p>
    </div>
</section>

<!-- Jurusan Grid -->
<section class="py-16 bg-white">
    <div class="container px-4 mx-auto">
        @if($jurusans->count() > 0)
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach($jurusans as $jurusan)
                <a href="{{ route('jurusan.show', $jurusan->id) }}" class="group">
                    <div class="overflow-hidden transition-all duration-300 bg-white shadow-md rounded-2xl hover:shadow-xl" style="border: 1px solid var(--primary-100)">
                        <!-- Gambar Jurusan -->
                        <div class="h-48 overflow-hidden">
                            @if($jurusan->gambar && file_exists(public_path('storage/' . $jurusan->gambar)))
                                <img src="{{ asset('storage/' . $jurusan->gambar) . '?v=' . time() }}"
                                     alt="{{ $jurusan->nama_jurusan }}"
                                     class="object-cover w-full h-full transition duration-500 group-hover:scale-110">
                            @else
                                <div class="flex items-center justify-center w-full h-full" style="background: linear-gradient(135deg, var(--primary-100) 0%, var(--primary-50) 100%)">
                                    <svg class="w-20 h-20 transition text-primary group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-5">
                            <div class="inline-block px-2 py-1 mb-2 text-xs font-semibold rounded" style="background-color: var(--primary-100); color: var(--primary)">
                                {{ $jurusan->kode_jurusan }}
                            </div>
                            <h3 class="mb-2 text-xl font-bold transition group-hover:text-primary">{{ $jurusan->nama_jurusan }}</h3>
                            <p class="text-sm text-gray-600 line-clamp-2">{{ Str::limit($jurusan->deskripsi, 100) }}</p>
                            <div class="flex items-center gap-1 mt-3 text-sm font-semibold transition-all text-primary group-hover:gap-2">
                                Selengkapnya
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        @else
            <div class="py-12 text-center">
                <svg class="w-24 h-24 mx-auto mb-4" style="color: var(--primary-300)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                </svg>
                <p class="text-gray-600">Belum ada data jurusan</p>
            </div>
        @endif
    </div>
</section>
@endsection
