<div class="flex items-center gap-4">

    <!-- Notifikasi (opsional) dengan secondary -->
    <button class="relative text-slate-400 hover:text-secondary transition-colors group" style="hover-color: #3E5A76;">
        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
        </svg>
        <span class="absolute top-0 right-0 w-2 h-2 bg-secondary rounded-full ring-2 ring-white" style="background-color: #3E5A76;"></span>
    </button>

    <div class="hidden md:block w-px h-5 bg-stone-200"></div>

    <!-- User Dropdown -->
    <div x-data="{ open: false }" class="relative">
        <button @click="open = !open"
                class="flex items-center gap-2.5 hover:bg-secondary/10 rounded-xl px-2 py-1.5 transition-all duration-200 focus:outline-none group"
                style="hover:background-color: rgba(62, 90, 118, 0.1);">

            <!-- Avatar dengan secondary -->
            <div class="w-7 h-7 rounded-lg bg-primary flex items-center justify-center text-white font-semibold text-xs flex-shrink-0 group-hover:scale-105 transition-transform duration-200" 
                 style="background-color: #141E30; font-family: 'Georgia', serif;">
                {{ strtoupper(substr(Auth::user()->name ?? '', 0, 1)) }}
            </div>

            <span class="hidden md:block text-sm font-medium text-slate-700 group-hover:text-primary transition-colors" style="group-hover:color: #141E30;">
                {{ Auth::user()->name ?? '' }}
            </span>

            <svg class="w-3.5 h-3.5 text-slate-400 group-hover:text-secondary transition-colors" 
                 style="group-hover:color: #3E5A76;" 
                 fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <!-- Dropdown -->
        <div x-show="open"
             @click.away="open = false"
             x-transition:enter="transition ease-out duration-150"
             x-transition:enter-start="opacity-0 translate-y-1"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-100"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 translate-y-1"
             class="absolute right-0 mt-2 w-44 bg-white border border-stone-200/70 rounded-2xl shadow-lg shadow-stone-200/60 overflow-hidden z-50"
             style="display: none;">

            <!-- User info dengan aksen secondary -->
            <div class="px-4 py-3 border-b border-stone-100">
                <div class="flex items-center gap-2 mb-1">
                    <span class="w-1 h-3 bg-secondary rounded-full" style="background-color: #3E5A76;"></span>
                    <p class="text-[10px] uppercase tracking-[0.15em] text-slate-400">Login sebagai</p>
                </div>
                <p class="text-xs font-semibold text-primary truncate pl-3" style="color: #141E30;">{{ Auth::user()->name ?? '' }}</p>
            </div>

            <div class="py-1.5">
                <!-- Profil -->
                <a href="{{ route('profile.index') }}"
                   class="flex items-center gap-2.5 px-4 py-2 text-sm text-slate-600 hover:bg-secondary/10 hover:text-primary transition-all duration-200 group">
                    <svg class="w-3.5 h-3.5 text-slate-400 group-hover:text-secondary transition-colors" style="group-hover:color: #3E5A76;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                    </svg>
                    Profil Saya
                </a>

                <div class="mx-3 my-1.5 h-px bg-gradient-to-r from-transparent via-stone-200 to-transparent"></div>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="flex items-center gap-2.5 w-full px-4 py-2 text-sm text-red-500 hover:bg-red-50 hover:text-red-600 transition-all duration-200 group">
                        <svg class="w-3.5 h-3.5 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/>
                        </svg>
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>