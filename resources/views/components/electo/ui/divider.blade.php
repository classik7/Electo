@props([
    'label' => '',
])

<div class="relative my-8">

    <div class="absolute inset-0 flex items-center">

        <div class="w-full border-t border-slate-200"></div>

    </div>

    @if($label)

        <div class="relative flex justify-center">

            <span class="bg-white px-4 text-sm text-slate-500">

                {{ $label }}

            </span>

        </div>

    @endif

</div>