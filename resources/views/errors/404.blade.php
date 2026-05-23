@extends('layouts.app')

@section('content')
<section class="py-20 bg-white">
    <div class="container px-4 mx-auto text-center">
        <div class="max-w-lg mx-auto">
            <div class="mb-6 font-bold text-8xl" style="color: var(--primary)">404</div>
            <h1 class="mb-4 text-3xl font-bold" style="color: var(--gray-900)">Halaman Tidak Ditemukan</h1>
            <p class="mb-8 text-gray-600">Maaf, halaman yang Anda cari tidak tersedia atau telah dipindahkan.</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('home') }}" class="px-6 py-3 text-white transition rounded-lg hover:opacity-90" style="background-color: var(--primary)">
                    Kembali ke Beranda
                </a>
                <a href="{{ route('kontak') }}" class="px-6 py-3 text-gray-700 transition border rounded-lg hover:border-primary hover:text-primary">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
