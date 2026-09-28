<section
    class="electo-landing-bg relative overflow-hidden pb-24 pt-32 sm:pt-36 lg:pb-32 lg:pt-40"
>

    {{-- Background Glow --}}
    <div
        class="pointer-events-none absolute left-[5%] top-[15%] h-80 w-80 rounded-full bg-blue-500/10 blur-3xl dark:bg-blue-500/15">
    </div>

    <div
        class="pointer-events-none absolute right-[5%] top-[20%] h-96 w-96 rounded-full bg-cyan-400/10 blur-3xl dark:bg-cyan-400/10">
    </div>

    <div
        class="pointer-events-none absolute bottom-[5%] left-[40%] h-96 w-96 rounded-full bg-indigo-500/10 blur-3xl">
    </div>


    <div class="landing-container relative">

        <div
            class="grid items-center gap-16 lg:grid-cols-[minmax(0,1fr)_minmax(0,1.08fr)] lg:gap-12 xl:gap-16"
        >

            {{-- ================================================= --}}
            {{-- LEFT --}}
            {{-- ================================================= --}}

            <div class="order-2 min-w-0 lg:order-1">

                @include('electo.components.hero.hero-left')

            </div>


            {{-- ================================================= --}}
            {{-- RIGHT --}}
            {{-- ================================================= --}}

            <div
                class="order-1 min-w-0 lg:order-2"
            >

                <div
                    class="landing-dashboard w-full"
                >

                    @include('electo.components.dashboard-preview.index')

                </div>

            </div>

        </div>

    </div>

</section>