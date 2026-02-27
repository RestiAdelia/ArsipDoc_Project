@extends('layouts.main')

@section('title', 'Data User')

@section('content')
<div class="space-y-5">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 mb-0.5">Admin</p>
            <h1 class="text-lg font-semibold text-slate-800" style="font-family: 'Georgia', serif;">
                Manajemen User
            </h1>
        </div>

        <a href="{{ route('admin.user.create') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-sm font-medium rounded-xl transition-all duration-200 shadow-md shadow-slate-900/15">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah User
        </a>
    </div>

    <!-- Alert -->
    @if(session('success'))
        <div class="px-5 py-3 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table -->
    <div class="overflow-x-auto border border-stone-200 rounded-2xl shadow-sm">
        <table class="w-full text-sm text-left">
            <thead>
                <tr class="border-b border-stone-200 bg-stone-50">
                    <th class="px-5 py-3 text-xs uppercase text-slate-400">No</th>
                    <th class="px-5 py-3 text-xs uppercase text-slate-400">Nama</th>
                    <th class="px-5 py-3 text-xs uppercase text-slate-400">Email</th>
                    <th class="px-5 py-3 text-xs uppercase text-slate-400">Alamat</th>
                    <th class="px-5 py-3 text-xs uppercase text-slate-400">Role</th>
                   
                </tr>
            </thead>

            <tbody class="divide-y divide-stone-100 bg-white">
                @forelse($users as $index => $user)
                <tr class="hover:bg-stone-50">

                    <!-- No -->
                    <td class="px-5 py-4 text-xs text-slate-400">
                        {{ $users->firstItem() + $index }}
                    </td>

                    <!-- Nama -->
                    <td class="px-5 py-4 font-medium text-slate-700">
                        {{ $user->name }}
                    </td>

                    <!-- Email -->
                    <td class="px-5 py-4 text-slate-600 text-sm">
                        {{ $user->email }}
                    </td>

                    <!-- Instansi -->
                    <td class="px-5 py-4 text-slate-600 text-sm">
                        {{ $user->alamat ?? '-' }}
                    </td>

                    <!-- Role Badge -->
                    <td class="px-5 py-4">
                        @if($user->role == 'admin')
                            <span class="px-3 py-1 text-xs rounded-full bg-purple-100 text-purple-700">
                                Admin
                            </span>

                        @elseif ($user->role == 'superadmin')
                        <span class="px-3 py-1 text-xs rounded-full bg-slate-100 text-slate-700">
                                Super Admin
                            </span>
                        @else
                            <span class="px-3 py-1 text-xs rounded-full bg-slate-100 text-slate-700">
                                User
                            </span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-16 text-center text-slate-400">
                        Belum ada data user.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex justify-end">
        {{ $users->links() }}
    </div>

</div>
@endsection