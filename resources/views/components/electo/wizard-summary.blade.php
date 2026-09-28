<div
    class="
        overflow-hidden
        rounded-3xl
        border border-slate-200
        bg-white
        shadow-[0_12px_40px_rgba(15,23,42,0.07)]

        dark:border-white/10
        dark:bg-[#0B1730]
        dark:shadow-[0_20px_60px_rgba(0,0,0,0.25)]
    "
>

    {{-- ===================================================== --}}
    {{-- HEADER --}}
    {{-- ===================================================== --}}

    <div
        class="
            relative
            overflow-hidden
            border-b border-slate-100
            bg-gradient-to-br
            from-blue-50
            via-white
            to-cyan-50
            px-5 py-5

            dark:border-white/10
            dark:from-blue-500/10
            dark:via-[#10203D]
            dark:to-cyan-500/10
        "
    >

        {{-- Decorative glow --}}

        <div
            class="
                pointer-events-none
                absolute
                -right-10
                -top-10
                h-28
                w-28
                rounded-full
                bg-blue-500/10
                blur-2xl

                dark:bg-blue-400/10
            "
        ></div>


        <div
            class="
                relative
                flex
                items-center
                gap-3
            "
        >

            {{-- Icon --}}

            <div
                class="
                    flex
                    h-11
                    w-11
                    shrink-0
                    items-center
                    justify-center
                    rounded-2xl
                    bg-gradient-to-br
                    from-blue-600
                    to-cyan-500
                    text-white
                    shadow-lg
                    shadow-blue-500/20
                "
            >

                <x-heroicon-o-clipboard-document-list
                    class="h-5 w-5"
                />

            </div>


            {{-- Title --}}

            <div class="min-w-0">

                <h3
                    class="
                        text-lg
                        font-extrabold
                        tracking-tight
                        text-slate-900

                        dark:text-white
                    "
                >
                    Election Summary
                </h3>

                <p
                    class="
                        mt-0.5
                        text-xs
                        text-slate-500

                        dark:text-slate-400
                    "
                >
                    Live preview
                </p>

            </div>

        </div>

    </div>


    {{-- ===================================================== --}}
    {{-- PROGRESS --}}
    {{-- ===================================================== --}}

    <div class="px-5 pt-5">

        <div
            class="
                flex
                items-center
                justify-between
            "
        >

            <span
                class="
                    text-[10px]
                    font-bold
                    uppercase
                    tracking-[0.14em]
                    text-slate-400

                    dark:text-slate-500
                "
            >
                Progress
            </span>

            <span
                class="
                    text-xs
                    font-bold
                    text-blue-600

                    dark:text-blue-400
                "
                x-text="progress + '%'"
            >
                25%
            </span>

        </div>


        <div
            class="
                mt-3
                h-2
                overflow-hidden
                rounded-full
                bg-slate-100

                dark:bg-white/10
            "
        >

            <div
                class="
                    h-full
                    rounded-full
                    bg-gradient-to-r
                    from-blue-600
                    to-cyan-400
                    shadow-sm
                    shadow-blue-500/20
                    transition-all
                    duration-500
                "
                :style="'width:' + progress + '%'"
            ></div>

        </div>

    </div>


    {{-- ===================================================== --}}
    {{-- SUMMARY CONTENT --}}
    {{-- ===================================================== --}}

    <div class="space-y-4 px-5 py-5">


        {{-- ================================================= --}}
        {{-- STATUS --}}
        {{-- ================================================= --}}

        <div
            class="
                rounded-2xl
                border border-emerald-100
                bg-emerald-50
                p-3.5

                dark:border-emerald-400/20
                dark:bg-emerald-500/10
            "
        >

            <div
                class="
                    flex
                    items-center
                    justify-between
                "
            >

                <div class="flex items-center gap-3">

                    <div
                        class="
                            flex
                            h-9
                            w-9
                            shrink-0
                            items-center
                            justify-center
                            rounded-xl
                            bg-white
                            text-emerald-600
                            shadow-sm

                            dark:bg-emerald-400/10
                            dark:text-emerald-400
                        "
                    >

                        <x-heroicon-o-sparkles
                            class="h-4 w-4"
                        />

                    </div>


                    <div>

                        <p
                            class="
                                text-[10px]
                                font-bold
                                uppercase
                                tracking-wider
                                text-emerald-600

                                dark:text-emerald-400
                            "
                        >
                            Status
                        </p>

                        <p
                            class="
                                mt-0.5
                                text-sm
                                font-bold
                                text-emerald-800

                                dark:text-emerald-300
                            "
                        >
                            Draft
                        </p>

                    </div>

                </div>


                <span
                    class="
                        h-2.5
                        w-2.5
                        shrink-0
                        rounded-full
                        bg-emerald-500
                        shadow-sm
                        shadow-emerald-500/40
                    "
                ></span>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- ELECTION TYPE --}}
        {{-- ================================================= --}}

        <div>

            <p
                class="
                    text-[10px]
                    font-bold
                    uppercase
                    tracking-[0.14em]
                    text-slate-400

                    dark:text-slate-500
                "
            >
                Election Type
            </p>


            <div
                class="
                    mt-2
                    flex
                    min-w-0
                    items-center
                    gap-3
                    rounded-2xl
                    border border-slate-200
                    bg-slate-50
                    p-3

                    dark:border-white/10
                    dark:bg-white/[0.04]
                "
            >

                <div
                    class="
                        flex
                        h-9
                        w-9
                        shrink-0
                        items-center
                        justify-center
                        rounded-xl
                        bg-blue-50
                        text-blue-600

                        dark:bg-blue-500/10
                        dark:text-blue-400
                    "
                >

                    <x-heroicon-o-document-check
                        class="h-4 w-4"
                    />

                </div>


                <p
                    class="
                        min-w-0
                        truncate
                        text-sm
                        font-semibold
                        text-slate-700

                        dark:text-slate-200
                    "
                    x-text="selectedTypeName || 'Not selected'"
                >
                    Not selected
                </p>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- ORGANIZATION --}}
        {{-- ================================================= --}}

        <div>

            <p
                class="
                    text-[10px]
                    font-bold
                    uppercase
                    tracking-[0.14em]
                    text-slate-400

                    dark:text-slate-500
                "
            >
                Organization
            </p>


            <div
                class="
                    mt-2
                    flex
                    min-w-0
                    items-center
                    gap-3
                    rounded-2xl
                    border border-slate-200
                    bg-slate-50
                    p-3

                    dark:border-white/10
                    dark:bg-white/[0.04]
                "
            >

                <div
                    class="
                        flex
                        h-9
                        w-9
                        shrink-0
                        items-center
                        justify-center
                        rounded-xl
                        bg-indigo-50
                        text-indigo-600

                        dark:bg-indigo-500/10
                        dark:text-indigo-400
                    "
                >

                    <x-heroicon-o-building-office-2
                        class="h-4 w-4"
                    />

                </div>


                <p
                    class="
                        min-w-0
                        truncate
                        text-sm
                        font-semibold
                        text-slate-700

                        dark:text-slate-200
                    "
                    x-text="selectedOrganization || 'Not selected'"
                >
                    Not selected
                </p>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- ELECTION TITLE --}}
        {{-- ================================================= --}}

        <div>

            <p
                class="
                    text-[10px]
                    font-bold
                    uppercase
                    tracking-[0.14em]
                    text-slate-400

                    dark:text-slate-500
                "
            >
                Election Title
            </p>


            <div
                class="
                    mt-2
                    rounded-2xl
                    border border-slate-200
                    bg-slate-50
                    px-3.5
                    py-3

                    dark:border-white/10
                    dark:bg-white/[0.04]
                "
            >

                <p
                    class="
                        truncate
                        text-sm
                        font-semibold
                        text-slate-600

                        dark:text-slate-300
                    "
                    x-text="electionTitle || 'Not provided'"
                >
                    Not provided
                </p>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- VISIBILITY --}}
        {{-- ================================================= --}}

        <div>

            <p
                class="
                    text-[10px]
                    font-bold
                    uppercase
                    tracking-[0.14em]
                    text-slate-400

                    dark:text-slate-500
                "
            >
                Visibility
            </p>


            <div
                class="
                    mt-2
                    flex
                    min-w-0
                    items-center
                    gap-3
                    rounded-2xl
                    border border-slate-200
                    bg-slate-50
                    p-3

                    dark:border-white/10
                    dark:bg-white/[0.04]
                "
            >

                <div
                    class="
                        flex
                        h-9
                        w-9
                        shrink-0
                        items-center
                        justify-center
                        rounded-xl
                        bg-violet-50
                        text-violet-600

                        dark:bg-violet-500/10
                        dark:text-violet-400
                    "
                >

                    <x-heroicon-o-eye
                        class="h-4 w-4"
                    />

                </div>


                <p
                    class="
                        min-w-0
                        truncate
                        text-sm
                        font-semibold
                        text-slate-600

                        dark:text-slate-300
                    "
                    x-text="visibility || 'Not selected'"
                >
                    Not selected
                </p>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- POSITIONS --}}
        {{-- ================================================= --}}

        <div>

            <div
                class="
                    flex
                    items-center
                    justify-between
                    gap-3
                "
            >

                <p
                    class="
                        text-[10px]
                        font-bold
                        uppercase
                        tracking-[0.14em]
                        text-slate-400

                        dark:text-slate-500
                    "
                >
                    Positions
                </p>


                <span
                    class="
                        shrink-0
                        rounded-full
                        bg-slate-100
                        px-2.5
                        py-1
                        text-[11px]
                        font-bold
                        text-slate-500

                        dark:bg-white/10
                        dark:text-slate-400
                    "
                    x-text="positionCount + ' Selected'"
                >
                    0 Selected
                </span>

            </div>

        </div>

    </div>


    {{-- ===================================================== --}}
    {{-- FOOTER --}}
    {{-- ===================================================== --}}

    <div
        class="
            border-t
            border-slate-100
            bg-slate-50/70
            px-5
            py-4

            dark:border-white/10
            dark:bg-white/[0.02]
        "
    >

        <div
            class="
                flex
                items-start
                gap-3
            "
        >

            <div
                class="
                    mt-0.5
                    flex
                    h-7
                    w-7
                    shrink-0
                    items-center
                    justify-center
                    rounded-lg
                    bg-blue-50
                    text-blue-600

                    dark:bg-blue-500/10
                    dark:text-blue-400
                "
            >

                <x-heroicon-o-shield-check
                    class="h-4 w-4"
                />

            </div>


            <p
                class="
                    text-[11px]
                    leading-5
                    text-slate-500

                    dark:text-slate-400
                "
            >
                Your election configuration is saved securely while you complete the setup.
            </p>

        </div>

    </div>

</div>