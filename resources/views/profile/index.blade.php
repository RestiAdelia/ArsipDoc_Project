@extends('layouts.main')

@section('content')
    <div class="max-w-4xl mx-auto space-y-5 pb-10">

        <!-- Header Section -->
        <div class="flex items-end justify-between px-1">
            <div>
                <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-slate-500 mb-0.5">Akun</p>
                <h1 class="text-xl font-bold text-slate-900" style="font-family: 'Georgia', serif;">Pengaturan Akun</h1>
            </div>
            <a href="{{ route('profile.edit') }}"
                class="group inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 text-slate-700 text-xs font-bold rounded-full transition-all duration-200 hover:border-slate-900 hover:bg-slate-900 hover:text-white hover:shadow-md active:scale-95">
                <svg class="w-3.5 h-3.5 text-slate-400 group-hover:text-white transition-colors" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
                Edit Profil
            </a>
        </div>

        @if (session('success'))
            <div
                class="flex items-center gap-3 px-4 py-2.5 bg-emerald-50 border border-emerald-100 text-emerald-800 text-xs rounded-xl">
                <svg class="w-4 h-4 text-emerald-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                <span><span class="font-bold">Berhasil!</span> {{ session('success') }}</span>
            </div>
        @endif
        <div x-data="{ activeTab: 'profile' }"
            class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden min-h-[350px]">
            <div class="px-4 py-2 border-b border-slate-100 bg-slate-50/50">
                <div class="flex items-center gap-2 overflow-x-auto scrollbar-hide">
                    @foreach ([
            'profile' => ['label' => 'Informasi Pribadi', 'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
            'contact' => ['label' => 'Kontak & Alamat', 'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 002 2v10a2 2 0 002 2z'],
            'security' => ['label' => 'Keamanan', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
        ] as $key => $tab)
                        <button @click="activeTab = '{{ $key }}'"
                            class="flex items-center gap-2 px-4 py-2 rounded-full text-xs font-bold tracking-wide transition-all duration-300 border whitespace-nowrap"
                            :class="activeTab === '{{ $key }}'
                                ?
                                'bg-slate-900 border-slate-900 text-white shadow-md shadow-slate-900/20' :
                                'bg-white border-slate-200 text-slate-600 hover:border-slate-300 hover:bg-slate-50'">

                            <svg class="w-3.5 h-3.5"
                                :class="activeTab === '{{ $key }}' ? 'text-slate-300' : 'text-slate-400'"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $tab['icon'] }}" />
                            </svg>
                            {{ $tab['label'] }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Content Area -->
            <div class="p-5">

                <!-- TAB 1: Profile -->
                <div x-show="activeTab === 'profile'" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                    style="display: none;">

                    <div class="flex flex-col sm:flex-row gap-6 items-start">
                        <!-- Avatar Section -->
                        <div
                            class="w-full sm:w-auto flex flex-col items-center text-center sm:text-left sm:items-center min-w-[140px]">
                            <div class="relative group">
                                @if ($user->foto)
                                    <img src="{{ asset('storage/' . $user->foto) }}" alt="{{ $user->name }}"
                                        class="w-24 h-24 rounded-2xl object-cover border-[3px] border-white shadow-lg ring-1 ring-slate-200">
                                @else
                                    <!-- Avatar Placeholder menggunakan Navy -->
                                    <div class="w-24 h-24 rounded-2xl bg-slate-900 border-[3px] border-white shadow-lg ring-1 ring-slate-200 flex items-center justify-center text-white font-bold text-3xl"
                                        style="font-family: 'Georgia', serif;">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                @endif
                                <div
                                    class="absolute -bottom-1 -right-1 w-5 h-5 bg-emerald-500 rounded-full border-[3px] border-white">
                                </div>
                            </div>

                            <div class="mt-3 text-center">
                                <h2 class="text-sm font-bold text-slate-900">{{ $user->name }}</h2>
                                <!-- Badge Role: Navy Solid -->
                                <span
                                    class="mt-1 inline-flex items-center px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider rounded border 
                                {{ $user->role === 'admin' ? 'bg-slate-900 text-white border-slate-900' : 'bg-slate-100 text-slate-600 border-slate-200' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </div>
                        </div>

                        <!-- Details Grid -->
                        <div class="w-full grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach ([['Nama Lengkap', $user->name], ['Email', $user->email], ['Role Akun', ucfirst($user->role)], ['Bergabung', $user->created_at ? $user->created_at->format('d M Y') : '—']] as $item)
                                <!-- Kartu Detail: Background Terang (Slate-50) -->
                                <div
                                    class="bg-slate-50 rounded-lg p-3 border border-slate-100 hover:border-slate-300 transition-colors">
                                    <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-0.5">
                                        {{ $item[0] }}
                                    </p>
                                    <p class="text-xs font-semibold text-slate-800 break-words">{{ $item[1] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- TAB 2: Kontak -->
                <div x-show="activeTab === 'contact'" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                    style="display: none;">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <!-- Phone -->
                        <div
                            class="flex items-center gap-3 p-3 rounded-xl border border-slate-100 bg-slate-50 hover:bg-white hover:border-slate-200 transition-colors shadow-sm hover:shadow">
                            <div
                                class="w-8 h-8 rounded-lg bg-white border border-slate-200 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Telepon</p>
                                <p
                                    class="text-xs font-semibold {{ $user->phone ? 'text-slate-800' : 'text-slate-400 italic' }}">
                                    {{ $user->phone ?? '—' }}
                                </p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div
                            class="flex items-center gap-3 p-3 rounded-xl border border-slate-100 bg-slate-50 hover:bg-white hover:border-slate-200 transition-colors shadow-sm hover:shadow">
                            <div
                                class="w-8 h-8 rounded-lg bg-white border border-slate-200 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Email</p>
                                <p class="text-xs font-semibold text-slate-800">{{ $user->email }}</p>
                            </div>
                        </div>

                        <!-- Address -->
                        <div
                            class="col-span-1 sm:col-span-2 flex items-start gap-3 p-3 rounded-xl border border-slate-100 bg-slate-50 hover:bg-white hover:border-slate-200 transition-colors shadow-sm hover:shadow">
                            <div
                                class="w-8 h-8 rounded-lg bg-white border border-slate-200 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Alamat</p>
                                <p
                                    class="text-xs font-semibold leading-relaxed {{ $user->alamat ? 'text-slate-800' : 'text-slate-400 italic' }}">
                                    {{ $user->alamat ?? '—' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TAB 3: Keamanan -->
                <div x-show="activeTab === 'security'" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                    style="display: none;">

                    <div class="bg-white rounded-xl p-4 border border-slate-200 shadow-sm">
                        <div class="flex items-center justify-between gap-4 mb-4">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-slate-50 rounded-lg border border-slate-100">
                                    <svg class="w-4 h-4 text-slate-800" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-sm font-bold text-slate-900">Kata Sandi</h3>
                                    <p class="text-[10px] text-slate-500">Update:
                                        {{ $user->updated_at ? $user->updated_at->format('d M Y') : '-' }}</p>
                                </div>
                            </div>
                            <!-- Tombol Ganti Password Navy -->
                            <a href="{{ route('profile.password') }}"
                                class="px-3 py-1.5 bg-slate-900 hover:bg-slate-800 text-white text-[10px] font-bold rounded-lg transition-all shadow hover:shadow-lg hover:-translate-y-0.5">
                                Ganti
                            </a>
                        </div>

                        <div
                            class="flex gap-2.5 items-start p-3 bg-slate-50 rounded-lg border border-slate-100 text-slate-600">
                            <svg class="w-3.5 h-3.5 text-emerald-500 mt-0.5 flex-shrink-0" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-xs leading-relaxed">
                                Gunakan password unik untuk menjaga keamanan akun Anda.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
