<section class="relative overflow-hidden">

    <div class="container-electo mx-auto flex min-h-screen items-center">

        <div class="grid w-full items-center gap-16 lg:grid-cols-2">

            <!-- LEFT SIDE -->

            <div>

                <span
                    class="inline-flex items-center rounded-full border border-blue-500/20 bg-blue-500/10 px-4 py-2 text-sm text-blue-300">

                    🚀 Next Generation Election Platform

                </span>

                <h1 class="hero-title mt-8">

                    Secure

                    <span class="gradient-text">

                        Digital

                    </span>

                    Elections.

                </h1>

                <p class="lead mt-8">

                    Electo enables governments,
                    universities,
                    organizations,
                    churches,
                    NGOs,
                    associations,
                    companies and institutions to conduct
                    secure,
                    transparent
                    and trustworthy elections from anywhere
                    in the world.

                </p>

                <div class="mt-10 flex flex-wrap gap-5">

                    <a href="{{ route('register') }}"
                       class="btn-primary">

                        Create Organization

                    </a>

                    <a href="{{ route('login') }}"
                       class="btn-secondary">

                        Join Election

                    </a>

                </div>

            </div>

            <!-- RIGHT SIDE -->

            <div class="glass-card">

                <div
                    class="rounded-3xl bg-gradient-to-br from-blue-600 to-purple-600 p-10 text-center shadow-electo">

                    @include('electo.components.logo.logo')

                    <p class="mt-6 text-blue-100">

                        Secure. Transparent. Trusted.

                    </p>

                </div>

                <div class="mt-6 grid grid-cols-2 gap-5">

                    <div class="card text-center">

                        <h3 class="text-4xl font-bold text-blue-400">

                            99.99%

                        </h3>

                        <p class="mt-2 text-slate-400">

                            Election Integrity

                        </p>

                    </div>

                    <div class="card text-center">

                        <h3 class="text-4xl font-bold text-purple-400">

                            500K+

                        </h3>

                        <p class="mt-2 text-slate-400">

                            Votes Cast

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>