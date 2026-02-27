<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Arsip Surat')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: '#2563eb',
                        secondary: '#475569',
                    }
                }
            }
        }
    </script>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="font-sans antialiased bg-stone-50 text-slate-800">

    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">

        <!-- Mobile Overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-20 bg-black/40 backdrop-blur-sm lg:hidden" x-cloak></div>

        <!-- SIDEBAR -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-30 w-64 transition-transform duration-300 transform bg-slate-900 border-r border-slate-800/80 lg:translate-x-0 lg:static lg:inset-0 flex flex-col">
            <!-- Logo -->
            <div class="flex items-center gap-3 px-6 h-16 border-b border-slate-800 flex-shrink-0">
                <div class="w-7 h-7 rounded-lg bg-white/10 flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <span class="text-white font-semibold text-base tracking-wide"
                    style="font-family: 'Georgia', serif;">E-Arsip</span>
            </div>

            <!-- Nav -->
            <div class="flex-1 overflow-y-auto">
                @include('layouts.sidebar')
            </div>

            <!-- Footer Sidebar -->
            <div class="px-5 py-4 border-t border-slate-800">
                <p class="text-[10px] text-slate-500 tracking-widest uppercase text-center">&copy; {{ date('Y') }}
                    Arsip Digital</p>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden">

            <!-- HEADER -->
            <header
                class="flex items-center justify-between px-6 h-16 bg-white border-b border-stone-200 sticky top-0 z-10 flex-shrink-0">
                <div class="flex items-center gap-4">
                    <!-- Hamburger Mobile -->
                    <button @click="sidebarOpen = true"
                        class="text-slate-400 hover:text-slate-600 transition-colors lg:hidden">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <h2 class="text-base font-semibold text-slate-800">
                        @yield('header_title', 'Dashboard')
                    </h2>
                </div>

                <div class="flex items-center gap-3">
                    @include('layouts.header')
                </div>
            </header>

            <!-- CONTENT -->
            <main class="flex-1 p-6">
                <div class="w-full max-w-7xl mx-auto">
                    <div class="bg-white rounded-2xl border border-stone-200 shadow-sm min-h-[500px] p-6">
                        @yield('content')
                    </div>
                </div>
            </main>

            <!-- FOOTER -->
            <footer class="px-6 py-4 border-t border-stone-200 bg-white">
                <div class="text-xs text-slate-400 text-center">
                    @include('layouts.footer')
                </div>
            </footer>

        </div>
    </div>

</body>

</html>
