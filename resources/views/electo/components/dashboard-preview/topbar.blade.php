<div
    class="flex items-center justify-between border-b border-white/10 bg-slate-900/40 px-6 py-4">

    <!-- ========================================= -->
    <!-- Search -->
    <!-- ========================================= -->

    <div
        class="flex w-full max-w-md items-center gap-3 rounded-xl border border-white/10 bg-slate-800/70 px-4 py-3 transition-all duration-300 hover:border-cyan-400/40 hover:bg-slate-800">

        <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5 text-slate-400"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor">

            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z"/>

        </svg>

        <input
            type="text"
            placeholder="Search elections..."
            class="w-full bg-transparent text-sm text-white placeholder:text-slate-500 focus:outline-none">

    </div>

    <!-- ========================================= -->
    <!-- Right Section -->
    <!-- ========================================= -->

    <div class="ml-6 flex items-center gap-4">

        <!-- Notifications -->

        <button
            class="relative flex h-11 w-11 items-center justify-center rounded-xl border border-white/10 bg-slate-800/70 transition-all duration-300 hover:scale-105 hover:bg-slate-700">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 text-white"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 10-12 0v3.2c0 .5-.2 1-.6 1.4L4 17h5m6 0a3 3 0 11-6 0"/>

            </svg>

            <!-- Notification Dot -->

            <span
                class="absolute right-2 top-2 flex h-2.5 w-2.5">

                <span
                    class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75">
                </span>

                <span
                    class="relative inline-flex h-2.5 w-2.5 rounded-full bg-emerald-400">
                </span>

            </span>

        </button>

        <!-- Demo User -->

        <div
            class="flex items-center gap-3 rounded-xl border border-white/10 bg-slate-800/60 px-3 py-2">

            <!-- Avatar -->

            <div
                class="flex h-11 w-11 items-center justify-center rounded-full bg-gradient-to-br from-cyan-400 via-blue-500 to-indigo-600 font-bold text-white shadow-lg">

                DE

            </div>

            <!-- User Info -->

            <div class="hidden lg:block">

                <p
                    class="text-sm font-semibold text-white">

                    Demo Environment

                </p>

                <div
                    class="mt-1 flex items-center gap-2">

                    <span
                        class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse">
                    </span>

                    <span
                        class="text-xs text-slate-400">

                        Enterprise Preview

                    </span>

                </div>

            </div>

        </div>

    </div>

</div>