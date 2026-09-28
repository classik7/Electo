@props([
    'title',
    'value',
    'icon' => '📊',
    'color' => 'blue'
])

@php

$colors = [
    'blue' => 'text-blue-500 dark:text-blue-400',
    'green' => 'text-green-500 dark:text-green-400',
    'yellow' => 'text-yellow-500 dark:text-yellow-400',
    'red' => 'text-red-500 dark:text-red-400',
];

$textColor = $colors[$color] ?? $colors['blue'];

@endphp


<div
    class="rounded-2xl
           border
           border-slate-200
           bg-white
           p-6
           shadow-lg
           transition
           hover:shadow-xl

           dark:border-white/10
           dark:bg-[#132544]"
>

    <div
        class="flex
               items-center
               justify-between"
    >

        <div>

            {{-- ================================================= --}}
            {{-- TITLE --}}
            {{-- ================================================= --}}

            <p
                class="text-sm
                       text-slate-500

                       dark:text-gray-400"
            >
                {{ $title }}
            </p>


            {{-- ================================================= --}}
            {{-- VALUE --}}
            {{-- ================================================= --}}

            <h2
                class="mt-2
                       text-3xl
                       font-bold
                       text-slate-900

                       dark:text-white"
            >
                {{ $value }}
            </h2>

        </div>


        {{-- ================================================= --}}
        {{-- ICON --}}
        {{-- ================================================= --}}

        <div
            class="text-4xl
                   {{ $textColor }}"
        >
            {{ $icon }}
        </div>

    </div>

</div>