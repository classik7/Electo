@props([
    'label' => '',
    'name',
    'type' => 'text',
    'placeholder' => '',
    'icon' => null,

    'value' => null,

    'helper' => '',

    'required' => false,
    'disabled' => false,
    'readonly' => false,

    'autocomplete' => null,
    'autofocus' => false,
])

@php

$hasError = $errors->has($name);

$inputValue = in_array($type, ['password', 'password_confirmation'])
    ? ''
    : old($name, $value);

@endphp

<div class="space-y-2">

    @if($label)

        <label
            for="{{ $name }}"
            class="block text-sm font-semibold text-slate-700">

            {{ $label }}

            @if($required)

                <span class="text-red-500">*</span>

            @endif

        </label>

    @endif

    <div class="relative">

        @if($icon)

            <div
                class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">

                <x-dynamic-component
                    :component="'heroicon-o-'.$icon"
                    class="h-5 w-5 text-slate-400" />

            </div>

        @endif

        <input

            id="{{ $name }}"

            name="{{ $name }}"

            type="{{ $type }}"

            value="{{ $inputValue }}"

            placeholder="{{ $placeholder }}"

            autocomplete="{{ $autocomplete }}"

            @if($autofocus) autofocus @endif
            @if($required) required @endif
            @if($disabled) disabled @endif
            @if($readonly) readonly @endif

            {{ $attributes->merge([

                'class' =>

                    'input-electo '

                    .($icon ? 'pl-12 ' : '')

                    .($hasError
                        ? 'border-red-500 focus:border-red-500 focus:ring-red-100 '
                        : '')

                    .($disabled
                        ? 'opacity-60 cursor-not-allowed '
                        : '')

            ]) }}

        >

    </div>

    @if($helper && !$hasError)

        <p class="text-sm text-slate-500">

            {{ $helper }}

        </p>

    @endif

    @error($name)

        <p class="text-sm font-medium text-red-500">

            {{ $message }}

        </p>

    @enderror

</div>