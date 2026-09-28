<nav
    x-data="{ open: false }"
    class="fixed inset-x-0 top-0 z-50"
>

    <div
        class="landing-container pt-5"
    >

        <div
            class="
                electo-public-nav
                flex min-h-[76px]
                items-center
                justify-between
                gap-4
                rounded-3xl
                px-4
                py-3
                sm:px-6
                lg:px-7
            "
        >

            {{-- ================================================= --}}
            {{-- LOGO --}}
            {{-- ================================================= --}}

            <a
                href="/"
                class="flex shrink-0 items-center gap-3"
            >

                <div
                    class="
                        flex h-11 w-11
                        items-center justify-center
                        rounded-2xl
                        bg-gradient-to-br
                        from-blue-600
                        to-cyan-500
                        text-xl
                        shadow-lg
                        shadow-blue-500/20
                    "
                >
                    🗳️
                </div>


                <div>

                    <h2
                        class="
                            text-lg
                            font-black
                            leading-none
                            text-slate-900
                            dark:text-white
                            sm:text-xl
                        "
                    >
                        Electo
                    </h2>

                    <p
                        class="
                            mt-1
                            text-[10px]
                            font-semibold
                            tracking-wide
                            text-slate-500
                            dark:text-slate-400
                        "
                    >
                        Secure Digital Elections
                    </p>

                </div>

            </a>


            {{-- ================================================= --}}
            {{-- DESKTOP NAVIGATION --}}
            {{-- ================================================= --}}

            <div
                class="
                    hidden
                    items-center
                    gap-7
                    lg:flex
                    xl:gap-9
                "
            >

                <a
                    href="#features"
                    class="
                        text-sm
                        font-semibold
                        text-slate-600
                        transition
                        hover:text-blue-600
                        dark:text-slate-300
                        dark:hover:text-cyan-300
                    "
                >
                    Features
                </a>

                <a
                    href="#solutions"
                    class="
                        text-sm
                        font-semibold
                        text-slate-600
                        transition
                        hover:text-blue-600
                        dark:text-slate-300
                        dark:hover:text-cyan-300
                    "
                >
                    Solutions
                </a>

                <a
                    href="#security"
                    class="
                        text-sm
                        font-semibold
                        text-slate-600
                        transition
                        hover:text-blue-600
                        dark:text-slate-300
                        dark:hover:text-cyan-300
                    "
                >
                    Security
                </a>

                <a
                    href="#pricing"
                    class="
                        text-sm
                        font-semibold
                        text-slate-600
                        transition
                        hover:text-blue-600
                        dark:text-slate-300
                        dark:hover:text-cyan-300
                    "
                >
                    Pricing
                </a>

                <a
                    href="#contact"
                    class="
                        text-sm
                        font-semibold
                        text-slate-600
                        transition
                        hover:text-blue-600
                        dark:text-slate-300
                        dark:hover:text-cyan-300
                    "
                >
                    Contact
                </a>

            </div>


            {{-- ================================================= --}}
            {{-- RIGHT CONTROLS --}}
            {{-- ================================================= --}}

            <div
                class="
                    hidden
                    items-center
                    gap-2
                    lg:flex
                "
            >

                {{-- THEME TOGGLE --}}

                <button
                    type="button"
                    onclick="window.ElectoTheme.toggle()"
                    class="theme-toggle-public"
                    aria-label="Toggle light and dark mode"
                >

                    <svg
                        class="h-5 w-5 dark:hidden"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 3v2m0 14v2M4.93 4.93l1.42 1.42m11.3 11.3l1.42 1.42M3 12h2m14 0h2M4.93 19.07l1.42-1.42m11.3-11.3l1.42-1.42"
                        />
                        <circle
                            cx="12"
                            cy="12"
                            r="4"
                        />
                    </svg>


                    <svg
                        class="hidden h-5 w-5 dark:block"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"
                        />
                    </svg>

                </button>


                @auth

                    <a
                        href="{{ route('dashboard') }}"
                        class="public-secondary ml-1"
                    >
                        Dashboard
                    </a>

                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                        class="inline"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="public-primary"
                        >
                            Logout
                        </button>

                    </form>

                @else

                    <a
                        href="{{ route('login') }}"
                        class="public-secondary ml-1"
                    >
                        Sign In
                    </a>

                    <a
                        href="{{ route('register') }}"
                        class="public-primary"
                    >
                        Get Started
                        <span>→</span>
                    </a>

                @endauth

            </div>


            {{-- ================================================= --}}
            {{-- MOBILE CONTROLS --}}
            {{-- ================================================= --}}

            <div
                class="flex items-center gap-2 lg:hidden"
            >

                <button
                    type="button"
                    onclick="window.ElectoTheme.toggle()"
                    class="theme-toggle-public"
                    aria-label="Toggle theme"
                >

                    <svg
                        class="h-5 w-5 dark:hidden"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <circle
                            cx="12"
                            cy="12"
                            r="4"
                        />
                        <path
                            stroke-linecap="round"
                            d="M12 2v2m0 16v2M4.93 4.93l1.42 1.42m11.3 11.3l1.42 1.42M2 12h2m16 0h2"
                        />
                    </svg>


                    <svg
                        class="hidden h-5 w-5 dark:block"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"
                        />
                    </svg>

                </button>


                <button
                    @click="open = !open"
                    type="button"
                    class="
                        flex h-11 w-11
                        items-center justify-center
                        rounded-2xl
                        border
                        border-slate-200
                        bg-white/80
                        text-slate-700
                        dark:border-white/10
                        dark:bg-white/5
                        dark:text-white
                    "
                    aria-label="Open menu"
                >

                    <svg
                        x-show="!open"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
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
                        x-show="open"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
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

        </div>


        {{-- ================================================= --}}
        {{-- MOBILE MENU --}}
        {{-- ================================================= --}}

        <div
            x-show="open"
            x-transition
            class="
                electo-public-nav
                mt-3
                rounded-3xl
                p-6
                lg:hidden
            "
        >

            <div class="space-y-5">

                <a
                    href="#features"
                    @click="open = false"
                    class="
                        block
                        font-semibold
                        text-slate-700
                        hover:text-blue-600
                        dark:text-slate-300
                        dark:hover:text-cyan-300
                    "
                >
                    Features
                </a>

                <a
                    href="#solutions"
                    @click="open = false"
                    class="
                        block
                        font-semibold
                        text-slate-700
                        hover:text-blue-600
                        dark:text-slate-300
                        dark:hover:text-cyan-300
                    "
                >
                    Solutions
                </a>

                <a
                    href="#security"
                    @click="open = false"
                    class="
                        block
                        font-semibold
                        text-slate-700
                        hover:text-blue-600
                        dark:text-slate-300
                        dark:hover:text-cyan-300
                    "
                >
                    Security
                </a>

                <a
                    href="#pricing"
                    @click="open = false"
                    class="
                        block
                        font-semibold
                        text-slate-700
                        hover:text-blue-600
                        dark:text-slate-300
                        dark:hover:text-cyan-300
                    "
                >
                    Pricing
                </a>

                <a
                    href="#contact"
                    @click="open = false"
                    class="
                        block
                        font-semibold
                        text-slate-700
                        hover:text-blue-600
                        dark:text-slate-300
                        dark:hover:text-cyan-300
                    "
                >
                    Contact
                </a>

            </div>


            <div class="mt-6 space-y-3">

                @auth

                    <a
                        href="{{ route('dashboard') }}"
                        class="public-secondary w-full"
                    >
                        Dashboard
                    </a>

                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="public-primary w-full"
                        >
                            Logout
                        </button>

                    </form>

                @else

                    <a
                        href="{{ route('login') }}"
                        class="public-secondary w-full"
                    >
                        Sign In
                    </a>

                    <a
                        href="{{ route('register') }}"
                        class="public-primary w-full"
                    >
                        Get Started
                        <span>→</span>
                    </a>

                @endauth

            </div>

        </div>

    </div>

</nav>