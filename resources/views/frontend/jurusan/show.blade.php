@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    @if($jurusan->gambar)
                        <img src="{{ asset('storage/' . $jurusan->gambar) }}" alt="{{ $jurusan->nama_jurusan }}" class="w-full h-64 object-cover">
                    @endif
                    <div class="p-6">
                        <div class="inline-block bg-primary-light text-primary text-xs px-2 py-1 rounded mb-3">
                            {{ $jurusan->kode_jurusan }}
                        </div>
                        <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $jurusan->nama_jurusan }}</h1>

                        <h3 class="text-xl font-semibold text-gray-800 mt-6 mb-3">Deskripsi Jurusan</h3>
                        <div class="prose max-w-none">
                            {!! $jurusan->deskripsi !!}
                        </div>

                        <h3 class="text-xl font-semibold text-gray-800 mt-6 mb-3">Kurikulum</h3>
                        <div class="prose max-w-none">
                            {!! $jurusan->kurikulum !!}
                        </div>

                        <h3 class="text-xl font-semibold text-gray-800 mt-6 mb-3">Prospek Karir</h3>
                        <div class="prose max-w-none">
                            {!! $jurusan->prospek_karir !!}
                        </div>

                        <h3 class="text-xl font-semibold text-gray-800 mt-6 mb-3">Fasilitas Jurusan</h3>
                        <div class="prose max-w-none">
                            {!! $jurusan->fasilitas !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div>
                <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Jurusan Lainnya</h3>
                    <div class="space-y-3">
                        @foreach($jurusans as $item)
                            @if($item->id != $jurusan->id)
                            <a href="{{ route('jurusan.show', $item->id) }}" class="block p-3 bg-gray-50 rounded-lg hover:bg-primary-light transition">
                                <div class="font-semibold text-gray-800">{{ $item->nama_jurusan }}</div>
                                <div class="text-xs text-gray-500">{{ $item->singkatan }}</div>
                            </a>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="bg-primary text-white rounded-xl shadow-md p-6 text-center">
                    <h3 class="text-lg font-bold mb-2">Tertarik Mendaftar?</h3>
                    <p class="text-sm mb-4">Segera daftarkan diri Anda sekarang juga!</p>
                    <a href="{{ route('ppdb') }}" class="inline-block bg-white text-primary px-6 py-2 rounded-lg font-semibold hover:bg-gray-100 transition">
                        Daftar Sekarang →
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
