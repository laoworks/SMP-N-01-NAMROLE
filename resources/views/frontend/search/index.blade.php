@extends('layouts.app')

@section('content')
<section class="py-16 bg-white">
    <div class="container px-4 mx-auto">
        <div class="max-w-3xl mx-auto mb-12 text-center">
            <h1 class="text-4xl font-bold" style="color: var(--gray-900)">Pencarian</h1>
            <div class="w-20 h-1 mx-auto mt-4 rounded-full" style="background-color: var(--primary)"></div>
        </div>

        <!-- Form Pencarian -->
        <div class="max-w-2xl mx-auto mb-12">
            <form action="{{ route('search') }}" method="GET" class="flex gap-2">
                <input type="text" name="q" value="{{ $query }}"
                       placeholder="Cari berita, prestasi, fasilitas, ekskul..."
                       class="flex-1 px-5 py-3 border rounded-xl focus:outline-none focus:border-primary"
                       style="border-color: var(--gray-200)">
                <button type="submit" class="px-6 py-3 text-white transition rounded-xl hover:opacity-90" style="background-color: var(--primary)">
                    Cari
                </button>
            </form>
        </div>

        @if($query)
            @php $total = $results['berita']->count() + $results['prestasi']->count() + $results['fasilitas']->count() + $results['ekskul']->count(); @endphp

            @if($total > 0)
                <p class="mb-8 text-center text-gray-500">Menampilkan {{ $total }} hasil untuk "<strong>{{ $query }}</strong>"</p>

                <!-- Hasil Berita -->
                @if($results['berita']->count() > 0)
                <div class="mb-10">
                    <h2 class="pb-2 mb-4 text-xl font-bold border-b" style="color: var(--gray-800); border-color: var(--primary-100)">Berita & Pengumuman</h2>
                    <div class="space-y-4">
                        @foreach($results['berita'] as $item)
                        <a href="{{ route('berita.show', $item->slug) }}" class="block p-4 transition bg-gray-50 rounded-xl hover:bg-primary-50">
                            <h3 class="font-semibold text-gray-800">{{ $item->judul }}</h3>
                            <p class="mt-1 text-sm text-gray-500">{{ Str::limit(strip_tags($item->konten), 100) }}</p>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Hasil Prestasi -->
                @if($results['prestasi']->count() > 0)
                <div class="mb-10">
                    <h2 class="pb-2 mb-4 text-xl font-bold border-b" style="color: var(--gray-800); border-color: var(--primary-100)">Prestasi</h2>
                    <div class="space-y-4">
                        @foreach($results['prestasi'] as $item)
                        <div class="p-4 bg-gray-50 rounded-xl">
                            <h3 class="font-semibold text-gray-800">{{ $item->judul }}</h3>
                            <p class="mt-1 text-sm text-gray-500">{{ $item->tahun }} • {{ $item->tingkat }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Hasil Fasilitas -->
                @if($results['fasilitas']->count() > 0)
                <div class="mb-10">
                    <h2 class="pb-2 mb-4 text-xl font-bold border-b" style="color: var(--gray-800); border-color: var(--primary-100)">Fasilitas</h2>
                    <div class="space-y-4">
                        @foreach($results['fasilitas'] as $item)
                        <div class="p-4 bg-gray-50 rounded-xl">
                            <h3 class="font-semibold text-gray-800">{{ $item->nama_fasilitas }}</h3>
                            <p class="mt-1 text-sm text-gray-500">{{ Str::limit(strip_tags($item->deskripsi), 100) }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Hasil Ekskul -->
                @if($results['ekskul']->count() > 0)
                <div class="mb-10">
                    <h2 class="pb-2 mb-4 text-xl font-bold border-b" style="color: var(--gray-800); border-color: var(--primary-100)">Ekstrakurikuler</h2>
                    <div class="space-y-4">
                        @foreach($results['ekskul'] as $item)
                        <a href="{{ route('ekskul.show', $item->id) }}" class="block p-4 transition bg-gray-50 rounded-xl hover:bg-primary-50">
                            <h3 class="font-semibold text-gray-800">{{ $item->nama_ekskul }}</h3>
                            <p class="mt-1 text-sm text-gray-500">{{ Str::limit(strip_tags($item->deskripsi), 100) }}</p>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            @else
                <div class="py-12 text-center">
                    <svg class="w-24 h-24 mx-auto mb-4" style="color: var(--primary-300)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <p class="text-gray-600">Tidak ada hasil untuk "<strong>{{ $query }}</strong>"</p>
                    <p class="mt-2 text-sm text-gray-500">Coba dengan kata kunci lain</p>
                </div>
            @endif
        @else
            <div class="py-12 text-center">
                <svg class="w-24 h-24 mx-auto mb-4" style="color: var(--primary-300)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <p class="text-gray-600">Masukkan kata kunci untuk mencari</p>
            </div>
        @endif
    </div>
</section>
@endsection
