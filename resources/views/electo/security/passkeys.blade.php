

@php
    /*
    |--------------------------------------------------------------------------
    | Security Data
    |--------------------------------------------------------------------------
    */

    $passkeys = $passkeys ?? collect();

    $twoFactorEnabled = $twoFactor?->enabled ?? false;

    /*
    |--------------------------------------------------------------------------
    | 2FA Setup
    |--------------------------------------------------------------------------
    |
    | The controller now loads pending 2FA setup directly from the database.
    |
    */

    $twoFactorSetup = $twoFactorSetup ?? false;

    $twoFactorQrUrl = $twoFactorQrUrl ?? null;

    $twoFactorSecret = $twoFactorSecret ?? null;

    /*
    |--------------------------------------------------------------------------
    | Recovery Codes
    |--------------------------------------------------------------------------
    */

    $recoveryCodes = session('recovery_codes');
@endphp


<div class="mx-auto w-full max-w-5xl space-y-8">

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <div>

        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-blue-600 dark:text-blue-400">
            Account Security
        </p>

        <h1 class="mt-1 text-3xl font-black tracking-tight text-slate-900 dark:text-white">
            Security & Devices
        </h1>

        <p class="mt-2 text-sm text-slate-500 dark:text-gray-400">
            Manage your password, trusted devices, and secure authentication methods.
        </p>

    </div>


    {{-- ========================================================= --}}
    {{-- SUCCESS MESSAGE --}}
    {{-- ========================================================= --}}

    @if(session('success'))

        <div
            class="rounded-2xl
                   border
                   border-emerald-200
                   bg-emerald-50
                   p-4
                   dark:border-emerald-500/20
                   dark:bg-emerald-500/[0.05]"
        >

            <div class="flex items-start gap-3">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="mt-0.5 h-5 w-5 shrink-0 text-emerald-600 dark:text-emerald-400"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 12l2 2 4-4"
                    />

                    <circle
                        cx="12"
                        cy="12"
                        r="9"
                    />
                </svg>

                <p class="text-sm font-medium text-emerald-700 dark:text-emerald-300">
                    {{ session('success') }}
                </p>

            </div>

        </div>

    @endif


    {{-- ========================================================= --}}
    {{-- ERROR MESSAGE --}}
    {{-- ========================================================= --}}

    @if(session('error'))

        <div
            class="rounded-2xl
                   border
                   border-red-200
                   bg-red-50
                   p-4
                   dark:border-red-500/20
                   dark:bg-red-500/[0.05]"
        >

            <div class="flex items-start gap-3">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="mt-0.5 h-5 w-5 shrink-0 text-red-600 dark:text-red-400"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <circle
                        cx="12"
                        cy="12"
                        r="9"
                    />

                    <path
                        stroke-linecap="round"
                        d="M12 8v5"
                    />

                    <path
                        stroke-linecap="round"
                        d="M12 16h.01"
                    />
                </svg>

                <p class="text-sm font-medium text-red-700 dark:text-red-300">
                    {{ session('error') }}
                </p>

            </div>

        </div>

    @endif


    {{-- ========================================================= --}}
    {{-- CHANGE PASSWORD --}}
    {{-- ========================================================= --}}

    <div
        class="overflow-hidden
               rounded-3xl
               border
               border-slate-200
               bg-white
               shadow-[0_20px_60px_rgba(15,23,42,0.08)]
               transition
               dark:border-white/10
               dark:bg-gradient-to-br
               dark:from-[#172d50]
               dark:via-[#132544]
               dark:to-[#0d1c35]"
    >

        <div class="h-1 w-full bg-gradient-to-r from-blue-600 via-cyan-500 to-blue-500"></div>

        <div class="p-6 md:p-7">

            <div class="flex items-start gap-4">

                <div
                    class="flex
                           h-12
                           w-12
                           shrink-0
                           items-center
                           justify-center
                           rounded-2xl
                           bg-blue-100
                           text-blue-600
                           dark:bg-blue-500/10
                           dark:text-blue-400"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 11V7a3 3 0 00-6 0v4"
                        />

                        <rect
                            x="5"
                            y="11"
                            width="14"
                            height="10"
                            rx="2"
                        />

                        <path
                            stroke-linecap="round"
                            d="M12 15v2"
                        />
                    </svg>

                </div>

                <div>

                    <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                        Change Password
                    </h2>

                    <p class="mt-1 text-sm text-slate-500 dark:text-gray-400">
                        Update your password to keep your Electo account secure.
                    </p>

                </div>

            </div>


            <form
                method="POST"
                action="{{ route('settings.security.password.update') }}"
                class="mt-7 space-y-5"
            >

                @csrf

                @method('PUT')


                <div>

                    <label
                        for="current_password"
                        class="mb-2 block text-sm font-semibold text-slate-700 dark:text-gray-300"
                    >
                        Current Password
                    </label>

                    <input
                        id="current_password"
                        name="current_password"
                        type="password"
                        autocomplete="current-password"
                        required
                        class="w-full
                               rounded-xl
                               border
                               border-slate-200
                               bg-slate-50
                               px-4
                               py-3
                               text-sm
                               text-slate-900
                               outline-none
                               transition
                               placeholder:text-slate-400
                               focus:border-blue-500
                               focus:ring-2
                               focus:ring-blue-500/20
                               dark:border-white/10
                               dark:bg-white/[0.04]
                               dark:text-white
                               dark:placeholder-gray-500"
                        placeholder="Enter your current password"
                    >

                    @error('current_password')

                        <p class="mt-2 text-xs font-medium text-red-600 dark:text-red-400">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                <div>

                    <label
                        for="password"
                        class="mb-2 block text-sm font-semibold text-slate-700 dark:text-gray-300"
                    >
                        New Password
                    </label>

                    <input
                        id="password"
                        name="password"
                        type="password"
                        autocomplete="new-password"
                        required
                        class="w-full
                               rounded-xl
                               border
                               border-slate-200
                               bg-slate-50
                               px-4
                               py-3
                               text-sm
                               text-slate-900
                               outline-none
                               transition
                               placeholder:text-slate-400
                               focus:border-blue-500
                               focus:ring-2
                               focus:ring-blue-500/20
                               dark:border-white/10
                               dark:bg-white/[0.04]
                               dark:text-white
                               dark:placeholder-gray-500"
                        placeholder="Enter your new password"
                    >

                    @error('password')

                        <p class="mt-2 text-xs font-medium text-red-600 dark:text-red-400">
                            {{ $message }}
                        </p>

                    @enderror

                    <p class="mt-2 text-xs text-slate-500 dark:text-gray-500">
                        Use at least 8 characters and choose a password you do not use elsewhere.
                    </p>

                </div>


                <div>

                    <label
                        for="password_confirmation"
                        class="mb-2 block text-sm font-semibold text-slate-700 dark:text-gray-300"
                    >
                        Confirm New Password
                    </label>

                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        autocomplete="new-password"
                        required
                        class="w-full
                               rounded-xl
                               border
                               border-slate-200
                               bg-slate-50
                               px-4
                               py-3
                               text-sm
                               text-slate-900
                               outline-none
                               transition
                               placeholder:text-slate-400
                               focus:border-blue-500
                               focus:ring-2
                               focus:ring-blue-500/20
                               dark:border-white/10
                               dark:bg-white/[0.04]
                               dark:text-white
                               dark:placeholder-gray-500"
                        placeholder="Confirm your new password"
                    >

                    @error('password_confirmation')

                        <p class="mt-2 text-xs font-medium text-red-600 dark:text-red-400">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                <div
                    class="rounded-2xl
                           border
                           border-blue-200
                           bg-blue-50
                           p-4
                           dark:border-blue-500/20
                           dark:bg-blue-500/[0.05]"
                >

                    <div class="flex items-start gap-3">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="mt-0.5 h-5 w-5 shrink-0 text-blue-600 dark:text-blue-400"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 3l8 4v5c0 5.5-3.5 8.5-8 10-4.5-1.5-8-4.5-8-10V7l8-4z"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 12l2 2 4-4"
                            />
                        </svg>

                        <div>

                            <p class="text-sm font-semibold text-blue-800 dark:text-blue-300">
                                Keep your account protected
                            </p>

                            <p class="mt-1 text-xs leading-5 text-blue-700/80 dark:text-blue-200/60">
                                Never share your password with anyone. Electo will never ask you
                                to send your password by email or message.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="flex justify-end pt-1">

                    <button
                        type="submit"
                        class="inline-flex
                               items-center
                               justify-center
                               gap-2
                               rounded-xl
                               bg-gradient-to-r
                               from-blue-600
                               to-cyan-500
                               px-6
                               py-3
                               text-sm
                               font-bold
                               text-white
                               shadow-lg
                               shadow-blue-500/20
                               transition
                               hover:-translate-y-0.5
                               hover:shadow-blue-500/30
                               focus:outline-none
                               focus:ring-2
                               focus:ring-blue-500/30"
                    >

                        Update Password

                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- REGISTERED DEVICES --}}
    {{-- ========================================================= --}}

    <div>

        <div class="mb-4 flex items-center justify-between">

            <div>

                <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                    Registered Devices
                </h2>

                <p class="mt-1 text-sm text-slate-500 dark:text-gray-400">
                    Devices that can be used to authenticate your Electo account.
                </p>

            </div>

            <span
                class="rounded-full
                       border
                       border-slate-200
                       bg-slate-100
                       px-3
                       py-1
                       text-xs
                       font-medium
                       text-slate-600
                       dark:border-white/10
                       dark:bg-white/[0.04]
                       dark:text-gray-400"
            >
                {{ $passkeys->count() }}
                {{ $passkeys->count() === 1 ? 'device' : 'devices' }}
            </span>

        </div>


        @if($passkeys->count())

            <div class="space-y-3">

                @foreach($passkeys as $passkey)

                    <div
                        class="group
                               rounded-2xl
                               border
                               border-slate-200
                               bg-white
                               p-5
                               shadow-sm
                               transition
                               hover:border-blue-200
                               hover:bg-blue-50/40
                               dark:border-white/10
                               dark:bg-white/[0.025]
                               dark:hover:border-blue-500/20
                               dark:hover:bg-white/[0.04]"
                    >

                        <div
                            class="flex
                                   flex-col
                                   gap-5
                                   sm:flex-row
                                   sm:items-center
                                   sm:justify-between"
                        >

                            <div class="flex items-center gap-4">

                                <div
                                    class="flex
                                           h-12
                                           w-12
                                           shrink-0
                                           items-center
                                           justify-center
                                           rounded-xl
                                           bg-blue-100
                                           dark:bg-blue-500/10"
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6 text-blue-600 dark:text-blue-400"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <rect
                                            x="5"
                                            y="3"
                                            width="14"
                                            height="18"
                                            rx="2"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            d="M9 18h6"
                                        />
                                    </svg>

                                </div>


                                <div>

                                    <div class="flex flex-wrap items-center gap-2">

                                        <h3 class="font-semibold text-slate-900 dark:text-white">
                                            {{ $passkey->name }}
                                        </h3>

                                        <span
                                            class="rounded-full
                                                   border
                                                   border-emerald-200
                                                   bg-emerald-50
                                                   px-2
                                                   py-0.5
                                                   text-[10px]
                                                   font-semibold
                                                   uppercase
                                                   tracking-wide
                                                   text-emerald-700
                                                   dark:border-emerald-500/20
                                                   dark:bg-emerald-500/10
                                                   dark:text-emerald-300"
                                        >
                                            Trusted
                                        </span>

                                    </div>


                                    <p class="mt-1 text-xs text-slate-500 dark:text-gray-500">

                                        Registered
                                        {{ \Carbon\Carbon::parse($passkey->created_at)->format('M d, Y') }}

                                        @if($passkey->last_used_at)

                                            <span class="mx-1 text-slate-300 dark:text-gray-700">
                                                •
                                            </span>

                                            Last used
                                            {{ \Carbon\Carbon::parse($passkey->last_used_at)->diffForHumans() }}

                                        @else

                                            <span class="mx-1 text-slate-300 dark:text-gray-700">
                                                •
                                            </span>

                                            Never used

                                        @endif

                                    </p>

                                </div>

                            </div>


                            <button
                                type="button"
                                class="remove-passkey
                                       inline-flex
                                       items-center
                                       justify-center
                                       gap-2
                                       rounded-xl
                                       border
                                       border-red-200
                                       bg-red-50
                                       px-4
                                       py-2.5
                                       text-xs
                                       font-semibold
                                       text-red-600
                                       transition
                                       hover:border-red-300
                                       hover:bg-red-100
                                       dark:border-red-500/10
                                       dark:bg-red-500/5
                                       dark:text-red-300
                                       dark:hover:border-red-500/20
                                       dark:hover:bg-red-500/10"
                                data-passkey-id="{{ $passkey->id }}"
                                data-passkey-name="{{ $passkey->name }}"
                            >

                                Remove

                            </button>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div
                class="rounded-2xl
                       border
                       border-dashed
                       border-slate-200
                       bg-slate-50
                       p-10
                       text-center
                       dark:border-white/10
                       dark:bg-white/[0.02]"
            >

                <h3 class="text-sm font-semibold text-slate-900 dark:text-white">
                    No registered devices
                </h3>

                <p class="mx-auto mt-1 max-w-md text-sm text-slate-500 dark:text-gray-500">
                    Register a trusted device to use secure passkey authentication.
                </p>

            </div>

        @endif

    </div>


    {{-- ========================================================= --}}
    {{-- ADD DEVICE --}}
    {{-- ========================================================= --}}

    <div
        class="rounded-2xl
               border
               border-blue-200
               bg-blue-50
               p-6
               dark:border-blue-500/20
               dark:bg-blue-500/[0.04]"
    >

        <div
            class="flex
                   flex-col
                   gap-6
                   sm:flex-row
                   sm:items-center
                   sm:justify-between"
        >

            <div class="flex items-start gap-4">

                <div
                    class="flex
                           h-12
                           w-12
                           shrink-0
                           items-center
                           justify-center
                           rounded-xl
                           bg-blue-100
                           dark:bg-blue-500/10"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-blue-600 dark:text-blue-400"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 5v14M5 12h14"
                        />
                    </svg>

                </div>


                <div>

                    <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                        Register Another Device
                    </h2>

                    <p class="mt-1 max-w-xl text-sm leading-6 text-slate-600 dark:text-gray-400">
                        Add another phone, computer, or supported security device
                        to your Electo account.
                    </p>

                </div>

            </div>


            <button
                type="button"
                id="register-passkey"
                class="inline-flex
                       shrink-0
                       items-center
                       justify-center
                       gap-2
                       rounded-xl
                       bg-gradient-to-r
                       from-blue-600
                       to-cyan-500
                       px-5
                       py-3
                       text-sm
                       font-semibold
                       text-white
                       shadow-lg
                       shadow-blue-600/20
                       transition
                       hover:-translate-y-0.5
                       hover:shadow-blue-500/30
                       disabled:cursor-not-allowed
                       disabled:opacity-50"
            >

                Register Device

            </button>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- TWO-FACTOR AUTHENTICATION --}}
    {{-- ========================================================= --}}

    <div
        class="overflow-hidden
               rounded-3xl
               border
               border-slate-200
               bg-white
               shadow-[0_20px_60px_rgba(15,23,42,0.08)]
               transition
               dark:border-white/10
               dark:bg-gradient-to-br
               dark:from-[#172d50]
               dark:via-[#132544]
               dark:to-[#0d1c35]"
    >

        <div class="h-1 w-full bg-gradient-to-r from-blue-600 via-cyan-500 to-blue-500"></div>

        <div class="p-6 md:p-7">

            {{-- HEADER --}}

            <div class="flex items-start gap-4">

                <div
                    class="flex
                           h-12
                           w-12
                           shrink-0
                           items-center
                           justify-center
                           rounded-2xl
                           bg-blue-100
                           text-blue-600
                           dark:bg-blue-500/10
                           dark:text-blue-400"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 3l8 4v5c0 5.5-3.5 8.5-8 10-4.5-1.5-8-4.5-8-10V7l8-4z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 12l2 2 4-4"
                        />
                    </svg>

                </div>


                <div class="min-w-0 flex-1">

                    <div class="flex flex-wrap items-center gap-3">

                        <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                            Two-Factor Authentication
                        </h2>


                        @if($twoFactorEnabled)

                            <span
                                class="inline-flex
                                       items-center
                                       gap-1.5
                                       rounded-full
                                       border
                                       border-emerald-200
                                       bg-emerald-50
                                       px-3
                                       py-1
                                       text-[10px]
                                       font-bold
                                       uppercase
                                       tracking-wide
                                       text-emerald-700
                                       dark:border-emerald-500/20
                                       dark:bg-emerald-500/10
                                       dark:text-emerald-300"
                            >

                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                Enabled

                            </span>

                        @elseif($twoFactorSetup)

                            <span
                                class="inline-flex
                                       items-center
                                       gap-1.5
                                       rounded-full
                                       border
                                       border-amber-200
                                       bg-amber-50
                                       px-3
                                       py-1
                                       text-[10px]
                                       font-bold
                                       uppercase
                                       tracking-wide
                                       text-amber-700
                                       dark:border-amber-500/20
                                       dark:bg-amber-500/10
                                       dark:text-amber-300"
                            >
                                Setup Required
                            </span>

                        @else

                            <span
                                class="inline-flex
                                       items-center
                                       gap-1.5
                                       rounded-full
                                       border
                                       border-slate-200
                                       bg-slate-100
                                       px-3
                                       py-1
                                       text-[10px]
                                       font-bold
                                       uppercase
                                       tracking-wide
                                       text-slate-600
                                       dark:border-white/10
                                       dark:bg-white/[0.04]
                                       dark:text-gray-400"
                            >

                                <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>

                                Disabled

                            </span>

                        @endif

                    </div>


                    <p class="mt-1 text-sm text-slate-500 dark:text-gray-400">
                        Protect your Electo administrator account with an authenticator app.
                    </p>

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- ENABLED --}}
            {{-- ================================================= --}}

            @if($twoFactorEnabled)

                <div class="mt-7 space-y-5">

                    <div
                        class="rounded-2xl
                               border
                               border-emerald-200
                               bg-emerald-50
                               p-5
                               dark:border-emerald-500/20
                               dark:bg-emerald-500/[0.05]"
                    >

                        <div class="flex items-start gap-3">

                            <div>

                                <p class="text-sm font-semibold text-emerald-800 dark:text-emerald-300">
                                    Your account is protected
                                </p>

                                <p class="mt-1 text-xs leading-5 text-emerald-700/80 dark:text-emerald-200/60">
                                    Two-factor authentication is active. Your authenticator
                                    app provides an additional security code.
                                </p>

                                @if($twoFactor->confirmed_at)

                                    <p class="mt-2 text-[11px] text-emerald-700/60 dark:text-emerald-200/50">
                                        Enabled
                                        {{ $twoFactor->confirmed_at->diffForHumans() }}
                                    </p>

                                @endif

                            </div>

                        </div>

                    </div>


                    <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">

                        {{-- RECOVERY CODES --}}

                        <form
                            method="POST"
                            action="{{ route('settings.security.2fa.recovery-codes') }}"
                            onsubmit="return submitSecurityPassword(this, 'Enter your current password to generate new recovery codes:');"
                        >

                            @csrf

                            <input
                                type="hidden"
                                name="current_password"
                            >

                            <button
                                type="submit"
                                class="inline-flex
                                       w-full
                                       items-center
                                       justify-center
                                       rounded-xl
                                       border
                                       border-slate-200
                                       bg-white
                                       px-5
                                       py-3
                                       text-sm
                                       font-semibold
                                       text-slate-700
                                       transition
                                       hover:border-blue-300
                                       hover:bg-blue-50
                                       dark:border-white/10
                                       dark:bg-white/[0.03]
                                       dark:text-gray-300
                                       sm:w-auto"
                            >
                                Generate New Recovery Codes
                            </button>

                        </form>


                        {{-- DISABLE 2FA --}}

                        <form
                            method="POST"
                            action="{{ route('settings.security.2fa.disable') }}"
                            onsubmit="return submitDisable2FA(this);"
                        >

                            @csrf

                            <input
                                type="hidden"
                                name="current_password"
                            >

                            <button
                                type="submit"
                                class="inline-flex
                                       w-full
                                       items-center
                                       justify-center
                                       rounded-xl
                                       border
                                       border-red-200
                                       bg-red-50
                                       px-5
                                       py-3
                                       text-sm
                                       font-semibold
                                       text-red-600
                                       transition
                                       hover:border-red-300
                                       hover:bg-red-100
                                       dark:border-red-500/10
                                       dark:bg-red-500/5
                                       dark:text-red-300
                                       sm:w-auto"
                            >
                                Disable 2FA
                            </button>

                        </form>

                    </div>

                </div>


            {{-- ================================================= --}}
            {{-- SETUP --}}
            {{-- ================================================= --}}

            @elseif($twoFactorSetup)

                <div class="mt-7">

                    <div
                        class="rounded-2xl
                               border
                               border-blue-200
                               bg-blue-50
                               p-6
                               dark:border-blue-500/20
                               dark:bg-blue-500/[0.04]"
                    >

                        <div class="text-center">

                            <h3 class="text-base font-bold text-slate-900 dark:text-white">
                                Set Up Your Authenticator App
                            </h3>

                            <p class="mx-auto mt-2 max-w-lg text-sm leading-6 text-slate-600 dark:text-gray-400">
                                Scan this QR code using Google Authenticator,
                                Microsoft Authenticator, Authy, or another
                                compatible authenticator application.
                            </p>


                            {{-- QR CODE --}}

                            <div
                                class="mx-auto mt-6
                                       flex
                                       min-h-[250px]
                                       w-[250px]
                                       items-center
                                       justify-center
                                       rounded-2xl
                                       bg-white
                                       p-4
                                       shadow-lg"
                            >

                                @if($twoFactorQrUrl)

                                    {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(210)
                                        ->margin(1)
                                        ->generate($twoFactorQrUrl) !!}

                                @else

                                    <p class="text-sm text-red-500">
                                        QR code could not be generated.
                                    </p>

                                @endif

                            </div>


                            {{-- MANUAL SECRET --}}

                            <div class="mx-auto mt-6 max-w-md">

                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-gray-500">
                                    Can't scan the QR code?
                                </p>

                                <p class="mt-1 text-xs text-slate-500 dark:text-gray-500">
                                    Enter this setup key manually in your authenticator app.
                                </p>


                                <div
                                    class="mt-3
                                           select-all
                                           rounded-xl
                                           border
                                           border-slate-200
                                           bg-white
                                           px-4
                                           py-3
                                           font-mono
                                           text-sm
                                           font-bold
                                           tracking-widest
                                           text-slate-700
                                           break-all
                                           dark:border-white/10
                                           dark:bg-white/[0.03]
                                           dark:text-gray-300"
                                >
                                    {{ $twoFactorSecret }}
                                </div>

                            </div>

                        </div>


                        {{-- VERIFICATION FORM --}}

                        <form
                            method="POST"
                            action="{{ route('settings.security.2fa.confirm') }}"
                            class="mx-auto mt-7 max-w-md"
                        >

                            @csrf

                            <label
                                for="one_time_password"
                                class="mb-2 block text-sm font-semibold text-slate-700 dark:text-gray-300"
                            >
                                Enter the 6-digit verification code
                            </label>

                            <input
                                id="one_time_password"
                                name="one_time_password"
                                type="text"
                                inputmode="numeric"
                                autocomplete="one-time-code"
                                maxlength="6"
                                pattern="[0-9]{6}"
                                required
                                autofocus
                                class="w-full
                                       rounded-xl
                                       border
                                       border-slate-200
                                       bg-white
                                       px-4
                                       py-3
                                       text-center
                                       text-xl
                                       font-bold
                                       tracking-[0.5em]
                                       text-slate-900
                                       outline-none
                                       transition
                                       focus:border-blue-500
                                       focus:ring-2
                                       focus:ring-blue-500/20
                                       dark:border-white/10
                                       dark:bg-white/[0.04]
                                       dark:text-white"
                                placeholder="000000"
                            >

                            @error('one_time_password')

                                <p class="mt-2 text-center text-xs font-medium text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </p>

                            @enderror


                            <button
                                type="submit"
                                class="mt-4
                                       inline-flex
                                       w-full
                                       items-center
                                       justify-center
                                       gap-2
                                       rounded-xl
                                       bg-gradient-to-r
                                       from-blue-600
                                       to-cyan-500
                                       px-6
                                       py-3
                                       text-sm
                                       font-bold
                                       text-white
                                       shadow-lg
                                       shadow-blue-500/20
                                       transition
                                       hover:-translate-y-0.5
                                       hover:shadow-blue-500/30
                                       focus:outline-none
                                       focus:ring-2
                                       focus:ring-blue-500/30"
                            >
                                Verify & Enable 2FA
                            </button>

                        </form>

                    </div>

                </div>


            {{-- ================================================= --}}
            {{-- DISABLED --}}
            {{-- ================================================= --}}

            @else

                <div
                    class="mt-7
                           flex
                           flex-col
                           gap-5
                           rounded-2xl
                           border
                           border-slate-200
                           bg-slate-50
                           p-6
                           dark:border-white/10
                           dark:bg-white/[0.025]
                           sm:flex-row
                           sm:items-center
                           sm:justify-between"
                >

                    <div class="max-w-xl">

                        <h3 class="text-sm font-bold text-slate-900 dark:text-white">
                            Protect your account with 2FA
                        </h3>

                        <p class="mt-1 text-sm leading-6 text-slate-500 dark:text-gray-400">
                            Use an authenticator app to generate a unique
                            verification code when additional account security
                            is required.
                        </p>

                    </div>


                    <form
                        method="POST"
                        action="{{ route('settings.security.2fa.enable') }}"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="inline-flex
                                   w-full
                                   items-center
                                   justify-center
                                   gap-2
                                   rounded-xl
                                   bg-gradient-to-r
                                   from-blue-600
                                   to-cyan-500
                                   px-5
                                   py-3
                                   text-sm
                                   font-bold
                                   text-white
                                   shadow-lg
                                   shadow-blue-500/20
                                   transition
                                   hover:-translate-y-0.5
                                   hover:shadow-blue-500/30
                                   sm:w-auto"
                        >
                            Enable 2FA
                        </button>

                    </form>

                </div>

            @endif

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- RECOVERY CODES --}}
    {{-- ========================================================= --}}

    @if($recoveryCodes)

        <div
            class="overflow-hidden
                   rounded-2xl
                   border
                   border-amber-200
                   bg-amber-50
                   dark:border-amber-500/20
                   dark:bg-amber-500/[0.05]"
        >

            <div class="p-6">

                <div class="flex items-start gap-3">

                    <div class="min-w-0 flex-1">

                        <h3 class="text-sm font-bold text-amber-800 dark:text-amber-300">
                            Save your recovery codes
                        </h3>

                        <p class="mt-1 text-xs leading-5 text-amber-700/80 dark:text-amber-200/60">
                            Each recovery code can be used if you lose access to your
                            authenticator app. Store these codes somewhere safe.
                        </p>


                        <div
                            class="mt-4
                                   grid
                                   grid-cols-1
                                   gap-2
                                   sm:grid-cols-2"
                        >

                            @foreach($recoveryCodes as $code)

                                <div
                                    class="select-all
                                           rounded-lg
                                           border
                                           border-amber-200
                                           bg-white
                                           px-4
                                           py-2.5
                                           text-center
                                           font-mono
                                           text-sm
                                           font-bold
                                           tracking-wider
                                           text-slate-700
                                           dark:border-amber-500/10
                                           dark:bg-white/[0.04]
                                           dark:text-gray-300"
                                >
                                    {{ $code }}
                                </div>

                            @endforeach

                        </div>


                        <p class="mt-4 text-[11px] font-medium text-amber-700/70 dark:text-amber-200/50">
                            These codes are displayed only once. Save them before leaving this page.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    @endif


    {{-- ========================================================= --}}
    {{-- SECURITY INFORMATION --}}
    {{-- ========================================================= --}}

    <div
        class="rounded-2xl
               border
               border-slate-200
               bg-white
               p-6
               shadow-sm
               dark:border-white/10
               dark:bg-white/[0.02]"
    >

        <div class="flex items-start gap-3">

            <div>

                <p class="text-sm font-semibold text-slate-700 dark:text-gray-300">
                    Your biometric information stays on your device
                </p>

                <p class="mt-2 text-sm leading-6 text-slate-500 dark:text-gray-500">
                    Electo does not receive or store your fingerprint or Face ID.
                    Your device performs the authentication and sends only a
                    secure cryptographic response to Electo.
                </p>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- STATUS --}}
    {{-- ========================================================= --}}

    <div
        id="passkey-status"
        class="hidden rounded-2xl border p-5"
    >

        <p
            id="passkey-status-text"
            class="text-sm font-medium"
        ></p>

    </div>

</div>


{{-- ============================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ============================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', () => {

    /*
    |--------------------------------------------------------------------------
    | Passkey Elements
    |--------------------------------------------------------------------------
    */

    const registerButton =
        document.getElementById('register-passkey');

    const status =
        document.getElementById('passkey-status');

    const statusText =
        document.getElementById('passkey-status-text');


    /*
    |--------------------------------------------------------------------------
    | Status Helper
    |--------------------------------------------------------------------------
    */

    function showStatus(message, type = 'success')
    {
        if (!status || !statusText) {
            return;
        }

        status.classList.remove(
            'hidden',
            'border-emerald-500/20',
            'bg-emerald-500/10',
            'border-red-500/20',
            'bg-red-500/10'
        );

        statusText.classList.remove(
            'text-emerald-300',
            'text-red-300'
        );


        if (type === 'success') {

            status.classList.add(
                'border-emerald-500/20',
                'bg-emerald-500/10'
            );

            statusText.classList.add(
                'text-emerald-300'
            );

        } else {

            status.classList.add(
                'border-red-500/20',
                'bg-red-500/10'
            );

            statusText.classList.add(
                'text-red-300'
            );
        }


        statusText.textContent = message;
    }


    /*
    |--------------------------------------------------------------------------
    | Register Passkey
    |--------------------------------------------------------------------------
    */

    if (registerButton) {

        registerButton.addEventListener('click', async () => {

            registerButton.disabled = true;

            registerButton.textContent = 'Waiting...';


            try {

                if (!window.Passkeys) {

                    throw new Error(
                        'The Passkeys library is not available.'
                    );

                }


                await window.Passkeys.register({
                    name: 'Electo Device'
                });


                showStatus(
                    'This device has been successfully registered as a trusted passkey.'
                );


                setTimeout(() => {

                    window.location.reload();

                }, 1200);


            } catch (error) {

                console.error(error);

                registerButton.disabled = false;

                registerButton.textContent = 'Register Device';


                showStatus(
                    error?.message ||
                    'Device registration could not be completed.',
                    'error'
                );

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Remove Passkey
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll('.remove-passkey')
        .forEach(button => {

            button.addEventListener('click', async () => {

                const passkeyId =
                    button.dataset.passkeyId;

                const passkeyName =
                    button.dataset.passkeyName;


                const confirmed =
                    confirm(
                        `Remove "${passkeyName}" from your trusted devices?`
                    );


                if (!confirmed) {
                    return;
                }


                button.disabled = true;


                try {

                    const response = await fetch(
                        `/user/passkeys/${passkeyId}`,
                        {
                            method: 'DELETE',

                            headers: {
                                'X-CSRF-TOKEN':
                                    document
                                        .querySelector(
                                            'meta[name="csrf-token"]'
                                        )
                                        ?.getAttribute('content'),

                                'Accept':
                                    'application/json',
                            },
                        }
                    );


                    if (!response.ok) {

                        throw new Error(
                            'Unable to remove this device.'
                        );

                    }


                    showStatus(
                        'The device has been removed successfully.'
                    );


                    setTimeout(() => {

                        window.location.reload();

                    }, 800);


                } catch (error) {

                    console.error(error);

                    button.disabled = false;


                    showStatus(
                        error?.message ||
                        'Unable to remove this device.',
                        'error'
                    );

                }

            });

        });

});


/*
|--------------------------------------------------------------------------
| Security Password Prompt
|--------------------------------------------------------------------------
*/

function submitSecurityPassword(form, message)
{
    const password = prompt(message);

    if (!password) {
        return false;
    }


    const input =
        form.querySelector(
            'input[name="current_password"]'
        );


    if (!input) {
        return false;
    }


    input.value = password;

    return true;
}


/*
|--------------------------------------------------------------------------
| Disable 2FA
|--------------------------------------------------------------------------
*/

function submitDisable2FA(form)
{
    const confirmed = confirm(
        'Are you sure you want to disable two-factor authentication on your Electo account?'
    );


    if (!confirmed) {
        return false;
    }


    const password = prompt(
        'Enter your current Electo account password to disable 2FA:'
    );


    if (!password) {
        return false;
    }


    const input =
        form.querySelector(
            'input[name="current_password"]'
        );


    if (!input) {
        return false;
    }


    input.value = password;

    return true;
}

</script>

