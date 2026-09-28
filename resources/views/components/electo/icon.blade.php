@props([
    'name',
    'class' => 'w-5 h-5',
])

@switch($name)

    @case('arrow-left')

        <svg xmlns="http://www.w3.org/2000/svg"
             fill="none"
             viewBox="0 0 24 24"
             stroke-width="1.5"
             stroke="currentColor"
             {{ $attributes->merge(['class' => $class]) }}>

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>

        </svg>

        @break


    @case('plus')

        <svg xmlns="http://www.w3.org/2000/svg"
             fill="none"
             viewBox="0 0 24 24"
             stroke-width="1.5"
             stroke="currentColor"
             {{ $attributes->merge(['class' => $class]) }}>

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M12 4.5v15m7.5-7.5h-15"/>

        </svg>

        @break


    @case('eye')

        <svg xmlns="http://www.w3.org/2000/svg"
             fill="none"
             viewBox="0 0 24 24"
             stroke-width="1.5"
             stroke="currentColor"
             {{ $attributes->merge(['class' => $class]) }}>

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M2.25 12S5.25 5.25 12 5.25 21.75 12 21.75 12 18.75 18.75 12 18.75 2.25 12 2.25 12Z"/>

            <circle cx="12"
                    cy="12"
                    r="3"/>

        </svg>

        @break


    @case('pencil')

        <svg xmlns="http://www.w3.org/2000/svg"
             fill="none"
             viewBox="0 0 24 24"
             stroke-width="1.5"
             stroke="currentColor"
             {{ $attributes->merge(['class' => $class]) }}>

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M16.862 4.487a2.25 2.25 0 113.182 3.182L8.25 19.463 3.75 20.25l.787-4.5L16.862 4.487Z"/>

        </svg>

        @break


    @case('trash')

        <svg xmlns="http://www.w3.org/2000/svg"
             fill="none"
             viewBox="0 0 24 24"
             stroke-width="1.5"
             stroke="currentColor"
             {{ $attributes->merge(['class' => $class]) }}>

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M6 7.5h12M9.75 7.5V6A1.5 1.5 0 0111.25 4.5h1.5A1.5 1.5 0 0114.25 6v1.5m-7.5 0v10.5A1.5 1.5 0 008.25 19.5h7.5A1.5 1.5 0 0017.25 18V7.5"/>

        </svg>

        @break


    @default

        <svg xmlns="http://www.w3.org/2000/svg"
             fill="none"
             viewBox="0 0 24 24"
             stroke-width="1.5"
             stroke="currentColor"
             {{ $attributes->merge(['class' => $class]) }}>

            <circle cx="12"
                    cy="12"
                    r="10"/>

        </svg>

@endswitch