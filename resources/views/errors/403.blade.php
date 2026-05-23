@extends('layouts.app')

@section('content')
<section class="py-20 bg-white">
    <div class="container px-4 mx-auto text-center">
        <div class="max-w-lg mx-auto">
            <div class="mb-6 font-bold text-8xl" style="color: var(--primary)">403</div>
            <h1 class="mb-4 text-3xl font-bold" style="color: var(--gray-900)">Akses Ditolak</h1>
            <p class="mb-8 text-gray-600">Anda tidak memiliki izin untuk mengakses halaman ini.</p>
            <a href="{{ route('home') }}" class="inline-block px-6 py-3 text-white transition rounded-lg" style="background-color: var(--primary)">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</section>
@endsection
