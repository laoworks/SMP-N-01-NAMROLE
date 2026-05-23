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
            Alumni <span style="color: var(--primary)">Kami</span>
        </h1>
        <div class="w-20 h-1 mx-auto mt-4 rounded-full" style="background-color: var(--primary)"></div>
        <p class="max-w-2xl mx-auto mt-4 text-lg" style="color: var(--gray-600)">
            Kisah sukses dan perjalanan alumni {{ $settings->nama_website ?? 'Sekolah Kami' }}
        </p>
    </div>
</section>

<!-- Statistik Alumni -->
<section class="py-12 bg-white">
    <div class="container px-4 mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <div class="p-6 text-center bg-gradient-to-r from-primary-50 to-primary-100 rounded-2xl">
                <div class="text-4xl font-bold" style="color: var(--primary)">{{ $totalAlumni }}+</div>
                <p class="mt-2 text-gray-600">Total Alumni</p>
            </div>
            <div class="p-6 text-center bg-gradient-to-r from-primary-50 to-primary-100 rounded-2xl">
                <div class="text-4xl font-bold" style="color: var(--primary)">{{ $totalTahun }}+</div>
                <p class="mt-2 text-gray-600">Angkatan</p>
            </div>
            <div class="p-6 text-center bg-gradient-to-r from-primary-50 to-primary-100 rounded-2xl">
                <div class="text-4xl font-bold" style="color: var(--primary)">100%</div>
                <p class="mt-2 text-gray-600">Terserap Kerja/Kuliah</p>
            </div>
        </div>
    </div>
</section>

<!-- Filter & Grid -->
<section class="py-16 bg-white lg:py-20">
    <div class="container px-4 mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            <!-- Sidebar Filter -->
            <div class="lg:col-span-1">
                <div class="p-6 mb-6 bg-white shadow-md rounded-2xl" style="border: 1px solid var(--primary-100)">
                    <h3 class="pb-2 mb-4 text-lg font-bold border-b" style="color: var(--gray-800); border-color: var(--primary-100)">
                        Filter Jurusan
                    </h3>
                    <div class="space-y-2">
                        <a href="{{ route('alumni') }}" class="block px-3 py-2 text-gray-600 transition rounded-lg hover:bg-primary-50 hover:text-primary">
                            Semua Jurusan
                        </a>
                        @foreach($jurusan as $j)
                        <a href="{{ route('alumni.jurusan', $j->id) }}" class="block px-3 py-2 text-gray-600 transition rounded-lg hover:bg-primary-50 hover:text-primary">
                            {{ $j->nama_jurusan }}
                        </a>
                        @endforeach
                    </div>
                </div>

                <div class="p-6 bg-white shadow-md rounded-2xl" style="border: 1px solid var(--primary-100)">
                    <h3 class="pb-2 mb-4 text-lg font-bold border-b" style="color: var(--gray-800); border-color: var(--primary-100)">
                        Alumni Terbaru
                    </h3>
                    <div class="space-y-3">
                        @foreach($alumniTerbaru as $item)
                        <a href="{{ route('alumni.show', $item->id) }}" class="flex items-center gap-3 group">
                            <div class="w-10 h-10 overflow-hidden rounded-full bg-primary-100">
                                @if($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_lengkap }}" class="object-cover w-full h-full">
                                @else
                                    <div class="flex items-center justify-center w-full h-full font-bold text-primary">
                                        {{ substr($item->nama_lengkap, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <div>
                                <p class="text-sm font-semibold transition group-hover:text-primary">{{ $item->nama_lengkap }}</p>
                                <p class="text-xs text-gray-500">Angkatan {{ $item->tahun_lulus }}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Alumni Grid -->
            <div class="lg:col-span-2">
                @if($alumnis->count() > 0)
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        @foreach($alumnis as $alumni)
                        <a href="{{ route('alumni.show', $alumni->id) }}" class="group">
                            <div class="p-5 transition-all duration-300 bg-white shadow-md rounded-2xl hover:shadow-xl" style="border: 1px solid var(--primary-100)">
                                <div class="flex gap-4">
                                    <div class="flex-shrink-0 w-20 h-20 overflow-hidden rounded-full bg-primary-100">
                                        @if($alumni->foto)
                                            <img src="{{ asset('storage/' . $alumni->foto) }}" alt="{{ $alumni->nama_lengkap }}" class="object-cover w-full h-full">
                                        @else
                                            <div class="flex items-center justify-center w-full h-full text-2xl font-bold text-primary">
                                                {{ substr($alumni->nama_lengkap, 0, 1) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-lg font-bold transition group-hover:text-primary">{{ $alumni->nama_lengkap }}</h3>
                                        <p class="text-sm text-gray-500">Angkatan {{ $alumni->tahun_lulus }}</p>
                                        @if($alumni->jurusan)
                                            <p class="mt-1 text-xs text-primary">{{ $alumni->jurusan->nama_jurusan }}</p>
                                        @endif
                                        <p class="mt-2 text-sm text-gray-600 line-clamp-2">{{ Str::limit($alumni->kisah_sukses, 100) }}</p>
                                        <div class="flex items-center gap-2 mt-2 text-xs">
                                            @if($alumni->pekerjaan)
                                                <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full">{{ $alumni->pekerjaan }}</span>
                                            @endif
                                            @if($alumni->universitas)
                                                <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full">{{ $alumni->universitas }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-10">
                        {{ $alumnis->links() }}
                    </div>
                @else
                    <div class="py-12 text-center">
                        <svg class="w-24 h-24 mx-auto mb-4" style="color: var(--primary-300)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <p class="text-gray-600">Belum ada data alumni</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
