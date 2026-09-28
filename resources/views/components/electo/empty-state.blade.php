@props([
    'title',
    'description',
])

<div class="py-16 text-center">

    <div class="text-5xl mb-4">
        📂
    </div>

    <h2 class="text-2xl font-semibold text-white">
        {{ $title }}
    </h2>

    <p class="text-gray-400 mt-3 max-w-md mx-auto">
        {{ $description }}
    </p>

    @isset($actions)
        <div class="mt-8">
            {{ $actions }}
        </div>
    @endisset

</div>