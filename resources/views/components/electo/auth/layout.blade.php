<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      class="scroll-smooth">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>
        {{ config('app.name', 'Electo') }}
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>


<body
    class="min-h-screen bg-slate-50 text-slate-900 antialiased transition-colors duration-300 dark:bg-[#071326] dark:text-white"
>


<div
    class="relative min-h-screen overflow-hidden"
>


    {{-- ================================================= --}}
    {{-- BACKGROUND EFFECTS --}}
    {{-- ================================================= --}}

    <div
        class="pointer-events-none absolute inset-0 overflow-hidden"
    >

        <div
            class="absolute -left-40 -top-40 h-[500px] w-[500px] rounded-full bg-blue-500/10 blur-[140px] dark:bg-blue-500/15"
        ></div>

        <div
            class="absolute -bottom-40 -right-40 h-[500px] w-[500px] rounded-full bg-cyan-400/10 blur-[140px] dark:bg-indigo-500/15"
        ></div>

        <div
            class="absolute left-1/2 top-1/2 h-[400px] w-[400px] -translate-x-1/2 -translate-y-1/2 rounded-full bg-indigo-400/5 blur-[130px]"
        ></div>

    </div>



    {{-- ================================================= --}}
    {{-- TOP BRAND BAR --}}
    {{-- ================================================= --}}

    <header
        class="relative z-20 px-5 pt-5 sm:px-8 lg:px-10"
    >

        <div
            class="mx-auto flex max-w-[1500px] items-center justify-between rounded-2xl border border-slate-200/80 bg-white/85 px-5 py-4 shadow-sm backdrop-blur-xl dark:border-white/10 dark:bg-[#0c1a31]/85 dark:shadow-2xl"
        >

            {{-- BRAND --}}

            <a
                href="{{ url('/') }}"
                class="flex items-center gap-3"
            >

                <div
                    class="flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-blue-600 to-cyan-500 text-xl shadow-lg shadow-blue-500/20"
                >
                    📦
                </div>

                <div>

                    <div
                        class="text-lg font-black tracking-tight text-slate-900 dark:text-white"
                    >
                        Electo
                    </div>

                    <div
                        class="text-[10px] font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400"
                    >
                        Secure Digital Elections
                    </div>

                </div>

            </a>



            {{-- RIGHT CONTROLS --}}

            <div
                class="flex items-center gap-2"
            >

                {{-- HOME --}}

                <a
                    href="{{ url('/') }}"
                    class="hidden rounded-xl px-4 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-blue-600 sm:inline-flex dark:text-slate-300 dark:hover:bg-white/10 dark:hover:text-cyan-300"
                >
                    Home
                </a>


                {{-- THEME TOGGLE --}}

                <button
                    type="button"
                    id="auth-theme-toggle"
                    aria-label="Toggle theme"
                    class="flex h-11 w-11 items-center justify-center rounded-xl border border-slate-200 bg-white text-lg shadow-sm transition hover:-translate-y-0.5 hover:border-blue-300 hover:shadow-md dark:border-white/10 dark:bg-white/5"
                >

                    <span
                        id="auth-theme-icon"
                    >
                        🌙
                    </span>

                </button>


                {{-- REGISTER --}}

                @if (Route::has('register'))

                    <a
                        href="{{ route('register') }}"
                        class="hidden rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-blue-500/20 transition hover:-translate-y-0.5 hover:shadow-blue-500/30 sm:inline-flex"
                    >
                        Create Account
                    </a>

                @endif

            </div>

        </div>

    </header>



    {{-- ================================================= --}}
    {{-- MAIN AUTH AREA --}}
    {{-- ================================================= --}}

    <main
        class="relative z-10 mx-auto grid min-h-[calc(100vh-100px)] max-w-[1500px] items-center gap-10 px-5 py-10 sm:px-8 lg:grid-cols-[1.05fr_.95fr] lg:gap-16 lg:px-10 lg:py-14"
    >


        {{-- ================================================= --}}
        {{-- LEFT BRAND / MARKETING AREA --}}
        {{-- ================================================= --}}

        <section
            class="hidden lg:block"
        >

            <div
                class="max-w-2xl"
            >

                {{-- TRUST BADGES --}}

                <div
                    class="mb-7 flex flex-wrap gap-3"
                >

                    <span
                        class="inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-4 py-2 text-xs font-bold text-blue-700 dark:border-blue-400/20 dark:bg-blue-500/10 dark:text-cyan-300"
                    >

                        <span
                            class="h-2 w-2 rounded-full bg-emerald-500"
                        ></span>

                        Trusted by Organizations

                    </span>


                    <span
                        class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 text-xs font-bold text-slate-600 shadow-sm dark:border-white/10 dark:bg-white/5 dark:text-slate-300"
                    >
                        🇳🇬 Built for Africa
                    </span>

                </div>



                {{-- EYEBROW --}}

                <p
                    class="mb-5 text-xs font-black uppercase tracking-[0.25em] text-blue-600 dark:text-cyan-400"
                >
                    Enterprise Election Platform
                </p>



                {{-- HEADING --}}

                <h1
                    class="max-w-2xl text-5xl font-black leading-[0.98] tracking-[-0.045em] text-slate-950 sm:text-6xl xl:text-[5rem] dark:text-white"
                >

                    Secure

                    <span
                        class="bg-gradient-to-r from-cyan-500 via-blue-600 to-indigo-600 bg-clip-text text-transparent dark:from-cyan-300 dark:via-blue-400 dark:to-indigo-400"
                    >
                        Digital Elections
                    </span>

                    for Modern Organizations.

                </h1>



                {{-- DESCRIPTION --}}

                <p
                    class="mt-7 max-w-xl text-base leading-8 text-slate-600 sm:text-lg dark:text-slate-300"
                >

                    Electo helps universities, schools, governments,
                    companies, churches and associations conduct secure,
                    transparent and verifiable elections.

                </p>



                {{-- FEATURES --}}

                <div
                    class="mt-9 grid max-w-xl grid-cols-1 gap-3 sm:grid-cols-2"
                >

                    <div
                        class="rounded-2xl border border-slate-200 bg-white/80 p-4 shadow-sm backdrop-blur-xl dark:border-white/10 dark:bg-white/5"
                    >

                        <div
                            class="mb-2 flex h-9 w-9 items-center justify-center rounded-xl bg-blue-100 dark:bg-blue-500/15"
                        >
                            🔐
                        </div>

                        <p
                            class="font-bold text-slate-900 dark:text-white"
                        >
                            End-to-End Security
                        </p>

                        <p
                            class="mt-1 text-xs leading-5 text-slate-500 dark:text-slate-400"
                        >
                            Protect every stage of your election.
                        </p>

                    </div>


                    <div
                        class="rounded-2xl border border-slate-200 bg-white/80 p-4 shadow-sm backdrop-blur-xl dark:border-white/10 dark:bg-white/5"
                    >

                        <div
                            class="mb-2 flex h-9 w-9 items-center justify-center rounded-xl bg-cyan-100 dark:bg-cyan-500/15"
                        >
                            ⚡
                        </div>

                        <p
                            class="font-bold text-slate-900 dark:text-white"
                        >
                            Live Results
                        </p>

                        <p
                            class="mt-1 text-xs leading-5 text-slate-500 dark:text-slate-400"
                        >
                            Monitor participation and results in real time.
                        </p>

                    </div>


                    <div
                        class="rounded-2xl border border-slate-200 bg-white/80 p-4 shadow-sm backdrop-blur-xl dark:border-white/10 dark:bg-white/5"
                    >

                        <div
                            class="mb-2 flex h-9 w-9 items-center justify-center rounded-xl bg-indigo-100 dark:bg-indigo-500/15"
                        >
                            📊
                        </div>

                        <p
                            class="font-bold text-slate-900 dark:text-white"
                        >
                            Transparent Results
                        </p>

                        <p
                            class="mt-1 text-xs leading-5 text-slate-500 dark:text-slate-400"
                        >
                            Clear and verifiable election outcomes.
                        </p>

                    </div>


                    <div
                        class="rounded-2xl border border-slate-200 bg-white/80 p-4 shadow-sm backdrop-blur-xl dark:border-white/10 dark:bg-white/5"
                    >

                        <div
                            class="mb-2 flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-100 dark:bg-emerald-500/15"
                        >
                            ☁️
                        </div>

                        <p
                            class="font-bold text-slate-900 dark:text-white"
                        >
                            Cloud Ready
                        </p>

                        <p
                            class="mt-1 text-xs leading-5 text-slate-500 dark:text-slate-400"
                        >
                            Built for organizations of every size.
                        </p>

                    </div>

                </div>

            </div>

        </section>



        {{-- ================================================= --}}
        {{-- AUTH CARD --}}
        {{-- ================================================= --}}

        <section
            class="flex w-full items-center justify-center"
        >

            <div
                class="w-full max-w-[520px]"
            >

                {{-- MOBILE BRAND --}}

                <div
                    class="mb-7 text-center lg:hidden"
                >

                    <a
                        href="{{ url('/') }}"
                        class="inline-flex items-center gap-3"
                    >

                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-blue-600 to-cyan-500 text-xl shadow-lg"
                        >
                            📦
                        </div>

                        <span
                            class="text-2xl font-black text-slate-900 dark:text-white"
                        >
                            Electo
                        </span>

                    </a>

                </div>



                {{-- PREMIUM CARD --}}

                <div
                    class="relative overflow-hidden rounded-[30px] border border-slate-200/80 bg-white/95 p-7 shadow-[0_30px_90px_rgba(15,23,42,0.12)] backdrop-blur-2xl sm:p-9 dark:border-white/10 dark:bg-[#0d1b32]/95 dark:shadow-[0_30px_100px_rgba(0,0,0,0.4)]"
                >

                    {{-- CARD GLOW --}}

                    <div
                        class="pointer-events-none absolute -right-20 -top-20 h-48 w-48 rounded-full bg-blue-500/10 blur-3xl dark:bg-cyan-400/10"
                    ></div>

                    <div
                        class="pointer-events-none absolute -bottom-20 -left-20 h-48 w-48 rounded-full bg-cyan-500/10 blur-3xl dark:bg-indigo-500/10"
                    ></div>


                    {{-- CONTENT --}}

                    <div
                        class="relative z-10"
                    >

                        {{ $slot }}

                    </div>

                </div>


                {{-- FOOTER --}}

                <p
                    class="mt-5 text-center text-xs leading-5 text-slate-500 dark:text-slate-400"
                >

                    By continuing, you agree to Electo's
                    <a
                        href="#"
                        class="font-semibold text-blue-600 hover:text-blue-700 dark:text-cyan-400"
                    >
                        Terms
                    </a>
                    and
                    <a
                        href="#"
                        class="font-semibold text-blue-600 hover:text-blue-700 dark:text-cyan-400"
                    >
                        Privacy Policy
                    </a>.

                </p>

            </div>

        </section>

    </main>

</div>



{{-- ================================================= --}}
{{-- THEME SCRIPT --}}
{{-- ================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const html = document.documentElement;

    const toggle = document.getElementById('auth-theme-toggle');

    const icon = document.getElementById('auth-theme-icon');


    function updateThemeIcon() {

        if (html.classList.contains('dark')) {

            icon.textContent = '☀️';

        } else {

            icon.textContent = '🌙';

        }

    }


    const savedTheme = localStorage.getItem('electo-theme');


    if (savedTheme === 'dark') {

        html.classList.add('dark');

    } else if (savedTheme === 'light') {

        html.classList.remove('dark');

    } else if (
        window.matchMedia &&
        window.matchMedia('(prefers-color-scheme: dark)').matches
    ) {

        html.classList.add('dark');

    }


    updateThemeIcon();


    if (toggle) {

        toggle.addEventListener('click', function () {

            html.classList.toggle('dark');


            localStorage.setItem(
                'electo-theme',
                html.classList.contains('dark')
                    ? 'dark'
                    : 'light'
            );


            updateThemeIcon();

        });

    }

});

</script>

</body>
</html>