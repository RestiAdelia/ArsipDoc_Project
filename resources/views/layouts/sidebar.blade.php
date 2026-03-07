<div class="flex flex-col h-full " style="background-color: #141E30;">
    <div class="mx-5 mb-4 h-px" style="background: linear-gradient(90deg, #3E5A76 0%, transparent 100%);"></div>
    <nav class="px-3 space-y-0.5">

        <p class="px-3 pb-1.5 text-[10px] uppercase tracking-[0.2em] text-slate-500 font-medium">Menu Utama</p>

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
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
               {{ $isDashboard ? 'text-white' : 'text-slate-400 hover:text-white hover:bg-white/5' }}"
                style="{{ $isDashboard ? 'background-color:rgba(62,90,118,0.25);border-left:2px solid #3E5A76;' : 'border-left:2px solid transparent;' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                Dashboard
            </a>
        @endauth

        @if (Auth::check() && Auth::user()->role !== 'user')
            @php
                $navItems = [
                    [url('/surat_masuk'), 'Surat Masuk', 'surat_masuk*,surat-masuk*', 'M19 14l-7 7m0 0l-7-7m7 7V3'],
                    [
                        route('surat-keluar.index'),
                        'Surat Keluar',
                        'surat-keluar*',
                        'M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5',
                    ],
                    [
                        url('/dokumen'),
                        'Arsip Digital',
                        'arsip*,dokumen*',
                        'M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4',
                    ],
                    [
                        url('/kategori'),
                        'Kategori Surat',
                        'kategori*',
                        'M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z',
                    ],
                    [
                        route('template.pilih'),
                        'Template Surat',
                        'template*',
                        'M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z',
                    ],
                ];
            @endphp
            @foreach ($navItems as [$url, $label, $match, $icon])
                @php
                    $isActive = false;
                    foreach (explode(',', $match) as $p) {
                        if (request()->is(trim($p))) {
                            $isActive = true;
                        }
                    }
                @endphp
                <a href="{{ $url }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
                   {{ $isActive ? 'text-white' : 'text-slate-400 hover:text-white hover:bg-white/5' }}"
                    style="{{ $isActive ? 'background-color:rgba(62,90,118,0.25);border-left:2px solid #3E5A76;' : 'border-left:2px solid transparent;' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}" />
                    </svg>
                    {{ $label }}
                </a>
            @endforeach
        @endif

        @if (Auth::check() && Auth::user()->role === 'superadmin')
            @php $isActive = request()->routeIs('admin.user*'); @endphp
            <a href="{{ route('admin.user.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
               {{ $isActive ? 'text-white' : 'text-slate-400 hover:text-white hover:bg-white/5' }}"
                style="{{ $isActive ? 'background-color:rgba(62,90,118,0.25);border-left:2px solid #3E5A76;' : 'border-left:2px solid transparent;' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
                Akun User
            </a>
        @endif

        @if (Auth::check() && Auth::user()->role === 'user')
            @php $isActive = request()->is('kirim-surat*') || request()->routeIs('user.surat_masuk*'); @endphp
            <a href="{{ route('user.surat_masuk.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
               {{ $isActive ? 'text-white' : 'text-slate-400 hover:text-white hover:bg-white/5' }}"
                style="{{ $isActive ? 'background-color:rgba(62,90,118,0.25);border-left:2px solid #3E5A76;' : 'border-left:2px solid transparent;' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                </svg>
                Kirim Surat
            </a>
        @endif
        @if (Auth::check() && Auth::user()->role !== 'user')
            @php
                $isLaporanActive = request()->routeIs('laporan.*');
            @endphp


            <div x-data="{ open: {{ $isLaporanActive ? 'true' : 'false' }} }" class="pt-3">
                <p class="px-3 pb-1.5 text-[10px] uppercase tracking-[0.2em] text-slate-500 font-medium">Laporan</p>

                <button @click="open = !open"
                    class="w-full flex items-center justify-between gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
                {{ $isLaporanActive ? 'text-white' : 'text-slate-400 hover:text-white hover:bg-white/5' }}"
                    style="{{ $isLaporanActive ? 'background-color:rgba(62,90,118,0.25);border-left:2px solid #3E5A76;' : 'border-left:2px solid transparent;' }}">

                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Laporan
                    </div>
                    <svg class="w-3 h-3 transition-transform duration-200 flex-shrink-0"
                        :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0 -translate-y-1"
                    x-transition:enter-end="opacity-100 translate-y-0" class="mt-0.5 ml-7 space-y-0.5">

                    @php
                        $laporanMenus = [
                            ['route' => 'laporan.surat-masuk', 'label' => 'Surat Masuk'],
                            ['route' => 'laporan.surat-keluar', 'label' => 'Surat Keluar'],
                            ['route' => 'laporan.arsip', 'label' => 'Arsip'],
                        ];
                    @endphp

                    @foreach ($laporanMenus as $menu)
                        @php
                            $isActiveItem = request()->routeIs($menu['route'] . '*');
                        @endphp

                        <a href="{{ route($menu['route']) }}"
                            class="flex items-center gap-2 px-3 py-2 rounded-lg text-xs transition-all duration-200
                        {{ $isActiveItem ? 'text-white bg-white/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">

                            <!-- Indikator bulat -->
                            <span
                                class="w-1 h-1 rounded-full flex-shrink-0 {{ $isActiveItem ? 'bg-white' : 'bg-slate-600' }}"></span>
                            {{ $menu['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

    </nav>
    <div class="mx-5 mt-3 mb-2 h-px" style="background: linear-gradient(90deg, transparent, #3E5A76, transparent);">
    </div>

    <div class="px-3">
        <p class="px-3 pb-1.5 text-[10px] uppercase tracking-[0.2em] text-slate-500 font-medium">Lainnya</p>
        @php $isProfile = request()->routeIs('profile*'); @endphp
        <a href="{{ route('profile.index') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
           {{ $isProfile ? 'text-white' : 'text-slate-400 hover:text-white hover:bg-white/5' }}"
            style="{{ $isProfile ? 'background-color:rgba(62,90,118,0.25);border-left:2px solid #3E5A76;' : 'border-left:2px solid transparent;' }}">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Pengaturan
        </a>
    </div>

</div>
