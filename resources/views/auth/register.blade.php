<x-guest-layout>

    <!-- Header -->

    <x-electo.auth.header
        title="Create your free account"
        subtitle="Start building secure elections in less than 2 minutes."
    />

    <form
        method="POST"
        action="{{ route('register') }}"
        class="space-y-6"
    >

        @csrf

        <!-- Full Name -->

        <x-electo.ui.input
            label="Full Name"
            name="name"
            icon="user"
            placeholder="Enter your full name"
            required
        />

        <!-- Email -->

        <x-electo.ui.input
            label="Email Address"
            name="email"
            type="email"
            icon="envelope"
            placeholder="you@example.com"
            required
        />

        <!-- Password -->

        <x-electo.ui.input
            label="Password"
            name="password"
            type="password"
            icon="lock-closed"
            placeholder="Create a strong password"
            required
        />

        <!-- Confirm Password -->

        <x-electo.ui.input
            label="Confirm Password"
            name="password_confirmation"
            type="password"
            icon="shield-check"
            placeholder="Confirm your password"
            required
        />

        <!-- Terms -->

        <div class="flex items-start gap-3">

            <input
                id="terms"
                type="checkbox"
                required
                class="mt-1 h-5 w-5 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500"
            >

            <label
                for="terms"
                class="text-sm leading-6 text-slate-600"
            >

                I agree to the

                <a
                    href="#"
                    class="font-semibold text-indigo-600 hover:underline"
                >
                    Terms of Service
                </a>

                and

                <a
                    href="#"
                    class="font-semibold text-indigo-600 hover:underline"
                >
                    Privacy Policy
                </a>

            </label>

        </div>

        <!-- Register Button -->

        <x-electo.ui.button
            type="submit"
            variant="primary"
            size="lg"
            class="w-full justify-center"
        >

            Create Free Account

        </x-electo.ui.button>

    </form>

    <x-electo.ui.divider
        label="Already have an account?"
    />

    <a
        href="{{ route('login') }}"
        class="flex items-center justify-center rounded-2xl border border-slate-300 py-4 font-semibold text-slate-700 transition hover:bg-slate-100"
    >

        Sign In

    </a>

</x-guest-layout>