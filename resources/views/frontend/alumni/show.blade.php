@extends('layouts.app')

@section('content')
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
                <a href="{{ route('alumni') }}" class="transition hover:text-primary">Alumni</a>
                <span class="mx-2">/</span>
                <span style="color: var(--gray-700)">{{ $alumni->nama_lengkap }}</span>
            </nav>

            <div class="overflow-hidden bg-white shadow-xl rounded-2xl" style="border: 1px solid var(--primary-100)">
                <div class="p-8 text-center">
                    <div class="w-32 h-32 mx-auto mb-4 overflow-hidden rounded-full bg-primary-100">
                        @if($alumni->foto)
                            <img src="{{ asset('storage/' . $alumni->foto) }}" alt="{{ $alumni->nama_lengkap }}" class="object-cover w-full h-full">
                        @else
                            <div class="flex items-center justify-center w-full h-full text-4xl font-bold text-primary">
                                {{ substr($alumni->nama_lengkap, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <h1 class="text-3xl font-bold" style="color: var(--gray-900)">{{ $alumni->nama_lengkap }}</h1>
                    <p class="mt-1 text-gray-500">Angkatan {{ $alumni->tahun_lulus }}</p>
                    @if($alumni->jurusan)
                        <p class="mt-1 text-primary">{{ $alumni->jurusan->nama_jurusan }}</p>
                    @endif
                </div>

                <div class="p-8 border-t border-gray-100">
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        @if($alumni->pekerjaan || $alumni->perusahaan)
                        <div>
                            <h3 class="mb-2 font-semibold" style="color: var(--gray-700)">💼 Pekerjaan</h3>
                            <p class="text-gray-600">{{ $alumni->pekerjaan }} di {{ $alumni->perusahaan }}</p>
                            @if($alumni->posisi)
                                <p class="mt-1 text-sm text-gray-500">Posisi: {{ $alumni->posisi }}</p>
                            @endif
                        </div>
                        @endif

                        @if($alumni->universitas)
                        <div>
                            <h3 class="mb-2 font-semibold" style="color: var(--gray-700)">🎓 Pendidikan</h3>
                            <p class="text-gray-600">{{ $alumni->universitas }}</p>
                            @if($alumni->jurusan_kuliah)
                                <p class="mt-1 text-sm text-gray-500">Jurusan: {{ $alumni->jurusan_kuliah }}</p>
                            @endif
                            @if($alumni->tahun_masuk_kuliah)
                                <p class="text-sm text-gray-500">Masuk: {{ $alumni->tahun_masuk_kuliah }}</p>
                            @endif
                        </div>
                        @endif
                    </div>

                    @if($alumni->kisah_sukses)
                    <div class="mt-6">
                        <h3 class="mb-2 font-semibold" style="color: var(--gray-700)">📖 Kisah Sukses</h3>
                        <div class="leading-relaxed text-gray-600">
                            {!! nl2br(e($alumni->kisah_sukses)) !!}
                        </div>
                    </div>
                    @endif

                    @if($alumni->prestasi_alumni)
                    <div class="mt-6">
                        <h3 class="mb-2 font-semibold" style="color: var(--gray-700)">🏆 Prestasi</h3>
                        <div class="text-gray-600">
                            {!! nl2br(e($alumni->prestasi_alumni)) !!}
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Alumni Lainnya -->
            @if($alumniLain->count() > 0)
            <div class="mt-12">
                <h3 class="mb-6 text-xl font-bold text-center" style="color: var(--gray-800)">Alumni Lainnya</h3>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    @foreach($alumniLain as $item)
                    <a href="{{ route('alumni.show', $item->id) }}" class="flex items-center gap-3 p-3 transition bg-gray-50 rounded-xl hover:bg-primary-50">
                        <div class="w-12 h-12 overflow-hidden rounded-full bg-primary-100">
                            @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_lengkap }}" class="object-cover w-full h-full">
                            @else
                                <div class="flex items-center justify-center w-full h-full font-bold text-primary">
                                    {{ substr($item->nama_lengkap, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <p class="font-semibold">{{ $item->nama_lengkap }}</p>
                            <p class="text-xs text-gray-500">Angkatan {{ $item->tahun_lulus }}</p>
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
