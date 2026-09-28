<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ darkMode: localStorage.getItem('electo-theme') === 'dark' }"
      :class="{ 'dark': darkMode }">

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

    <style>

        /* =========================================================
           ELECTO PREMIUM AUTH SYSTEM
        ========================================================= */

        html,
        body {
            min-height: 100%;
        }

        body {
            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;
        }

        /* ---------------------------------------------------------
           LIGHT MODE
        --------------------------------------------------------- */

        .electo-auth-page {
            background:
                radial-gradient(
                    circle at 5% 10%,
                    rgba(37, 99, 235, 0.10),
                    transparent 32%
                ),
                radial-gradient(
                    circle at 95% 85%,
                    rgba(6, 182, 212, 0.10),
                    transparent 30%
                ),
                linear-gradient(
                    135deg,
                    #f8fbff 0%,
                    #ffffff 45%,
                    #f4f8ff 100%
                );
        }

        /* ---------------------------------------------------------
           GRID
        --------------------------------------------------------- */

        .electo-auth-grid {
            background-image:
                linear-gradient(
                    rgba(37, 99, 235, .045) 1px,
                    transparent 1px
                ),
                linear-gradient(
                    90deg,
                    rgba(37, 99, 235, .045) 1px,
                    transparent 1px
                );

            background-size: 48px 48px;
        }

        /* ---------------------------------------------------------
           GLASS HEADER
        --------------------------------------------------------- */

        .auth-topbar {
    background: linear-gradient(
        90deg,
        #2563eb 0%,
        #2563eb 55%,
        #06b6d4 100%
    );

    border: 1px solid rgba(255, 255, 255, .16);

    backdrop-filter: blur(24px);
    -webkit-backdrop-filter: blur(24px);

    box-shadow:
        0 12px 35px rgba(37, 99, 235, .22);
}

        /* ---------------------------------------------------------
           LOGO
        --------------------------------------------------------- */

        .auth-logo-box {
            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #06b6d4
                );

            box-shadow:
                0 12px 30px rgba(37, 99, 235, .25);
        }

        /* ---------------------------------------------------------
           LEFT HERO
        --------------------------------------------------------- */

        .auth-hero-card {
            position: relative;
            overflow: hidden;

            background:
                linear-gradient(
                    135deg,
                    #eff6ff 0%,
                    #ffffff 55%,
                    #ecfeff 100%
                );

            border: 1px solid rgba(148, 163, 184, .18);

            box-shadow:
                0 30px 80px rgba(15, 23, 42, .08);
        }

        .auth-hero-glow-blue {
            position: absolute;
            width: 420px;
            height: 420px;
            top: -180px;
            left: -180px;

            border-radius: 9999px;

            background: rgba(37, 99, 235, .12);

            filter: blur(90px);

            pointer-events: none;
        }

        .auth-hero-glow-cyan {
            position: absolute;
            width: 360px;
            height: 360px;
            right: -180px;
            bottom: -180px;

            border-radius: 9999px;

            background: rgba(6, 182, 212, .12);

            filter: blur(90px);

            pointer-events: none;
        }

        /* ---------------------------------------------------------
           HERO TITLE
        --------------------------------------------------------- */

        .auth-title {
            font-size: clamp(
                2.8rem,
                4.5vw,
                5rem
            );

            line-height: .98;

            letter-spacing: -.055em;

            font-weight: 900;

            color: #0f172a;
        }

        .auth-gradient-text {
            background:
                linear-gradient(
                    90deg,
                    #06b6d4,
                    #2563eb,
                    #6366f1
                );

            -webkit-background-clip: text;
            background-clip: text;

            -webkit-text-fill-color: transparent;
        }

        /* ---------------------------------------------------------
           FEATURE CARDS
        --------------------------------------------------------- */

        .auth-feature {
            background: rgba(255, 255, 255, .72);

            border: 1px solid rgba(148, 163, 184, .20);

            box-shadow:
                0 10px 30px rgba(15, 23, 42, .05);

            transition:
                transform .25s ease,
                box-shadow .25s ease,
                border-color .25s ease;
        }

        .auth-feature:hover {
            transform: translateY(-3px);

            box-shadow:
                0 18px 40px rgba(15, 23, 42, .08);

            border-color:
                rgba(37, 99, 235, .25);
        }

        /* ---------------------------------------------------------
           LOGIN CARD
        --------------------------------------------------------- */

        .auth-card {
            background: rgba(255, 255, 255, .92);

            border: 1px solid rgba(148, 163, 184, .20);

            box-shadow:
                0 35px 90px rgba(15, 23, 42, .12),
                0 8px 30px rgba(37, 99, 235, .05);

            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
        }

        /* ---------------------------------------------------------
           INPUT OVERRIDE
           Your app.css globally forces dark inputs.
           These rules intentionally override that for auth pages.
        --------------------------------------------------------- */

        .electo-auth-page input,
        .electo-auth-page textarea,
        .electo-auth-page select {

            background-color: #ffffff !important;

            color: #0f172a !important;

            border-color:
                #dbe4f0 !important;
        }

        .electo-auth-page input::placeholder,
        .electo-auth-page textarea::placeholder {

            color: #94a3b8 !important;
        }

        .electo-auth-page input:focus,
        .electo-auth-page textarea:focus,
        .electo-auth-page select:focus {

            border-color:
                #2563eb !important;

            box-shadow:
                0 0 0 4px rgba(37, 99, 235, .10) !important;

            outline: none !important;
        }

        /* Chrome autofill */

        .electo-auth-page input:-webkit-autofill,
        .electo-auth-page input:-webkit-autofill:hover,
        .electo-auth-page input:-webkit-autofill:focus {

            -webkit-box-shadow:
                0 0 0 1000px #ffffff inset !important;

            -webkit-text-fill-color:
                #0f172a !important;
        }

        /* ---------------------------------------------------------
           PRIMARY AUTH BUTTON
        --------------------------------------------------------- */

        .auth-primary-button {
            background:
                linear-gradient(
                    90deg,
                    #2563eb,
                    #06b6d4
                ) !important;

            color: white !important;

            border: none !important;

            box-shadow:
                0 12px 28px rgba(37, 99, 235, .22);

            transition:
                transform .2s ease,
                box-shadow .2s ease;
        }

        .auth-primary-button:hover {

            transform:
                translateY(-2px);

            box-shadow:
                0 18px 38px rgba(37, 99, 235, .30);
        }

        /* ---------------------------------------------------------
           DARK MODE
        --------------------------------------------------------- */

        html.dark .electo-auth-page {

            background:
                radial-gradient(
                    circle at 5% 10%,
                    rgba(37, 99, 235, .16),
                    transparent 32%
                ),
                radial-gradient(
                    circle at 95% 85%,
                    rgba(6, 182, 212, .12),
                    transparent 30%
                ),
                #071225;
        }

       

        html.dark .auth-hero-card {

            background:
                linear-gradient(
                    135deg,
                    #0f1d35,
                    #101d33,
                    #0b2535
                );

            border-color:
                rgba(255,255,255,.08);

            box-shadow:
                0 35px 90px rgba(0,0,0,.30);
        }

        html.dark .auth-title {

            color: #ffffff;
        }

        html.dark .auth-feature {

            background:
                rgba(15, 23, 42, .65);

            border-color:
                rgba(255,255,255,.08);

            box-shadow:
                none;
        }

        html.dark .auth-card {

            background:
                rgba(15, 23, 42, .94);

            border-color:
                rgba(255,255,255,.08);

            box-shadow:
                0 35px 90px rgba(0,0,0,.35);
        }

        html.dark .electo-auth-page input,
        html.dark .electo-auth-page textarea,
        html.dark .electo-auth-page select {

            background-color:
                #132544 !important;

            color:
                #ffffff !important;

            border-color:
                rgba(255,255,255,.10) !important;
        }

        html.dark .electo-auth-page input::placeholder,
        html.dark .electo-auth-page textarea::placeholder {

            color:
                #64748b !important;
        }

        html.dark .electo-auth-page input:-webkit-autofill,
        html.dark .electo-auth-page input:-webkit-autofill:hover,
        html.dark .electo-auth-page input:-webkit-autofill:focus {

            -webkit-box-shadow:
                0 0 0 1000px #132544 inset !important;

            -webkit-text-fill-color:
                #ffffff !important;
        }

        /* ---------------------------------------------------------
           THEME TOGGLE
        --------------------------------------------------------- */

        .auth-theme-button {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    width: 46px;
    height: 46px;

    border-radius: 14px;

    border: 1px solid rgba(255,255,255,.20);

    background: rgba(255,255,255,.10);

    color: #ffffff;

    backdrop-filter: blur(12px);

    transition: .25s ease;
}

.auth-theme-button:hover {

    transform: translateY(-2px);

    border-color: rgba(255,255,255,.40);

    background: rgba(255,255,255,.18);

    color: #ffffff;

    box-shadow:
        0 10px 25px rgba(0,0,0,.12);
}

        html.dark .auth-theme-button {

            background:
                rgba(255,255,255,.06);

            border-color:
                rgba(255,255,255,.10);

            color: #f8fafc;
        }

        /* ---------------------------------------------------------
           MOBILE
        --------------------------------------------------------- */

        @media(max-width:1279px) {

            .auth-hero-card {
                display: none;
            }

        }

        @media(max-width:640px) {

            .auth-main {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .auth-card {
                border-radius: 24px;
            }

        }

    </style>

</head>


<body class="electo-auth-page min-h-screen overflow-x-hidden text-slate-900 dark:text-white">

    <!-- =========================================================
         BACKGROUND GRID
    ========================================================== -->

    <div
        class="electo-auth-grid pointer-events-none fixed inset-0 -z-10 opacity-70">
    </div>


    <!-- =========================================================
     TOP NAVIGATION
========================================================== -->

<header class="relative z-30 px-4 pt-5 sm:px-6 lg:px-10">

    <div
        class="auth-topbar mx-auto
        flex max-w-[1500px]
        items-center
        justify-between
        rounded-2xl
        px-4
        py-3
        sm:px-5"
    >

        <!-- ============================================= -->
        <!-- LOGO -->
        <!-- ============================================= -->

        <a
            href="{{ url('/') }}"
            class="group flex items-center gap-3"
        >

            <div
                class="auth-logo-box
                flex h-11 w-11
                items-center justify-center
                rounded-xl
                text-xl
                ring-1
                ring-white/20
                transition
                duration-300
                group-hover:scale-105"
                style="
                    background:rgba(255,255,255,.15);
                    box-shadow:0 8px 20px rgba(0,0,0,.12);
                "
            >
                📦
            </div>


            <div class="hidden sm:block">

                <div
                    class="text-lg
                    font-black
                    tracking-tight
                    text-white"
                >
                    Electo
                </div>

                <div
                    class="text-[10px]
                    font-medium
                    tracking-wide
                    text-blue-100"
                >
                    SECURE DIGITAL ELECTIONS
                </div>

            </div>

        </a>


        <!-- ============================================= -->
        <!-- RIGHT CONTROLS -->
        <!-- ============================================= -->

        <div class="flex items-center gap-2 sm:gap-3">


            <!-- Home -->

            <a
                href="{{ url('/') }}"
                class="hidden
                rounded-xl
                px-4
                py-2.5
                text-sm
                font-semibold
                text-white/90
                transition
                hover:bg-white/10
                hover:text-white
                sm:block"
            >
                Home
            </a>


            <!-- Theme -->

            <button
                type="button"
                class="auth-theme-button"
                x-on:click="
                    darkMode = !darkMode;
                    localStorage.setItem(
                        'electo-theme',
                        darkMode ? 'dark' : 'light'
                    );
                "
                aria-label="Toggle theme"
            >

                <!-- Sun -->

                <svg
                    x-show="darkMode"
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364-.707.707M6.343 17.657l-.707.707m12.728 0-.707-.707M6.343 6.343l-.707-.707M16 12a4 4 0 1 1-8 0 4 4 0 0 1 8 0z"
                    />

                </svg>


                <!-- Moon -->

                <svg
                    x-show="!darkMode"
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"
                    />

                </svg>

            </button>


            <!-- Create Account -->

            <a
                href="{{ route('register') }}"
                class="hidden
                rounded-xl
                border
                border-white/20
                bg-white
                px-4
                py-2.5
                text-sm
                font-bold
                text-blue-600
                shadow-lg
                transition
                duration-300
                hover:-translate-y-0.5
                hover:bg-blue-50
                hover:shadow-xl
                sm:inline-flex"
            >
                Create Account
            </a>

        </div>

    </div>

</header>


    <!-- =========================================================
         MAIN
    ========================================================== -->

    <main
        class="auth-main mx-auto flex min-h-[calc(100vh-100px)] w-full max-w-[1500px] items-center px-4 py-10 sm:px-6 lg:px-10 lg:py-14">

        <div
            class="grid w-full items-center gap-10 lg:grid-cols-2 lg:gap-16 xl:gap-24">


            <!-- =================================================
                 LEFT — PREMIUM AUTH HERO
            ================================================== -->

            <section class="hidden lg:block">

                <div
                    class="auth-hero-card relative overflow-hidden rounded-[32px] p-8 xl:p-12">

                    <div class="auth-hero-glow-blue"></div>

                    <div class="auth-hero-glow-cyan"></div>


                    <div class="relative z-10">


                        <!-- Badge -->

                        <div
                            class="mb-7 inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-4 py-2 dark:border-blue-500/20 dark:bg-blue-500/10">

                            <span
                                class="h-2.5 w-2.5 animate-pulse rounded-full bg-emerald-500">
                            </span>

                            <span
                                class="text-xs font-bold tracking-wide text-blue-700 dark:text-blue-300">

                                TRUSTED DIGITAL ELECTION PLATFORM

                            </span>

                        </div>


                        <!-- Heading -->

                        <h1 class="auth-title max-w-3xl">

                            Secure

                            <span class="auth-gradient-text">

                                Digital Elections

                            </span>

                            for Modern Organizations.

                        </h1>


                        <!-- Description -->

                        <p
                            class="mt-7 max-w-2xl text-base leading-8 text-slate-600 dark:text-slate-300 xl:text-lg">

                            Electo helps universities, schools, governments,
                            companies, churches and associations conduct
                            secure, transparent and verifiable elections.

                        </p>


                        <!-- Features -->

                        <div
                            class="mt-9 grid grid-cols-2 gap-4">


                            <div
                                class="auth-feature rounded-2xl p-5">

                                <div
                                    class="mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-blue-100 text-xl dark:bg-blue-500/10">

                                    🔐

                                </div>

                                <h3
                                    class="font-bold text-slate-900 dark:text-white">

                                    End-to-End Security

                                </h3>

                                <p
                                    class="mt-1 text-xs leading-5 text-slate-500 dark:text-slate-400">

                                    Protect every stage of your election.

                                </p>

                            </div>


                            <div
                                class="auth-feature rounded-2xl p-5">

                                <div
                                    class="mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-cyan-100 text-xl dark:bg-cyan-500/10">

                                    ⚡

                                </div>

                                <h3
                                    class="font-bold text-slate-900 dark:text-white">

                                    Live Results

                                </h3>

                                <p
                                    class="mt-1 text-xs leading-5 text-slate-500 dark:text-slate-400">

                                    Follow election activity in real time.

                                </p>

                            </div>


                            <div
                                class="auth-feature rounded-2xl p-5">

                                <div
                                    class="mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-100 text-xl dark:bg-indigo-500/10">

                                    📊

                                </div>

                                <h3
                                    class="font-bold text-slate-900 dark:text-white">

                                    Smart Analytics

                                </h3>

                                <p
                                    class="mt-1 text-xs leading-5 text-slate-500 dark:text-slate-400">

                                    Understand participation and outcomes.

                                </p>

                            </div>


                            <div
                                class="auth-feature rounded-2xl p-5">

                                <div
                                    class="mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-100 text-xl dark:bg-emerald-500/10">

                                    ☁️

                                </div>

                                <h3
                                    class="font-bold text-slate-900 dark:text-white">

                                    Always Available

                                </h3>

                                <p
                                    class="mt-1 text-xs leading-5 text-slate-500 dark:text-slate-400">

                                    Access your elections whenever you need.

                                </p>

                            </div>

                        </div>


                        <!-- Trust -->

                        <div
                            class="mt-8 flex flex-wrap gap-x-6 gap-y-3 text-xs font-semibold text-slate-500 dark:text-slate-400">

                            <span class="flex items-center gap-2">

                                <span class="text-emerald-500">✓</span>

                                Secure infrastructure

                            </span>

                            <span class="flex items-center gap-2">

                                <span class="text-emerald-500">✓</span>

                                Verifiable results

                            </span>

                            <span class="flex items-center gap-2">

                                <span class="text-emerald-500">✓</span>

                                Built for organizations

                            </span>

                        </div>

                    </div>

                </div>

            </section>


            <!-- =================================================
                 RIGHT — AUTH CARD
            ================================================== -->

            <section
                class="flex w-full items-center justify-center">

                <div class="w-full max-w-[500px]">


                    <!-- Mobile Logo -->

                    <div class="mb-7 flex items-center gap-3 lg:hidden">

                        <div
                            class="auth-logo-box flex h-12 w-12 items-center justify-center rounded-xl text-xl">

                            📦

                        </div>

                        <div>

                            <div
                                class="text-xl font-black text-slate-900 dark:text-white">

                                Electo

                            </div>

                            <div
                                class="text-xs text-slate-500 dark:text-slate-400">

                                Secure Digital Elections

                            </div>

                        </div>

                    </div>


                    <!-- Auth Card -->

                    <div
                        class="auth-card rounded-[30px] p-6 sm:p-8 lg:p-10">

                        {{ $slot }}

                    </div>


                    <!-- Security Notice -->

                    <div
                        class="mt-5 flex items-center justify-center gap-2 text-center text-xs text-slate-400 dark:text-slate-500">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2zm10-10V7a4 4 0 0 0-8 0v4h8z"
                            />

                        </svg>

                        Your account is protected by Electo security.

                    </div>

                </div>

            </section>

        </div>

    </main>


    <!-- =========================================================
         FOOTER
    ========================================================== -->

    <footer
        class="mx-auto w-full max-w-[1500px] px-6 pb-6 text-center text-xs text-slate-400 dark:text-slate-600">

        © {{ date('Y') }} Electo. All rights reserved.

        <span class="mx-2">•</span>

        Secure Digital Elections

    </footer>


    <!-- =========================================================
         THEME INITIALIZATION
    ========================================================== -->

    <script>

        document.documentElement.classList.toggle(
            'dark',
            localStorage.getItem('electo-theme') === 'dark'
        );

    </script>

</body>

</html>