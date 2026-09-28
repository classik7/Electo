@props([
    'color' => 'blue'
])

@php
$classes = match($color) {
    'green' => 'bg-green-500/20 text-green-400',
    'red' => 'bg-red-500/20 text-red-400',
    'yellow' => 'bg-yellow-500/20 text-yellow-400',
    'gray' => 'bg-gray-500/20 text-gray-300',
    default => 'bg-blue-500/20 text-blue-400',
};
@endphp

<span {{ $attributes->merge([
    'class' => "inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold $classes"
]) }}>
    {{ $slot }}
</span>