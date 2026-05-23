@extends('layouts.app')

@section('content')
<section class="py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto text-center">
            <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold mb-4" style="color: var(--gray-900)">Pendaftaran Berhasil!</h1>
            <p class="text-gray-600 mb-6">Terima kasih telah mendaftar di {{ $settings->nama_website ?? 'Sekolah Kami' }}</p>

            <div class="bg-gray-50 rounded-2xl p-6 mb-6">
                <p class="text-sm text-gray-500 mb-2">Nomor Pendaftaran Anda:</p>
                <p class="text-2xl font-bold" style="color: var(--primary)">{{ $pendaftar->no_pendaftaran }}</p>
                <p class="text-xs text-gray-400 mt-2">Simpan nomor ini untuk keperluan selanjutnya</p>
            </div>

            <div class="bg-yellow-50 rounded-2xl p-6 mb-8 text-left">
                <h3 class="font-semibold mb-2" style="color: var(--gray-800)">Informasi Penting:</h3>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li>✓ Silakan simpan nomor pendaftaran Anda</li>
                    <li>✓ Data akan diverifikasi oleh petugas</li>
                    <li>✓ Status pendaftaran dapat dicek melalui kontak sekolah</li>
                    <li>✓ Pengumuman akan diinformasikan melalui SMS/WhatsApp</li>
                </ul>
            </div>

            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ route('home') }}" class="px-6 py-3 rounded-lg text-white font-semibold transition" style="background: linear-gradient(135deg, var(--primary), var(--primary-dark))">
                    Kembali ke Beranda
                </a>
                <button onclick="window.print()" class="px-6 py-3 rounded-lg border font-semibold transition" style="border-color: var(--gray-300); color: var(--gray-700)">
                    Cetak Bukti
                </button>
            </div>
        </div>
    </div>
</section>
@endsection
