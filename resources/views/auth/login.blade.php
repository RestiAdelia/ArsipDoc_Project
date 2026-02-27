<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-stone-50 min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-sm">

        <!-- Logo / Brand -->
        <div class="text-center mb-8">
            <div class="w-12 h-12 rounded-2xl bg-slate-900 flex items-center justify-center mx-auto mb-4">
                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
            <p class="text-[10px] uppercase tracking-[0.3em] text-slate-400 mb-1">Sistem Pengarsipan</p>
            <h1 class="text-xl font-semibold text-slate-800" style="font-family: 'Georgia', serif;">E-Arsip</h1>
        </div>

        <!-- Card -->
        <div class="bg-white border border-stone-200 rounded-2xl shadow-sm overflow-hidden">

            <div class="px-8 pt-7 pb-2">
                <h2 class="text-base font-semibold text-slate-800" style="font-family: 'Georgia', serif;">Masuk ke Akun</h2>
                <p class="text-xs text-slate-400 mt-0.5">Silakan masuk untuk melanjutkan.</p>
            </div>

            <!-- Alerts -->
            <div class="px-8 pt-4 space-y-3">
                @if(session('success'))
                    <div class="flex items-center gap-2.5 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs rounded-xl">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="flex items-center gap-2.5 px-4 py-3 bg-red-50 border border-red-200 text-red-600 text-xs rounded-xl">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('info'))
                    <div class="flex items-center gap-2.5 px-4 py-3 bg-stone-50 border border-stone-200 text-slate-600 text-xs rounded-xl">
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

                <div class="px-8 py-6 space-y-5">

                    <!-- Email -->
                    <div>
                        <label class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">Email</label>
                        <input type="email" name="email"
                               value="{{ old('email') }}"
                               placeholder="admin@example.com"
                               required
                               class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-300 focus:outline-none focus:border-slate-400 focus:bg-white transition-colors duration-200 {{ $errors->has('email') ? 'border-red-300' : '' }}">
                        @error('email')
                            <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-[11px] uppercase tracking-[0.2em] text-slate-400 font-medium mb-2">Password</label>
                        <input type="password" name="password"
                               placeholder="••••••••"
                               required
                               class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-300 focus:outline-none focus:border-slate-400 focus:bg-white transition-colors duration-200 {{ $errors->has('password') ? 'border-red-300' : '' }}">
                        @error('password')
                            <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <!-- Footer Aksi -->
                <div class="px-8 py-5 bg-stone-50 border-t border-stone-100">
                    <button type="submit"
                            class="w-full py-2.5 text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 rounded-xl transition-all duration-200 hover:-translate-y-0.5 shadow-md shadow-slate-900/15">
                        Masuk
                    </button>
                </div>

            </form>
        </div>

        <!-- Footer -->
        <p class="text-center text-[11px] tracking-widest uppercase text-slate-400 mt-6">
            &copy; {{ date('Y') }} Sistem Pengarsipan Dokumen
        </p>

    </div>

</body>
</html>