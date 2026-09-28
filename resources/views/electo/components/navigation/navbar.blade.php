{{-- =========================================================
     ELECTO PREMIUM RESPONSIVE NAVBAR
========================================================= --}}

<header class="relative z-50 px-3 pt-4 sm:px-5 sm:pt-5 lg:px-10">

    <nav
        class="electo-main-navbar relative mx-auto flex w-full max-w-[1500px] items-center justify-between rounded-[22px] px-3 py-3 sm:rounded-[24px] sm:px-5 lg:px-7"
    >

        {{-- =====================================================
             LOGO
        ====================================================== --}}

        <a
            href="{{ url('/') }}"
            class="group flex min-w-0 shrink-0 items-center gap-2.5 sm:gap-3"
        >

            <div
                class="electo-navbar-logo flex h-10 w-10 shrink-0 items-center justify-center rounded-xl text-lg transition duration-300 group-hover:scale-105 sm:h-11 sm:w-11 sm:text-xl"
            >
                📦
            </div>

            <div class="hidden min-w-0 sm:block">

                <div
                    class="truncate text-lg font-black tracking-tight text-white"
                >
                    Electo
                </div>

                <div
                    class="whitespace-nowrap text-[10px] font-medium tracking-wide text-blue-100"
                >
                    Secure Digital Elections
                </div>

            </div>

        </a>


        {{-- =====================================================
             DESKTOP NAVIGATION
        ====================================================== --}}

        <div
            class="hidden items-center gap-1 lg:flex"
        >

            <a href="#features" class="electo-nav-link">
                Features
            </a>

            <a href="#solutions" class="electo-nav-link">
                Solutions
            </a>

            <a href="#security" class="electo-nav-link">
                Security
            </a>

            <a href="#pricing" class="electo-nav-link">
                Pricing
            </a>

            <a href="#contact" class="electo-nav-link">
                Contact
            </a>

        </div>


        {{-- =====================================================
             RIGHT SIDE
        ====================================================== --}}

        <div class="flex shrink-0 items-center gap-2 sm:gap-3">

            {{-- Theme Toggle --}}

            <button
                type="button"
                id="electo-theme-toggle"
                class="electo-navbar-theme"
                aria-label="Toggle light and dark mode"
            >

                {{-- Sun --}}

                <svg
                    id="electo-theme-sun"
                    xmlns="http://www.w3.org/2000/svg"
                    class="hidden h-5 w-5"
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

                {{-- Moon --}}

                <svg
                    id="electo-theme-moon"
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


            {{-- Desktop Auth Buttons --}}

            <div class="hidden items-center gap-3 lg:flex">

                <a
                    href="{{ route('login') }}"
                    class="electo-navbar-login"
                >
                    Sign In
                </a>

                <a
                    href="{{ route('register') }}"
                    class="electo-navbar-start"
                >
                    Get Started
                </a>

            </div>


            {{-- Mobile Menu Button --}}

            <button
                type="button"
                id="electo-mobile-menu-toggle"
                class="electo-mobile-menu-button lg:hidden"
                aria-label="Open navigation menu"
                aria-expanded="false"
                aria-controls="electo-mobile-menu"
            >

                <svg
                    id="electo-menu-open"
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
                        d="M4 6h16M4 12h16M4 18h16"
                    />
                </svg>

                <svg
                    id="electo-menu-close"
                    xmlns="http://www.w3.org/2000/svg"
                    class="hidden h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>

            </button>

        </div>


        {{-- =====================================================
             MOBILE MENU
        ====================================================== --}}

        <div
            id="electo-mobile-menu"
            class="electo-mobile-menu hidden"
        >

            <div class="electo-mobile-menu-links">

                <a href="#features" class="electo-mobile-link">
                    Features
                </a>

                <a href="#solutions" class="electo-mobile-link">
                    Solutions
                </a>

                <a href="#security" class="electo-mobile-link">
                    Security
                </a>

                <a href="#pricing" class="electo-mobile-link">
                    Pricing
                </a>

                <a href="#contact" class="electo-mobile-link">
                    Contact
                </a>

            </div>


            <div class="electo-mobile-auth">

                <a
                    href="{{ route('login') }}"
                    class="electo-mobile-login"
                >
                    Sign In
                </a>

                <a
                    href="{{ route('register') }}"
                    class="electo-mobile-start"
                >
                    Get Started
                </a>

            </div>

        </div>

    </nav>

</header>


{{-- =========================================================
     NAVBAR STYLES
========================================================= --}}

<style>

    .electo-main-navbar {
        background:
            linear-gradient(
                90deg,
                #1d4ed8 0%,
                #2563eb 55%,
                #0891b2 100%
            );

        border: 1px solid rgba(255,255,255,.16);

        box-shadow:
            0 18px 50px rgba(37,99,235,.22);

        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);

        transition:
            box-shadow .3s ease,
            transform .3s ease;
    }


    .electo-main-navbar:hover {
        box-shadow:
            0 22px 60px rgba(37,99,235,.28);
    }


    .electo-navbar-logo {
        background:
            rgba(255,255,255,.14);

        border:
            1px solid rgba(255,255,255,.22);

        box-shadow:
            0 8px 22px rgba(0,0,0,.12);
    }


    .electo-nav-link {
        position: relative;

        display: inline-flex;

        align-items: center;

        padding:
            .75rem
            .9rem;

        border-radius: 12px;

        color:
            rgba(255,255,255,.88);

        font-size:
            .875rem;

        font-weight:
            600;

        transition:
            all .25s ease;
    }


    .electo-nav-link:hover {
        color: #ffffff;

        background:
            rgba(255,255,255,.10);
    }


    .electo-navbar-theme {
        display:
            inline-flex;

        align-items:
            center;

        justify-content:
            center;

        width:
            42px;

        height:
            42px;

        flex-shrink: 0;

        border-radius:
            13px;

        border:
            1px solid rgba(255,255,255,.22);

        background:
            rgba(255,255,255,.10);

        color:
            #ffffff;

        backdrop-filter:
            blur(12px);

        transition:
            all .25s ease;
    }


    .electo-navbar-theme:hover {
        transform:
            translateY(-2px);

        background:
            rgba(255,255,255,.18);

        border-color:
            rgba(255,255,255,.40);

        box-shadow:
            0 10px 25px rgba(0,0,0,.12);
    }


    .electo-navbar-login {
        display:
            inline-flex;

        align-items:
            center;

        justify-content:
            center;

        padding:
            .72rem
            1.25rem;

        border-radius:
            14px;

        color:
            #ffffff;

        font-size:
            .875rem;

        font-weight:
            700;

        border:
            1px solid rgba(255,255,255,.18);

        background:
            rgba(255,255,255,.08);

        transition:
            all .25s ease;
    }


    .electo-navbar-login:hover {
        transform:
            translateY(-2px);

        background:
            rgba(255,255,255,.16);

        border-color:
            rgba(255,255,255,.35);
    }


    .electo-navbar-start {
        display:
            inline-flex;

        align-items:
            center;

        justify-content:
            center;

        padding:
            .78rem
            1.35rem;

        border-radius:
            14px;

        color:
            #2563eb;

        font-size:
            .875rem;

        font-weight:
            800;

        background:
            #ffffff;

        box-shadow:
            0 10px 25px rgba(0,0,0,.12);

        transition:
            all .25s ease;
    }


    .electo-navbar-start:hover {
        transform:
            translateY(-2px);

        background:
            #eff6ff;

        box-shadow:
            0 18px 45px rgba(37,99,235,.16);
    }


    /* =========================================================
       MOBILE MENU BUTTON
    ========================================================= */

    .electo-mobile-menu-button {
        display:
            inline-flex;

        align-items:
            center;

        justify-content:
            center;

        width:
            42px;

        height:
            42px;

        flex-shrink: 0;

        border-radius:
            13px;

        border:
            1px solid rgba(255,255,255,.22);

        background:
            rgba(255,255,255,.10);

        color:
            #ffffff;

        transition:
            all .25s ease;
    }


    .electo-mobile-menu-button:hover {
        background:
            rgba(255,255,255,.18);
    }


    /* =========================================================
       MOBILE DROPDOWN
    ========================================================= */

    .electo-mobile-menu {
        position:
            absolute;

        left:
            0;

        right:
            0;

        top:
            calc(100% + 10px);

        padding:
            14px;

        border-radius:
            20px;

        background:
            rgba(15,23,42,.96);

        border:
            1px solid rgba(255,255,255,.12);

        box-shadow:
            0 24px 60px rgba(0,0,0,.25);

        backdrop-filter:
            blur(24px);

        -webkit-backdrop-filter:
            blur(24px);
    }


    .electo-mobile-menu-links {
        display:
            flex;

        flex-direction:
            column;

        gap:
            4px;
    }


    .electo-mobile-link {
        display:
            flex;

        align-items:
            center;

        min-height:
            46px;

        padding:
            .7rem
            .85rem;

        border-radius:
            12px;

        color:
            rgba(255,255,255,.92);

        font-size:
            .9rem;

        font-weight:
            600;

        transition:
            all .2s ease;
    }


    .electo-mobile-link:hover {
        background:
            rgba(255,255,255,.08);

        color:
            #ffffff;
    }


    .electo-mobile-auth {
        display:
            grid;

        grid-template-columns:
            1fr 1fr;

        gap:
            10px;

        margin-top:
            12px;

        padding-top:
            12px;

        border-top:
            1px solid rgba(255,255,255,.10);
    }


    .electo-mobile-login,
    .electo-mobile-start {
        display:
            flex;

        align-items:
            center;

        justify-content:
            center;

        min-height:
            46px;

        padding:
            .7rem
            .8rem;

        border-radius:
            12px;

        font-size:
            .85rem;

        font-weight:
            800;

        transition:
            all .2s ease;
    }


    .electo-mobile-login {
        color:
            #ffffff;

        border:
            1px solid rgba(255,255,255,.18);

        background:
            rgba(255,255,255,.08);
    }


    .electo-mobile-start {
        color:
            #2563eb;

        background:
            #ffffff;
    }


    /* =========================================================
       VERY SMALL PHONES
    ========================================================= */

    @media(max-width:380px) {

        .electo-main-navbar {
            padding-left:
                .65rem;

            padding-right:
                .65rem;
        }

        .electo-navbar-theme,
        .electo-mobile-menu-button {
            width:
                40px;

            height:
                40px;
        }

        .electo-mobile-auth {
            grid-template-columns:
                1fr;
        }

    }

</style>


{{-- =========================================================
     NAVBAR SCRIPT
========================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    /* =====================================================
       THEME
    ====================================================== */

    const toggle =
        document.getElementById('electo-theme-toggle');

    const sun =
        document.getElementById('electo-theme-sun');

    const moon =
        document.getElementById('electo-theme-moon');


    function updateThemeIcon() {

        const isDark =
            document.documentElement.classList.contains('dark');

        if (isDark) {

            sun.classList.remove('hidden');

            moon.classList.add('hidden');

        } else {

            sun.classList.add('hidden');

            moon.classList.remove('hidden');

        }

    }


    updateThemeIcon();


    if (toggle) {

        toggle.addEventListener('click', function () {

            const isDark =
                document.documentElement.classList.contains('dark');


            if (isDark) {

                document.documentElement.classList.remove('dark');

                localStorage.setItem(
                    'electo-theme',
                    'light'
                );

            } else {

                document.documentElement.classList.add('dark');

                localStorage.setItem(
                    'electo-theme',
                    'dark'
                );

            }

            updateThemeIcon();

        });

    }


    /* =====================================================
       MOBILE MENU
    ====================================================== */

    const mobileToggle =
        document.getElementById(
            'electo-mobile-menu-toggle'
        );

    const mobileMenu =
        document.getElementById(
            'electo-mobile-menu'
        );

    const menuOpen =
        document.getElementById(
            'electo-menu-open'
        );

    const menuClose =
        document.getElementById(
            'electo-menu-close'
        );


    function closeMobileMenu() {

        if (!mobileMenu) return;

        mobileMenu.classList.add('hidden');

        if (menuOpen) {
            menuOpen.classList.remove('hidden');
        }

        if (menuClose) {
            menuClose.classList.add('hidden');
        }

        if (mobileToggle) {
            mobileToggle.setAttribute(
                'aria-expanded',
                'false'
            );

            mobileToggle.setAttribute(
                'aria-label',
                'Open navigation menu'
            );
        }

    }


    if (mobileToggle && mobileMenu) {

        mobileToggle.addEventListener('click', function () {

            const isOpen =
                !mobileMenu.classList.contains('hidden');


            if (isOpen) {

                closeMobileMenu();

            } else {

                mobileMenu.classList.remove('hidden');

                menuOpen.classList.add('hidden');

                menuClose.classList.remove('hidden');

                mobileToggle.setAttribute(
                    'aria-expanded',
                    'true'
                );

                mobileToggle.setAttribute(
                    'aria-label',
                    'Close navigation menu'
                );

            }

        });


        document
            .querySelectorAll('.electo-mobile-link')
            .forEach(function (link) {

                link.addEventListener(
                    'click',
                    closeMobileMenu
                );

            });

    }


    /* Close menu if browser becomes desktop size */

    window.addEventListener('resize', function () {

        if (window.innerWidth >= 1024) {

            closeMobileMenu();

        }

    });

});

</script>