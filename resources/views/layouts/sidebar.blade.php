<div class="flex flex-col h-full py-6 bg-primary" style="background-color: #141E30;">
    <div class="px-5 mb-4">
        <div class="flex items-center gap-2 mb-2">
            <span class="w-1 h-4 bg-secondary rounded-full" style="background-color: #3E5A76;"></span>
            <p class="text-[10px] uppercase tracking-[0.2em] text-slate-400 font-semibold">Menu Utama</p>
        </div>
        <div class="w-10 h-px bg-gradient-to-r from-secondary/70 to-transparent" style="background: linear-gradient(90deg, #3E5A76 0%, transparent 100%);"></div>
    </div>

    <nav class="flex-1 space-y-1 px-3">

        @auth
            @php
                $role = Auth::user()->role;

                $isDashboard =
                    (in_array($role, ['admin', 'superadmin']) && request()->is('admin/dashboard')) ||
                    ($role === 'user' && request()->is('user/dashboard'));

                $dashboardUrl = in_array($role, ['admin', 'superadmin'])
                    ? url('/admin/dashboard')
                    : route('user.dashboard');
            @endphp

            <a href="{{ $dashboardUrl }}"
                class="group flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300
                {{ $isDashboard 
                    ? 'bg-secondary/20 text-white shadow-lg shadow-secondary/15 border-l-2 border-secondary' 
                    : 'text-slate-400 hover:bg-secondary hover:text-white hover:translate-x-1' }}"
                style="{{ $isDashboard ? 'background-color: rgba(62, 90, 118, 0.15); border-left-color: #3E5A76;' : '' }}">
                
                <svg class="w-5 h-5 flex-shrink-0 transition-transform duration-300 group-hover:scale-110 {{ $isDashboard ? 'text-white' : '' }}" 
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                <span class="relative">
                    Dashboard
                    @if($isDashboard)
                        <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-secondary" style="background-color: #3E5A76;"></span>
                    @endif
                </span>
            </a>
        @endauth

        {{-- Menu Admin --}}
        @if (Auth::check() && Auth::user()->role !== 'user')
            <!-- Surat Masuk -->
            <a href="{{ url('/surat_masuk') }}"
                class="group flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300
                {{ request()->is('surat_masuk*') || request()->is('surat-masuk*') 
                    ? 'bg-secondary/20 text-white shadow-lg shadow-secondary/15 border-l-2 border-secondary' 
                    : 'text-slate-400 hover:bg-secondary hover:text-white hover:translate-x-1' }}"
                style="{{ request()->is('surat_masuk*') || request()->is('surat-masuk*') ? 'background-color: rgba(62, 90, 118, 0.15); border-left-color: #3E5A76;' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0 transition-transform duration-300 group-hover:scale-110 {{ request()->is('surat_masuk*') || request()->is('surat-masuk*') ? 'text-white' : '' }}"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
                <span>Surat Masuk</span>
            </a>

            <!-- Surat Keluar -->
            <a href="{{ route('surat-keluar.index') }}"
                class="group flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300
                {{ request()->is('surat-keluar*') 
                    ? 'bg-secondary/20 text-white shadow-lg shadow-secondary/15 border-l-2 border-secondary' 
                    : 'text-slate-400 hover:bg-secondary hover:text-white hover:translate-x-1' }}"
                style="{{ request()->is('surat-keluar*') ? 'background-color: rgba(62, 90, 118, 0.15); border-left-color: #3E5A76;' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0 transition-transform duration-300 group-hover:scale-110 {{ request()->is('surat-keluar*') ? 'text-white' : '' }}"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                </svg>
                <span>Surat Keluar</span>
            </a>

            <!-- Arsip Digital -->
            <a href="{{ url('/dokumen') }}"
                class="group flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300
                {{ request()->is('arsip*') || request()->is('dokumen*') 
                    ? 'bg-secondary/20 text-white shadow-lg shadow-secondary/15 border-l-2 border-secondary' 
                    : 'text-slate-400 hover:bg-secondary hover:text-white hover:translate-x-1' }}"
                style="{{ request()->is('arsip*') || request()->is('dokumen*') ? 'background-color: rgba(62, 90, 118, 0.15); border-left-color: #3E5A76;' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0 transition-transform duration-300 group-hover:scale-110 {{ request()->is('arsip*') || request()->is('dokumen*') ? 'text-white' : '' }}"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                </svg>
                <span>Arsip Digital</span>
            </a>

            <!-- Kategori Surat -->
            <a href="{{ url('/kategori') }}"
                class="group flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300
                {{ request()->is('kategori*') 
                    ? 'bg-secondary/20 text-white shadow-lg shadow-secondary/15 border-l-2 border-secondary' 
                    : 'text-slate-400 hover:bg-secondary hover:text-white hover:translate-x-1' }}"
                style="{{ request()->is('kategori*') ? 'background-color: rgba(62, 90, 118, 0.15); border-left-color: #3E5A76;' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0 transition-transform duration-300 group-hover:scale-110 {{ request()->is('kategori*') ? 'text-white' : '' }}"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                </svg>
                <span>Kategori Surat</span>
            </a>

            <!-- Template Surat -->
            <a href="{{ route('template.pilih') }}"
                class="group flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300
                {{ request()->is('template*') 
                    ? 'bg-secondary/20 text-white shadow-lg shadow-secondary/15 border-l-2 border-secondary' 
                    : 'text-slate-400 hover:bg-secondary hover:text-white hover:translate-x-1' }}"
                style="{{ request()->is('template*') ? 'background-color: rgba(62, 90, 118, 0.15); border-left-color: #3E5A76;' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0 transition-transform duration-300 group-hover:scale-110 {{ request()->is('template*') ? 'text-white' : '' }}"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
                <span>Template Surat</span>
            </a>
        @endif

        <!-- Menu Superadmin -->
        @if (Auth::check() && Auth::user()->role === 'superadmin')
            <a href="{{ route('admin.user.index') }}"
                class="group flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300
                {{ request()->routeIs('admin.user*') 
                    ? 'bg-secondary/20 text-white shadow-lg shadow-secondary/15 border-l-2 border-secondary' 
                    : 'text-slate-400 hover:bg-secondary hover:text-white hover:translate-x-1' }}"
                style="{{ request()->routeIs('admin.user*') ? 'background-color: rgba(62, 90, 118, 0.15); border-left-color: #3E5A76;' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0 transition-transform duration-300 group-hover:scale-110 {{ request()->routeIs('admin.user*') ? 'text-white' : '' }}"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
                <span>Akun User</span>
            </a>
        @endif

        {{-- Menu User --}}
        @if (Auth::check() && Auth::user()->role === 'user')
            <a href="{{ route('user.surat_masuk.index') }}"
                class="group flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300
                {{ request()->is('kirim-surat*') || request()->routeIs('user.surat_masuk*') 
                    ? 'bg-secondary/20 text-white shadow-lg shadow-secondary/15 border-l-2 border-secondary' 
                    : 'text-slate-400 hover:bg-secondary hover:text-white hover:translate-x-1' }}"
                style="{{ request()->is('kirim-surat*') || request()->routeIs('user.surat_masuk*') ? 'background-color: rgba(62, 90, 118, 0.15); border-left-color: #3E5A76;' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0 transition-transform duration-300 group-hover:scale-110 {{ request()->is('kirim-surat*') || request()->routeIs('user.surat_masuk*') ? 'text-white' : '' }}"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                </svg>
                <span>Kirim Surat</span>
            </a>
        @endif

    </nav>

    <div class="mx-5 my-4">
        <div class="h-px bg-gradient-to-r from-transparent via-secondary/70 to-transparent" style="background: linear-gradient(90deg, transparent, #3E5A76, transparent);"></div>
    </div>

    <div class="px-5 mb-3">
        <div class="flex items-center gap-2 mb-2">
            <span class="w-1 h-4 bg-secondary rounded-full" style="background-color: #3E5A76;"></span>
            <p class="text-[10px] uppercase tracking-[0.2em] text-slate-400 font-semibold">Lainnya</p>
        </div>
        <div class="w-10 h-px bg-gradient-to-r from-secondary/70 to-transparent" style="background: linear-gradient(90deg, #3E5A76 0%, transparent 100%);"></div>
    </div>

    <div class="px-3 space-y-1">
        <!-- Pengaturan / Profile -->
        <a href="{{ route('profile.index') }}"
            class="group flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300
            {{ request()->routeIs('profile*') 
                ? 'bg-secondary/20 text-white shadow-lg shadow-secondary/15 border-l-2 border-secondary' 
                : 'text-slate-400 hover:bg-secondary hover:text-white hover:translate-x-1' }}"
            style="{{ request()->routeIs('profile*') ? 'background-color: rgba(62, 90, 118, 0.15); border-left-color: #3E5A76;' : '' }}">
            <svg class="w-5 h-5 flex-shrink-0 transition-transform duration-300 group-hover:rotate-90 {{ request()->routeIs('profile*') ? 'text-white' : '' }}"
                 fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span>Pengaturan</span>
        </a>
    </div>
</div>