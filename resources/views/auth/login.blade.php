<x-guest-layout>

    {{-- =========================================================
         ELECTO PREMIUM LOGIN
    ========================================================== --}}

    <div class="w-full">

        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div class="mb-8">

            <div
                class="mb-6 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-600 to-cyan-500 text-2xl shadow-lg shadow-blue-500/20">

                🔐

            </div>

            <div
                class="mb-2 text-xs font-bold uppercase tracking-[0.2em] text-blue-600 dark:text-blue-400">

                Account Access

            </div>

            <h1
                class="text-3xl font-black tracking-tight text-slate-900 dark:text-white sm:text-4xl">

                Welcome back

            </h1>

            <p
                class="mt-3 max-w-md text-sm leading-6 text-slate-500 dark:text-slate-400">

                Sign in to continue managing your elections and
                access your Electo account.

            </p>

        </div>


        {{-- =====================================================
             SESSION STATUS
        ====================================================== --}}

        @if (session('status'))

            <div
                class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700 dark:border-emerald-500/20 dark:bg-emerald-500/10 dark:text-emerald-300">

                {{ session('status') }}

            </div>

        @endif


        {{-- =====================================================
             VALIDATION SUMMARY
        ====================================================== --}}

        @if ($errors->any())

            <div
                class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4 dark:border-red-500/20 dark:bg-red-500/10">

                <div
                    class="flex items-start gap-3">

                    <div
                        class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-red-100 text-red-600 dark:bg-red-500/10 dark:text-red-400">

                        !

                    </div>

                    <div>

                        <p
                            class="font-semibold text-red-700 dark:text-red-300">

                            Please check your details.

                        </p>

                        <ul
                            class="mt-1 list-disc space-y-1 pl-4 text-xs text-red-600 dark:text-red-400">

                            @foreach ($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>

        @endif


        {{-- =====================================================
             LOGIN FORM
        ====================================================== --}}

        <form
            method="POST"
            action="{{ route('login') }}"
            class="space-y-6">

            @csrf


            {{-- =================================================
                 EMAIL
            ================================================== --}}

            <div>

                <label
                    for="email"
                    class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-200">

                    Email Address

                    <span class="text-red-500">*</span>

                </label>


                <div class="relative">

                    <div
                        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-slate-400"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M3 8l9 6 9-6M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                            />

                        </svg>

                    </div>


                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="you@example.com"
                        class="block w-full rounded-2xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-4 text-sm font-medium text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 dark:border-white/10 dark:bg-[#132544] dark:text-white dark:hover:border-white/20 dark:focus:border-blue-500 dark:focus:bg-[#162b4c] dark:placeholder:text-slate-500"
                    />

                </div>


                @if ($errors->has('email'))

                    <p
                        class="mt-2 text-xs font-medium text-red-600 dark:text-red-400">

                        {{ $errors->first('email') }}

                    </p>

                @endif

            </div>


            {{-- =================================================
                 PASSWORD
            ================================================== --}}

            <div>

                <div
                    class="mb-2 flex items-center justify-between">

                    <label
                        for="password"
                        class="block text-sm font-bold text-slate-700 dark:text-slate-200">

                        Password

                        <span class="text-red-500">*</span>

                    </label>


                    @if (Route::has('password.request'))

                        <a
                            href="{{ route('password.request') }}"
                            class="text-xs font-bold text-blue-600 transition hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">

                            Forgot password?

                        </a>

                    @endif

                </div>


                <div
                    class="relative"
                    x-data="{ showPassword: false }">

                    <div
                        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-slate-400"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M16 11V8a4 4 0 00-8 0v3m-2 0h12a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6a2 2 0 012-2z"
                            />

                        </svg>

                    </div>


                    <input
                        id="password"
                        name="password"
                        x-bind:type="showPassword ? 'text' : 'password'"
                        required
                        autocomplete="current-password"
                        placeholder="Enter your password"
                        class="block w-full rounded-2xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-12 text-sm font-medium text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 dark:border-white/10 dark:bg-[#132544] dark:text-white dark:hover:border-white/20 dark:focus:border-blue-500 dark:focus:bg-[#162b4c] dark:placeholder:text-slate-500"
                    />


                    <button
                        type="button"
                        x-on:click="showPassword = !showPassword"
                        class="absolute inset-y-0 right-0 flex items-center px-4 text-slate-400 transition hover:text-blue-600 dark:hover:text-blue-400"
                        aria-label="Toggle password visibility">

                        {{-- Eye --}}

                        <svg
                            x-show="!showPassword"
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                            />

                        </svg>


                        {{-- Eye Off --}}

                        <svg
                            x-show="showPassword"
                            x-cloak
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M3 3l18 18"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M10.584 10.587a2 2 0 002.829 2.826"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M9.88 5.09A10.94 10.94 0 0112 5c4.477 0 8.268 2.943 9.542 7a10.97 10.97 0 01-4.043 5.12M6.228 6.228A10.97 10.97 0 002.458 12C3.732 16.057 7.523 19 12 19c1.61 0 3.13-.365 4.485-1.015"
                            />

                        </svg>

                    </button>

                </div>


                @if ($errors->has('password'))

                    <p
                        class="mt-2 text-xs font-medium text-red-600 dark:text-red-400">

                        {{ $errors->first('password') }}

                    </p>

                @endif

            </div>


            {{-- =================================================
                 REMEMBER ME
            ================================================== --}}

            <div class="flex items-center">

                <label
                    for="remember_me"
                    class="inline-flex cursor-pointer items-center gap-3">

                    <input
                        id="remember_me"
                        type="checkbox"
                        name="remember"
                        class="h-4 w-4 rounded border-slate-300 text-blue-600 shadow-sm focus:ring-2 focus:ring-blue-500/20 dark:border-white/20 dark:bg-[#132544]"
                    />

                    <span
                        class="text-sm font-medium text-slate-600 dark:text-slate-400">

                        Remember me

                    </span>

                </label>

            </div>


            {{-- =================================================
                 SIGN IN BUTTON
            ================================================== --}}

            <button
                type="submit"
                class="group flex w-full items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-blue-600 to-cyan-500 px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-blue-500/20 transition duration-200 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-blue-500/25 focus:outline-none focus:ring-4 focus:ring-blue-500/20">

                <span>
                    Sign In
                </span>

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-1"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M13 7l5 5m0 0l-5 5m5-5H6"
                    />

                </svg>

            </button>

        </form>


        {{-- =====================================================
             DIVIDER
        ====================================================== --}}

        <div class="relative my-7">

            <div
                class="absolute inset-0 flex items-center">

                <div
                    class="w-full border-t border-slate-200 dark:border-white/10">
                </div>

            </div>

            <div
                class="relative flex justify-center">

                <span
                    class="bg-white px-4 text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400 dark:bg-[#0f1d35] dark:text-slate-500">

                    New to Electo?

                </span>

            </div>

        </div>


        {{-- =====================================================
             CREATE ACCOUNT
        ====================================================== --}}

        <div
            class="rounded-2xl border border-blue-100 bg-gradient-to-br from-blue-50 to-cyan-50 p-5 dark:border-blue-500/15 dark:from-blue-500/10 dark:to-cyan-500/10">

            <div
                class="flex items-start gap-4">

                <div
                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white text-xl shadow-sm dark:bg-[#132544]">

                    🚀

                </div>


                <div class="min-w-0 flex-1">

                    <h3
                        class="font-bold text-slate-900 dark:text-white">

                        Don't have an account?

                    </h3>

                    <p
                        class="mt-1 text-xs leading-5 text-slate-500 dark:text-slate-400">

                        Create your free Electo account and start
                        building secure elections.

                    </p>


                    <a
                        href="{{ route('register') }}"
                        class="mt-4 inline-flex items-center gap-2 rounded-xl border border-blue-200 bg-white px-4 py-2.5 text-xs font-bold text-blue-600 shadow-sm transition hover:-translate-y-0.5 hover:border-blue-300 hover:shadow-md dark:border-blue-500/20 dark:bg-[#132544] dark:text-blue-400">

                        Create Free Account

                        <span>→</span>

                    </a>

                </div>

            </div>

        </div>


        {{-- =====================================================
             SECURITY FOOTNOTE
        ====================================================== --}}

        <div
            class="mt-6 flex items-center justify-center gap-2 text-center text-[11px] leading-5 text-slate-400 dark:text-slate-500">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4 shrink-0"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.8"
                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                />

            </svg>

            Secure authentication powered by Electo.

        </div>

    </div>

</x-guest-layout>