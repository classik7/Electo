<nav class="fixed top-0 left-0 right-0 z-50">

    <div class="container-electo pt-6">

        <div class="glass-nav rounded-3xl px-6 py-4">

            <div class="flex items-center justify-between">

                <!-- Logo -->

                <a href="/">
    @include('electo.components.logo.logo')
</a>
                <!-- Menu -->

                <div class="hidden lg:flex items-center gap-8">

                    <a href="#" class="text-slate-300 hover:text-white transition">

                        Features

                    </a>

                    <a href="#" class="text-slate-300 hover:text-white transition">

                        Security

                    </a>

                    <a href="#" class="text-slate-300 hover:text-white transition">

                        Solutions

                    </a>

                    <a href="#" class="text-slate-300 hover:text-white transition">

                        Pricing

                    </a>

                    <a href="#" class="text-slate-300 hover:text-white transition">

                        Contact

                    </a>

                </div>

                <!-- Buttons -->

                <div class="flex items-center gap-4">

                    <a href="{{ route('login') }}"

                        class="btn-secondary">

                        Sign In

                    </a>

                    <a href="{{ route('register') }}"

                        class="btn-primary">

                        Create Organization

                    </a>

                </div>

            </div>

        </div>

    </div>

</nav>