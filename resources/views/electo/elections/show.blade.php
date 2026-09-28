@extends('electo.layouts.dashboard')

@section('title', $election->title)

@section('page-title', $election->title)

@section('content')

@php

    /*
    |--------------------------------------------------------------------------
    | ELECTION LIFECYCLE
    |--------------------------------------------------------------------------
    |
    | We do NOT expose "Draft" on the public management interface.
    | The displayed state is calculated from the actual election schedule.
    |
    */

    if ($election->isCancelled()) {

        $statusLabel = 'Cancelled';

        $statusClasses =
            'border-red-200 bg-red-50 text-red-700
             dark:border-red-400/20 dark:bg-red-500/10 dark:text-red-300';

        $statusDot = 'bg-red-500';

    } elseif (
        $election->starts_at &&
        $election->ends_at &&
        now()->greaterThan($election->ends_at)
    ) {

        $statusLabel = 'Completed';

        $statusClasses =
            'border-violet-200 bg-violet-50 text-violet-700
             dark:border-violet-400/20 dark:bg-violet-500/10 dark:text-violet-300';

        $statusDot = 'bg-violet-500';

    } elseif (
        $election->starts_at &&
        now()->greaterThanOrEqualTo($election->starts_at) &&
        (
            !$election->ends_at ||
            now()->lessThanOrEqualTo($election->ends_at)
        )
    ) {

        $statusLabel = 'Active';

        $statusClasses =
            'border-emerald-200 bg-emerald-50 text-emerald-700
             dark:border-emerald-400/20 dark:bg-emerald-500/10 dark:text-emerald-300';

        $statusDot = 'bg-emerald-500';

    } elseif (
        $election->starts_at &&
        now()->lessThan($election->starts_at)
    ) {

        $statusLabel = 'Scheduled';

        $statusClasses =
            'border-cyan-200 bg-cyan-50 text-cyan-700
             dark:border-cyan-400/20 dark:bg-cyan-500/10 dark:text-cyan-300';

        $statusDot = 'bg-cyan-500';

    } else {

        $statusLabel = 'Published';

        $statusClasses =
            'border-blue-200 bg-blue-50 text-blue-700
             dark:border-blue-400/20 dark:bg-blue-500/10 dark:text-blue-300';

        $statusDot = 'bg-blue-500';

    }


    /*
    |--------------------------------------------------------------------------
    | COUNTS
    |--------------------------------------------------------------------------
    */

    $positionsCount =
        $election->positions?->count() ?? 0;

    $candidatesCount =
        $election->candidates?->count() ?? 0;

    $votersCount =
        $election->electionVoters?->count() ?? 0;

    $votesCount =
    $election->ballots?->count() ?? 0;


    /*
    |--------------------------------------------------------------------------
    | SCHEDULE PROGRESS
    |--------------------------------------------------------------------------
    */

    $progress = 0;

    if ($election->starts_at && $election->ends_at) {

        $start = $election->starts_at->timestamp;
        $end = $election->ends_at->timestamp;
        $current = now()->timestamp;

        if ($current <= $start) {

            $progress = 0;

        } elseif ($current >= $end) {

            $progress = 100;

        } else {

            $duration = $end - $start;
            $elapsed = $current - $start;

            $progress = $duration > 0
                ? round(($elapsed / $duration) * 100)
                : 0;

        }

    }

@endphp


{{-- ========================================================= --}}
{{-- PAGE WRAPPER --}}
{{-- ========================================================= --}}

<div class="space-y-6">


    {{-- ========================================================= --}}
    {{-- SUCCESS MESSAGE --}}
    {{-- ========================================================= --}}

    @if(session('success'))

        <div
            class="
                rounded-2xl
                border
                border-emerald-200
                bg-emerald-50
                px-5
                py-4
                text-emerald-700
                shadow-sm

                dark:border-emerald-400/20
                dark:bg-emerald-500/10
                dark:text-emerald-300
            "
        >

            <div class="flex items-center gap-3">

                <div
                    class="
                        flex
                        h-9
                        w-9
                        items-center
                        justify-center
                        rounded-full
                        bg-emerald-500/15
                    "
                >

                    ✓

                </div>

                <span class="font-medium">
                    {{ session('success') }}
                </span>

            </div>

        </div>

    @endif


    {{-- ========================================================= --}}
    {{-- HEADER / HERO --}}
    {{-- ========================================================= --}}

    <section
        class="
            relative
            overflow-hidden
            rounded-3xl
            border
            border-slate-200
            bg-white
            shadow-sm

            dark:border-white/10
            dark:bg-[#132544]
            dark:shadow-2xl
        "
    >

        {{-- Decorative glow --}}

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

                dark:bg-blue-500/10
            "
        ></div>

        <div
            class="
                pointer-events-none
                absolute
                -bottom-32
                left-1/3
                h-72
                w-72
                rounded-full
                bg-cyan-500/10
                blur-3xl

                dark:bg-cyan-500/10
            "
        ></div>


        <div class="relative p-6 sm:p-8">


            {{-- TOP AREA --}}

            <div
                class="
                    flex
                    flex-col
                    gap-6
                    lg:flex-row
                    lg:items-start
                    lg:justify-between
                "
            >


                {{-- ELECTION INFORMATION --}}

                <div class="flex min-w-0 items-start gap-4 sm:gap-5">

                    {{-- ICON --}}

                    <div
                        class="
                            flex
                            h-14
                            w-14
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
                            sm:h-16
                            sm:w-16
                        "
                    >

                        <x-heroicon-o-clipboard-document-list
                            class="h-8 w-8"
                        />

                    </div>


                    <div class="min-w-0">

                        {{-- TITLE + STATUS --}}

                        <div
                            class="
                                flex
                                flex-wrap
                                items-center
                                gap-3
                            "
                        >

                            <h1
                                class="
                                    text-2xl
                                    font-black
                                    tracking-tight
                                    text-slate-900
                                    sm:text-3xl

                                    dark:text-white
                                "
                            >

                                {{ $election->title }}

                            </h1>


                            {{-- STATUS --}}

                            <span
                                class="
                                    inline-flex
                                    items-center
                                    gap-2
                                    rounded-full
                                    border
                                    px-3
                                    py-1.5
                                    text-xs
                                    font-bold
                                    {{ $statusClasses }}
                                "
                            >

                                <span
                                    class="
                                        h-1.5
                                        w-1.5
                                        rounded-full
                                        {{ $statusDot }}
                                    "
                                ></span>

                                {{ $statusLabel }}

                            </span>

                        </div>


                        <p
                            class="
                                mt-2
                                text-sm
                                text-slate-500

                                dark:text-slate-400
                            "
                        >

                            Manage and monitor this election.

                        </p>


                        {{-- META --}}

                        <div
                            class="
                                mt-4
                                flex
                                flex-wrap
                                items-center
                                gap-x-5
                                gap-y-2
                                text-sm
                                text-slate-500

                                dark:text-slate-400
                            "
                        >

                            <span class="flex items-center gap-2">

                                🏢

                                {{ $election->organization?->name ?? 'Organization' }}

                            </span>


                            <span class="hidden sm:block">
                                •
                            </span>


                            <span class="flex items-center gap-2">

                                📋

                                {{ $election->electionType?->name ?? 'Election' }}

                            </span>


                            <span class="hidden sm:block">
                                •
                            </span>


                            <span class="flex items-center gap-2">

                                🌐

                                {{ ucfirst($election->visibility ?? 'private') }}

                            </span>

                        </div>

                    </div>

                </div>


                {{-- ACTIONS --}}

                <div class="flex shrink-0 flex-wrap gap-3">

                    <a
                        href="{{ route('elections.index') }}"
                        class="
                            inline-flex
                            items-center
                            gap-2
                            rounded-xl
                            border
                            border-slate-200
                            bg-white
                            px-4
                            py-2.5
                            text-sm
                            font-semibold
                            text-slate-700
                            shadow-sm
                            transition-all
                            hover:-translate-y-0.5
                            hover:border-blue-300
                            hover:bg-blue-50
                            hover:text-blue-700

                            dark:border-white/10
                            dark:bg-white/[0.04]
                            dark:text-slate-300
                            dark:hover:border-cyan-400/30
                            dark:hover:bg-cyan-400/10
                            dark:hover:text-cyan-300
                        "
                    >

                        <x-heroicon-o-arrow-left
                            class="h-5 w-5"
                        />

                        Back

                    </a>


                    <a
                        href="{{ route('elections.edit', $election) }}"
                        class="
                            inline-flex
                            items-center
                            gap-2
                            rounded-xl
                            bg-gradient-to-r
                            from-blue-600
                            to-cyan-500
                            px-4
                            py-2.5
                            text-sm
                            font-bold
                            text-white
                            shadow-lg
                            shadow-blue-500/20
                            transition-all
                            hover:-translate-y-0.5
                            hover:shadow-xl
                        "
                    >

                        <x-heroicon-o-pencil-square
                            class="h-5 w-5"
                        />

                        Edit

                    </a>

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- BASIC INFORMATION --}}
            {{-- ================================================= --}}

            <div
                class="
                    mt-8
                    grid
                    grid-cols-2
                    gap-3
                    lg:grid-cols-4
                "
            >

                {{-- ORGANIZATION --}}

                <div
                    class="
                        rounded-2xl
                        border
                        border-slate-200
                        bg-slate-50
                        p-4

                        dark:border-white/10
                        dark:bg-white/[0.035]
                    "
                >

                    <p
                        class="
                            text-[11px]
                            font-bold
                            uppercase
                            tracking-wider
                            text-slate-500
                        "
                    >

                        Organization

                    </p>

                    <p
                        class="
                            mt-2
                            truncate
                            font-semibold
                            text-slate-900

                            dark:text-white
                        "
                    >

                        {{ $election->organization?->name ?? 'Not specified' }}

                    </p>

                </div>


                {{-- ELECTION TYPE --}}

                <div
                    class="
                        rounded-2xl
                        border
                        border-slate-200
                        bg-slate-50
                        p-4

                        dark:border-white/10
                        dark:bg-white/[0.035]
                    "
                >

                    <p
                        class="
                            text-[11px]
                            font-bold
                            uppercase
                            tracking-wider
                            text-slate-500
                        "
                    >

                        Election Type

                    </p>

                    <p
                        class="
                            mt-2
                            truncate
                            font-semibold
                            text-slate-900

                            dark:text-white
                        "
                    >

                        {{ $election->electionType?->name ?? 'Not specified' }}

                    </p>

                </div>


                {{-- VISIBILITY --}}

                <div
                    class="
                        rounded-2xl
                        border
                        border-slate-200
                        bg-slate-50
                        p-4

                        dark:border-white/10
                        dark:bg-white/[0.035]
                    "
                >

                    <p
                        class="
                            text-[11px]
                            font-bold
                            uppercase
                            tracking-wider
                            text-slate-500
                        "
                    >

                        Visibility

                    </p>

                    <p
                        class="
                            mt-2
                            font-semibold
                            capitalize
                            text-slate-900

                            dark:text-white
                        "
                    >

                        {{ $election->visibility ?? 'Private' }}

                    </p>

                </div>


                {{-- POSITIONS --}}

                <div
                    class="
                        rounded-2xl
                        border
                        border-slate-200
                        bg-slate-50
                        p-4

                        dark:border-white/10
                        dark:bg-white/[0.035]
                    "
                >

                    <p
                        class="
                            text-[11px]
                            font-bold
                            uppercase
                            tracking-wider
                            text-slate-500
                        "
                    >

                        Positions

                    </p>

                    <p
                        class="
                            mt-2
                            font-semibold
                            text-slate-900

                            dark:text-white
                        "
                    >

                        {{ $positionsCount }}

                    </p>

                </div>

            </div>

        </div>

    </section>


    {{-- ========================================================= --}}
    {{-- STATISTICS --}}
    {{-- ========================================================= --}}

    <div
        class="
            grid
            grid-cols-2
            gap-4
            lg:grid-cols-4
        "
    >

        {{-- POSITIONS --}}

        <div
            class="
                rounded-2xl
                border
                border-slate-200
                bg-white
                p-5
                shadow-sm
                transition-all
                hover:-translate-y-0.5
                hover:shadow-md

                dark:border-white/10
                dark:bg-[#132544]
            "
        >

            <div class="flex items-center justify-between">

                <div>

                    <p
                        class="
                            text-sm
                            font-medium
                            text-slate-500

                            dark:text-slate-400
                        "
                    >

                        Positions

                    </p>

                    <p
                        class="
                            mt-2
                            text-3xl
                            font-black
                            text-slate-900

                            dark:text-white
                        "
                    >

                        {{ $positionsCount }}

                    </p>

                </div>


                <div
                    class="
                        flex
                        h-11
                        w-11
                        items-center
                        justify-center
                        rounded-xl
                        bg-blue-500/10
                        text-blue-600

                        dark:text-blue-300
                    "
                >

                    <x-heroicon-o-briefcase
                        class="h-6 w-6"
                    />

                </div>

            </div>

        </div>


        {{-- CANDIDATES --}}

        <div
            class="
                rounded-2xl
                border
                border-slate-200
                bg-white
                p-5
                shadow-sm
                transition-all
                hover:-translate-y-0.5
                hover:shadow-md

                dark:border-white/10
                dark:bg-[#132544]
            "
        >

            <div class="flex items-center justify-between">

                <div>

                    <p
                        class="
                            text-sm
                            font-medium
                            text-slate-500

                            dark:text-slate-400
                        "
                    >

                        Candidates

                    </p>

                    <p
                        class="
                            mt-2
                            text-3xl
                            font-black
                            text-slate-900

                            dark:text-white
                        "
                    >

                        {{ $candidatesCount }}

                    </p>

                </div>


                <div
                    class="
                        flex
                        h-11
                        w-11
                        items-center
                        justify-center
                        rounded-xl
                        bg-purple-500/10
                        text-purple-600

                        dark:text-purple-300
                    "
                >

                    <x-heroicon-o-user-group
                        class="h-6 w-6"
                    />

                </div>

            </div>

        </div>


        {{-- VOTERS --}}

        <div
            class="
                rounded-2xl
                border
                border-slate-200
                bg-white
                p-5
                shadow-sm
                transition-all
                hover:-translate-y-0.5
                hover:shadow-md

                dark:border-white/10
                dark:bg-[#132544]
            "
        >

            <div class="flex items-center justify-between">

                <div>

                    <p
                        class="
                            text-sm
                            font-medium
                            text-slate-500

                            dark:text-slate-400
                        "
                    >

                        Registered Voters

                    </p>

                    <p
                        class="
                            mt-2
                            text-3xl
                            font-black
                            text-slate-900

                            dark:text-white
                        "
                    >

                        {{ $votersCount }}

                    </p>

                </div>


                <div
                    class="
                        flex
                        h-11
                        w-11
                        items-center
                        justify-center
                        rounded-xl
                        bg-cyan-500/10
                        text-cyan-600

                        dark:text-cyan-300
                    "
                >

                    <x-heroicon-o-users
                        class="h-6 w-6"
                    />

                </div>

            </div>

        </div>


        {{-- VOTES --}}

        <div
            class="
                rounded-2xl
                border
                border-slate-200
                bg-white
                p-5
                shadow-sm
                transition-all
                hover:-translate-y-0.5
                hover:shadow-md

                dark:border-white/10
                dark:bg-[#132544]
            "
        >

            <div class="flex items-center justify-between">

                <div>

                    <p
                        class="
                            text-sm
                            font-medium
                            text-slate-500

                            dark:text-slate-400
                        "
                    >

                        Votes Cast

                    </p>

                    <p
                        class="
                            mt-2
                            text-3xl
                            font-black
                            text-slate-900

                            dark:text-white
                        "
                    >

                        {{ $votesCount }}

                    </p>

                </div>


                <div
                    class="
                        flex
                        h-11
                        w-11
                        items-center
                        justify-center
                        rounded-xl
                        bg-emerald-500/10
                        text-emerald-600

                        dark:text-emerald-300
                    "
                >

                    <x-heroicon-o-check-circle
                        class="h-6 w-6"
                    />

                </div>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- TWO COLUMN CONTENT --}}
    {{-- ========================================================= --}}

    <div
        class="
            grid
            gap-6
            lg:grid-cols-3
        "
    >


        {{-- ===================================================== --}}
        {{-- LEFT --}}
        {{-- ===================================================== --}}

        <div class="space-y-6 lg:col-span-2">


            {{-- ================================================= --}}
            {{-- ELECTION DETAILS --}}
            {{-- ================================================= --}}

            <section
                class="
                    rounded-3xl
                    border
                    border-slate-200
                    bg-white
                    p-6
                    shadow-sm
                    sm:p-7

                    dark:border-white/10
                    dark:bg-[#132544]
                    dark:shadow-xl
                "
            >

                <div class="mb-6">

                    <h2
                        class="
                            text-xl
                            font-black
                            text-slate-900

                            dark:text-white
                        "
                    >

                        Election Details

                    </h2>

                    <p
                        class="
                            mt-1
                            text-sm
                            text-slate-500

                            dark:text-slate-400
                        "
                    >

                        Information and schedule for this election.

                    </p>

                </div>


                {{-- DESCRIPTION --}}

                <div
                    class="
                        rounded-2xl
                        border
                        border-slate-200
                        bg-slate-50
                        p-5

                        dark:border-white/10
                        dark:bg-white/[0.035]
                    "
                >

                    <p
                        class="
                            text-[11px]
                            font-bold
                            uppercase
                            tracking-wider
                            text-slate-500
                        "
                    >

                        Description

                    </p>

                    <p
                        class="
                            mt-3
                            leading-7
                            text-slate-600

                            dark:text-slate-300
                        "
                    >

                        {{ $election->description ?: 'No description provided.' }}

                    </p>

                </div>


                {{-- SCHEDULE --}}

                <div
                    class="
                        mt-5
                        grid
                        gap-4
                        sm:grid-cols-2
                    "
                >

                    {{-- START --}}

                    <div
                        class="
                            rounded-2xl
                            border
                            border-slate-200
                            bg-slate-50
                            p-5

                            dark:border-white/10
                            dark:bg-white/[0.035]
                        "
                    >

                        <div class="flex items-center gap-3">

                            <div
                                class="
                                    flex
                                    h-10
                                    w-10
                                    items-center
                                    justify-center
                                    rounded-xl
                                    bg-blue-500/10
                                    text-blue-600

                                    dark:text-blue-300
                                "
                            >

                                <x-heroicon-o-play
                                    class="h-5 w-5"
                                />

                            </div>

                            <div>

                                <p
                                    class="
                                        text-[11px]
                                        font-bold
                                        uppercase
                                        tracking-wider
                                        text-slate-500
                                    "
                                >

                                    Starts

                                </p>

                                <p
                                    class="
                                        mt-1
                                        font-bold
                                        text-slate-900

                                        dark:text-white
                                    "
                                >

                                    {{ $election->starts_at?->format('d M Y') ?? 'Not set' }}

                                </p>

                                <p
                                    class="
                                        mt-1
                                        text-sm
                                        text-slate-500

                                        dark:text-slate-400
                                    "
                                >

                                    {{ $election->starts_at?->format('h:i A') ?? '—' }}

                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- END --}}

                    <div
                        class="
                            rounded-2xl
                            border
                            border-slate-200
                            bg-slate-50
                            p-5

                            dark:border-white/10
                            dark:bg-white/[0.035]
                        "
                    >

                        <div class="flex items-center gap-3">

                            <div
                                class="
                                    flex
                                    h-10
                                    w-10
                                    items-center
                                    justify-center
                                    rounded-xl
                                    bg-violet-500/10
                                    text-violet-600

                                    dark:text-violet-300
                                "
                            >

                                <x-heroicon-o-stop
                                    class="h-5 w-5"
                                />

                            </div>

                            <div>

                                <p
                                    class="
                                        text-[11px]
                                        font-bold
                                        uppercase
                                        tracking-wider
                                        text-slate-500
                                    "
                                >

                                    Ends

                                </p>

                                <p
                                    class="
                                        mt-1
                                        font-bold
                                        text-slate-900

                                        dark:text-white
                                    "
                                >

                                    {{ $election->ends_at?->format('d M Y') ?? 'Not set' }}

                                </p>

                                <p
                                    class="
                                        mt-1
                                        text-sm
                                        text-slate-500

                                        dark:text-slate-400
                                    "
                                >

                                    {{ $election->ends_at?->format('h:i A') ?? '—' }}

                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- PROGRESS --}}

                @if($election->starts_at && $election->ends_at)

                    <div class="mt-6">

                        <div
                            class="
                                mb-2
                                flex
                                items-center
                                justify-between
                            "
                        >

                            <span
                                class="
                                    text-xs
                                    font-semibold
                                    text-slate-500

                                    dark:text-slate-400
                                "
                            >

                                Election Timeline

                            </span>

                            <span
                                class="
                                    text-xs
                                    font-bold
                                    text-slate-700

                                    dark:text-slate-300
                                "
                            >

                                {{ $progress }}%

                            </span>

                        </div>


                        <div
                            class="
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
                                    to-cyan-500
                                    transition-all
                                    duration-500
                                "
                                style="width: {{ $progress }}%"
                            ></div>

                        </div>

                    </div>

                @endif

            </section>


            {{-- ================================================= --}}
            {{-- POSITIONS --}}
            {{-- ================================================= --}}

            <section
                class="
                    rounded-3xl
                    border
                    border-slate-200
                    bg-white
                    p-6
                    shadow-sm
                    sm:p-7

                    dark:border-white/10
                    dark:bg-[#132544]
                    dark:shadow-xl
                "
            >

                <div
                    class="
                        flex
                        flex-col
                        gap-4
                        sm:flex-row
                        sm:items-center
                        sm:justify-between
                    "
                >

                    <div>

                        <h2
                            class="
                                text-xl
                                font-black
                                text-slate-900

                                dark:text-white
                            "
                        >

                            Election Positions

                        </h2>

                        <p
                            class="
                                mt-1
                                text-sm
                                text-slate-500

                                dark:text-slate-400
                            "
                        >

                            These are the offices voters will see on the ballot.

                        </p>

                    </div>


                    <span
                        class="
                            inline-flex
                            w-fit
                            rounded-full
                            border
                            border-blue-200
                            bg-blue-50
                            px-4
                            py-2
                            text-sm
                            font-bold
                            text-blue-700

                            dark:border-blue-400/20
                            dark:bg-blue-500/10
                            dark:text-blue-300
                        "
                    >

                        {{ $positionsCount }} Positions

                    </span>

                </div>


                @if($election->positions->count())

                    <div
                        class="
                            mt-6
                            grid
                            gap-4
                            md:grid-cols-2
                        "
                    >

                        @foreach($election->positions as $position)

                            <div
                                class="
                                    group
                                    rounded-2xl
                                    border
                                    border-slate-200
                                    bg-slate-50
                                    p-5
                                    transition-all
                                    duration-200
                                    hover:-translate-y-0.5
                                    hover:border-blue-300
                                    hover:bg-blue-50

                                    dark:border-white/10
                                    dark:bg-white/[0.03]
                                    dark:hover:border-blue-400/30
                                    dark:hover:bg-blue-500/5
                                "
                            >

                                <div
                                    class="
                                        flex
                                        items-start
                                        justify-between
                                        gap-4
                                    "
                                >

                                    <div class="flex items-center gap-4">

                                        <div
                                            class="
                                                flex
                                                h-11
                                                w-11
                                                shrink-0
                                                items-center
                                                justify-center
                                                rounded-xl
                                                bg-blue-600/10
                                                font-black
                                                text-blue-600

                                                dark:bg-blue-500/10
                                                dark:text-blue-300
                                            "
                                        >

                                            {{ $position->sort_order }}

                                        </div>


                                        <div>

                                            <h3
                                                class="
                                                    font-bold
                                                    text-slate-900

                                                    dark:text-white
                                                "
                                            >

                                                {{ $position->name }}

                                            </h3>

                                            <p
                                                class="
                                                    mt-1
                                                    text-xs
                                                    text-slate-500

                                                    dark:text-slate-500
                                                "
                                            >

                                                Election Position

                                            </p>

                                        </div>

                                    </div>


                                    <span
                                        class="
                                            mt-1
                                            h-2
                                            w-2
                                            shrink-0
                                            rounded-full
                                            bg-emerald-500
                                        "
                                    ></span>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div
                        class="
                            mt-6
                            rounded-2xl
                            border
                            border-dashed
                            border-slate-300
                            p-8
                            text-center

                            dark:border-white/10
                        "
                    >

                        <p
                            class="
                                text-sm
                                text-slate-500

                                dark:text-slate-400
                            "
                        >

                            No positions have been added yet.

                        </p>

                    </div>

                @endif

            </section>

        </div>


        {{-- ===================================================== --}}
        {{-- RIGHT SIDEBAR --}}
        {{-- ===================================================== --}}

        <div class="space-y-6">


            {{-- ================================================= --}}
            {{-- ELECTION SETTINGS --}}
            {{-- ================================================= --}}

            <section
                class="
                    rounded-3xl
                    border
                    border-slate-200
                    bg-white
                    p-6
                    shadow-sm

                    dark:border-white/10
                    dark:bg-[#132544]
                    dark:shadow-xl
                "
            >

                <h2
                    class="
                        text-xl
                        font-black
                        text-slate-900

                        dark:text-white
                    "
                >

                    Election Settings

                </h2>

                <p
                    class="
                        mt-1
                        text-sm
                        text-slate-500

                        dark:text-slate-400
                    "
                >

                    Current voting configuration.

                </p>


                <div class="mt-6 space-y-3">


                    {{-- MULTIPLE VOTES --}}

                    <div
                        class="
                            flex
                            items-center
                            justify-between
                            rounded-xl
                            border
                            border-slate-100
                            bg-slate-50
                            p-4

                            dark:border-white/5
                            dark:bg-white/[0.035]
                        "
                    >

                        <span
                            class="
                                text-sm
                                font-medium
                                text-slate-600

                                dark:text-slate-300
                            "
                        >

                            Multiple Votes

                        </span>


                        @if($election->allow_multiple_votes)

                            <span
                                class="
                                    font-bold
                                    text-emerald-600

                                    dark:text-emerald-300
                                "
                            >

                                Enabled

                            </span>

                        @else

                            <span
                                class="
                                    font-medium
                                    text-slate-400
                                "
                            >

                                Disabled

                            </span>

                        @endif

                    </div>


                    {{-- VOTER VERIFICATION --}}

                    <div
                        class="
                            flex
                            items-center
                            justify-between
                            rounded-xl
                            border
                            border-slate-100
                            bg-slate-50
                            p-4

                            dark:border-white/5
                            dark:bg-white/[0.035]
                        "
                    >

                        <span
                            class="
                                text-sm
                                font-medium
                                text-slate-600

                                dark:text-slate-300
                            "
                        >

                            Voter Verification

                        </span>


                        @if($election->require_voter_verification)

                            <span
                                class="
                                    font-bold
                                    text-emerald-600

                                    dark:text-emerald-300
                                "
                            >

                                Required

                            </span>

                        @else

                            <span
                                class="
                                    font-medium
                                    text-slate-400
                                "
                            >

                                Not Required

                            </span>

                        @endif

                    </div>


                    {{-- LIVE RESULTS --}}

                    <div
                        class="
                            flex
                            items-center
                            justify-between
                            rounded-xl
                            border
                            border-slate-100
                            bg-slate-50
                            p-4

                            dark:border-white/5
                            dark:bg-white/[0.035]
                        "
                    >

                        <span
                            class="
                                text-sm
                                font-medium
                                text-slate-600

                                dark:text-slate-300
                            "
                        >

                            Live Results

                        </span>


                        @if($election->show_live_results)

                            <span
                                class="
                                    font-bold
                                    text-emerald-600

                                    dark:text-emerald-300
                                "
                            >

                                Enabled

                            </span>

                        @else

                            <span
                                class="
                                    font-medium
                                    text-slate-400
                                "
                            >

                                Disabled

                            </span>

                        @endif

                    </div>


                    {{-- RESULT DOWNLOAD --}}

                    <div
                        class="
                            flex
                            items-center
                            justify-between
                            rounded-xl
                            border
                            border-slate-100
                            bg-slate-50
                            p-4

                            dark:border-white/5
                            dark:bg-white/[0.035]
                        "
                    >

                        <span
                            class="
                                text-sm
                                font-medium
                                text-slate-600

                                dark:text-slate-300
                            "
                        >

                            Result Download

                        </span>


                        @if($election->allow_result_download)

                            <span
                                class="
                                    font-bold
                                    text-emerald-600

                                    dark:text-emerald-300
                                "
                            >

                                Allowed

                            </span>

                        @else

                            <span
                                class="
                                    font-medium
                                    text-slate-400
                                "
                            >

                                Disabled

                            </span>

                        @endif

                    </div>

                </div>

            </section>


            {{-- ================================================= --}}
            {{-- QUICK INFO --}}
            {{-- ================================================= --}}

            <section
                class="
                    rounded-3xl
                    border
                    border-slate-200
                    bg-gradient-to-br
                    from-blue-50
                    via-white
                    to-cyan-50
                    p-6
                    shadow-sm

                    dark:border-white/10
                    dark:from-blue-500/10
                    dark:via-[#132544]
                    dark:to-cyan-500/10
                "
            >

                <div
                    class="
                        flex
                        h-11
                        w-11
                        items-center
                        justify-center
                        rounded-xl
                        bg-blue-600
                        text-white
                        shadow-lg
                        shadow-blue-500/20
                    "
                >

                    <x-heroicon-o-shield-check
                        class="h-6 w-6"
                    />

                </div>


                <h3
                    class="
                        mt-4
                        font-bold
                        text-slate-900

                        dark:text-white
                    "
                >

                    Electo Election Control

                </h3>


                <p
                    class="
                        mt-2
                        text-sm
                        leading-6
                        text-slate-600

                        dark:text-slate-400
                    "
                >

                    Manage the election, monitor participation
                    and maintain a secure voting environment.

                </p>


                <a
                    href="{{ route('elections.edit', $election) }}"
                    class="
                        mt-5
                        inline-flex
                        w-full
                        items-center
                        justify-center
                        gap-2
                        rounded-xl
                        bg-gradient-to-r
                        from-blue-600
                        to-cyan-500
                        px-5
                        py-3
                        text-sm
                        font-bold
                        text-white
                        shadow-lg
                        shadow-blue-500/20
                        transition-all
                        hover:-translate-y-0.5
                        hover:shadow-xl
                    "
                >

                    <x-heroicon-o-pencil-square
                        class="h-5 w-5"
                    />

                    Manage Election

                </a>

            </section>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- BOTTOM ACTIONS --}}
    {{-- ========================================================= --}}

    <section
        class="
            rounded-3xl
            border
            border-slate-200
            bg-white
            p-6
            shadow-sm

            dark:border-white/10
            dark:bg-[#132544]
            dark:shadow-xl
        "
    >

        <div
            class="
                flex
                flex-col
                gap-5
                sm:flex-row
                sm:items-center
                sm:justify-between
            "
        >

            <div>

                <h3
                    class="
                        font-bold
                        text-slate-900

                        dark:text-white
                    "
                >

                    Election Actions

                </h3>

                <p
                    class="
                        mt-1
                        text-sm
                        text-slate-500

                        dark:text-slate-400
                    "
                >

                    Manage your election from here.

                </p>

            </div>


            <div class="flex flex-wrap gap-3">

                {{-- BACK --}}

                <a
                    href="{{ route('elections.index') }}"
                    class="
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
                        hover:border-blue-300
                        hover:bg-blue-50
                        hover:text-blue-700

                        dark:border-white/10
                        dark:bg-white/[0.04]
                        dark:text-slate-300
                        dark:hover:bg-white/[0.08]
                    "
                >

                    <x-heroicon-o-arrow-left
                        class="h-5 w-5"
                    />

                    Back to Elections

                </a>


                {{-- EDIT --}}

                <a
                    href="{{ route('elections.edit', $election) }}"
                    class="
                        inline-flex
                        items-center
                        gap-2
                        rounded-xl
                        bg-gradient-to-r
                        from-blue-600
                        to-cyan-500
                        px-5
                        py-3
                        text-sm
                        font-bold
                        text-white
                        shadow-lg
                        shadow-blue-500/20
                        transition
                        hover:-translate-y-0.5
                        hover:shadow-xl
                    "
                >

                    <x-heroicon-o-pencil-square
                        class="h-5 w-5"
                    />

                    Edit Election

                </a>


                {{-- DELETE --}}

                <form
                    method="POST"
                    action="{{ route('elections.destroy', $election) }}"
                    onsubmit="return confirm('Are you sure you want to delete this election? This will move it to the trash.');"
                >

                    @csrf

                    @method('DELETE')

                    <button
                        type="submit"
                        class="
                            inline-flex
                            items-center
                            gap-2
                            rounded-xl
                            border
                            border-red-200
                            bg-red-50
                            px-5
                            py-3
                            text-sm
                            font-bold
                            text-red-600
                            transition
                            hover:bg-red-100

                            dark:border-red-500/20
                            dark:bg-red-500/10
                            dark:text-red-300
                            dark:hover:bg-red-500/20
                        "
                    >

                        <x-heroicon-o-trash
                            class="h-5 w-5"
                        />

                        Delete

                    </button>

                </form>

            </div>

        </div>

    </section>

</div>

@endsection