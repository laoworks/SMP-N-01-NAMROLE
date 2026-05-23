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
            --primary: {{ $settings->primary_color ?? '#4361ee' }};
            --primary-rgb: {{ $settings->primary_color ? hexdec(substr($settings->primary_color, 1, 2)) . ', ' . hexdec(substr($settings->primary_color, 3, 2)) . ', ' . hexdec(substr($settings->primary_color, 5, 2)) : '67, 97, 238' }};
            --primary-dark: {{ $settings->primary_color ?? '#4361ee' }}dd;
            --primary-light: {{ $settings->primary_color ?? '#4361ee' }}22;
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

        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
            background-color: var(--gray-50);
            color: var(--gray-800);
        }

        /* Typography */
        h1, h2, h3, h4, h5, h6 {
            font-weight: 700;
            color: var(--gray-900);
        }

        /* Custom Scrollbar */
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

        /* ========== BUTTON STYLES ========== */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(var(--primary-rgb), 0.3);
        }

        .btn-outline {
            background: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-outline:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        .btn-ghost {
            background: transparent;
            color: var(--gray-700);
            border: 1px solid var(--gray-300);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-ghost:hover {
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-2px);
        }

        /* ========== CARD STYLES ========== */
        .card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .card:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            transform: translateY(-4px);
        }

        /* ========== TEXT COLORS ========== */
        .text-primary {
            color: var(--primary);
        }

        .text-primary-dark {
            color: var(--primary-dark);
        }

        .text-primary-light {
            color: var(--primary-light);
        }

        /* ========== BACKGROUND COLORS ========== */
        .bg-primary {
            background: var(--primary);
        }

        .bg-primary-light {
            background-color: var(--primary-light);
        }

        .bg-primary-50 {
            background-color: var(--primary-50);
        }

        .bg-primary-100 {
            background-color: var(--primary-100);
        }

        /* ========== BORDER COLORS ========== */
        .border-primary {
            border-color: var(--primary);
        }

        .border-primary-light {
            border-color: var(--primary-light);
        }

        /* ========== GRADIENT ========== */
        .gradient-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        }

        .gradient-primary-light {
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
        }

        /* ========== FOCUS RING ========== */
        .focus-ring-primary:focus {
            outline: none;
            ring: 2px solid var(--primary);
            ring-offset: 2px;
        }

        /* ========== LINK STYLES ========== */
        a {
            transition: color 0.2s ease;
        }

        a:hover {
            color: var(--primary);
        }

        /* ========== ANIMATIONS ========== */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes pulse-primary {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }

        .animate-pulse-primary {
            animation: pulse-primary 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        /* ========== UTILITIES ========== */
        .shadow-primary {
            box-shadow: 0 10px 15px -3px rgba(var(--primary-rgb), 0.2);
        }

        .hover\:shadow-primary:hover {
            box-shadow: 0 20px 25px -5px rgba(var(--primary-rgb), 0.3);
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
           class="fixed bottom-6 right-6 bg-green-500 text-white p-4 rounded-full shadow-lg hover:bg-green-600 transition z-50 hover:scale-110 transform transition-all duration-300 group">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.012.263 1.999.764 2.861L6.5 18.5l3.777-.997c.826.464 1.773.709 2.739.709 3.18 0 5.767-2.586 5.768-5.766.001-3.18-2.585-5.766-5.766-5.766zm1.391 8.333c-.182.309-.456.551-.828.657-.344.098-.768.155-1.216.155-1.083 0-1.992-.305-2.723-.914-.383-.319-.721-.717-.996-1.165-.274-.448-.459-.97-.548-1.502-.042-.251-.042-.504 0-.755.063-.378.238-.718.489-.989.125-.135.293-.213.471-.213h.199c.134 0 .266.066.342.176l.862 1.254c.079.115.112.259.092.398-.02.139-.079.263-.176.364l-.383.394c-.059.061-.079.15-.053.232.155.461.461.905.883 1.274.419.369.93.603 1.48.7.094.017.188-.011.257-.066l.479-.382c.111-.089.264-.119.401-.076l1.273.434c.139.047.237.158.264.299.026.141-.007.287-.093.4z"/>
            </svg>
            <span class="absolute right-full mr-3 bg-gray-800 text-white text-xs font-medium px-2 py-1 rounded-lg opacity-0 group-hover:opacity-100 transition whitespace-nowrap">
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
