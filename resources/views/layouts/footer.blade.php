<div class="flex flex-col md:flex-row items-center justify-between gap-4 w-full">

    <!-- Bagian Kiri: Copyright -->
    <div class="flex items-center gap-2 text-xs">
        <!-- Aksen secondary -->
        <span class="w-1 h-3 bg-secondary rounded-full hidden sm:block" style="background-color: #3E5A76;"></span>
        
        <span class="font-medium text-primary" style="color: #141E30;">Sistem Informasi Arsip Surat</span>
        
        <span class="text-stone-300">•</span>
        
        <span class="text-slate-400">&copy; {{ date('Y') }} Dinas Instansi Terkait</span>
    </div>

    <!-- Bagian Kanan: Links & Versi -->
    <div class="flex items-center gap-3 text-xs">
        <!-- Kebijakan Privasi -->
        <a href="#" 
           class="text-slate-400 hover:text-secondary transition-all duration-200 hover:translate-y-[-1px] inline-flex items-center gap-1 group"
           style="hover-color: #3E5A76;">
            <svg class="w-3 h-3 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
            <span>Kebijakan Privasi</span>
        </a>

        <span class="text-stone-300 select-none">|</span>

        <!-- Bantuan -->
        <a href="#" 
           class="text-slate-400 hover:text-secondary transition-all duration-200 hover:translate-y-[-1px] inline-flex items-center gap-1 group"
           style="hover-color: #3E5A76;">
            <svg class="w-3 h-3 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Bantuan</span>
        </a>

        <span class="text-stone-300 select-none">|</span>

        <!-- Versi dengan badge style -->
        <span class="px-2 py-0.5 bg-secondary/10 text-secondary rounded-full text-[10px] font-medium border border-secondary/20" 
              style="background-color: rgba(62, 90, 118, 0.1); color: #3E5A76; border-color: rgba(62, 90, 118, 0.2);">
            v1.0.0
        </span>
    </div>

</div>

<!-- Garis dekoratif bawah (opsional) -->
<div class="w-full mt-3 h-px bg-gradient-to-r from-transparent via-secondary/30 to-transparent hidden md:block" style="background: linear-gradient(90deg, transparent, #3E5A76, transparent);"></div>