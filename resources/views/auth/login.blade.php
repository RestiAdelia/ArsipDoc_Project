<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login · E-Arsip</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Inter & Georgia -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', system-ui, sans-serif; background-color: #F8FAFC; }
        
        /* === PALET ELEGAN & PROFESIONAL === */
        /* Primary: #141E30 (Navy Gelap) */
        .bg-primary { background-color: #141E30; }
        .text-primary { color: #141E30; }
        .border-primary { border-color: #141E30; }
        .ring-primary { ring-color: #141E30; }
        
        /* Secondary: #2C3E50 (Biru Keabu-abuan) */
        .bg-secondary { background-color: #2C3E50; }
        .text-secondary { color: #2C3E50; }
        .border-secondary { border-color: #2C3E50; }
        .hover\:bg-secondary:hover { background-color: #2C3E50; }
        
        /* Accent Emas: #D4AF37 */
        .bg-accent { background-color: #D4AF37; }
        .text-accent { color: #D4AF37; }
        .border-accent { border-color: #D4AF37; }
        .ring-accent { ring-color: #D4AF37; }
        .hover\:bg-accent:hover { background-color: #c9a227; }
        .hover\:text-accent:hover { color: #D4AF37; }
        
        /* Background lembut untuk card & form */
        .bg-soft { background-color: #F8FAFC; }
        .bg-card { background-color: #FFFFFF; }
        
        /* Text colors */
        .text-body { color: #334155; }
        .text-muted { color: #64748B; }
        
        /* Custom focus & transition */
        .focus\:border-accent:focus { border-color: #D4AF37; }
        .focus\:ring-accent:focus { ring-color: #D4AF37; }
        
        /* Gradien halus untuk background (opsional) */
        .bg-gradient-subtle {
            background: linear-gradient(145deg, #F8FAFC 0%, #f1f5f9 100%);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center px-4 py-4 bg-gradient-subtle">

    <div class="w-full max-w-sm">

        <!-- Logo / Brand dengan aksen emas -->
        <div class="text-center mb-5">
            <div class="w-14 h-14 rounded-2xl bg-primary flex items-center justify-center mx-auto mb-3 shadow-lg shadow-primary/20 relative overflow-hidden">
                <!-- Aksen emas di sudut -->
                <div class="absolute -top-2 -right-2 w-6 h-6 bg-accent opacity-20 rounded-full"></div>
                <svg class="w-6 h-6 text-white relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
            <p class="text-[10px] uppercase tracking-[0.3em] text-muted mb-0.5">Sistem Pengarsipan</p>
            <h1 class="text-2xl font-semibold tracking-tight" style="font-family: 'Georgia', serif; color: #141E30;">
                E-Arsip
                <span class="text-accent text-3xl ml-0.5">·</span>
            </h1>
        </div>

        <!-- Card dengan bayangan elegan -->
        <div class="bg-card border border-stone-200/70 rounded-2xl shadow-xl overflow-hidden backdrop-blur-sm">

            <div class="px-8 pt-5 pb-2 border-b border-stone-100 text-center">
                <h2 class="text-base font-semibold" style="font-family: 'Georgia', serif; color: #141E30;">Masuk ke Akun</h2>
                <p class="text-xs text-muted mt-0.5">Silakan masuk untuk melanjutkan.</p>
            </div>

            <!-- Alerts dengan sentuhan warna -->
            <div class="px-8 pt-3 space-y-2">
                @if(session('success'))
                    <div class="flex items-center gap-2.5 px-4 py-2.5 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs rounded-xl">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="flex items-center gap-2.5 px-4 py-2.5 bg-red-50 border border-red-200 text-red-600 text-xs rounded-xl">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('info'))
                    <div class="flex items-center gap-2.5 px-4 py-2.5 bg-stone-50 border border-stone-200 text-slate-600 text-xs rounded-xl">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ session('info') }}
                    </div>
                @endif
            </div>

            <!-- Form -->
            <form action="{{ route('login.proses') }}" method="POST">
                @csrf

                <div class="px-8 py-4 space-y-4">

                    <!-- Email dengan aksen emas saat focus -->
                    <div>
                        <label class="block text-[11px] uppercase tracking-[0.2em] text-muted font-medium mb-1.5 flex items-center gap-1">
                            <span class="w-1 h-1 bg-accent rounded-full"></span>
                            Email
                        </label>
                        <input type="email" name="email"
                               value="{{ old('email') }}"
                               placeholder="admin@example.com"
                               required
                               class="w-full bg-soft border border-stone-200 rounded-xl px-4 py-3 text-sm text-body placeholder-stone-300 focus:outline-none focus:border-accent focus:ring-1 focus:ring-accent/20 focus:bg-white transition-all duration-200 {{ $errors->has('email') ? 'border-red-300' : '' }}">
                        @error('email')
                            <p class="text-xs text-red-400 mt-1 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-[11px] uppercase tracking-[0.2em] text-muted font-medium mb-1.5 flex items-center gap-1">
                            <span class="w-1 h-1 bg-accent rounded-full"></span>
                            Password
                        </label>
                        <input type="password" name="password"
                               placeholder="••••••••"
                               required
                               class="w-full bg-soft border border-stone-200 rounded-xl px-4 py-3 text-sm text-body placeholder-stone-300 focus:outline-none focus:border-accent focus:ring-1 focus:ring-accent/20 focus:bg-white transition-all duration-200 {{ $errors->has('password') ? 'border-red-300' : '' }}">
                        @error('password')
                            <p class="text-xs text-red-400 mt-1 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                  
                </div>

                <!-- Footer Aksi dengan tombol elegan -->
                <div class="px-8 py-4 bg-soft border-t border-stone-100">
                    <button type="submit"
                            class="group relative w-full py-3 text-sm font-medium text-white bg-primary hover:bg-secondary rounded-xl transition-all duration-300 hover:-translate-y-0.5 shadow-lg shadow-primary/20 hover:shadow-xl overflow-hidden">
                      
                        <span class="absolute inset-0 bg-accent opacity-0 group-hover:opacity-10 transition-opacity duration-300"></span>
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            Masuk
                        </span>
                    </button>
                </div>

            </form>
        </div>

       
        <div class="flex items-center justify-center gap-3 mt-5">
            <span class="h-px w-8 bg-gradient-to-r from-transparent to-accent/30"></span>
            <p class="text-[10px] tracking-widest uppercase text-muted">
                &copy; {{ date('Y') }} E-Arsip System
            </p>
            <span class="h-px w-8 bg-gradient-to-l from-transparent to-accent/30"></span>
        </div>

        <!-- Decorative elements -->
        <div class="absolute top-0 left-0 w-64 h-64 bg-primary/5 rounded-full blur-3xl -z-10"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-accent/5 rounded-full blur-3xl -z-10"></div>

    </div>

</body>
</html> 