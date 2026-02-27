<div class="flex flex-col h-full py-6">

    <div class="px-5 mb-3">
        <p class="text-[10px] uppercase tracking-[0.2em] text-slate-500 font-semibold">Menu Utama</p>
    </div>

    <nav class="flex-1 space-y-1.5 px-3">

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
                class="flex items-center gap-3.5 px-4 py-3.5 rounded-xl text-sm font-medium transition-all duration-200
               {{ $isDashboard ? 'bg-white text-slate-800 shadow-sm' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                <span>Dashboard</span>
            </a>
        @endauth

        {{-- Menu Admin --}}
        @if (Auth::check() && Auth::user()->role !== 'user')
            <a href="{{ url('/surat_masuk') }}"
                class="flex items-center gap-3.5 px-4 py-3.5 rounded-xl text-sm font-medium transition-all duration-200
               {{ request()->is('surat_masuk*') || request()->is('surat-masuk*') ? 'bg-white text-slate-800 shadow-sm' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
                <span>Surat Masuk</span>
            </a>
            <a href="{{ route('surat-keluar.index') }}"
                class="flex items-center gap-3.5 px-4 py-3.5 rounded-xl text-sm font-medium transition-all duration-200
   {{ request()->is('surat-keluar*') ? 'bg-white text-slate-800 shadow-sm' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                </svg>
                <span>Surat Keluar</span>
            </a>

            <a href="{{ url('/dokumen') }}"
                class="flex items-center gap-3.5 px-4 py-3.5 rounded-xl text-sm font-medium transition-all duration-200
               {{ request()->is('arsip*') || request()->is('dokumen*') ? 'bg-white text-slate-800 shadow-sm' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                </svg>
                <span>Arsip Digital</span>
            </a>
            <a href="{{ url('/kategori') }}"
                class="flex items-center gap-3.5 px-4 py-3.5 rounded-xl text-sm font-medium transition-all duration-200
          {{ request()->is('kategori*') ? 'bg-white text-slate-800 shadow-sm' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                </svg>
                <span>Kategori Surat</span>
            </a>
            {{-- {{ url('/template') }} --}}
            <a href="{{ route('template.pilih') }}"
                class="flex items-center gap-3.5 px-4 py-3.5 rounded-xl text-sm font-medium transition-all duration-200
   {{ request()->is('template*') ? 'bg-white text-slate-800 shadow-sm' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
                <span>Template Surat</span>
            </a>
        @endif
        @if (Auth::check() && Auth::user()->role === 'superadmin')
            <a href="{{ route('admin.user.index') }}"
                class="flex items-center gap-3.5 px-4 py-3.5 rounded-xl text-sm font-medium transition-all duration-200
   {{ request()->routeIs('admin.user*') ? 'bg-white text-slate-800 shadow-sm' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
                <span>Akun User</span>
            </a>
        @endif


        {{-- Menu User --}}
        @if (Auth::check() && Auth::user()->role === 'user')
            <a href="{{ route('user.surat_masuk.index') }}"
                class="flex items-center gap-3.5 px-4 py-3.5 rounded-xl text-sm font-medium transition-all duration-200
               {{ request()->is('kirim-surat*') || request()->routeIs('user.surat_masuk*') ? 'bg-white text-slate-800 shadow-sm' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                </svg>
                <span>Kirim Surat</span>
            </a>
        @endif

    </nav>

    {{-- Divider --}}
    <div class="mx-5 my-2 h-px bg-slate-800"></div>

    <div class="px-5 mt-4 mb-3">
        <p class="text-[10px] uppercase tracking-[0.2em] text-slate-500 font-semibold">Lainnya</p>
    </div>

    <div class="px-3">
        <a href="{{ route('profile.index') }}"
            class="flex items-center gap-3.5 px-4 py-3.5 rounded-xl text-sm font-medium transition-all duration-200
           {{ request()->routeIs('profile*') ? 'bg-white text-slate-800 shadow-sm' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span>Pengaturan</span>
        </a>
    </div>

</div>
