@extends('layouts.main')

@section('content')
<div class="max-w-4xl mx-auto space-y-4">

    <!-- Header minimalis -->
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center gap-1.5 mb-0.5">
                <span class="w-1 h-3 bg-secondary rounded-full" style="background-color: #3E5A76;"></span>
                <p class="text-[10px] uppercase tracking-[0.2em] text-slate-400 font-medium">Akun</p>
            </div>
            <h1 class="text-base font-semibold" style="font-family: 'Georgia', serif; color: #141E30;">Profil Saya</h1>
        </div>
        <a href="{{ route('profile.edit') }}"
           class="flex items-center gap-1.5 bg-primary hover:bg-secondary text-white text-xs font-medium px-4 py-2 rounded-lg transition-all duration-200 hover:-translate-y-0.5 shadow-sm shadow-primary/20"
           style="background-color: #141E30;">
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/>
            </svg>
            Edit
        </a>
    </div>

    @if(session('success'))
        <div class="flex items-center gap-2 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-2.5 rounded-lg text-xs">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <!-- Tab Navigation - lebih kecil & smooth -->
    <div x-data="{ 
            activeTab: 'profile',
            tabs: ['profile', 'contact', 'security'],
            init() {
                this.$watch('activeTab', value => {
                    // Smooth scroll ke atas saat ganti tab
                    this.$nextTick(() => {
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    });
                });
            }
         }" 
         class="bg-white rounded-xl border border-stone-200/70 shadow-sm overflow-hidden">
        
        <!-- Tab Header - compact -->
        <div class="border-b border-stone-100 bg-stone-50/30 px-3 flex gap-1 overflow-x-auto scrollbar-hide">
            <template x-for="tab in tabs" :key="tab">
                <button @click="activeTab = tab"
                        :class="activeTab === tab ? 'border-secondary text-primary bg-white shadow-sm' : 'border-transparent text-slate-400 hover:text-slate-600 hover:bg-white/50'"
                        class="relative px-4 py-2.5 text-xs font-medium border-b-2 transition-all duration-300 rounded-t-lg flex items-center gap-1.5 whitespace-nowrap"
                        :style="activeTab === tab ? 'color: #141E30; border-bottom-color: #3E5A76;' : ''">
                    
                    <!-- Ikon sesuai tab -->
                    <template x-if="tab === 'profile'">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                    </template>
                    <template x-if="tab === 'contact'">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                        </svg>
                    </template>
                    <template x-if="tab === 'security'">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                        </svg>
                    </template>
                    
                    <span x-text="tab === 'profile' ? 'Pribadi' : (tab === 'contact' ? 'Kontak' : 'Keamanan')"></span>
                </button>
            </template>
        </div>

        <!-- Tab Content dengan transisi smooth -->
        <div class="p-5">
            <!-- TAB 1: Pribadi -->
            <div x-show="activeTab === 'profile'" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform scale-95"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 transform scale-100"
                 x-transition:leave-end="opacity-0 transform scale-95">
                
                <div class="flex flex-col sm:flex-row gap-5">
                    <!-- Avatar compact -->
                    <div class="sm:w-1/4 flex flex-col items-center text-center">
                        <div class="relative group">
                            @if($user->foto)
                                <img src="{{ asset('storage/'.$user->foto) }}" alt="{{ $user->name }}"
                                     class="w-20 h-20 rounded-xl object-cover border-2 border-white shadow-md ring-2 ring-secondary/10">
                            @else
                                <div class="w-20 h-20 rounded-xl bg-gradient-to-br from-primary to-secondary flex items-center justify-center text-white font-bold text-2xl shadow-md ring-2 ring-secondary/10"
                                     style="background: linear-gradient(135deg, #141E30, #3E5A76);">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                            <div class="absolute -bottom-1 -right-1 w-3.5 h-3.5 bg-emerald-400 rounded-full border-2 border-white"></div>
                        </div>
                        <h2 class="text-sm font-semibold mt-2" style="color: #141E30;">{{ $user->name }}</h2>
                        <span class="mt-1 px-2 py-0.5 bg-primary/10 text-primary rounded-full text-[9px] font-medium">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                    
                    <!-- Detail compact -->
                    <div class="sm:w-3/4 space-y-3">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div class="bg-stone-50 rounded-lg p-3 border border-stone-100">
                                <p class="text-[9px] uppercase tracking-wider text-slate-400 mb-1">Nama Lengkap</p>
                                <p class="text-sm font-medium text-slate-800">{{ $user->name }}</p>
                            </div>
                            <div class="bg-stone-50 rounded-lg p-3 border border-stone-100">
                                <p class="text-[9px] uppercase tracking-wider text-slate-400 mb-1">Email</p>
                                <p class="text-sm font-medium text-slate-800 break-all">{{ $user->email }}</p>
                            </div>
                            <div class="bg-stone-50 rounded-lg p-3 border border-stone-100">
                                <p class="text-[9px] uppercase tracking-wider text-slate-400 mb-1">Role</p>
                                <p class="text-sm font-medium text-slate-800 capitalize">{{ $user->role }}</p>
                            </div>
                            <div class="bg-stone-50 rounded-lg p-3 border border-stone-100">
                                <p class="text-[9px] uppercase tracking-wider text-slate-400 mb-1">Bergabung</p>
                                <p class="text-sm font-medium text-slate-800">{{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 2: Kontak -->
            <div x-show="activeTab === 'contact'"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform scale-95"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 transform scale-100"
                 x-transition:leave-end="opacity-0 transform scale-95">
                
                <div class="space-y-3">
                    <!-- Telepon -->
                    <div class="flex items-center gap-3 p-3 bg-stone-50 rounded-lg border border-stone-100 hover:border-secondary/20 transition-colors duration-200">
                        <div class="w-8 h-8 rounded-lg bg-white flex items-center justify-center shadow-sm">
                            <svg class="w-4 h-4 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-[9px] uppercase tracking-wider text-slate-400">Nomor Telepon</p>
                            <p class="text-sm font-medium text-slate-800">{{ $user->phone ?? 'Belum diisi' }}</p>
                        </div>
                    </div>
                    
                    <!-- Email (tidak redundant karena di sini lebih detail) -->
                    <div class="flex items-center gap-3 p-3 bg-stone-50 rounded-lg border border-stone-100 hover:border-secondary/20 transition-colors duration-200">
                        <div class="w-8 h-8 rounded-lg bg-white flex items-center justify-center shadow-sm">
                            <svg class="w-4 h-4 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-[9px] uppercase tracking-wider text-slate-400">Email</p>
                            <p class="text-sm font-medium text-slate-800 break-all">{{ $user->email }}</p>
                        </div>
                    </div>
                    
                    <!-- Alamat -->
                    <div class="p-3 bg-stone-50 rounded-lg border border-stone-100 hover:border-secondary/20 transition-colors duration-200">
                        <div class="flex gap-3">
                            <div class="w-8 h-8 rounded-lg bg-white flex items-center justify-center shadow-sm flex-shrink-0">
                                <svg class="w-4 h-4 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-[9px] uppercase tracking-wider text-slate-400 mb-1">Alamat</p>
                                @if($user->alamat)
                                    <p class="text-sm text-slate-700 leading-relaxed">{{ $user->alamat }}</p>
                                @else
                                    <p class="text-sm text-slate-400">Belum diisi</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 3: Keamanan -->
            <div x-show="activeTab === 'security'"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform scale-95"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 transform scale-100"
                 x-transition:leave-end="opacity-0 transform scale-95">
                
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 bg-stone-50 rounded-lg border border-stone-100">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-white flex items-center justify-center shadow-sm">
                                <svg class="w-4 h-4 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-slate-800">Password</p>
                                <p class="text-[9px] text-slate-400">Terakhir diperbarui: {{ $user->updated_at ? $user->updated_at->format('d M Y') : '-' }}</p>
                            </div>
                        </div>
                        <a href="{{ route('profile.edit') }}#password"
                           class="px-3 py-1.5 bg-primary text-white text-[10px] font-medium rounded-lg hover:bg-secondary transition-colors duration-200">
                            Ganti
                        </a>
                    </div>
                    
                    <div class="p-3 bg-blue-50/30 rounded-lg border border-blue-100">
                        <div class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-blue-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-[10px] text-slate-500 leading-relaxed">Gunakan password yang kuat dan berbeda dari akun lainnya.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer card (opsional) -->
        <div class="px-5 py-3 bg-stone-50/50 border-t border-stone-100 text-[9px] text-slate-400 flex justify-between">
            <span></span>
            <span>Aktivitas terakhir: {{ $user->updated_at ? $user->updated_at->diffForHumans() : '-' }}</span>
        </div>
    </div>

    <!-- Tombol aksi tambahan (compact) -->
    <div class="flex justify-end gap-2">
        <a href="{{ route('profile.edit') }}"
           class="text-[10px] text-slate-400 hover:text-primary transition-colors duration-200 px-3 py-1.5">
            Pengaturan Lanjutan
        </a>
    </div>
</div>

<!-- Style untuk scrollbar hidden -->
<style>
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
@endsection