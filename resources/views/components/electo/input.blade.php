@props([
    'label' => '',
    'name',
    'type' => 'text',
    'value' => '',
])

<div class="space-y-2">

    @if($label)

        <label
            for="{{ $name }}"
            class="block text-sm font-semibold text-slate-700"
        >
            {{ $label }}

            @if($attributes->has('required'))
                <span class="text-red-500">*</span>
            @endif
        </label>

    @endif


    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ old($name, $value) }}"

        {{ $attributes->merge([
            'class' =>
                'w-full rounded-xl
                border border-slate-200
                bg-white
                px-4 py-3
                text-sm text-slate-800
                placeholder:text-slate-400
                shadow-sm
                outline-none
                transition duration-200
                focus:border-blue-500
                focus:ring-4
                focus:ring-blue-500/10
                hover:border-slate-300'
        ]) }}
    >


    @error($name)

        <p class="text-sm text-red-500">
            {{ $message }}
        </p>

    @enderror

</div>