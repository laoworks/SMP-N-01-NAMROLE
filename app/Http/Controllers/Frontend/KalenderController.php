<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\KalenderAkademik;
use App\Models\PengaturanWebsite;

class KalenderController extends Controller
{
    public function index()
    {
        $settings = PengaturanWebsite::first();
        $events = KalenderAkademik::where('is_published', true)
            ->orderBy('tanggal_mulai', 'asc')
            ->get();

        // Group by bulan
        $eventsByMonth = [];
        foreach ($events as $event) {
            $month = $event->tanggal_mulai->format('F Y');
            if (!isset($eventsByMonth[$month])) {
                $eventsByMonth[$month] = [];
            }
            $eventsByMonth[$month][] = $event;
        }

        return view('frontend.kalender.index', compact('settings', 'events', 'eventsByMonth'));
    }
}
