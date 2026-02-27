@extends('layouts.main')

@section('content')
<div class="max-w-2xl mx-auto space-y-5">

    {{-- Header --}}
    <div>
        <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400 mb-1">
            Generate Surat
        </p>
        <h1 class="text-lg font-semibold text-slate-800" style="font-family: Georgia, serif;">
            Form {{ $template->nama_template }}
        </h1>
    </div>

    {{-- Alert error --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-300 text-red-700 p-3 rounded-lg text-sm">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form --}}
    <div class="bg-white border border-stone-200 rounded-2xl shadow-sm">
        <form method="POST" action="{{ route('template.preview', $template->id) }}">
            @csrf

            <div class="p-6 space-y-4">

                @php
                    $fieldsSafe = is_array($fields) ? $fields : [];
                @endphp

                @forelse ($fieldsSafe as $field)
                    @if (is_array($field) && isset($field['name']))
                        <div>
                            <label class="block text-sm text-slate-600 mb-1">
                                {{ $field['label'] ?? ucfirst($field['name']) }}
                            </label>

                            {{-- TEXTAREA --}}
                            @if (($field['type'] ?? '') === 'textarea')
                                <textarea
                                    name="{{ $field['name'] }}"
                                    class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-slate-400"
                                    rows="3"
                                    required
                                >{{ old($field['name']) }}</textarea>

                            {{-- INPUT --}}
                            @else
                                <input
                                    type="{{ $field['type'] ?? 'text' }}"
                                    name="{{ $field['name'] }}"
                                    value="{{ old($field['name']) }}"
                                    class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-slate-400"
                                    required
                                >
                            @endif
                        </div>
                    @endif
                @empty
                    <div class="text-center py-6">
                        <p class="text-red-500 text-sm">
                            ⚠️ Field belum diset di template.
                        </p>
                    </div>
                @endforelse

            </div>

            {{-- Footer --}}
            <div class="px-6 py-4 bg-stone-50 flex justify-end">
                <button
                    type="submit"
                    class="px-5 py-2 bg-slate-900 text-white text-sm rounded-xl hover:bg-slate-800 transition">
                    Generate Surat
                </button>
            </div>

        </form>
    </div>

</div>
@endsection