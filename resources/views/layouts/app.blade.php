<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $settings->nama_website ?? 'Website Sekolah' }} - {{ $title ?? 'Home' }}</title>

    <!-- Favicon -->
    @if($settings && $settings->favicon)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $settings->favicon) }}">
    @endif

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Swiper JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Alpine JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

   <style>
    /* ========== CSS VARIABLES - WARNA KONSISTEN ========== */
    :root {
        --primary: {{ (isset($settings) && $settings && $settings->primary_color) ? $settings->primary_color : '#4361ee' }};
        --primary-rgb: {{ (isset($settings) && $settings && $settings->primary_color) ? hexdec(substr($settings->primary_color, 1, 2)) . ', ' . hexdec(substr($settings->primary_color, 3, 2)) . ', ' . hexdec(substr($settings->primary_color, 5, 2)) : '67, 97, 238' }};
        --primary-dark: {{ (isset($settings) && $settings && $settings->primary_color) ? $settings->primary_color : '#4361ee' }}dd;
        --primary-light: {{ (isset($settings) && $settings && $settings->primary_color) ? $settings->primary_color : '#4361ee' }}22;
        --primary-50: rgba(var(--primary-rgb), 0.05);
        --primary-100: rgba(var(--primary-rgb), 0.1);
        --primary-200: rgba(var(--primary-rgb), 0.2);
        --primary-300: rgba(var(--primary-rgb), 0.3);
        --primary-400: rgba(var(--primary-rgb), 0.4);
        --primary-500: rgba(var(--primary-rgb), 0.5);
        --primary-600: rgba(var(--primary-rgb), 0.6);
        --primary-700: rgba(var(--primary-rgb), 0.7);
        --primary-800: rgba(var(--primary-rgb), 0.8);
        --primary-900: rgba(var(--primary-rgb), 0.9);

        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-300: #d1d5db;
        --gray-400: #9ca3af;
        --gray-500: #6b7280;
        --gray-600: #4b5563;
        --gray-700: #374151;
        --gray-800: #1f2937;
        --gray-900: #111827;

        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --info: #3b82f6;
    }
</style>
    @stack('styles')
</head>
<body class="bg-gray-50">

    <!-- Navbar Component -->
    <x-navbar />

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer Component -->
    <x-footer />

    <!-- WhatsApp Floating Button -->
    @php
        $waSettings = \App\Models\PengaturanWa::where('is_active', true)->first();
    @endphp
    @if($waSettings && $waSettings->nomor_wa)
        <a href="https://wa.me/{{ $waSettings->nomor_wa }}?text={{ urlencode($waSettings->pesan_otomatis ?? 'Halo, saya ingin bertanya tentang sekolah') }}"
           target="_blank"
           class="fixed z-50 p-4 text-white transition-all transition duration-300 transform bg-green-500 rounded-full shadow-lg bottom-6 right-6 hover:bg-green-600 hover:scale-110 group">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.012.263 1.999.764 2.861L6.5 18.5l3.777-.997c.826.464 1.773.709 2.739.709 3.18 0 5.767-2.586 5.768-5.766.001-3.18-2.585-5.766-5.766-5.766zm1.391 8.333c-.182.309-.456.551-.828.657-.344.098-.768.155-1.216.155-1.083 0-1.992-.305-2.723-.914-.383-.319-.721-.717-.996-1.165-.274-.448-.459-.97-.548-1.502-.042-.251-.042-.504 0-.755.063-.378.238-.718.489-.989.125-.135.293-.213.471-.213h.199c.134 0 .266.066.342.176l.862 1.254c.079.115.112.259.092.398-.02.139-.079.263-.176.364l-.383.394c-.059.061-.079.15-.053.232.155.461.461.905.883 1.274.419.369.93.603 1.48.7.094.017.188-.011.257-.066l.479-.382c.111-.089.264-.119.401-.076l1.273.434c.139.047.237.158.264.299.026.141-.007.287-.093.4z"/>
            </svg>
            <span class="absolute px-2 py-1 mr-3 text-xs font-medium text-white transition bg-gray-800 rounded-lg opacity-0 right-full group-hover:opacity-100 whitespace-nowrap">
                Chat via WhatsApp
            </span>
        </a>
    @endif

    <script>
        AOS.init({ duration: 1000, once: true });

        // Smooth scroll untuk anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href !== "#" && href !== "#!" && href !== "") {
                    const target = document.querySelector(href);
                    if (target) {
                        e.preventDefault();
                        target.scrollIntoView({ behavior: 'smooth' });
                    }
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
