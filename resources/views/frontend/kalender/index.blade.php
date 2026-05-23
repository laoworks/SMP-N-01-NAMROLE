@extends('layouts.app')

@section('content')
<section class="py-16 bg-white">
    <div class="container px-4 mx-auto">
        <div class="mb-12 text-center">
            <h1 class="text-4xl font-bold" style="color: var(--gray-900)">Kalender <span style="color: var(--primary)">Akademik</span></h1>
            <div class="w-20 h-1 mx-auto mt-4 rounded-full" style="background-color: var(--primary)"></div>
            <p class="mt-4 text-gray-600">Jadwal kegiatan akademik tahun ajaran {{ date('Y') }}/{{ date('Y')+1 }}</p>
        </div>

        @if($events->count() > 0)
            <div class="max-w-4xl mx-auto">
                @foreach($eventsByMonth as $month => $monthEvents)
                <div class="mb-8">
                    <h2 class="pb-2 mb-4 text-2xl font-bold border-b" style="color: var(--gray-800); border-color: var(--primary-100)">{{ $month }}</h2>
                    <div class="space-y-3">
                        @foreach($monthEvents as $event)
                        @php
                            $warna = $event->warna ?? '#4361ee';
                        @endphp
                        <div class="p-4 bg-white rounded-lg shadow-sm" style="border-left: 4px solid {{ $warna }}">
                            <div class="flex flex-wrap items-start justify-between">
                                <div>
                                    <h3 class="font-semibold">{{ $event->judul_kegiatan }}</h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        📅 {{ \Carbon\Carbon::parse($event->tanggal_mulai)->format('d M Y') }}
                                        @if($event->tanggal_selesai)
                                            - {{ \Carbon\Carbon::parse($event->tanggal_selesai)->format('d M Y') }}
                                        @endif
                                        @if($event->waktu) • 🕐 {{ $event->waktu }} @endif
                                    </p>
                                    @if($event->tempat)
                                        <p class="text-sm text-gray-500">📍 {{ $event->tempat }}</p>
                                    @endif
                                </div>
                                <span class="px-2 py-1 text-xs rounded-full" style="background-color: var(--primary-100); color: var(--primary)">
                                    {{ ucfirst($event->jenis) }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="py-12 text-center">
                <svg class="w-24 h-24 mx-auto mb-4" style="color: var(--primary-300)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <p class="text-gray-600">Belum ada data kalender akademik</p>
            </div>
        @endif
    </div>
</section>
@endsection
