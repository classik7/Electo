<div class="flex h-full flex-col justify-center py-8">

    {{-- Logo --}}
    <x-electo.auth.logo />

    {{-- Trust badges --}}
    <div class="mt-6">
        <x-electo.auth.trust-badges />
    </div>

    {{-- Hero --}}
    <div class="mt-8 max-w-2xl">

        <span
            class="inline-flex items-center rounded-full
            border border-cyan-400/30
            bg-cyan-500/10
            px-4 py-2
            text-xs font-semibold uppercase tracking-[0.2em]
            text-cyan-300">

            Enterprise Election Platform

        </span>

        <h1
            class="mt-6 text-5xl font-black leading-tight tracking-tight text-white">

            Secure

            <span
                class="bg-gradient-to-r
                from-cyan-300
                via-blue-300
                to-indigo-400
                bg-clip-text
                text-transparent">

                Digital Elections

            </span>

            for Modern

            Organizations.

        </h1>

        <p
            class="mt-5 max-w-xl text-base leading-8 text-slate-300">

            Electo helps universities, schools, governments,
            companies, churches and associations conduct secure,
            transparent and verifiable elections with enterprise-grade
            infrastructure.

        </p>

    </div>

    {{-- Feature chips --}}
    <div class="mt-8 grid grid-cols-2 gap-3 max-w-xl">

        <div
            class="flex items-center gap-3 rounded-xl
            border border-white/10
            bg-white/5
            px-4 py-3">

            <span class="text-cyan-300">🔒</span>

            <div>

                <p class="text-sm font-semibold text-white">

                    End-to-End Encryption

                </p>

                <p class="text-xs text-slate-400">

                    Military-grade security

                </p>

            </div>

        </div>

        <div
            class="flex items-center gap-3 rounded-xl
            border border-white/10
            bg-white/5
            px-4 py-3">

            <span class="text-indigo-300">⚡</span>

            <div>

                <p class="text-sm font-semibold text-white">

                    Live Results

                </p>

                <p class="text-xs text-slate-400">

                    Real-time counting

                </p>

            </div>

        </div>

        <div
            class="flex items-center gap-3 rounded-xl
            border border-white/10
            bg-white/5
            px-4 py-3">

            <span class="text-emerald-300">📊</span>

            <div>

                <p class="text-sm font-semibold text-white">

                    Analytics

                </p>

                <p class="text-xs text-slate-400">

                    Smart reporting

                </p>

            </div>

        </div>

        <div
            class="flex items-center gap-3 rounded-xl
            border border-white/10
            bg-white/5
            px-4 py-3">

            <span class="text-amber-300">☁️</span>

            <div>

                <p class="text-sm font-semibold text-white">

                    Cloud Hosted

                </p>

                <p class="text-xs text-slate-400">

                    Available anywhere

                </p>

            </div>

        </div>

    </div>

    {{-- Dashboard --}}
    <div class="mt-8">

        <x-electo.auth.dashboard-preview />

    </div>

</div>