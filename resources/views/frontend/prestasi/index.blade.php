@extends('layouts.app')

@section('content')
<section class="py-16 bg-white">
    <div class="container px-4 mx-auto">
        <div class="mb-12 text-center">
            <h1 class="text-4xl font-bold" style="color: var(--gray-900)">Prestasi <span style="color: var(--primary)">Kami</span></h1>
            <div class="w-20 h-1 mx-auto mt-4 rounded-full" style="background-color: var(--primary)"></div>
            <p class="mt-4 text-gray-600">Berbagai prestasi membanggakan telah diraih oleh siswa-siswi kami</p>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($prestasis as $item)
            <div class="overflow-hidden bg-white shadow-md rounded-xl" style="border: 1px solid var(--primary-100)">
                @if($item->foto)
                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}" class="object-cover w-full h-48">
                @endif
                <div class="p-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="px-2 py-1 text-xs rounded-full" style="background-color: var(--primary-100); color: var(--primary)">{{ $item->tingkat }}</span>
                        <span class="text-sm text-gray-400">{{ $item->tahun }}</span>
                    </div>
                    <h3 class="mb-2 text-lg font-bold">{{ $item->judul }}</h3>
                    <p class="text-sm text-gray-600">{{ Str::limit($item->deskripsi, 100) }}</p>
                    <p class="mt-2 text-sm font-semibold text-primary">{{ $item->peserta_nama }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-10">
            {{ $prestasis->links() }}
        </div>
    </div>
</section>
@endsection
