<div class="w-full space-y-2">

    {{-- ===================================================== --}}
    {{-- STEP 1 — ACTIVE --}}
    {{-- ===================================================== --}}

    <div
        class="
            relative
            flex w-full items-center gap-3
            rounded-2xl
            border border-blue-200
            bg-gradient-to-br from-blue-50 via-white to-cyan-50
            px-3 py-3.5
            shadow-sm
            shadow-blue-500/5

            dark:border-blue-400/20
            dark:bg-gradient-to-br
            dark:from-blue-500/10
            dark:via-white/[0.03]
            dark:to-cyan-500/10
        "
    >

        {{-- Active accent --}}
        <div
            class="
                absolute
                left-0
                top-3
                bottom-3
                w-1
                rounded-r-full
                bg-gradient-to-b
                from-blue-600
                to-cyan-400

                dark:from-blue-400
                dark:to-cyan-400
            "
        ></div>

        <div
            class="
                flex h-10 w-10 shrink-0
                items-center justify-center
                rounded-xl
                bg-gradient-to-br
                from-blue-600
                to-cyan-500
                text-sm font-bold
                text-white
                shadow-lg
                shadow-blue-500/20
            "
        >
            1
        </div>

        <div class="min-w-0 flex-1">

            <p
                class="
                    text-sm
                    font-bold
                    leading-5
                    text-blue-700

                    dark:text-blue-300
                "
            >
                Election Type
            </p>

            <p
                class="
                    mt-0.5
                    text-[11px]
                    leading-4
                    text-blue-500

                    dark:text-blue-400
                "
            >
                Choose a format
            </p>

        </div>

        <span
            class="
                h-2
                w-2
                shrink-0
                rounded-full
                bg-blue-600
                shadow-sm
                shadow-blue-500/50

                dark:bg-cyan-400
            "
        ></span>

    </div>


    {{-- ===================================================== --}}
    {{-- STEP 2 --}}
    {{-- ===================================================== --}}

    <div
        class="
            group
            flex w-full items-center gap-3
            rounded-2xl
            border border-transparent
            px-3 py-3.5
            transition-all duration-200

            hover:border-slate-200
            hover:bg-slate-50

            dark:hover:border-white/10
            dark:hover:bg-white/[0.03]
        "
    >

        <div
            class="
                flex h-10 w-10 shrink-0
                items-center justify-center
                rounded-xl
                border border-slate-200
                bg-slate-50
                text-sm font-bold
                text-slate-400
                transition

                group-hover:border-blue-200
                group-hover:text-blue-500

                dark:border-white/10
                dark:bg-white/[0.04]
                dark:text-slate-500
                dark:group-hover:border-blue-400/20
                dark:group-hover:text-blue-400
            "
        >
            2
        </div>

        <div class="min-w-0 flex-1">

            <p
                class="
                    text-sm
                    font-semibold
                    leading-5
                    text-slate-600

                    dark:text-slate-300
                "
            >
                Details
            </p>

            <p
                class="
                    mt-0.5
                    text-[11px]
                    leading-4
                    text-slate-400

                    dark:text-slate-500
                "
            >
                Basic information
            </p>

        </div>

    </div>


    {{-- ===================================================== --}}
    {{-- STEP 3 --}}
    {{-- ===================================================== --}}

    <div
        class="
            group
            flex w-full items-center gap-3
            rounded-2xl
            border border-transparent
            px-3 py-3.5
            transition-all duration-200

            hover:border-slate-200
            hover:bg-slate-50

            dark:hover:border-white/10
            dark:hover:bg-white/[0.03]
        "
    >

        <div
            class="
                flex h-10 w-10 shrink-0
                items-center justify-center
                rounded-xl
                border border-slate-200
                bg-slate-50
                text-sm font-bold
                text-slate-400
                transition

                group-hover:border-blue-200
                group-hover:text-blue-500

                dark:border-white/10
                dark:bg-white/[0.04]
                dark:text-slate-500
                dark:group-hover:border-blue-400/20
                dark:group-hover:text-blue-400
            "
        >
            3
        </div>

        <div class="min-w-0 flex-1">

            <p
                class="
                    text-sm
                    font-semibold
                    leading-5
                    text-slate-600

                    dark:text-slate-300
                "
            >
                Schedule
            </p>

            <p
                class="
                    mt-0.5
                    text-[11px]
                    leading-4
                    text-slate-400

                    dark:text-slate-500
                "
            >
                Date and time
            </p>

        </div>

    </div>


    {{-- ===================================================== --}}
    {{-- STEP 4 --}}
    {{-- ===================================================== --}}

    <div
        class="
            group
            flex w-full items-center gap-3
            rounded-2xl
            border border-transparent
            px-3 py-3.5
            transition-all duration-200

            hover:border-slate-200
            hover:bg-slate-50

            dark:hover:border-white/10
            dark:hover:bg-white/[0.03]
        "
    >

        <div
            class="
                flex h-10 w-10 shrink-0
                items-center justify-center
                rounded-xl
                border border-slate-200
                bg-slate-50
                text-sm font-bold
                text-slate-400
                transition

                group-hover:border-blue-200
                group-hover:text-blue-500

                dark:border-white/10
                dark:bg-white/[0.04]
                dark:text-slate-500
                dark:group-hover:border-blue-400/20
                dark:group-hover:text-blue-400
            "
        >
            4
        </div>

        <div class="min-w-0 flex-1">

            <p
                class="
                    text-sm
                    font-semibold
                    leading-5
                    text-slate-600

                    dark:text-slate-300
                "
            >
                Positions
            </p>

            <p
                class="
                    mt-0.5
                    text-[11px]
                    leading-4
                    text-slate-400

                    dark:text-slate-500
                "
            >
                Voting positions
            </p>

        </div>

    </div>


    {{-- ===================================================== --}}
    {{-- SETUP PROGRESS --}}
    {{-- ===================================================== --}}

    <div
        class="
            mt-4
            w-full
            rounded-2xl
            border border-slate-200
            bg-slate-50
            p-4
            shadow-sm

            dark:border-white/10
            dark:bg-white/[0.03]
            dark:shadow-none
        "
    >

        <div
            class="
                flex
                items-center
                justify-between
                gap-3
            "
        >

            <span
                class="
                    text-[11px]
                    font-bold
                    uppercase
                    tracking-wide
                    text-slate-500

                    dark:text-slate-400
                "
            >
                Setup progress
            </span>

            <span
                class="
                    shrink-0
                    rounded-full
                    bg-blue-50
                    px-2
                    py-1
                    text-[11px]
                    font-bold
                    text-blue-600

                    dark:bg-blue-500/10
                    dark:text-blue-400
                "
            >
                25%
            </span>

        </div>


        {{-- Progress bar --}}

        <div
            class="
                mt-3
                h-2
                overflow-hidden
                rounded-full
                bg-slate-200

                dark:bg-white/10
            "
        >

            <div
                class="
                    h-full
                    w-1/4
                    rounded-full
                    bg-gradient-to-r
                    from-blue-600
                    via-blue-500
                    to-cyan-400
                    shadow-sm
                    shadow-blue-500/20
                "
            ></div>

        </div>


        <p
            class="
                mt-2.5
                text-[11px]
                leading-5
                text-slate-400

                dark:text-slate-500
            "
        >
            Complete each step to publish your election.
        </p>

    </div>

</div>