<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ (isset($settings) && $settings) ? $settings->nama_website : 'Website Sekolah' }}
        - {{ $title ?? 'Home' }}
    </title>

    {{-- Favicon --}}
    @if(isset($settings) && $settings && $settings->favicon)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $settings->favicon) }}">
    @endif

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- AOS --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    {{-- Swiper --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <style>
        :root {
            --primary: {{ (isset($settings) && $settings && $settings->primary_color) ? $settings->primary_color : '#4361ee' }};

            --primary-rgb:
                {{ (isset($settings) && $settings && $settings->primary_color)
                    ? hexdec(substr($settings->primary_color, 1, 2)) . ', ' .
                      hexdec(substr($settings->primary_color, 3, 2)) . ', ' .
                      hexdec(substr($settings->primary_color, 5, 2))
                    : '67, 97, 238'
                }};

            --primary-dark:
                {{ (isset($settings) && $settings && $settings->primary_color)
                    ? $settings->primary_color
                    : '#4361ee'
                }}dd;

            --primary-light:
                {{ (isset($settings) && $settings && $settings->primary_color)
                    ? $settings->primary_color
                    : '#4361ee'
                }}22;

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

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        * {
            -webkit-tap-highlight-color: transparent;
        }

        .transition-all {
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--gray-200);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }

        /* AOS */
        [data-aos] {
            opacity: 0;
            transition-property: opacity, transform;
            transition-timing-function: cubic-bezier(0.25, 0.1, 0.2, 1);
            pointer-events: none;
        }

        [data-aos].aos-animate {
            opacity: 1 !important;
            transform: translate(0, 0) !important;
            pointer-events: auto;
        }

        [data-aos="fade-up"] {
            transform: translateY(30px);
        }

        [data-aos="fade-down"] {
            transform: translateY(-30px);
        }

        [data-aos="fade-left"] {
            transform: translateX(30px);
        }

        [data-aos="fade-right"] {
            transform: translateX(-30px);
        }

        [data-aos="zoom-in"] {
            transform: scale(0.9);
        }

        @media (max-width: 768px) {
            [data-aos] {
                transition-duration: 0.4s !important;
            }

            [data-aos="fade-up"],
            [data-aos="fade-down"] {
                transform: translateY(20px);
            }

            [data-aos="fade-left"],
            [data-aos="fade-right"] {
                transform: translateX(20px);
            }
        }
    </style>

    @stack('styles')
</head>

<body class="bg-gray-50">

    {{-- Navbar --}}
    <x-navbar />

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <x-footer />

    {{-- WhatsApp Floating --}}
    @php
        $waSettings = \App\Models\PengaturanWa::where('is_active', true)->first();
    @endphp

    @if($waSettings && $waSettings->nomor_wa)
        <a href="https://wa.me/{{ $waSettings->nomor_wa }}?text={{ urlencode($waSettings->pesan_otomatis ?? 'Halo, saya ingin bertanya tentang sekolah') }}"
           target="_blank"
           class="fixed z-50 p-4 text-white transition-all duration-300 transform bg-green-500 rounded-full shadow-lg bottom-6 right-6 hover:bg-green-600 hover:scale-110 group">

            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.012.263 1.999.764 2.861L6.5 18.5l3.777-.997c.826.464 1.773.709 2.739.709 3.18 0 5.767-2.586 5.768-5.766.001-3.18-2.585-5.766-5.766-5.766z"/>
            </svg>

            <span class="absolute px-2 py-1 mr-3 text-xs font-medium text-white transition bg-gray-800 rounded-lg opacity-0 right-full group-hover:opacity-100 whitespace-nowrap">
                Chat via WhatsApp
            </span>
        </a>
    @endif

    {{-- Scripts --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const isMobile = window.innerWidth < 768;

            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: isMobile ? 500 : 800,
                    offset: isMobile ? 30 : 80,
                    delay: 0,
                    once: true,
                    easing: 'ease-out-cubic',
                    mirror: false,
                });

                setTimeout(() => {
                    AOS.refresh();
                }, 500);
            }

            // Smooth Scroll
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {

                    const href = this.getAttribute('href');

                    if (
                        href !== "#" &&
                        href !== "#!" &&
                        href !== "" &&
                        href !== "#0" &&
                        href !== "#/" &&
                        !href.includes("javascript")
                    ) {
                        const target = document.querySelector(href);

                        if (target) {
                            e.preventDefault();

                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    }
                });
            });
        });

        window.addEventListener('load', function () {
            if (typeof AOS !== 'undefined') {
                AOS.refresh();
            }
        });
    </script>

    @stack('scripts')

</body>
</html>
