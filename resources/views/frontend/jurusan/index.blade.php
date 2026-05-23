@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-16">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12" data-aos="fade-up">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Jurusan Kami</h1>
            <div class="w-24 h-1 bg-primary mx-auto mb-4"></div>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Pilih jurusan yang sesuai dengan minat dan bakat Anda untuk masa depan yang cerah
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($jurusans as $jurusan)
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition" data-aos="fade-up">
                @if($jurusan->gambar)
                    <img src="{{ asset('storage/' . $jurusan->gambar) }}" alt="{{ $jurusan->nama_jurusan }}" class="w-full h-48 object-cover">
                @endif
                <div class="p-6">
                    <div class="inline-block bg-primary-light text-primary text-xs px-2 py-1 rounded mb-3">
                        {{ $jurusan->kode_jurusan }}
                    </div>
                    <h2 class="text-xl font-bold text-gray-800 mb-2">{{ $jurusan->nama_jurusan }}</h2>
                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($jurusan->deskripsi, 100) }}</p>
                    <a href="{{ route('jurusan.show', $jurusan->id) }}" class="text-primary font-semibold hover:underline">Selengkapnya →</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
