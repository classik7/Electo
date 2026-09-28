<!DOCTYPE html>

<html
    lang="{{ str_replace('-', '-', app()->getLocale()) }}"
>

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Electo')
    </title>


    {{-- ========================================================= --}}
    {{-- ELECTO THEME INITIALIZATION --}}
    {{-- ========================================================= --}}

    <script>

        (() => {

            const theme = @json(
                auth()->check()
                    ? (auth()->user()->settings?->theme ?? 'dark')
                    : 'dark'
            );

            const root = document.documentElement;

            root.classList.remove('dark');

            if (theme === 'dark') {

                root.classList.add('dark');

            }

            else if (theme === 'system') {

                if (
                    window.matchMedia(
                        '(prefers-color-scheme: dark)'
                    ).matches
                ) {

                    root.classList.add('dark');

                }

            }

        })();

    </script>


    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>


<body
    class="
        min-h-screen
        w-full
        overflow-x-hidden
        bg-slate-50
        text-slate-900
        antialiased
        transition-colors
        duration-300

        dark:bg-[#081225]
        dark:text-white
    "
>


    {{-- ========================================================= --}}
    {{-- APPLICATION SHELL --}}
    {{-- ========================================================= --}}

    <div
        class="
            flex
            min-h-screen
            w-full
            min-w-0
        "
    >


        {{-- ===================================================== --}}
        {{-- SIDEBAR --}}
        {{-- ===================================================== --}}

        <x-electo.sidebar />


        {{-- ===================================================== --}}
        {{-- MAIN APPLICATION COLUMN --}}
        {{-- ===================================================== --}}

        <div
            class="
                flex
                min-h-screen
                min-w-0
                flex-1
                flex-col
            "
        >


            {{-- ================================================= --}}
            {{-- TOP NAVIGATION --}}
            {{-- ================================================= --}}

            <div class="w-full min-w-0">

                <x-electo.topbar />

            </div>


            {{-- ================================================= --}}
            {{-- PAGE CONTENT --}}
            {{-- ================================================= --}}

            <main
                class="
                    min-w-0
                    w-full
                    flex-1

                    px-4
                    py-5

                    sm:px-5
                    sm:py-6

                    lg:px-6
                    lg:py-7

                    xl:px-8
                    xl:py-8
                "
            >


                {{-- ================================================= --}}
                {{-- SUCCESS MESSAGE --}}
                {{-- ================================================= --}}

                @if(session('success'))

                    <div
                        class="
                            mb-5
                            w-full
                            rounded-2xl
                            border
                            border-emerald-200
                            bg-emerald-50
                            px-5
                            py-4
                            text-sm
                            font-medium
                            text-emerald-700
                            shadow-sm

                            dark:border-emerald-500/20
                            dark:bg-emerald-500/[0.06]
                            dark:text-emerald-400
                        "
                    >

                        <div class="flex items-center gap-3">

                            <span
                                class="
                                    flex
                                    h-8
                                    w-8
                                    shrink-0
                                    items-center
                                    justify-center
                                    rounded-xl
                                    bg-emerald-100
                                    text-emerald-600

                                    dark:bg-emerald-500/10
                                    dark:text-emerald-400
                                "
                            >

                                <svg
                                    class="h-4 w-4"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M5 13l4 4L19 7"
                                    />

                                </svg>

                            </span>


                            <span>
                                {{ session('success') }}
                            </span>

                        </div>

                    </div>

                @endif



                {{-- ================================================= --}}
                {{-- ERROR MESSAGE --}}
                {{-- ================================================= --}}

                @if(session('error'))

                    <div
                        class="
                            mb-5
                            w-full
                            rounded-2xl
                            border
                            border-red-200
                            bg-red-50
                            px-5
                            py-4
                            text-sm
                            font-medium
                            text-red-700
                            shadow-sm

                            dark:border-red-500/20
                            dark:bg-red-500/[0.06]
                            dark:text-red-400
                        "
                    >

                        <div class="flex items-center gap-3">

                            <span
                                class="
                                    flex
                                    h-8
                                    w-8
                                    shrink-0
                                    items-center
                                    justify-center
                                    rounded-xl
                                    bg-red-100
                                    text-red-600

                                    dark:bg-red-500/10
                                    dark:text-red-400
                                "
                            >

                                <svg
                                    class="h-4 w-4"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 9v4m0 4h.01"
                                    />

                                    <circle
                                        cx="12"
                                        cy="12"
                                        r="9"
                                    />

                                </svg>

                            </span>


                            <span>
                                {{ session('error') }}
                            </span>

                        </div>

                    </div>

                @endif



                {{-- ================================================= --}}
                {{-- PAGE CONTENT --}}
                {{-- ================================================= --}}

                <div
                    class="
                        w-full
                        min-w-0
                    "
                >

                    @yield('content')

                </div>


            </main>

        </div>

    </div>


</body>

</html>