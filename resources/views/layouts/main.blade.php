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
                        primary: '#141E30', // Navy Gelap
                        secondary: '#2C3E50', // Biru Keabu-abuan
                        'primary-light': '#1E2B3F',
                        'primary-dark': '#0F1A2B',
                        soft: '#F8FAFC',
                    }
                }
            }
        }
    </script>

    <style>
        [x-cloak] {
            display: none !important;
        }
        
        /* Custom scrollbar untuk sidebar */
        .overflow-y-auto::-webkit-scrollbar {
            width: 4px;
        }
        .overflow-y-auto::-webkit-scrollbar-track {
            background: #1E293B;
        }
        .overflow-y-auto::-webkit-scrollbar-thumb {
            background: #475569;
            border-radius: 20px;
        }
        .overflow-y-auto::-webkit-scrollbar-thumb:hover {
            background: #64748B;
        }
        
        /* Animasi untuk hover cards */
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(20, 30, 48, 0.1), 0 10px 10px -5px rgba(20, 30, 48, 0.04);
        }
        
        /* Garis aksen minimalis */
        .accent-line {
            height: 2px;
            width: 40px;
            background: linear-gradient(90deg, #2C3E50 0%, rgba(44, 62, 80, 0.2) 100%);
            margin-top: 4px;
        }
    </style>
</head>

<body class="font-sans antialiased bg-soft text-slate-800">

    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">

        <!-- Mobile Overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            x-transition:enter="transition-opacity ease-linear duration-300" 
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" 
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100" 
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-20 bg-primary/70 backdrop-blur-sm lg:hidden" 
            style="background-color: rgba(20, 30, 48, 0.7);"
            x-cloak></div>

        <!-- SIDEBAR - Premium dengan warna #141E30 -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-30 w-64 transition-transform duration-300 transform bg-primary border-r border-secondary/30 lg:translate-x-0 lg:static lg:inset-0 flex flex-col shadow-2xl shadow-primary/20"
            style="background-color: #141E30;">
            
            <!-- Logo dengan desain minimalis -->
            <div class="flex items-center justify-between px-6 h-16 border-b border-secondary/30 flex-shrink-0">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-secondary/80 flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <span class="text-white font-semibold text-base tracking-wide" style="font-family: 'Georgia', serif;">
                        E-Arsip
                    </span>
                </div>
                
                <!-- Badge version minimalis -->
                <span class="text-[8px] text-slate-400 border border-slate-700 px-1.5 py-0.5 rounded-full">v2.0</span>
            </div>

            <!-- Nav - Sidebar Menu -->
            <div class="flex-1 overflow-y-auto py-4">
                @include('layouts.sidebar')
            </div>

            <!-- Footer Sidebar -->
            <div class="px-5 py-4 border-t border-secondary/30">
                <p class="text-[9px] text-slate-500 tracking-widest uppercase text-center">
                    &copy; {{ date('Y') }} Arsip Digital
                </p>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden bg-soft">

            <!-- HEADER -->
            <header
                class="flex items-center justify-between px-6 h-16 bg-white/80 backdrop-blur-md border-b border-stone-200/70 sticky top-0 z-10 flex-shrink-0 shadow-sm">
                
                <div class="flex items-center gap-4">
                    <!-- Hamburger Mobile -->
                    <button @click="sidebarOpen = true"
                        class="text-primary/50 hover:text-primary transition-all duration-300 lg:hidden">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <div class="flex items-center gap-2">
                        <h2 class="text-base font-semibold" style="color: #141E30;">
                            @yield('header_title', 'Dashboard')
                        </h2>
                        <div class="accent-line"></div>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    @include('layouts.header')
                    
                 
                    
                </div>
            </header>

            <!-- CONTENT -->
            <main class="flex-1 p-6 lg:p-8">
                <div class="w-full max-w-7xl mx-auto">
                    <div class="bg-white rounded-2xl border border-stone-200/70 shadow-lg hover-lift p-6 lg:p-8">
                        @yield('content')
                    </div>
                </div>
            </main>

            <!-- FOOTER -->
            <footer class="px-6 py-4 border-t border-stone-200/70 bg-white/80 backdrop-blur-sm">
                <div class="text-xs text-slate-400 text-center">
                    @include('layouts.footer')
                </div>
            </footer>

        </div>
    </div>
</body>

</html>