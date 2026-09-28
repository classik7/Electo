@extends('electo.layouts.dashboard')

@section('title', 'Candidates')
@section('page-title', 'Candidates')

@section('content')

<div class="space-y-8">

    {{-- ========================================================= --}}
    {{-- HERO --}}
    {{-- ========================================================= --}}

    <div
        class="
            relative overflow-hidden
            rounded-[2rem]
            border border-slate-200
            bg-white
            p-7
            shadow-sm
            md:p-9

            dark:border-white/10
            dark:bg-[#101D35]
        "
    >

        {{-- Decorative background --}}

        <div
            class="
                pointer-events-none
                absolute
                -right-24
                -top-24
                h-72
                w-72
                rounded-full
                bg-blue-500/10
                blur-3xl
            "
        ></div>

        <div
            class="
                pointer-events-none
                absolute
                -bottom-32
                -left-20
                h-64
                w-64
                rounded-full
                bg-cyan-400/10
                blur-3xl
            "
        ></div>


        <div
            class="
                relative
                flex
                flex-col
                gap-6
                lg:flex-row
                lg:items-center
                lg:justify-between
            "
        >

            <div class="flex items-start gap-5">

                <div
                    class="
                        flex h-16 w-16 shrink-0
                        items-center justify-center
                        rounded-2xl
                        bg-gradient-to-br
                        from-blue-600
                        to-cyan-500
                        text-white
                        shadow-lg
                        shadow-blue-500/20
                    "
                >
                    <x-heroicon-o-users class="h-8 w-8"/>
                </div>

                <div>

                    <p
                        class="
                            text-xs
                            font-bold
                            uppercase
                            tracking-[0.22em]
                            text-blue-600
                            dark:text-blue-400
                        "
                    >
                        Candidate Management
                    </p>

                    <h1
                        class="
                            mt-2
                            text-3xl
                            font-black
                            tracking-tight
                            text-slate-900
                            dark:text-white
                            md:text-4xl
                        "
                    >
                        Candidates
                    </h1>

                    <p
                        class="
                            mt-2
                            max-w-2xl
                            text-sm
                            leading-6
                            text-slate-500
                            dark:text-slate-400
                        "
                    >
                        Select an election to view and manage
                        the candidates contesting that election.
                    </p>

                </div>

            </div>


            {{-- Total elections --}}

            <div
                class="
                    rounded-2xl
                    border border-blue-100
                    bg-blue-50
                    px-6 py-4
                    dark:border-blue-500/20
                    dark:bg-blue-500/10
                "
            >

                <p
                    class="
                        text-xs
                        font-semibold
                        uppercase
                        tracking-wider
                        text-blue-600
                        dark:text-blue-400
                    "
                >
                    Your Elections
                </p>

                <p
                    class="
                        mt-1
                        text-3xl
                        font-black
                        text-slate-900
                        dark:text-white
                    "
                >
                    {{ $elections->count() }}
                </p>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- ELECTIONS --}}
    {{-- ========================================================= --}}

    @if($elections->count())

        <div>

            <div
                class="
                    mb-5
                    flex
                    flex-col
                    gap-2
                    sm:flex-row
                    sm:items-end
                    sm:justify-between
                "
            >

                <div>

                    <h2
                        class="
                            text-xl
                            font-bold
                            text-slate-900
                            dark:text-white
                        "
                    >
                        Choose an Election
                    </h2>

                    <p
                        class="
                            mt-1
                            text-sm
                            text-slate-500
                            dark:text-slate-400
                        "
                    >
                        Candidates are separated by election to keep
                        every contest completely independent.
                    </p>

                </div>

            </div>


            <div
                class="
                    grid
                    grid-cols-1
                    gap-5
                    md:grid-cols-2
                    xl:grid-cols-3
                "
            >

                @foreach($elections as $election)

                    <div
                        class="
                            group
                            relative
                            overflow-hidden
                            rounded-3xl
                            border
                            border-slate-200
                            bg-white
                            p-6
                            shadow-sm
                            transition-all
                            duration-300

                            hover:-translate-y-1
                            hover:border-blue-200
                            hover:shadow-xl
                            hover:shadow-blue-500/10

                            dark:border-white/10
                            dark:bg-[#101D35]

                            dark:hover:border-blue-500/30
                        "
                    >

                        {{-- Top accent --}}

                        <div
                            class="
                                absolute
                                inset-x-0
                                top-0
                                h-1
                                bg-gradient-to-r
                                from-blue-600
                                via-indigo-500
                                to-cyan-400
                            "
                        ></div>


                        {{-- Header --}}

                        <div
                            class="
                                flex
                                items-start
                                justify-between
                                gap-4
                            "
                        >

                            <div
                                class="
                                    flex
                                    h-12
                                    w-12
                                    items-center
                                    justify-center
                                    rounded-2xl
                                    bg-blue-50
                                    text-blue-600

                                    dark:bg-blue-500/10
                                    dark:text-blue-400
                                "
                            >
                                <x-heroicon-o-building-office-2
                                    class="h-6 w-6"
                                />
                            </div>


                            {{-- Status --}}

                            <span
                                class="
                                    inline-flex
                                    items-center
                                    gap-1.5
                                    rounded-full
                                    bg-emerald-50
                                    px-3
                                    py-1
                                    text-xs
                                    font-semibold
                                    text-emerald-700

                                    dark:bg-emerald-500/10
                                    dark:text-emerald-400
                                "
                            >

                                <span
                                    class="
                                        h-1.5
                                        w-1.5
                                        rounded-full
                                        bg-emerald-500
                                    "
                                ></span>

                                {{ ucfirst($election->status ?? 'Draft') }}

                            </span>

                        </div>


                        {{-- Election information --}}

                        <div class="mt-6">

                            <p
                                class="
                                    text-xs
                                    font-semibold
                                    uppercase
                                    tracking-wider
                                    text-blue-600
                                    dark:text-blue-400
                                "
                            >
                                {{ $election->organization->name ?? 'Organization' }}
                            </p>


                            <h3
                                class="
                                    mt-2
                                    line-clamp-2
                                    text-xl
                                    font-black
                                    tracking-tight
                                    text-slate-900
                                    dark:text-white
                                "
                            >
                                {{ $election->title }}
                            </h3>


                            @if($election->electionType)

                                <span
                                    class="
                                        mt-3
                                        inline-flex
                                        rounded-full
                                        bg-slate-100
                                        px-3
                                        py-1
                                        text-xs
                                        font-semibold
                                        text-slate-600

                                        dark:bg-white/5
                                        dark:text-slate-300
                                    "
                                >
                                    {{ $election->electionType->name }}
                                </span>

                            @endif

                        </div>


                        {{-- Statistics --}}

                        <div
                            class="
                                mt-6
                                grid
                                grid-cols-2
                                gap-3
                            "
                        >

                            <div
                                class="
                                    rounded-2xl
                                    border
                                    border-slate-100
                                    bg-slate-50
                                    p-4

                                    dark:border-white/5
                                    dark:bg-white/[0.03]
                                "
                            >

                                <p
                                    class="
                                        text-xs
                                        text-slate-400
                                    "
                                >
                                    Candidates
                                </p>

                                <p
                                    class="
                                        mt-1
                                        text-2xl
                                        font-black
                                        text-slate-900
                                        dark:text-white
                                    "
                                >
                                    {{ $election->candidates_count }}
                                </p>

                            </div>


                            <div
                                class="
                                    rounded-2xl
                                    border
                                    border-slate-100
                                    bg-slate-50
                                    p-4

                                    dark:border-white/5
                                    dark:bg-white/[0.03]
                                "
                            >

                                <p
                                    class="
                                        text-xs
                                        text-slate-400
                                    "
                                >
                                    Positions
                                </p>

                                <p
                                    class="
                                        mt-1
                                        text-2xl
                                        font-black
                                        text-slate-900
                                        dark:text-white
                                    "
                                >
                                    {{ $election->positions_count }}
                                </p>

                            </div>

                        </div>


                        {{-- Action --}}

                        <a
                            href="{{ route('elections.candidates', $election) }}"
                            class="
                                mt-6
                                flex
                                w-full
                                items-center
                                justify-center
                                gap-2
                                rounded-xl
                                bg-gradient-to-r
                                from-blue-600
                                to-cyan-500
                                px-4
                                py-3
                                text-sm
                                font-bold
                                text-white
                                shadow-lg
                                shadow-blue-500/15
                                transition-all
                                duration-200

                                hover:-translate-y-0.5
                                hover:shadow-xl
                                hover:shadow-blue-500/20
                            "
                        >

                            View Candidates

                            <x-heroicon-o-arrow-right
                                class="h-4 w-4"
                            />

                        </a>

                    </div>

                @endforeach

            </div>

        </div>

    @else

        {{-- Empty state --}}

        <div
            class="
                rounded-3xl
                border
                border-dashed
                border-slate-300
                bg-white
                px-6
                py-16
                text-center
                shadow-sm

                dark:border-white/10
                dark:bg-[#101D35]
            "
        >

            <div
                class="
                    mx-auto
                    flex
                    h-16
                    w-16
                    items-center
                    justify-center
                    rounded-2xl
                    bg-blue-50
                    text-blue-600

                    dark:bg-blue-500/10
                    dark:text-blue-400
                "
            >
                <x-heroicon-o-clipboard-document-list
                    class="h-8 w-8"
                />
            </div>

            <h2
                class="
                    mt-5
                    text-xl
                    font-bold
                    text-slate-900
                    dark:text-white
                "
            >
                No Elections Yet
            </h2>

            <p
                class="
                    mx-auto
                    mt-2
                    max-w-md
                    text-sm
                    leading-6
                    text-slate-500
                    dark:text-slate-400
                "
            >
                Create an election first. Once an election exists,
                you can add and manage candidates specifically for
                that election.
            </p>

            <a
                href="{{ route('elections.create') }}"
                class="
                    mt-6
                    inline-flex
                    items-center
                    gap-2
                    rounded-xl
                    bg-blue-600
                    px-5
                    py-3
                    text-sm
                    font-bold
                    text-white
                    shadow-lg
                    shadow-blue-500/20
                    transition
                    hover:bg-blue-700
                "
            >

                <x-heroicon-o-plus class="h-5 w-5"/>

                Create Election

            </a>

        </div>

    @endif

</div>

@endsection