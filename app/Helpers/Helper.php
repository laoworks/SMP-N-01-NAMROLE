<?php

if (!function_exists('formatTanggal')) {
    function formatTanggal($date)
    {
        if (!$date) return '-';
        return \Carbon\Carbon::parse($date)->translatedFormat('d F Y');
    }
}

if (!function_exists('formatTanggalIndo')) {
    function formatTanggalIndo($date)
    {
        if (!$date) return '-';
        return \Carbon\Carbon::parse($date)->translatedFormat('d F Y');
    }
}

if (!function_exists('extractYouTubeId')) {
    function extractYouTubeId($url)
    {
        if (!$url) return '';
        preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([\w-]+)/', $url, $matches);
        return $matches[1] ?? '';
    }
}

if (!function_exists('limitWords')) {
    function limitWords($text, $limit = 20)
    {
        if (!$text) return '';
        $words = explode(' ', strip_tags($text));
        if (count($words) <= $limit) return $text;
        return implode(' ', array_slice($words, 0, $limit)) . '...';
    }
}
