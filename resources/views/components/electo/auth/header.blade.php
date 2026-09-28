@props([
    'title' => '',
    'subtitle' => '',
])

<div class="mb-8">

    <h1 class="text-3xl font-black text-slate-900">

        {{ $title }}

    </h1>

    @if($subtitle)

        <p class="mt-3 text-slate-500 leading-relaxed">

            {{ $subtitle }}

        </p>

    @endif

</div>