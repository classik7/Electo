@props([
    'title',
    'subtitle' => ''
])

<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-8">

    <div>

        <h1 class="text-3xl font-bold text-white">
            {{ $title }}
        </h1>

        @if($subtitle)
            <p class="mt-2 text-gray-400">
                {{ $subtitle }}
            </p>
        @endif

    </div>

    @isset($actions)
        <div class="flex items-center gap-3">
            {{ $actions }}
        </div>
    @endisset

</div>