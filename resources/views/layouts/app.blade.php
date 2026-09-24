<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pesona Kaltim - Katalog Destinasi Wisata Kalimantan Timur')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="flex flex-col min-h-full text-slate-800 antialiased selection:bg-emerald-500 selection:text-white">

    <!-- Header & Navbar Sticky -->
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-slate-200 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-20">
                <!-- Logo & Brand -->
                <a href="{{ route('destinations.index') }}" class="flex items-center gap-2.5 sm:gap-3 group shrink-0">
                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-emerald-700 flex items-center justify-center text-white shadow-xs group-hover:bg-emerald-800 transition-colors">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-base sm:text-xl font-bold text-slate-900 tracking-tight flex items-center gap-1">
                            Pesona<span class="text-emerald-700">Kaltim</span>
                        </div>
                        <p class="text-[11px] text-slate-700 font-medium hidden sm:block">Katalog Wisata Kalimantan Timur</p>
                    </div>
                </a>

                <!-- Nav Links Desktop -->
                <nav class="hidden md:flex items-center space-x-1 lg:space-x-2">
                    <a href="{{ route('destinations.index') }}" 
                       class="px-3.5 py-2 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('destinations.*') ? 'text-emerald-800 bg-emerald-50' : 'text-slate-800 hover:text-emerald-700 hover:bg-slate-100' }}">
                        Destinasi Wisata
                    </a>
                    <a href="{{ route('culinaries.index') }}" 
                       class="px-3.5 py-2 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('culinaries.*') ? 'text-emerald-800 bg-emerald-50' : 'text-slate-800 hover:text-emerald-700 hover:bg-slate-100' }}">
                        Kuliner Khas
                    </a>
                    <a href="{{ route('events.index') }}" 
                       class="px-3.5 py-2 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('events.*') ? 'text-emerald-800 bg-emerald-50' : 'text-slate-800 hover:text-emerald-700 hover:bg-slate-100' }}">
                        Event & Budaya
                    </a>
                    <a href="{{ route('reviews.index') }}" 
                       class="px-3.5 py-2 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('reviews.*') ? 'text-emerald-800 bg-emerald-50' : 'text-slate-800 hover:text-emerald-700 hover:bg-slate-100' }}">
                        Ulasan
                    </a>
                </nav>

                <!-- Actions & Mobile Menu Toggle -->
                <div class="flex items-center gap-2 sm:gap-3">
                    <!-- Desktop Action Button -->
                    <a href="{{ route('destinations.create') }}" 
                       class="hidden sm:inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg text-sm font-semibold text-white bg-emerald-700 hover:bg-emerald-800 active:bg-emerald-900 transition-colors shadow-xs whitespace-nowrap">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 4v16m8-8H4" />
                        </svg>
                        <span>Tambah Destinasi</span>
                    </a>

                    <!-- Mobile Compact Quick Add Button -->
                    <a href="{{ route('destinations.create') }}" 
                       title="Tambah Destinasi"
                       class="sm:hidden inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg text-xs font-semibold text-white bg-emerald-700 hover:bg-emerald-800 active:bg-emerald-900 transition-colors shadow-xs whitespace-nowrap">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                        </svg>
                        <span>Tambah</span>
                    </a>

                    <!-- Hamburger Button Mobile -->
                    <button type="button" 
                            id="mobileMenuBtn"
                            onclick="toggleMobileMenu()"
                            aria-label="Buka menu navigasi"
                            class="md:hidden inline-flex items-center justify-center p-2 rounded-lg text-slate-700 hover:text-slate-900 hover:bg-slate-100 focus:outline-hidden focus:ring-2 focus:ring-emerald-500 transition-colors">
                        <svg id="hamburgerIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg id="closeIcon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Drawer Dropdown -->
        <div id="mobileMenu" class="hidden md:hidden border-t border-slate-200 bg-white/98 backdrop-blur-md px-4 pt-3 pb-5 space-y-3 shadow-md">
            <nav class="space-y-1">
                <a href="{{ route('destinations.index') }}" 
                   class="flex items-center justify-between px-3.5 py-2.5 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('destinations.*') ? 'text-emerald-800 bg-emerald-50' : 'text-slate-800 hover:bg-slate-100' }}">
                    <span class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Destinasi Wisata
                    </span>
                    <span class="text-xs text-slate-700 font-normal">Katalog</span>
                </a>

                <a href="{{ route('culinaries.index') }}" 
                   class="flex items-center justify-between px-3.5 py-2.5 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('culinaries.*') ? 'text-emerald-800 bg-emerald-50' : 'text-slate-800 hover:bg-slate-100' }}">
                    <span class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        Kuliner Khas
                    </span>
                    <span class="text-xs text-slate-700 font-normal">Makanan &amp; Jajanan</span>
                </a>

                <a href="{{ route('events.index') }}" 
                   class="flex items-center justify-between px-3.5 py-2.5 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('events.*') ? 'text-emerald-800 bg-emerald-50' : 'text-slate-800 hover:bg-slate-100' }}">
                    <span class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Event &amp; Budaya
                    </span>
                    <span class="text-xs text-slate-700 font-normal">Kalender Festival</span>
                </a>

                <a href="{{ route('reviews.index') }}" 
                   class="flex items-center justify-between px-3.5 py-2.5 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('reviews.*') ? 'text-emerald-800 bg-emerald-50' : 'text-slate-800 hover:bg-slate-100' }}">
                    <span class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                        Ulasan Pengunjung
                    </span>
                    <span class="text-xs text-slate-700 font-normal">Testimoni</span>
                </a>
            </nav>

            <div class="pt-3 border-t border-slate-100 grid grid-cols-2 gap-2">
                <a href="{{ route('culinaries.create') }}" 
                   class="px-3 py-2 text-center text-xs font-semibold rounded-lg bg-amber-50 text-amber-800 border border-amber-200 hover:bg-amber-100">
                    + Tambah Kuliner
                </a>
                <a href="{{ route('reviews.create') }}" 
                   class="px-3 py-2 text-center text-xs font-semibold rounded-lg bg-emerald-50 text-emerald-800 border border-emerald-200 hover:bg-emerald-100">
                    + Tulis Ulasan
                </a>
            </div>
        </div>
    </header>

    <!-- Flash Notification Messages -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 sm:mt-6">
        @if (session('success'))
            <div id="alert-success" class="flex items-center p-3.5 sm:p-4 text-emerald-800 bg-emerald-50 border border-emerald-200 rounded-xl shadow-xs" role="alert">
                <svg class="flex-shrink-0 w-5 h-5 text-emerald-600 mr-2.5 sm:mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <div class="text-xs sm:text-sm font-medium flex-1">
                    {{ session('success') }}
                </div>
                <button type="button" onclick="document.getElementById('alert-success').remove()" class="ml-auto -mx-1 -my-1 bg-emerald-50 text-emerald-500 rounded-lg focus:ring-2 focus:ring-emerald-400 p-1.5 hover:bg-emerald-100 inline-flex h-7 w-7 items-center justify-center">
                    <span class="sr-only">Tutup</span>
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div id="alert-error" class="flex items-center p-3.5 sm:p-4 text-rose-800 bg-rose-50 border border-rose-200 rounded-xl shadow-xs" role="alert">
                <svg class="flex-shrink-0 w-5 h-5 text-rose-600 mr-2.5 sm:mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                <div class="text-xs sm:text-sm font-medium flex-1">
                    {{ session('error') }}
                </div>
                <button type="button" onclick="document.getElementById('alert-error').remove()" class="ml-auto -mx-1 -my-1 bg-rose-50 text-rose-500 rounded-lg focus:ring-2 focus:ring-rose-400 p-1.5 hover:bg-rose-100 inline-flex h-7 w-7 items-center justify-center">
                    <span class="sr-only">Tutup</span>
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-5 sm:py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-auto bg-white border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-600 inline-block"></span>
                    <p class="text-xs sm:text-sm font-semibold text-slate-700">Pesona Wisata Kalimantan Timur &copy; {{ date('Y') }}</p>
                </div>
                <div class="flex items-center gap-3 text-xs font-semibold text-slate-700">
                    <a href="{{ route('destinations.index') }}" class="hover:text-emerald-700 transition-colors">Destinasi</a>
                    <span>&bull;</span>
                    <a href="{{ route('culinaries.index') }}" class="hover:text-emerald-700 transition-colors">Kuliner</a>
                    <span>&bull;</span>
                    <a href="{{ route('events.index') }}" class="hover:text-emerald-700 transition-colors">Event</a>
                    <span>&bull;</span>
                    <a href="{{ route('reviews.index') }}" class="hover:text-emerald-700 transition-colors">Ulasan</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Script -->
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            const hamburgerIcon = document.getElementById('hamburgerIcon');
            const closeIcon = document.getElementById('closeIcon');

            if (menu.classList.contains('hidden')) {
                menu.classList.remove('hidden');
                hamburgerIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
            } else {
                menu.classList.add('hidden');
                hamburgerIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            }
        }
    </script>

    @stack('scripts')
</body>
</html>
