@props([
    'type' => 'submit',
    'variant' => 'primary',
])

@php
    $classes = match ($variant) {
        'success' => 'bg-green-600 hover:bg-green-700 focus:ring-green-500 text-white',
        'danger' => 'bg-red-600 hover:bg-red-700 focus:ring-red-500 text-white',
        'warning' => 'bg-yellow-500 hover:bg-yellow-600 focus:ring-yellow-500 text-black',
        'secondary' => 'bg-slate-700 hover:bg-slate-600 border border-slate-500 focus:ring-slate-500 text-white',
        default => 'bg-blue-600 hover:bg-blue-700 focus:ring-blue-500 text-white',
    };
@endphp

<button
    type="{{ $type }}"
    {{ $attributes->class([
        'inline-flex items-center justify-center gap-2 rounded-xl px-5 py-3 font-semibold transition-all duration-200 hover:scale-[1.02] active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-[#081225] disabled:opacity-50 disabled:cursor-not-allowed',
        $classes,
    ]) }}>
    {{ $slot }}
</button>