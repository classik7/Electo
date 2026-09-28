<!DOCTYPE html>

<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
>

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>
        @yield('title', config('app.name', 'Electo'))
    </title>


    {{-- ========================================================= --}}
    {{-- ELECTO THEME INITIALIZATION --}}
    {{-- ========================================================= --}}

    <script>

        (() => {

            const theme = @json(
                auth()->check()
                    ? auth()->user()->settings?->theme ?? 'dark'
                    : 'dark'
            );

            const root = document.documentElement;

            root.classList.remove('dark');

            if (theme === 'dark') {

                root.classList.add('dark');

            } else if (theme === 'system') {

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


    {{-- ========================================================= --}}
    {{-- FONTS --}}
    {{-- ========================================================= --}}

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >


    {{-- ========================================================= --}}
    {{-- GLOBAL MOBILE SAFETY --}}
    {{-- ========================================================= --}}

    <style>

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }


        html {
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
        }


        body {
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
        }


        img,
        svg,
        video,
        canvas {
            max-width: 100%;
        }


        /* Prevent long text/URLs from forcing pages wider */

        main {
            min-width: 0;
            max-width: 100%;
        }


        /* Tables remain usable without breaking the page */

        main table {
            max-width: 100%;
        }


        /* Common flex/grid children must be allowed to shrink */

        main > *,
        main .flex,
        main .grid {
            min-width: 0;
        }


        /* =====================================================
           MOBILE APPLICATION SHELL
        ====================================================== */

        @media (max-width: 1023px) {

            .electo-app-shell {
                width: 100%;
                max-width: 100%;
                min-width: 0;
            }

            .electo-app-main {
                width: 100%;
                max-width: 100%;
                min-width: 0;
            }

            .electo-app-content {
                width: 100%;
                max-width: 100%;
                min-width: 0;
            }

        }


        @media (max-width: 640px) {

            .electo-app-content {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
                padding-top: 1rem !important;
                padding-bottom: 1.5rem !important;
            }


            /*
             * Stop common cards from becoming wider
             * than the phone screen.
             */

            .electo-app-content > *,
            .electo-app-content section,
            .electo-app-content article,
            .electo-app-content .card {
                max-width: 100%;
            }


            /*
             * Allow horizontal content such as large
             * tables to scroll inside its own container.
             */

            .electo-app-content table {
                min-width: 0;
            }


            /*
             * Long words and labels should wrap rather
             * than create horizontal overflow.
             */

            .electo-app-content h1,
            .electo-app-content h2,
            .electo-app-content h3,
            .electo-app-content h4,
            .electo-app-content p,
            .electo-app-content span,
            .electo-app-content a,
            .electo-app-content label {
                overflow-wrap: anywhere;
            }

        }


        @media (max-width: 380px) {

            .electo-app-content {
                padding-left: .75rem !important;
                padding-right: .75rem !important;
            }

        }

    </style>

</head>


<body
    class="
        min-h-screen
        w-full
        max-w-full
        overflow-x-hidden

        bg-white
        text-slate-900

        transition-colors
        duration-300

        dark:bg-[#081225]
        dark:text-white
    "
>


    {{-- ============================================================= --}}
    {{-- ANIMATED BACKGROUND --}}
    {{-- ============================================================= --}}

    @include('electo.components.background.background')


    {{-- ============================================================= --}}
    {{-- ELECTO APPLICATION SHELL --}}
    {{-- ============================================================= --}}

    <div
        class="electo-app-shell relative z-10 flex min-h-screen w-full max-w-full min-w-0"
    >


        {{-- ========================================================= --}}
        {{-- SIDEBAR --}}
        {{-- ========================================================= --}}

        <x-electo.sidebar />


        {{-- ========================================================= --}}
        {{-- MAIN APPLICATION AREA --}}
        {{-- ========================================================= --}}

        <div
            class="
                electo-app-main
                flex
                min-w-0
                max-w-full
                flex-1
                flex-col

                bg-transparent
            "
        >


            {{-- ===================================================== --}}
            {{-- TOPBAR --}}
            {{-- ===================================================== --}}

            <x-electo.topbar />


            {{-- ===================================================== --}}
            {{-- PAGE CONTENT --}}
            {{-- ===================================================== --}}

            <main
                class="
                    electo-app-content
                    min-w-0
                    max-w-full
                    flex-1

                    p-4
                    sm:p-5
                    lg:p-8

                    bg-transparent

                    transition-colors
                    duration-300
                "
            >


                {{-- ================================================= --}}
                {{-- SUCCESS MESSAGE --}}
                {{-- ================================================= --}}

                @if(session('success'))

                    <div
                        class="
                            mb-6
                            max-w-full
                            overflow-hidden
                            rounded-xl
                            border
                            border-green-200
                            bg-green-50
                            px-4
                            py-4
                            text-sm
                            text-green-700
                            shadow-sm

                            dark:border-green-500/30
                            dark:bg-green-500/10
                            dark:text-green-300

                            sm:px-5
                        "
                    >

                        {{ session('success') }}

                    </div>

                @endif


                {{-- ================================================= --}}
                {{-- ERROR MESSAGE --}}
                {{-- ================================================= --}}

                @if(session('error'))

                    <div
                        class="
                            mb-6
                            max-w-full
                            overflow-hidden
                            rounded-xl
                            border
                            border-red-200
                            bg-red-50
                            px-4
                            py-4
                            text-sm
                            text-red-700
                            shadow-sm

                            dark:border-red-500/30
                            dark:bg-red-500/10
                            dark:text-red-300

                            sm:px-5
                        "
                    >

                        {{ session('error') }}

                    </div>

                @endif


                {{-- ================================================= --}}
                {{-- VALIDATION ERRORS --}}
                {{-- ================================================= --}}

                @if($errors->any())

                    <div
                        class="
                            mb-6
                            max-w-full
                            overflow-hidden
                            rounded-xl
                            border
                            border-red-200
                            bg-red-50
                            px-4
                            py-4
                            shadow-sm

                            dark:border-red-500/30
                            dark:bg-red-500/10

                            sm:px-5
                        "
                    >

                        <p
                            class="
                                mb-2
                                text-sm
                                font-semibold
                                text-red-700

                                dark:text-red-300
                            "
                        >
                            Please correct the following:
                        </p>


                        <ul
                            class="
                                list-disc
                                space-y-1
                                pl-5
                                text-xs
                                text-red-600

                                dark:text-red-300
                            "
                        >

                            @foreach($errors->all() as $error)

                                <li class="break-words">
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                {{-- ================================================= --}}
                {{-- PAGE CONTENT --}}
                {{-- ================================================= --}}

                @yield('content')


            </main>

        </div>

    </div>


</body>

</html>