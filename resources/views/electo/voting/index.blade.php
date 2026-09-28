@extends('electo.layouts.dashboard')

@section('title', 'My Voting')
@section('page-title', 'My Voting')

@section('content')

<div class="mx-auto w-full max-w-7xl space-y-8">

    {{-- ========================================================= --}}
    {{-- PREMIUM HERO --}}
    {{-- ========================================================= --}}

    <section
        class="
            relative overflow-hidden
            rounded-[2rem]
            border border-blue-100
            bg-gradient-to-br
            from-blue-600
            via-indigo-600
            to-cyan-500
            px-6 py-8
            text-white
            shadow-[0_20px_60px_rgba(37,99,235,0.18)]
            sm:px-10 sm:py-10
        "
    >

        {{-- Decorative glow --}}
        <div
            class="
                pointer-events-none
                absolute -right-24 -top-24
                h-72 w-72
                rounded-full
                bg-white/10
                blur-3xl
            "
        ></div>

        <div
            class="
                pointer-events-none
                absolute -bottom-28 -left-20
                h-72 w-72
                rounded-full
                bg-cyan-300/20
                blur-3xl
            "
        ></div>

        <div class="relative z-10">

            {{-- Badge --}}
            <div
                class="
                    inline-flex items-center gap-2
                    rounded-full
                    border border-white/20
                    bg-white/10
                    px-4 py-2
                    text-xs font-bold
                    uppercase
                    tracking-[0.18em]
                    backdrop-blur-md
                "
            >
                <x-heroicon-o-shield-check class="h-4 w-4"/>

                Secure Voting Portal
            </div>


            {{-- Heading --}}
            <div
                class="
                    mt-5
                    flex flex-col
                    gap-6
                    lg:flex-row
                    lg:items-end
                    lg:justify-between
                "
            >

                <div>

                    <h1
                        class="
                            text-3xl
                            font-black
                            tracking-tight
                            sm:text-4xl
                            lg:text-5xl
                        "
                    >
                        Choose an Election
                    </h1>

                    <p
                        class="
                            mt-3
                            max-w-2xl
                            text-sm
                            leading-7
                            text-blue-100
                            sm:text-base
                        "
                    >
                        Select the election you want to participate in.
                        Your access is based on your individual eligibility.
                    </p>

                </div>


                {{-- Election count --}}
                <div
                    class="
                        inline-flex
                        w-fit
                        items-center
                        gap-3
                        rounded-2xl
                        border border-white/20
                        bg-white/10
                        px-4 py-3
                        backdrop-blur-md
                    "
                >

                    <div
                        class="
                            flex h-10 w-10
                            items-center justify-center
                            rounded-xl
                            bg-white/15
                        "
                    >
                        <x-heroicon-o-clipboard-document-check
                            class="h-5 w-5"
                        />
                    </div>

                    <div>

                        <p class="text-[10px] font-semibold uppercase tracking-wider text-blue-100">
                            Your Elections
                        </p>

                        <p class="mt-0.5 text-lg font-black">
                            {{ $elections->count() }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- ========================================================= --}}
    {{-- ELECTIONS --}}
    {{-- ========================================================= --}}

    @if($elections->count())

        <div
            class="
                grid
                grid-cols-1
                gap-6
                xl:grid-cols-2
            "
        >

            @foreach($elections as $election)

                @php

                    /*
                    |--------------------------------------------------------------------------
                    | Get this voter's record for THIS election
                    |--------------------------------------------------------------------------
                    */

                    $electionVoter =
                        $election->electionVoters->first();

                    $hasVoted =
                        (bool) ($electionVoter?->has_voted ?? false);

                    /*
                    |--------------------------------------------------------------------------
                    | Determine election timing
                    |--------------------------------------------------------------------------
                    */

                    $isOngoing =
                        $election->starts_at &&
                        $election->ends_at &&
                        now()->between(
                            $election->starts_at,
                            $election->ends_at
                        );

                    $isUpcoming =
                        $election->starts_at &&
                        now()->lt($election->starts_at);

                    $isCompleted =
                        $election->ends_at &&
                        now()->gt($election->ends_at);

                @endphp


                {{-- ================================================= --}}
                {{-- ELECTION CARD --}}
                {{-- ================================================= --}}

                <article
                    class="
                        group
                        relative
                        overflow-hidden
                        rounded-[1.75rem]

                        border
                        border-slate-200

                        bg-white

                        shadow-[0_8px_30px_rgba(15,23,42,0.06)]

                        transition-all
                        duration-300

                        hover:-translate-y-1
                        hover:border-blue-200
                        hover:shadow-[0_20px_50px_rgba(37,99,235,0.12)]
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


                    {{-- Hover glow --}}
                    <div
                        class="
                            pointer-events-none
                            absolute
                            -right-16
                            -top-16
                            h-40
                            w-40
                            rounded-full
                            bg-blue-500/10
                            blur-3xl
                            opacity-0
                            transition-opacity
                            duration-300
                            group-hover:opacity-100
                        "
                    ></div>


                    <div class="relative p-6 sm:p-7">

                        {{-- ================================================= --}}
                        {{-- HEADER --}}
                        {{-- ================================================= --}}

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
                                    min-w-0
                                    items-start
                                    gap-4
                                "
                            >

                                {{-- Organization icon --}}
                                <div
                                    class="
                                        flex
                                        h-14
                                        w-14
                                        shrink-0
                                        items-center
                                        justify-center

                                        rounded-2xl

                                        border
                                        border-blue-100

                                        bg-blue-50

                                        text-blue-600

                                        transition-all
                                        duration-300

                                        group-hover:scale-105
                                        group-hover:bg-blue-600
                                        group-hover:text-white
                                        group-hover:shadow-lg
                                        group-hover:shadow-blue-500/20
                                    "
                                >
                                    <x-heroicon-o-building-library
                                        class="h-7 w-7"
                                    />
                                </div>


                                {{-- Election identity --}}
                                <div class="min-w-0">

                                    <p
                                        class="
                                            text-[11px]
                                            font-bold
                                            uppercase
                                            tracking-[0.18em]
                                            text-slate-400
                                        "
                                    >
                                        {{ $election->organization->name ?? 'Organization' }}
                                    </p>

                                    <h2
                                        class="
                                            mt-1
                                            text-xl
                                            font-black
                                            tracking-tight
                                            text-slate-900
                                            sm:text-2xl
                                        "
                                    >
                                        {{ $election->title }}
                                    </h2>

                                    {{-- Election type --}}
                                    <div class="mt-2">

                                        <span
                                            class="
                                                inline-flex
                                                items-center
                                                gap-1.5
                                                rounded-full
                                                border
                                                border-slate-200
                                                bg-slate-50
                                                px-3
                                                py-1.5
                                                text-xs
                                                font-semibold
                                                text-slate-600
                                            "
                                        >
                                            <x-heroicon-o-tag
                                                class="h-3.5 w-3.5"
                                            />

                                            {{ $election->electionType->name ?? 'General Election' }}

                                        </span>

                                    </div>

                                </div>

                            </div>


                            {{-- ================================================= --}}
                            {{-- STATUS --}}
                            {{-- ================================================= --}}

                            @if($hasVoted)

                                <span
                                    class="
                                        inline-flex
                                        shrink-0
                                        items-center
                                        gap-1.5

                                        rounded-full

                                        border
                                        border-emerald-200

                                        bg-emerald-50

                                        px-3
                                        py-1.5

                                        text-xs
                                        font-bold
                                        text-emerald-700
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

                                    Voted

                                </span>

                            @elseif($isOngoing)

                                <span
                                    class="
                                        inline-flex
                                        shrink-0
                                        items-center
                                        gap-1.5

                                        rounded-full

                                        border
                                        border-blue-200

                                        bg-blue-50

                                        px-3
                                        py-1.5

                                        text-xs
                                        font-bold
                                        text-blue-700
                                    "
                                >

                                    <span
                                        class="
                                            h-1.5
                                            w-1.5
                                            rounded-full
                                            bg-blue-600
                                        "
                                    ></span>

                                    Voting Open

                                </span>

                            @elseif($isUpcoming)

                                <span
                                    class="
                                        inline-flex
                                        shrink-0
                                        items-center
                                        gap-1.5

                                        rounded-full

                                        border
                                        border-amber-200

                                        bg-amber-50

                                        px-3
                                        py-1.5

                                        text-xs
                                        font-bold
                                        text-amber-700
                                    "
                                >

                                    <span
                                        class="
                                            h-1.5
                                            w-1.5
                                            rounded-full
                                            bg-amber-500
                                        "
                                    ></span>

                                    Upcoming

                                </span>

                            @elseif($isCompleted)

                                <span
                                    class="
                                        inline-flex
                                        shrink-0
                                        items-center
                                        gap-1.5

                                        rounded-full

                                        border
                                        border-slate-200

                                        bg-slate-100

                                        px-3
                                        py-1.5

                                        text-xs
                                        font-bold
                                        text-slate-500
                                    "
                                >

                                    <span
                                        class="
                                            h-1.5
                                            w-1.5
                                            rounded-full
                                            bg-slate-400
                                        "
                                    ></span>

                                    Closed

                                </span>

                            @endif

                        </div>


                        {{-- ================================================= --}}
                        {{-- DATE PANEL --}}
                        {{-- ================================================= --}}

                        <div
                            class="
                                mt-6
                                grid
                                grid-cols-1
                                gap-3
                                sm:grid-cols-2
                            "
                        >

                            {{-- Starts --}}
                            <div
                                class="
                                    rounded-2xl
                                    border
                                    border-slate-100
                                    bg-slate-50
                                    p-4
                                "
                            >

                                <div class="flex items-center gap-2">

                                    <div
                                        class="
                                            flex h-8 w-8
                                            items-center justify-center
                                            rounded-xl
                                            bg-white
                                            text-blue-600
                                            shadow-sm
                                        "
                                    >
                                        <x-heroicon-o-calendar
                                            class="h-4 w-4"
                                        />
                                    </div>

                                    <p
                                        class="
                                            text-[10px]
                                            font-bold
                                            uppercase
                                            tracking-wider
                                            text-slate-400
                                        "
                                    >
                                        Starts
                                    </p>

                                </div>

                                <p
                                    class="
                                        mt-3
                                        text-sm
                                        font-bold
                                        text-slate-900
                                    "
                                >
                                    {{ $election->starts_at
                                        ? $election->starts_at->format('d M Y')
                                        : 'Not scheduled'
                                    }}
                                </p>

                                @if($election->starts_at)

                                    <p class="mt-1 text-xs text-slate-400">
                                        {{ $election->starts_at->format('h:i A') }}
                                    </p>

                                @endif

                            </div>


                            {{-- Ends --}}
                            <div
                                class="
                                    rounded-2xl
                                    border
                                    border-slate-100
                                    bg-slate-50
                                    p-4
                                "
                            >

                                <div class="flex items-center gap-2">

                                    <div
                                        class="
                                            flex h-8 w-8
                                            items-center justify-center
                                            rounded-xl
                                            bg-white
                                            text-indigo-600
                                            shadow-sm
                                        "
                                    >
                                        <x-heroicon-o-clock
                                            class="h-4 w-4"
                                        />
                                    </div>

                                    <p
                                        class="
                                            text-[10px]
                                            font-bold
                                            uppercase
                                            tracking-wider
                                            text-slate-400
                                        "
                                    >
                                        Ends
                                    </p>

                                </div>

                                <p
                                    class="
                                        mt-3
                                        text-sm
                                        font-bold
                                        text-slate-900
                                    "
                                >
                                    {{ $election->ends_at
                                        ? $election->ends_at->format('d M Y')
                                        : 'Not scheduled'
                                    }}
                                </p>

                                @if($election->ends_at)

                                    <p class="mt-1 text-xs text-slate-400">
                                        {{ $election->ends_at->format('h:i A') }}
                                    </p>

                                @endif

                            </div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- DESCRIPTION --}}
                        {{-- ================================================= --}}

                        <div
                            class="
                                mt-5
                                rounded-2xl
                                border
                                border-slate-100
                                bg-white
                                p-4
                            "
                        >

                            <p
                                class="
                                    line-clamp-2
                                    text-sm
                                    leading-6
                                    text-slate-500
                                "
                            >
                                {{ $election->description
                                    ?: 'Secure digital election with verified voter accreditation and transparent result management.'
                                }}
                            </p>

                        </div>


                        {{-- ================================================= --}}
                        {{-- FOOTER --}}
                        {{-- ================================================= --}}

                        <div
                            class="
                                mt-6
                                flex
                                flex-col
                                gap-4
                                border-t
                                border-slate-100
                                pt-5
                                sm:flex-row
                                sm:items-center
                                sm:justify-between
                            "
                        >

                            {{-- Security --}}
                            <div
                                class="
                                    flex
                                    items-center
                                    gap-2
                                    text-xs
                                    font-semibold
                                    text-slate-400
                                "
                            >

                                <div
                                    class="
                                        flex h-8 w-8
                                        items-center justify-center
                                        rounded-xl
                                        bg-emerald-50
                                        text-emerald-600
                                    "
                                >
                                    <x-heroicon-o-shield-check
                                        class="h-4 w-4"
                                    />
                                </div>

                                Secure Voting

                            </div>


                            {{-- ================================================= --}}
{{-- ACTION --}}
{{-- ================================================= --}}

@if($hasVoted)

    {{-- ================================================= --}}
    {{-- ALREADY VOTED --}}
    {{-- ================================================= --}}

    <div class="flex flex-col items-end gap-2">

        <div
            class="inline-flex items-center gap-2
                   rounded-xl
                   border border-purple-200
                   bg-purple-50
                   px-5 py-3
                   text-sm font-bold
                   text-purple-700
                   dark:border-purple-500/20
                   dark:bg-purple-500/10
                   dark:text-purple-400"
        >

            <x-heroicon-o-check-circle class="h-5 w-5"/>

            Already Voted

        </div>

        <p class="text-right text-[11px] text-slate-400">
            Your ballot has already been submitted.
        </p>

    </div>


@elseif($isUpcoming)

    {{-- ================================================= --}}
    {{-- UPCOMING --}}
    {{-- ================================================= --}}

    <div class="flex flex-col items-end gap-2">

        <div
            class="inline-flex items-center gap-2
                   rounded-xl
                   border border-blue-200
                   bg-blue-50
                   px-5 py-3
                   text-sm font-bold
                   text-blue-700
                   dark:border-blue-500/20
                   dark:bg-blue-500/10
                   dark:text-blue-400"
        >

            <x-heroicon-o-clock class="h-5 w-5"/>

            Voting Starts
            {{ $election->starts_at?->format('d M, h:i A') }}

        </div>

        <p class="text-right text-[11px] text-slate-400">
            You can vote when the election opens.
        </p>

    </div>


@elseif($isCompleted)

    {{-- ================================================= --}}
    {{-- CLOSED --}}
    {{-- ================================================= --}}

    <div class="flex flex-col items-end gap-2">

        <div
            class="inline-flex items-center gap-2
                   rounded-xl
                   border border-slate-200
                   bg-slate-100
                   px-5 py-3
                   text-sm font-bold
                   text-slate-500
                   dark:border-white/10
                   dark:bg-white/5
                   dark:text-slate-400"
        >

            <x-heroicon-o-lock-closed class="h-5 w-5"/>

            Election Closed

        </div>

        <p class="text-right text-[11px] text-slate-400">
            Voting is no longer available for this election.
        </p>

    </div>


@elseif(!$electionVoter?->is_eligible)

    {{-- ================================================= --}}
    {{-- NOT ELIGIBLE --}}
    {{-- ================================================= --}}

    <div class="flex flex-col items-end gap-2">

        <div
            class="inline-flex items-center gap-2
                   rounded-xl
                   border border-red-200
                   bg-red-50
                   px-5 py-3
                   text-sm font-bold
                   text-red-600
                   dark:border-red-500/20
                   dark:bg-red-500/10
                   dark:text-red-400"
        >

            <x-heroicon-o-lock-closed class="h-5 w-5"/>

            Not Eligible

        </div>

        <p class="text-right text-[11px] text-slate-400">
            You are not eligible to participate in this election.
        </p>

    </div>


@elseif($electionVoter?->accreditation_status !== 'accredited')

    {{-- ================================================= --}}
    {{-- ACCREDITATION REQUIRED --}}
    {{-- ================================================= --}}

    <div class="flex flex-col items-end gap-2">

        <div
            class="flex items-center gap-3
                   rounded-2xl
                   border border-amber-200
                   bg-amber-50
                   px-4 py-3
                   dark:border-amber-500/20
                   dark:bg-amber-500/10"
        >

            <div
                class="flex h-9 w-9 shrink-0 items-center justify-center
                       rounded-xl
                       bg-amber-100
                       text-amber-600
                       dark:bg-amber-500/10
                       dark:text-amber-400"
            >
                <x-heroicon-o-identification class="h-5 w-5"/>
            </div>

            <div class="min-w-0">

                <p class="text-xs font-bold text-amber-800 dark:text-amber-300">
                    Accreditation Required
                </p>

                <p class="mt-0.5 text-[11px] text-amber-700/70 dark:text-amber-400/70">
                    Complete accreditation before casting your vote.
                </p>

            </div>

        </div>


        <a
            href="{{ route(
                'accreditation.show',
                [
                    'voter' => $voter,
                    'election' => $election
                ]
            ) }}"
            class="group inline-flex items-center justify-center gap-2
                   rounded-xl
                   bg-gradient-to-r
                   from-amber-500
                   to-orange-500
                   px-6 py-3
                   text-sm font-bold
                   text-white
                   shadow-lg
                   shadow-amber-500/20
                   transition-all duration-200
                   hover:-translate-y-0.5
                   hover:shadow-xl
                   hover:shadow-amber-500/30"
        >

            <x-heroicon-o-identification class="h-5 w-5"/>

            Get Accredited

            <x-heroicon-o-arrow-right
                class="h-4 w-4 transition-transform
                       group-hover:translate-x-1"
            />

        </a>

    </div>


@else

    {{-- ================================================= --}}
    {{-- READY TO VOTE --}}
    {{-- ================================================= --}}

    <div class="flex flex-col items-end gap-2">

        <div
            class="flex items-center gap-3
                   rounded-2xl
                   border border-emerald-200
                   bg-emerald-50
                   px-4 py-3
                   dark:border-emerald-500/20
                   dark:bg-emerald-500/10"
        >

            <div
                class="flex h-9 w-9 shrink-0 items-center justify-center
                       rounded-xl
                       bg-emerald-100
                       text-emerald-600
                       dark:bg-emerald-500/10
                       dark:text-emerald-400"
            >
                <x-heroicon-o-check-badge class="h-5 w-5"/>
            </div>

            <div class="min-w-0">

                <p class="text-xs font-bold text-emerald-800 dark:text-emerald-300">
                    You're Ready to Vote
                </p>

                <p class="mt-0.5 text-[11px] text-emerald-700/70 dark:text-emerald-400/70">
                    Your accreditation is complete.
                </p>

            </div>

        </div>


        <a
            href="{{ route(
                'voting.start',
                [
                    'voter' => $voter->id,
                    'election' => $election->id
                ]
            ) }}"
            class="group inline-flex items-center justify-center gap-2
                   rounded-xl
                   bg-gradient-to-r
                   from-blue-600
                   to-indigo-600
                   px-6 py-3
                   text-sm font-bold
                   text-white
                   shadow-lg
                   shadow-blue-600/20
                   transition-all duration-200
                   hover:-translate-y-0.5
                   hover:shadow-xl
                   hover:shadow-blue-600/30"
        >

            <x-heroicon-o-check-badge class="h-5 w-5"/>

            Vote Now

            <x-heroicon-o-arrow-right
                class="h-4 w-4 transition-transform
                       group-hover:translate-x-1"
            />

        </a>

    </div>

@endif

                        </div>

                    </div>

                </article>

            @endforeach

        </div>

    @else

        {{-- ========================================================= --}}
        {{-- EMPTY STATE --}}
        {{-- ========================================================= --}}

        <div
            class="
                rounded-[2rem]
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
                    h-20
                    w-20
                    items-center
                    justify-center
                    rounded-3xl
                    bg-blue-50
                    text-blue-600
                    dark:bg-blue-500/10
                    dark:text-blue-400
                "
            >

                <x-heroicon-o-inbox
                    class="h-10 w-10"
                />

            </div>

            <h2
                class="
                    mt-6
                    text-2xl
                    font-black
                    tracking-tight
                    text-slate-900
                    dark:text-white
                "
            >
                No Elections Available
            </h2>

            <p
                class="
                    mx-auto
                    mt-3
                    max-w-md
                    text-sm
                    leading-7
                    text-slate-500
                    dark:text-slate-400
                "
            >
                You are not currently eligible to participate in any election.
                Contact your organization administrator if you believe this is an error.
            </p>

            <a
                href="{{ route('dashboard') }}"
                class="
                    mt-8
                    inline-flex
                    items-center
                    gap-2
                    rounded-xl
                    border
                    border-slate-200
                    bg-white
                    px-5
                    py-3
                    text-sm
                    font-semibold
                    text-slate-700
                    shadow-sm
                    transition
                    hover:border-blue-200
                    hover:bg-blue-50
                    hover:text-blue-700
                    dark:border-white/10
                    dark:bg-white/5
                    dark:text-slate-300
                    dark:hover:border-blue-500/20
                    dark:hover:bg-blue-500/10
                    dark:hover:text-blue-400
                "
            >

                <x-heroicon-o-home class="h-5 w-5"/>

                Return to Dashboard

            </a>

        </div>

    @endif

</div>

@endsection