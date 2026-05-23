@extends('layouts.app')

@section('content')
<section class="py-20 bg-white">
    <div class="container px-4 mx-auto text-center">
        <div class="max-w-lg mx-auto">
            <div class="mb-6 font-bold text-8xl" style="color: var(--primary)">500</div>
            <h1 class="mb-4 text-3xl font-bold" style="color: var(--gray-900)">Terjadi Kesalahan Server</h1>
            <p class="mb-8 text-gray-600">Maaf, terjadi kesalahan pada server kami. Silakan coba lagi nanti.</p>
            <a href="{{ route('home') }}" class="inline-block px-6 py-3 text-white transition rounded-lg hover:opacity-90" style="background-color: var(--primary)">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</section>
@endsection
