<div class="flex items-center gap-4">

   
    <div class="hidden md:block w-px h-5 bg-stone-200"></div>

    <!-- User Dropdown -->
    <div x-data="{ open: false }" class="relative">
        <button @click="open = !open"
                class="flex items-center gap-2.5 hover:bg-stone-50 rounded-xl px-2 py-1.5 transition-colors duration-200 focus:outline-none">

            <!-- Avatar -->
            <div class="w-7 h-7 rounded-lg bg-slate-900 text-white flex items-center justify-center font-semibold text-xs flex-shrink-0" style="font-family: 'Georgia', serif;">
                {{ strtoupper(substr(Auth::user()->name ?? '', 0, 1)) }}
            </div>

            <span class="hidden md:block text-sm font-medium text-slate-700">
                {{ Auth::user()->name ?? '' }}
            </span>

            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
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
             class="absolute right-0 mt-2 w-44 bg-white border border-stone-200 rounded-2xl shadow-lg shadow-stone-200/60 overflow-hidden z-50"
             style="display: none;">

            <!-- User info -->
            <div class="px-4 py-3 border-b border-stone-100">
                <p class="text-[10px] uppercase tracking-[0.15em] text-slate-400 mb-0.5">Login sebagai</p>
                <p class="text-xs font-semibold text-slate-700 truncate">{{ Auth::user()->name ?? '' }}</p>
            </div>

            <div class="py-1.5">
                <a href="{{ route('profile.index') }}"
                   class="flex items-center gap-2.5 px-4 py-2 text-sm text-slate-600 hover:bg-stone-50 hover:text-slate-800 transition-colors">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                    </svg>
                    Profil Saya
                </a>

                <div class="mx-3 my-1.5 h-px bg-stone-100"></div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="flex items-center gap-2.5 w-full px-4 py-2 text-sm text-red-500 hover:bg-red-50 hover:text-red-600 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/>
                        </svg>
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>