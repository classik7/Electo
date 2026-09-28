<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
>
<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>
        @yield('title', config('app.name', 'Electo'))
    </title>


    {{-- ========================================================= --}}
    {{-- ELECTO THEME --}}
    {{-- ========================================================= --}}

    <script>
        (() => {

            const savedTheme =
                localStorage.getItem('electo-theme');

            const userTheme =
                @json(
                    auth()->check()
                        ? auth()->user()->settings?->theme
                        : null
                );

            let theme =
                savedTheme ||
                userTheme ||
                'system';


            const root =
                document.documentElement;


            function applyTheme(value) {

                root.classList.remove('dark');

                if (value === 'dark') {

                    root.classList.add('dark');

                }

                else if (value === 'system') {

                    if (
                        window.matchMedia(
                            '(prefers-color-scheme: dark)'
                        ).matches
                    ) {

                        root.classList.add('dark');

                    }

                }

            }


            applyTheme(theme);


            window.ElectoTheme = {

                get() {
                    return theme;
                },

                set(value) {

                    theme = value;

                    localStorage.setItem(
                        'electo-theme',
                        value
                    );

                    applyTheme(value);

                    window.dispatchEvent(
                        new CustomEvent(
                            'electo-theme-changed',
                            {
                                detail: {
                                    theme: value
                                }
                            }
                        )
                    );

                },

                toggle() {

                    const current =
                        root.classList.contains('dark')
                            ? 'dark'
                            : 'light';

                    this.set(
                        current === 'dark'
                            ? 'light'
                            : 'dark'
                    );

                }

            };

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
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet"
    >


    {{-- ========================================================= --}}
    {{-- LANDING PAGE PREMIUM STYLES --}}
    {{-- ========================================================= --}}

    <style>

        html {
            scroll-behavior: smooth;
        }


        body {
            font-family: 'Inter', sans-serif;
        }


        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Poppins', sans-serif;
        }


        /* --------------------------------------------------------- */
        /* LANDING BACKGROUND */
        /* --------------------------------------------------------- */

        .electo-landing-bg {

            background:
                radial-gradient(
                    circle at 12% 20%,
                    rgba(37, 99, 235, .10),
                    transparent 30%
                ),
                radial-gradient(
                    circle at 88% 18%,
                    rgba(6, 182, 212, .10),
                    transparent 28%
                ),
                radial-gradient(
                    circle at 55% 90%,
                    rgba(99, 102, 241, .08),
                    transparent 35%
                ),
                #f8fbff;

        }


        .dark .electo-landing-bg {

            background:
                radial-gradient(
                    circle at 12% 20%,
                    rgba(37, 99, 235, .16),
                    transparent 30%
                ),
                radial-gradient(
                    circle at 88% 18%,
                    rgba(6, 182, 212, .12),
                    transparent 28%
                ),
                radial-gradient(
                    circle at 55% 90%,
                    rgba(99, 102, 241, .10),
                    transparent 35%
                ),
                #061126;

        }


        /* --------------------------------------------------------- */
        /* LANDING CONTAINER */
        /* --------------------------------------------------------- */

        .landing-container {

            width: min(
                calc(100% - 32px),
                1440px
            );

            margin-inline: auto;

        }


        @media (min-width: 640px) {

            .landing-container {

                width: min(
                    calc(100% - 64px),
                    1440px
                );

            }

        }


        @media (min-width: 1280px) {

            .landing-container {

                width: min(
                    calc(100% - 96px),
                    1500px
                );

            }

        }


        /* --------------------------------------------------------- */
        /* NAVBAR */
        /* --------------------------------------------------------- */

        .electo-public-nav {

            background:
                rgba(255,255,255,.82);

            border:
                1px solid
                rgba(148,163,184,.22);

            box-shadow:
                0 20px 50px
                rgba(15,23,42,.08);

            backdrop-filter:
                blur(24px);

        }


        .dark .electo-public-nav {

            background:
                rgba(10,24,49,.78);

            border-color:
                rgba(255,255,255,.08);

            box-shadow:
                0 20px 60px
                rgba(0,0,0,.28);

        }


        /* --------------------------------------------------------- */
        /* HERO TITLE */
        /* --------------------------------------------------------- */

        .electo-hero-title {

            font-family:
                'Poppins',
                sans-serif;

            font-size:
                clamp(
                    3.2rem,
                    6vw,
                    6.8rem
                );

            line-height:
                .96;

            letter-spacing:
                -.055em;

        }


        /* --------------------------------------------------------- */
        /* PREMIUM DASHBOARD */
        /* --------------------------------------------------------- */

        .landing-dashboard {

            transition:
                transform .4s ease,
                box-shadow .4s ease;

        }


        .landing-dashboard:hover {

            transform:
                translateY(-6px);

        }


        .dark .landing-dashboard {

            box-shadow:
                0 45px 120px
                rgba(0,0,0,.48);

        }


        .light-dashboard-surface {

            background:
                linear-gradient(
                    145deg,
                    #ffffff,
                    #f1f6ff
                );

        }


        .dark .light-dashboard-surface {

            background:
                linear-gradient(
                    145deg,
                    #101d35,
                    #081225
                );

        }


        /* --------------------------------------------------------- */
        /* THEME BUTTON */
        /* --------------------------------------------------------- */

        .theme-toggle-public {

            width: 44px;
            height: 44px;

            display: inline-flex;

            align-items: center;
            justify-content: center;

            border-radius: 14px;

            border:
                1px solid
                rgba(148,163,184,.25);

            background:
                rgba(255,255,255,.75);

            color:
                #334155;

            transition:
                all .25s ease;

        }


        .theme-toggle-public:hover {

            transform:
                translateY(-2px);

            border-color:
                rgba(37,99,235,.4);

            color:
                #2563eb;

            box-shadow:
                0 10px 25px
                rgba(37,99,235,.12);

        }


        .dark .theme-toggle-public {

            background:
                rgba(255,255,255,.06);

            color:
                #e2e8f0;

            border-color:
                rgba(255,255,255,.10);

        }


        .dark .theme-toggle-public:hover {

            color:
                #67e8f9;

        }


        /* --------------------------------------------------------- */
        /* PUBLIC BUTTONS */
        /* --------------------------------------------------------- */

        .public-primary {

            display:
                inline-flex;

            align-items:
                center;

            justify-content:
                center;

            gap:
                .5rem;

            border-radius:
                14px;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #06b6d4
                );

            color:
                white;

            padding:
                .9rem 1.35rem;

            font-weight:
                800;

            box-shadow:
                0 14px 30px
                rgba(37,99,235,.20);

            transition:
                all .25s ease;

        }


        .public-primary:hover {

            transform:
                translateY(-2px);

            box-shadow:
                0 18px 35px
                rgba(37,99,235,.28);

        }


        .public-secondary {

            display:
                inline-flex;

            align-items:
                center;

            justify-content:
                center;

            gap:
                .5rem;

            border-radius:
                14px;

            padding:
                .9rem 1.35rem;

            font-weight:
                800;

            color:
                #334155;

            background:
                rgba(255,255,255,.78);

            border:
                1px solid
                rgba(148,163,184,.28);

            transition:
                all .25s ease;

        }


        .public-secondary:hover {

            transform:
                translateY(-2px);

            border-color:
                rgba(37,99,235,.35);

            color:
                #2563eb;

            box-shadow:
                0 12px 25px
                rgba(15,23,42,.08);

        }


        .dark .public-secondary {

            color:
                #e2e8f0;

            background:
                rgba(255,255,255,.06);

            border-color:
                rgba(255,255,255,.10);

        }


        .dark .public-secondary:hover {

            color:
                #67e8f9;

            border-color:
                rgba(103,232,249,.30);

        }


        /* --------------------------------------------------------- */
        /* SMOOTH THEME */
        /* --------------------------------------------------------- */

        body,
        nav,
        section,
        div,
        a,
        button {

            transition-property:
                background-color,
                border-color,
                color,
                box-shadow;

            transition-duration:
                .25s;

        }

    </style>

</head>


<body
    class="
        min-h-screen
        overflow-x-hidden
        bg-white
        text-slate-900
        transition-colors
        duration-300

        dark:bg-[#061126]
        dark:text-white
    "
>

    {{-- Landing background --}}
    <div
        class="electo-landing-bg
               min-h-screen
               transition-colors
               duration-500"
    >

        {{-- Public landing page does NOT need dashboard sidebar/topbar --}}
        @yield('content')

    </div>


</body>

</html>