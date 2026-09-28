@props([
    'href' => null,
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'icon' => null,
    'loading' => false,
    'block' => false,
])

@php

$variants = [

    'primary' => 'btn-electo btn-electo-primary',

    'secondary' => 'btn-electo btn-electo-secondary',

    'danger' => 'btn-electo bg-red-600 text-white hover:bg-red-700',

    'success' => 'btn-electo bg-emerald-600 text-white hover:bg-emerald-700',

    'outline' => 'btn-electo border border-indigo-600 text-indigo-600 hover:bg-indigo-600 hover:text-white',

];

$sizes = [

    'sm' => 'px-4 py-2 text-sm',

    'md' => 'px-6 py-3 text-sm',

    'lg' => 'px-8 py-4 text-base',

];

$classes = ($variants[$variant] ?? $variants['primary'])
    .' '
    .($sizes[$size] ?? $sizes['md'])
    .' '
    .($block ? 'w-full' : '');

@endphp

@if($href)

<a
    href="{{ $href }}"
    {{ $attributes->merge(['class'=>$classes]) }}
>

    @if($icon)

        <x-dynamic-component
            :component="'heroicon-o-'.$icon"
            class="w-5 h-5"
        />

    @endif

    {{ $slot }}

</a>

@else

<button

    type="{{ $type }}"

    {{ $attributes->merge(['class'=>$classes]) }}

>

    @if($loading)

        <svg
            class="w-5 h-5 animate-spin"
            fill="none"
            viewBox="0 0 24 24">

            <circle
                class="opacity-25"
                cx="12"
                cy="12"
                r="10"
                stroke="currentColor"
                stroke-width="4"/>

            <path
                class="opacity-75"
                fill="currentColor"
                d="M4 12a8 8 0 018-8v8z"/>

        </svg>

    @elseif($icon)

        <x-dynamic-component
            :component="'heroicon-o-'.$icon"
            class="w-5 h-5"
        />

    @endif

    {{ $slot }}

</button>

@endif