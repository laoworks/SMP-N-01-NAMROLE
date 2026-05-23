@extends('layouts.app')

@section('content')
<!-- Page Title Section -->
<section class="relative overflow-hidden bg-white">
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] rounded-full blur-3xl" style="background-color: var(--primary-50)"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] rounded-full blur-3xl opacity-30" style="background-color: var(--primary-50)"></div>
    </div>

    <div class="relative container mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">
        <div class="max-w-4xl mx-auto text-center">
            <nav class="flex justify-center mb-6 text-sm" style="color: var(--gray-500)">
                <a href="{{ route('home') }}" class="hover:text-primary transition">Beranda</a>
                <span class="mx-2">/</span>
                <a href="{{ route('galeri') }}" class="hover:text-primary transition">Galeri</a>
                <span class="mx-2">/</span>
                <span style="color: var(--gray-700)">{{ $album->nama_album }}</span>
            </nav>

            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4" style="color: var(--gray-900)">
                {{ $album->nama_album }}
            </h1>
            <div class="w-20 h-1 mx-auto rounded-full" style="background-color: var(--primary)"></div>
            <p class="mt-4 text-lg max-w-2xl mx-auto" style="color: var(--gray-600)">
                {{ $album->deskripsi }}
            </p>
            <p class="mt-2 text-sm" style="color: var(--gray-400)">
                {{ $album->tanggal ? $album->tanggal->format('d F Y') : '' }} • {{ $album->foto->count() }} foto
            </p>
        </div>
    </div>
</section>

<!-- Foto Grid -->
<section class="py-16 lg:py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($fotos as $foto)
            <div class="group cursor-pointer" onclick="openLightbox('{{ asset('storage/' . $foto->foto) }}', '{{ $foto->judul }}', '{{ $foto->deskripsi }}')">
                <div class="relative overflow-hidden rounded-xl aspect-square">
                    <img src="{{ asset('storage/' . $foto->foto) }}"
                         alt="{{ $foto->judul ?? 'Foto' }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m-3-3h6"></path>
                        </svg>
                    </div>
                </div>
                @if($foto->judul)
                    <p class="text-sm text-center mt-2 line-clamp-1" style="color: var(--gray-600)">{{ $foto->judul }}</p>
                @endif
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-10">
            {{ $fotos->links() }}
        </div>

        <!-- Album Lain -->
        @if($albumLain && $albumLain->count() > 0)
        <div class="mt-16 pt-8 border-t" style="border-color: var(--gray-100)">
            <h3 class="text-xl font-bold mb-6 text-center" style="color: var(--gray-800)">Album Lainnya</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($albumLain as $item)
                <a href="{{ route('galeri.album', $item->id) }}" class="group">
                    <div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300" style="border: 1px solid var(--primary-100)">
                        @php
                            $coverFoto = $item->foto->first();
                        @endphp
                        <div class="h-36 overflow-hidden">
                            @if($coverFoto && $coverFoto->foto)
                                <img src="{{ asset('storage/' . $coverFoto->foto) }}" alt="{{ $item->nama_album }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center" style="background: linear-gradient(135deg, var(--primary-100) 0%, var(--primary-50) 100%)">
                                    <svg class="w-8 h-8" style="color: var(--primary-300)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-3">
                            <h4 class="font-semibold text-sm line-clamp-1 group-hover:text-primary transition" style="color: var(--gray-700)">{{ $item->nama_album }}</h4>
                            <p class="text-xs" style="color: var(--gray-400)">{{ $item->foto->count() }} foto</p>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 bg-black/90 z-50 hidden items-center justify-center" onclick="closeLightbox()">
    <div class="relative max-w-5xl w-full mx-4" onclick="event.stopPropagation()">
        <button onclick="closeLightbox()" class="absolute -top-12 right-0 text-white hover:text-gray-300 transition">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        <img id="lightbox-img" src="" alt="" class="w-full rounded-lg">
        <div id="lightbox-caption" class="text-center mt-4 text-white"></div>
        <div id="lightbox-desc" class="text-center mt-2 text-gray-300 text-sm"></div>
    </div>
</div>

<script>
    function openLightbox(src, title, desc) {
        document.getElementById('lightbox-img').src = src;
        document.getElementById('lightbox-caption').innerHTML = title || '';
        document.getElementById('lightbox-desc').innerHTML = desc || '';
        document.getElementById('lightbox').classList.remove('hidden');
        document.getElementById('lightbox').classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        document.getElementById('lightbox').classList.add('hidden');
        document.getElementById('lightbox').classList.remove('flex');
        document.body.style.overflow = 'auto';
    }

    // Close with ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeLightbox();
        }
    });
</script>
@endsection
