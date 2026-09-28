@php

use Illuminate\Support\Facades\Route;

$currentRoute = Route::currentRouteName();

$menu = [

    [
        'name' => 'Dashboard',
        'route' => 'dashboard',
        'icon' => 'home',
    ],

    [
        'name' => 'Organizations',
        'route' => 'organizations.index',
        'icon' => 'building',
    ],

    [
        'name' => 'Elections',
        'route' => 'elections.index',
        'icon' => 'ballot',
    ],

    [
        'name' => 'Candidates',
        'route' => 'candidates.index',
        'icon' => 'users',
    ],

    [
        'name' => 'Voting',
        'route' => 'voting.my',
        'icon' => 'vote',
    ],

    [
        'name' => 'Voters',
        'route' => 'voters.index',
        'icon' => 'user',
    ],

    [
        'name' => 'Results',
        'route' => 'results.index',
        'icon' => 'chart',
    ],

    [
        'name' => 'Settings',
        'route' => 'settings.index',
        'icon' => 'settings',
    ],

];

@endphp


@auth

{{-- =========================================================
     MOBILE HAMBURGER
========================================================= --}}

<button
    type="button"
    id="electo-sidebar-open"
    class="electo-sidebar-open lg:hidden"
    aria-label="Open navigation"
    aria-controls="electo-sidebar"
    aria-expanded="false"
>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        class="h-6 w-6"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
        stroke-width="2"
    >
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M4 6h16M4 12h16M4 18h16"
        />
    </svg>
</button>


{{-- =========================================================
     MOBILE OVERLAY
========================================================= --}}

<div
    id="electo-sidebar-overlay"
    class="electo-sidebar-overlay hidden lg:hidden"
></div>


{{-- =========================================================
     SIDEBAR
========================================================= --}}

<aside
    id="electo-sidebar"
    class="
        electo-sidebar
        flex
        w-72
        shrink-0
        flex-col
        border-r
        border-slate-200
        bg-white
        text-slate-900
        transition-colors
        duration-300

        dark:border-white/10
        dark:bg-[#0B1730]
        dark:text-white
    "
>

    {{-- =========================================================
         MOBILE CLOSE BUTTON
    ========================================================== --}}

    <button
        type="button"
        id="electo-sidebar-close"
        class="electo-sidebar-close lg:hidden"
        aria-label="Close navigation"
    >

        <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2"
        >

            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M6 18L18 6M6 6l12 12"
            />

        </svg>

    </button>


    {{-- =========================================================
         LOGO
    ========================================================== --}}

    <div
        class="
            flex
            h-20
            shrink-0
            items-center
            border-b
            border-slate-200
            px-6

            dark:border-white/10

            lg:px-8
        "
    >

        <div>

            <h1
                class="
                    text-3xl
                    font-black
                    tracking-wide
                    text-blue-600

                    dark:text-blue-500
                "
            >
                Electo
            </h1>

            <p
                class="
                    text-xs
                    text-slate-500

                    dark:text-gray-400
                "
            >
                Electronic Voting Platform
            </p>

        </div>

    </div>


    {{-- =========================================================
         NAVIGATION
    ========================================================== --}}

    <nav
        class="
            flex-1
            overflow-y-auto
            px-4
            py-6
        "
    >

        <p
            class="
                mb-3
                px-4
                text-xs
                uppercase
                tracking-widest
                text-slate-400

                dark:text-gray-500
            "
        >
            Main Menu
        </p>


        <div class="space-y-2">

            @foreach($menu as $item)

                @php

                    $active = match ($item['name']) {

                        'Dashboard' =>
                            request()->routeIs('dashboard'),

                        'Organizations' =>
                            request()->routeIs('organizations.*'),

                        'Elections' =>
                            request()->routeIs('elections.*')
                            && !request()->routeIs('elections.candidates'),

                        'Candidates' =>
                            request()->routeIs('candidates.index')
                            || request()->routeIs('candidates.*')
                            || request()->routeIs('elections.candidates'),

                        'Voting' =>
                            request()->routeIs('voting.*'),

                        'Voters' =>
                            request()->routeIs('voters.*'),

                        'Results' =>
                            request()->routeIs('results.*'),

                        'Settings' =>
                            request()->routeIs('settings.*'),

                        default =>
                            false,

                    };

                @endphp


                <a
                    href="{{ route($item['route']) }}"
                    class="
                        group
                        flex
                        items-center
                        gap-3
                        rounded-xl
                        px-4
                        py-3
                        transition-all
                        duration-200

                        {{ $active
                            ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/20'
                            : 'text-slate-600 hover:bg-blue-50 hover:text-blue-700 dark:text-gray-300 dark:hover:bg-blue-600/20 dark:hover:text-white'
                        }}
                    "
                >

                    {{-- =================================================
                         ICONS
                    ================================================== --}}

                    @switch($item['icon'])

                        @case('home')

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 shrink-0"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3 10.5L12 3l9 7.5M5.25 9.75V21h13.5V9.75"
                                />

                            </svg>

                            @break


                        @case('building')

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 shrink-0"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3 21h18M5 21V7l7-4 7 4v14M9 9h.01M9 13h.01M9 17h.01M15 9h.01M15 13h.01M15 17h.01"
                                />

                            </svg>

                            @break


                        @case('ballot')

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 shrink-0"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 12l2 2 4-4M4 5h16v14H4z"
                                />

                            </svg>

                            @break


                        @case('users')

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 shrink-0"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M17 20h5v-1a4 4 0 00-4-4h-1M9 20H2v-1a4 4 0 014-4h3M15 7a3 3 0 11-6 0 3 3 0 016 0z"
                                />

                            </svg>

                            @break


                        @case('vote')

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 shrink-0"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4 5h16v14H4z"
                                />

                                <path
                                    stroke-linecap="round"
                                    d="M8 9h8M8 13h5"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15 16l2 2 4-4"
                                />

                            </svg>

                            @break


                        @case('user')

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 shrink-0"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 12a4 4 0 100-8 4 4 0 000 8zm0 2c-4 0-7 2-7 5h14c0-3-3-5-7-5z"
                                />

                            </svg>

                            @break


                        @case('chart')

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 shrink-0"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M7 20V10m5 10V4m5 16v-7"
                                />

                            </svg>

                            @break


                        @default

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 shrink-0"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 8v4l3 3"
                                />

                            </svg>

                    @endswitch


                    <span class="font-medium">
                        {{ $item['name'] }}
                    </span>

                </a>

            @endforeach

        </div>

    </nav>


    {{-- =========================================================
         USER SECTION
    ========================================================== --}}

    <div
        class="
            shrink-0
            border-t
            border-slate-200
            p-4

            dark:border-white/10

            sm:p-6
        "
    >

        <div class="flex min-w-0 items-center gap-3">

            <div
                class="
                    flex
                    h-11
                    w-11
                    shrink-0
                    items-center
                    justify-center
                    rounded-full
                    bg-blue-600
                    font-bold
                    text-white
                    shadow-lg
                    shadow-blue-500/10
                "
            >
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>


            <div class="min-w-0">

                <h4
                    class="
                        truncate
                        font-semibold
                        text-slate-900

                        dark:text-white
                    "
                >
                    {{ auth()->user()->name }}
                </h4>

                <p
                    class="
                        truncate
                        text-sm
                        capitalize
                        text-slate-500

                        dark:text-gray-400
                    "
                >
                    {{ auth()->user()->getRoleNames()->first() ?? 'Administrator' }}
                </p>

            </div>

        </div>


        <form
            method="POST"
            action="{{ route('logout') }}"
            class="mt-5"
        >

            @csrf

            <x-electo.button
                variant="danger"
                class="w-full"
            >
                Logout
            </x-electo.button>

        </form>

    </div>

</aside>


{{-- =========================================================
     STYLES
========================================================= --}}

<style>

    .electo-sidebar {
        min-height: 100vh;
    }


    /* =========================================================
       DRAGGABLE GLASS HAMBURGER
    ========================================================== */

    .electo-sidebar-open {

        position: fixed;

        left: 12px;
        top: 12px;

        z-index: 100;

        display: inline-flex;

        width: 42px;
        height: 42px;

        align-items: center;
        justify-content: center;

        padding: 0;

        border-radius: 13px;

        background:
            rgba(255, 255, 255, 0.58);

        border:
            1px solid rgba(255, 255, 255, 0.75);

        color:
            #2563eb;

        box-shadow:
            0 8px 24px rgba(15, 23, 42, 0.10);

        backdrop-filter:
            blur(12px);

        -webkit-backdrop-filter:
            blur(12px);

        cursor:
            grab;

        touch-action:
            none;

        user-select:
            none;

        -webkit-user-select:
            none;

        transition:
            transform .2s ease,
            box-shadow .2s ease,
            background .2s ease,
            border-color .2s ease;
    }


    .electo-sidebar-open.dragging {

        cursor:
            grabbing;

        transform:
            scale(1.08);

        background:
            rgba(255, 255, 255, 0.72);

        border-color:
            rgba(37, 99, 235, 0.40);

        box-shadow:
            0 16px 40px rgba(37, 99, 235, 0.24);

        transition:
            none;
    }


    .dark .electo-sidebar-open {

        background:
            rgba(11, 23, 48, 0.62);

        border:
            1px solid rgba(255, 255, 255, 0.13);

        color:
            #93c5fd;

        box-shadow:
            0 8px 28px rgba(0, 0, 0, 0.28);
    }


    .dark .electo-sidebar-open.dragging {

        background:
            rgba(30, 64, 175, 0.48);

        border-color:
            rgba(147, 197, 253, 0.35);

        box-shadow:
            0 16px 40px rgba(0, 0, 0, 0.40);
    }


    .electo-sidebar-open:hover {

        transform:
            translateY(-1px)
            scale(1.03);

        background:
            rgba(255, 255, 255, 0.78);

        box-shadow:
            0 12px 30px rgba(37, 99, 235, 0.16);
    }


    .dark .electo-sidebar-open:hover {

        background:
            rgba(30, 64, 175, 0.38);

        box-shadow:
            0 12px 30px rgba(0, 0, 0, 0.35);
    }


    .electo-sidebar-open:active {

        transform:
            scale(.94);
    }


    /* =========================================================
       MOBILE CLOSE BUTTON
    ========================================================== */

    .electo-sidebar-close {

        position: absolute;

        right: 14px;
        top: 14px;

        z-index: 5;

        display: inline-flex;

        width: 40px;
        height: 40px;

        align-items: center;
        justify-content: center;

        padding: 0;

        border-radius: 13px;

        border:
            1px solid rgba(148, 163, 184, .20);

        background:
            rgba(148, 163, 184, .10);

        color:
            #64748b;

        transition:
            all .2s ease;
    }


    .electo-sidebar-close:hover {

        background:
            rgba(37, 99, 235, .10);

        color:
            #2563eb;

        transform:
            scale(1.04);
    }


    .dark .electo-sidebar-close {

        color:
            #cbd5e1;

        border-color:
            rgba(255, 255, 255, .12);

        background:
            rgba(255, 255, 255, .06);
    }


    .dark .electo-sidebar-close:hover {

        background:
            rgba(37, 99, 235, .20);

        color:
            #93c5fd;
    }


    /* =========================================================
       MOBILE OVERLAY
    ========================================================== */

    .electo-sidebar-overlay {

        position: fixed;

        inset: 0;

        z-index: 80;

        background:
            rgba(2, 6, 23, .48);

        backdrop-filter:
            blur(4px);

        -webkit-backdrop-filter:
            blur(4px);
    }


    /* =========================================================
       MOBILE SIDEBAR DRAWER
    ========================================================== */

    @media (max-width: 1023px) {

        .electo-sidebar {

            position: fixed;

            left: 0;
            top: 0;
            bottom: 0;

            z-index: 90;

            width:
                min(310px, 86vw);

            min-height:
                100vh;

            transform:
                translateX(-105%);

            box-shadow:
                20px 0 70px rgba(0, 0, 0, .22);

            transition:
                transform .3s cubic-bezier(.4, 0, .2, 1);
        }


        .electo-sidebar.electo-sidebar-opened {

            transform:
                translateX(0);
        }

    }


    /* =========================================================
       SMALL PHONES
    ========================================================== */

    @media (max-width: 380px) {

        .electo-sidebar-open {

            width: 40px;
            height: 40px;

            border-radius: 12px;
        }


        .electo-sidebar {

            width: 88vw;
        }

    }


    /* =========================================================
       DESKTOP — HAMBURGER COMPLETELY HIDDEN
    ========================================================== */

    @media (min-width: 1024px) {

        .electo-sidebar-open {

            display:
                none !important;
        }

        .electo-sidebar-close {

            display:
                none !important;
        }

        .electo-sidebar-overlay {

            display:
                none !important;
        }

    }


    /* =========================================================
       ACCESSIBILITY
    ========================================================== */

    @media (prefers-reduced-motion: reduce) {

        .electo-sidebar,
        .electo-sidebar-open,
        .electo-sidebar-close {

            transition:
                none !important;
        }

    }

</style>


{{-- =========================================================
     SIDEBAR SCRIPT
========================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const sidebar =
        document.getElementById(
            'electo-sidebar'
        );

    const openButton =
        document.getElementById(
            'electo-sidebar-open'
        );

    const closeButton =
        document.getElementById(
            'electo-sidebar-close'
        );

    const overlay =
        document.getElementById(
            'electo-sidebar-overlay'
        );


    /* =====================================================
       SIDEBAR OPEN
    ===================================================== */

    function openSidebar() {

        if (!sidebar) return;

        sidebar.classList.add(
            'electo-sidebar-opened'
        );


        if (overlay) {

            overlay.classList.remove(
                'hidden'
            );

        }


        if (openButton) {

            openButton.setAttribute(
                'aria-expanded',
                'true'
            );

        }


        document.body.style.overflow =
            'hidden';

    }


    /* =====================================================
       SIDEBAR CLOSE
    ===================================================== */

    function closeSidebar() {

        if (!sidebar) return;

        sidebar.classList.remove(
            'electo-sidebar-opened'
        );


        if (overlay) {

            overlay.classList.add(
                'hidden'
            );

        }


        if (openButton) {

            openButton.setAttribute(
                'aria-expanded',
                'false'
            );

        }


        document.body.style.overflow =
            '';

    }


    /* =====================================================
       NORMAL CLICK / TAP
    ===================================================== */

    let wasDragging = false;


    if (openButton) {

        openButton.addEventListener(
            'click',
            function (event) {

                /*
                 * If the user dragged the button,
                 * don't accidentally open the menu.
                 */

                if (wasDragging) {

                    wasDragging = false;

                    return;

                }


                if (
                    sidebar &&
                    sidebar.classList.contains(
                        'electo-sidebar-opened'
                    )
                ) {

                    closeSidebar();

                } else {

                    openSidebar();

                }

            }
        );

    }


    /* =====================================================
       DRAGGABLE HAMBURGER
    ===================================================== */

    if (openButton) {

        let dragging = false;

        let startX = 0;
        let startY = 0;

        let startLeft = 0;
        let startTop = 0;

        let moved = false;


        openButton.addEventListener(
            'pointerdown',
            function (event) {

                /*
                 * Only make the button draggable
                 * on mobile/tablet.
                 */

                if (
                    window.innerWidth >= 1024
                ) {

                    return;

                }


                dragging = true;

                moved = false;

                startX =
                    event.clientX;

                startY =
                    event.clientY;


                const rect =
                    openButton.getBoundingClientRect();


                startLeft =
                    rect.left;

                startTop =
                    rect.top;


                openButton.classList.add(
                    'dragging'
                );


                openButton.setPointerCapture(
                    event.pointerId
                );

            }
        );


        openButton.addEventListener(
            'pointermove',
            function (event) {

                if (!dragging) return;


                const deltaX =
                    event.clientX - startX;

                const deltaY =
                    event.clientY - startY;


                /*
                 * Prevent tiny finger movements
                 * from counting as a drag.
                 */

                if (
                    Math.abs(deltaX) > 5 ||
                    Math.abs(deltaY) > 5
                ) {

                    moved = true;

                }


                let newLeft =
                    startLeft + deltaX;

                let newTop =
                    startTop + deltaY;


                const buttonWidth =
                    openButton.offsetWidth;

                const buttonHeight =
                    openButton.offsetHeight;


                const maxLeft =
                    window.innerWidth -
                    buttonWidth -
                    6;

                const maxTop =
                    window.innerHeight -
                    buttonHeight -
                    6;


                /*
                 * Keep the button inside
                 * the visible screen.
                 */

                newLeft =
                    Math.max(
                        6,
                        Math.min(
                            newLeft,
                            maxLeft
                        )
                    );


                newTop =
                    Math.max(
                        6,
                        Math.min(
                            newTop,
                            maxTop
                        )
                    );


                openButton.style.left =
                    newLeft + 'px';

                openButton.style.top =
                    newTop + 'px';


                /*
                 * Once manually moved,
                 * remove right/bottom positioning
                 * if any exists.
                 */

                openButton.style.right =
                    'auto';

                openButton.style.bottom =
                    'auto';

            }
        );


        openButton.addEventListener(
            'pointerup',
            function (event) {

                if (!dragging) return;


                dragging = false;


                openButton.classList.remove(
                    'dragging'
                );


                if (moved) {

                    wasDragging = true;


                    /*
                     * Save the user's preferred
                     * hamburger position.
                     */

                    try {

                        localStorage.setItem(
                            'electoHamburgerPosition',
                            JSON.stringify({

                                left:
                                    openButton
                                        .getBoundingClientRect()
                                        .left,

                                top:
                                    openButton
                                        .getBoundingClientRect()
                                        .top

                            })
                        );

                    } catch (error) {

                        /*
                         * Ignore localStorage errors.
                         */

                    }

                }


                try {

                    openButton.releasePointerCapture(
                        event.pointerId
                    );

                } catch (error) {

                    /*
                     * Pointer capture may already
                     * have been released.
                     */

                }

            }
        );


        openButton.addEventListener(
            'pointercancel',
            function () {

                dragging = false;

                openButton.classList.remove(
                    'dragging'
                );

            }
        );

    }


    /* =====================================================
       RESTORE SAVED HAMBURGER POSITION
    ===================================================== */

    function restoreHamburgerPosition() {

        if (!openButton) return;


        if (
            window.innerWidth >= 1024
        ) {

            return;

        }


        try {

            const saved =
                localStorage.getItem(
                    'electoHamburgerPosition'
                );


            if (!saved) return;


            const position =
                JSON.parse(saved);


            if (
                typeof position.left !==
                    'number' ||
                typeof position.top !==
                    'number'
            ) {

                return;

            }


            const buttonWidth =
                openButton.offsetWidth;

            const buttonHeight =
                openButton.offsetHeight;


            const maxLeft =
                window.innerWidth -
                buttonWidth -
                6;

            const maxTop =
                window.innerHeight -
                buttonHeight -
                6;


            const safeLeft =
                Math.max(
                    6,
                    Math.min(
                        position.left,
                        maxLeft
                    )
                );


            const safeTop =
                Math.max(
                    6,
                    Math.min(
                        position.top,
                        maxTop
                    )
                );


            openButton.style.left =
                safeLeft + 'px';

            openButton.style.top =
                safeTop + 'px';

            openButton.style.right =
                'auto';

            openButton.style.bottom =
                'auto';

        } catch (error) {

            /*
             * If saved data is invalid,
             * simply use the default position.
             */

        }

    }


    /*
     * Wait slightly so the browser has
     * calculated the button dimensions.
     */

    setTimeout(
        restoreHamburgerPosition,
        50
    );


    /* =====================================================
       CLOSE BUTTON
    ===================================================== */

    if (closeButton) {

        closeButton.addEventListener(
            'click',
            closeSidebar
        );

    }


    /* =====================================================
       OVERLAY
    ===================================================== */

    if (overlay) {

        overlay.addEventListener(
            'click',
            closeSidebar
        );

    }


    /* =====================================================
       CLOSE AFTER MENU SELECTION
    ===================================================== */

    if (sidebar) {

        sidebar
            .querySelectorAll('nav a')
            .forEach(function (link) {

                link.addEventListener(
                    'click',
                    function () {

                        if (
                            window.innerWidth <
                            1024
                        ) {

                            closeSidebar();

                        }

                    }
                );

            });

    }


    /* =====================================================
       ESCAPE KEY
    ===================================================== */

    document.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key === 'Escape'
            ) {

                closeSidebar();

            }

        }
    );


    /* =====================================================
       KEEP BUTTON INSIDE SCREEN AFTER ROTATION
    ===================================================== */

    window.addEventListener(
        'resize',
        function () {

            if (
                window.innerWidth >= 1024
            ) {

                closeSidebar();

                return;

            }


            if (!openButton) return;


            const rect =
                openButton.getBoundingClientRect();


            const buttonWidth =
                openButton.offsetWidth;

            const buttonHeight =
                openButton.offsetHeight;


            const maxLeft =
                window.innerWidth -
                buttonWidth -
                6;

            const maxTop =
                window.innerHeight -
                buttonHeight -
                6;


            const safeLeft =
                Math.max(
                    6,
                    Math.min(
                        rect.left,
                        maxLeft
                    )
                );


            const safeTop =
                Math.max(
                    6,
                    Math.min(
                        rect.top,
                        maxTop
                    )
                );


            openButton.style.left =
                safeLeft + 'px';

            openButton.style.top =
                safeTop + 'px';

        }
    );

});

</script>

@endauth