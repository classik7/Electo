<section
    id="live-elections"
    class="relative overflow-hidden py-28">

    <!-- Background Glow -->

    <div
        class="absolute left-1/2 top-0 h-[450px] w-[450px] -translate-x-1/2 rounded-full bg-cyan-500/10 blur-[150px]">
    </div>

    <div class="relative container-electo">

        <!-- Small Badge -->

        <div class="flex justify-center">

            <span
                class="inline-flex items-center gap-2 rounded-full border border-cyan-400/20 bg-cyan-500/10 px-5 py-2 text-sm font-semibold text-cyan-300">

                LIVE ELECTIONS

            </span>

        </div>

        <!-- Heading -->

        <div
            class="mx-auto mt-8 max-w-4xl text-center">

            <h2
                class="text-4xl font-black text-white lg:text-6xl">

                Elections Running Across

                <span class="gradient-text">

                    Every Organization

                </span>

            </h2>

            <p
                class="mx-auto mt-6 max-w-3xl text-lg leading-8 text-slate-400">

                Whether you're managing a university election,
                church leadership, company board,
                NGO or government institution,

                Electo delivers secure,
                transparent and verifiable digital elections.

            </p>

        </div>

        <!-- Cards -->

        <div
            class="mt-20 grid gap-8 xl:grid-cols-3">

            @include('electo.components.live-election.university-card')

            @include('electo.components.live-election.church-card')

            @include('electo.components.live-election.company-card')

        </div>
<!-- Trust Bar -->

<div
    class="mt-16 rounded-[28px] border border-white/10 bg-white/5 p-8 backdrop-blur-xl">

    <div
        class="grid gap-8 text-center md:grid-cols-4">

        <div>

            <h3
                class="text-4xl font-black text-cyan-300">

                120+

            </h3>

            <p
                class="mt-2 text-slate-400">

                Organizations

            </p>

        </div>

        <div>

            <h3
                class="text-4xl font-black text-white">

                48K+

            </h3>

            <p
                class="mt-2 text-slate-400">

                Verified Voters

            </p>

        </div>

        <div>

            <h3
                class="text-4xl font-black text-emerald-300">

                99.99%

            </h3>

            <p
                class="mt-2 text-slate-400">

                Election Integrity

            </p>

        </div>

        <div>

            <h3
                class="text-4xl font-black text-violet-300">

                24/7

            </h3>

            <p
                class="mt-2 text-slate-400">

                Cloud Availability

            </p>

        </div>

    </div>

</div>
    </div>

</section>