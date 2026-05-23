@extends('layouts.app')

@section('content')
<!-- Page Title Section -->
<section class="relative overflow-hidden bg-white">
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] rounded-full blur-3xl" style="background-color: var(--primary-50)"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] rounded-full blur-3xl opacity-30" style="background-color: var(--primary-50)"></div>
    </div>

    <div class="relative container mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20 text-center">
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight" style="color: var(--gray-900)">
            Galeri <span style="color: var(--primary)">Sekolah</span>
        </h1>
        <div class="w-20 h-1 mx-auto mt-4 rounded-full" style="background-color: var(--primary)"></div>
        <p class="mt-4 text-lg max-w-2xl mx-auto" style="color: var(--gray-600)">
            Dokumentasi kegiatan dan fasilitas sekolah dalam foto dan video
        </p>
    </div>
</section>

<!-- Filter Tabs -->
<section class="py-8 bg-white border-b" style="border-color: var(--gray-100)">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('galeri', ['type' => 'foto']) }}"
               class="px-6 py-2 rounded-full text-sm font-medium transition-all duration-300 {{ $type == 'foto' ? 'text-white' : 'bg-gray-100 text-gray-600 hover:bg-primary-100' }}"
               style="{{ $type == 'foto' ? 'background: linear-gradient(135deg, var(--primary), var(--primary-dark))' : '' }}">
                📸 Galeri Foto
            </a>
            <a href="{{ route('galeri', ['type' => 'video']) }}"
               class="px-6 py-2 rounded-full text-sm font-medium transition-all duration-300 {{ $type == 'video' ? 'text-white' : 'bg-gray-100 text-gray-600 hover:bg-primary-100' }}"
               style="{{ $type == 'video' ? 'background: linear-gradient(135deg, var(--primary), var(--primary-dark))' : '' }}">
                🎬 Galeri Video
            </a>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="py-16 lg:py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                @if($type == 'video')
                    <!-- Video Grid -->
                    @if($videos && $videos->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($videos as $video)
                            <div class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 group" style="border: 1px solid var(--primary-100)">
                                <div class="relative aspect-video overflow-hidden bg-black">
                                    @if($video->url_youtube)
                                        <iframe class="w-full h-full"
                                                src="https://www.youtube.com/embed/{{ $video->embed_url ?? extractYouTubeId($video->url_youtube) }}"
                                                frameborder="0"
                                                allowfullscreen>
                                        </iframe>
                                    @else
                                        <div class="w-full h-full flex items-center justify-center" style="background: linear-gradient(135deg, var(--primary-100) 0%, var(--primary-50) 100%)">
                                            <svg class="w-16 h-16" style="color: var(--primary-300)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-4">
                                    <h3 class="font-bold text-lg mb-1 line-clamp-1" style="color: var(--gray-800)">{{ $video->judul }}</h3>
                                    <p class="text-sm line-clamp-2" style="color: var(--gray-600)">{{ $video->deskripsi }}</p>
                                    <p class="text-xs mt-2" style="color: var(--gray-400)">{{ $video->tanggal ? $video->tanggal->format('d M Y') : '-' }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-10">
                            {{ $videos->appends(['type' => 'video'])->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="w-24 h-24 mx-auto mb-4" style="color: var(--primary-300)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-lg" style="color: var(--gray-600)">Belum ada video</p>
                            <p class="text-sm mt-2" style="color: var(--gray-500)">Silakan cek kembali nanti</p>
                        </div>
                    @endif
                @else
                    <!-- Album Grid -->
                    @if($albums && $albums->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($albums as $album)
                            <a href="{{ route('galeri.album', $album->id) }}" class="group">
                                <div class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300" style="border: 1px solid var(--primary-100)">
                                    <div class="relative h-48 overflow-hidden">
                                        @php
                                            $coverFoto = $album->foto->first();
                                        @endphp
                                        @if($coverFoto && $coverFoto->foto)
                                            <img src="{{ asset('storage/' . $coverFoto->foto) }}"
                                                 alt="{{ $album->nama_album }}"
                                                 class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                        @elseif($album->cover)
                                            <img src="{{ asset('storage/' . $album->cover) }}"
                                                 alt="{{ $album->nama_album }}"
                                                 class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center" style="background: linear-gradient(135deg, var(--primary-100) 0%, var(--primary-50) 100%)">
                                                <svg class="w-16 h-16" style="color: var(--primary-300)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                                            <span class="bg-white/90 text-gray-800 px-4 py-2 rounded-full text-sm font-semibold">Lihat Album →</span>
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <h3 class="font-bold text-lg mb-1" style="color: var(--gray-800)">{{ $album->nama_album }}</h3>
                                        <p class="text-sm line-clamp-2" style="color: var(--gray-600)">{{ $album->deskripsi }}</p>
                                        <div class="flex items-center justify-between mt-3">
                                            <p class="text-xs" style="color: var(--gray-400)">{{ $album->tanggal ? $album->tanggal->format('d M Y') : '-' }}</p>
                                            <p class="text-xs" style="color: var(--primary)">{{ $album->foto->count() }} foto</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-10">
                            {{ $albums->appends(['type' => 'foto'])->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="w-24 h-24 mx-auto mb-4" style="color: var(--primary-300)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-lg" style="color: var(--gray-600)">Belum ada album foto</p>
                            <p class="text-sm mt-2" style="color: var(--gray-500)">Silakan cek kembali nanti</p>
                        </div>
                    @endif
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Album Terbaru -->
                @if($albumTerbaru && $albumTerbaru->count() > 0)
                <div class="bg-white rounded-2xl p-6 shadow-md mb-6" style="border: 1px solid var(--primary-100)">
                    <h3 class="text-lg font-bold mb-4 pb-2 border-b" style="color: var(--gray-800); border-color: var(--primary-100)">
                        📸 Album Terbaru
                    </h3>
                    <div class="space-y-3">
                        @foreach($albumTerbaru as $album)
                        <a href="{{ route('galeri.album', $album->id) }}" class="flex items-center gap-3 group">
                            @php
                                $coverFoto = $album->foto->first();
                            @endphp
                            <div class="w-16 h-16 rounded-lg overflow-hidden flex-shrink-0">
                                @if($coverFoto && $coverFoto->foto)
                                    <img src="{{ asset('storage/' . $coverFoto->foto) }}" alt="{{ $album->nama_album }}" class="w-full h-full object-cover group-hover:scale-105 transition">
                                @else
                                    <div class="w-full h-full flex items-center justify-center" style="background-color: var(--primary-100)">
                                        <svg class="w-6 h-6" style="color: var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-semibold group-hover:text-primary transition line-clamp-1" style="color: var(--gray-700)">{{ $album->nama_album }}</h4>
                                <p class="text-xs" style="color: var(--gray-400)">{{ $album->foto->count() }} foto</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Video Terbaru -->
                @if($videoTerbaru && $videoTerbaru->count() > 0)
                <div class="bg-white rounded-2xl p-6 shadow-md" style="border: 1px solid var(--primary-100)">
                    <h3 class="text-lg font-bold mb-4 pb-2 border-b" style="color: var(--gray-800); border-color: var(--primary-100)">
                        🎬 Video Terbaru
                    </h3>
                    <div class="space-y-3">
                        @foreach($videoTerbaru as $video)
                        <div class="flex items-center gap-3">
                            <div class="w-16 h-12 rounded-lg overflow-hidden flex-shrink-0 bg-black">
                                @if($video->thumbnail)
                                    <img src="{{ $video->thumbnail }}" alt="{{ $video->judul }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center" style="background-color: var(--primary-100)">
                                        <svg class="w-6 h-6" style="color: var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-semibold line-clamp-1" style="color: var(--gray-700)">{{ $video->judul }}</h4>
                                <p class="text-xs" style="color: var(--gray-400)">{{ $video->tanggal ? $video->tanggal->format('d M Y') : '-' }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
