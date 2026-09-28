@extends('electo.layouts.dashboard')

@section('page-title', 'Voter Profile')
@section('title', $voter->name . ' | Voter | Electo')

@section('content')

<div class="w-full max-w-none space-y-5 pb-8">

    {{-- ============================================================
        PAGE HEADER
    ============================================================= --}}

    <div class="flex items-center justify-between gap-4">

        <div class="flex min-w-0 items-center gap-3">

            <a
                href="{{ route('voters.index') }}"
                class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl
                       border border-slate-200 bg-white text-slate-500
                       shadow-sm transition
                       hover:border-blue-200 hover:bg-blue-50 hover:text-blue-600
                       dark:border-white/10 dark:bg-[#101a2f] dark:text-slate-400
                       dark:hover:border-blue-500/30 dark:hover:bg-blue-500/10 dark:hover:text-blue-400"
                title="Back to voters"
            >
                <svg
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 19l-7-7 7-7"
                    />
                </svg>
            </a>

            <div class="min-w-0">

                <div class="flex items-center gap-2">

                    <span
                        class="text-[11px] font-bold uppercase tracking-[0.18em]
                               text-blue-600 dark:text-blue-400"
                    >
                        Voter Profile
                    </span>

                    @if($voter->status === 'active')

                        <span
                            class="inline-flex items-center gap-1.5 rounded-full
                                   bg-emerald-50 px-2.5 py-1
                                   text-[10px] font-bold text-emerald-700
                                   ring-1 ring-inset ring-emerald-200
                                   dark:bg-emerald-500/10
                                   dark:text-emerald-400
                                   dark:ring-emerald-500/20"
                        >
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                            Active
                        </span>

                    @elseif($voter->status === 'suspended')

                        <span
                            class="inline-flex items-center gap-1.5 rounded-full
                                   bg-red-50 px-2.5 py-1
                                   text-[10px] font-bold text-red-700
                                   ring-1 ring-inset ring-red-200
                                   dark:bg-red-500/10
                                   dark:text-red-400
                                   dark:ring-red-500/20"
                        >
                            <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>
                            Suspended
                        </span>

                    @else

                        <span
                            class="inline-flex items-center gap-1.5 rounded-full
                                   bg-slate-100 px-2.5 py-1
                                   text-[10px] font-bold text-slate-600
                                   ring-1 ring-inset ring-slate-200
                                   dark:bg-white/5
                                   dark:text-slate-400
                                   dark:ring-white/10"
                        >
                            <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                            Inactive
                        </span>

                    @endif

                </div>

                <h1
                    class="mt-1 truncate text-2xl font-black tracking-tight
                           text-slate-900 dark:text-white sm:text-3xl"
                >
                    {{ $voter->name }}
                </h1>

                <p class="mt-0.5 text-sm text-slate-500 dark:text-slate-400">
                    Registered voter · {{ $voter->voter_id }}
                </p>

            </div>

        </div>


        {{-- Actions --}}

        <div class="flex items-center gap-2">

            <a
                href="{{ route('voters.edit', $voter) }}"
                class="inline-flex items-center gap-2 rounded-xl
                       bg-blue-600 px-4 py-2.5
                       text-sm font-bold text-white
                       shadow-lg shadow-blue-600/20
                       transition
                       hover:bg-blue-700
                       hover:shadow-blue-600/30"
            >
                <svg
                    class="h-4 w-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 20h9"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M16.5 3.5a2.12 2.12 0 013 3L7 19l-4 1 1-4L16.5 3.5z"
                    />
                </svg>

                Edit Voter
            </a>


            <form
                method="POST"
                action="{{ route('voters.destroy', $voter) }}"
                onsubmit="return confirm('Are you sure you want to delete {{ addslashes($voter->name) }}? This voter will be removed from the active voter registry.');"
            >

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="inline-flex items-center gap-2 rounded-xl
                           border border-red-200
                           bg-red-50
                           px-4 py-2.5
                           text-sm font-bold
                           text-red-600
                           transition
                           hover:bg-red-100
                           dark:border-red-500/20
                           dark:bg-red-500/10
                           dark:text-red-400
                           dark:hover:bg-red-500/20"
                >
                    <svg
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3 6h18"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M8 6V4a1 1 0 011-1h6a1 1 0 011 1v2"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19 6l-1 14H6L5 6"
                        />
                    </svg>

                    <span class="hidden sm:inline">Delete</span>
                </button>

            </form>

        </div>

    </div>



    {{-- ============================================================
        VOTER PROFILE HERO
    ============================================================= --}}

    <div
        class="overflow-hidden rounded-3xl border border-slate-200
               bg-white shadow-sm
               dark:border-white/10 dark:bg-[#101a2f]"
    >

        <div class="h-1.5 bg-gradient-to-r from-blue-600 via-indigo-500 to-cyan-400"></div>

        <div class="p-5 lg:p-6">

            <div
                class="grid gap-6 lg:grid-cols-[minmax(0,1fr)_minmax(300px,0.7fr)] lg:items-center"
            >

                {{-- Identity --}}

                <div class="flex min-w-0 items-center gap-5">

                    @if($voter->photo)

                        <img
                            src="{{ asset('storage/' . $voter->photo) }}"
                            alt="{{ $voter->name }}"
                            class="h-24 w-24 shrink-0 rounded-2xl
                                   object-cover ring-4 ring-blue-50
                                   dark:ring-blue-500/10"
                        >

                    @else

                        <div
                            class="flex h-24 w-24 shrink-0
                                   items-center justify-center
                                   rounded-2xl
                                   bg-gradient-to-br
                                   from-blue-600
                                   to-cyan-500
                                   text-3xl font-black
                                   text-white
                                   shadow-lg shadow-blue-500/20"
                        >
                            {{ strtoupper(substr($voter->name, 0, 1)) }}
                        </div>

                    @endif


                    <div class="min-w-0">

                        <h2
                            class="truncate text-2xl font-black
                                   text-slate-900 dark:text-white"
                        >
                            {{ $voter->name }}
                        </h2>

                        <div class="mt-2 flex flex-wrap items-center gap-2">

                            <span
                                class="inline-flex items-center gap-1.5 rounded-lg
                                       bg-slate-100 px-2.5 py-1.5
                                       font-mono text-xs font-semibold
                                       text-slate-600
                                       dark:bg-white/5
                                       dark:text-slate-300"
                            >
                                {{ $voter->voter_id }}
                            </span>

                            @if($voter->verified_at)

                                <span
                                    class="inline-flex items-center gap-1.5 rounded-lg
                                           bg-emerald-50 px-2.5 py-1.5
                                           text-xs font-semibold text-emerald-700
                                           dark:bg-emerald-500/10
                                           dark:text-emerald-400"
                                >

                                    <svg
                                        class="h-3.5 w-3.5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M5 13l4 4L19 7"
                                        />
                                    </svg>

                                    Verified
                                </span>

                            @else

                                <span
                                    class="inline-flex items-center gap-1.5 rounded-lg
                                           bg-amber-50 px-2.5 py-1.5
                                           text-xs font-semibold text-amber-700
                                           dark:bg-amber-500/10
                                           dark:text-amber-400"
                                >
                                    Not verified
                                </span>

                            @endif

                        </div>

                        <p class="mt-3 text-sm text-slate-500 dark:text-slate-400">
                            Registered {{ $voter->created_at->format('M d, Y') }}
                        </p>

                    </div>

                </div>


                {{-- Contact summary --}}

                <div class="grid grid-cols-2 gap-3">

                    <div
                        class="rounded-2xl border border-slate-100
                               bg-slate-50 p-4
                               dark:border-white/5
                               dark:bg-white/[0.03]"
                    >

                        <p
                            class="text-[10px] font-bold uppercase
                                   tracking-wider text-slate-400"
                        >
                            Email
                        </p>

                        <p
                            class="mt-1 truncate text-sm font-semibold
                                   text-slate-800 dark:text-slate-200"
                        >
                            {{ $voter->email ?: 'Not provided' }}
                        </p>

                    </div>


                    <div
                        class="rounded-2xl border border-slate-100
                               bg-slate-50 p-4
                               dark:border-white/5
                               dark:bg-white/[0.03]"
                    >

                        <p
                            class="text-[10px] font-bold uppercase
                                   tracking-wider text-slate-400"
                        >
                            Phone
                        </p>

                        <p
                            class="mt-1 text-sm font-semibold
                                   text-slate-800 dark:text-slate-200"
                        >
                            {{ $voter->phone ?: 'Not provided' }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>



    {{-- ============================================================
        STATISTICS
    ============================================================= --}}

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

        {{-- Elections --}}

        <div
            class="rounded-2xl border border-blue-100
                   bg-gradient-to-br from-blue-50 to-white
                   p-5 shadow-sm
                   dark:border-blue-500/10
                   dark:from-blue-500/10
                   dark:to-[#101a2f]"
        >

            <div class="flex items-start justify-between">

                <div>

                    <p
                        class="text-xs font-bold uppercase tracking-wider
                               text-slate-500 dark:text-slate-400"
                    >
                        Elections
                    </p>

                    <p class="mt-2 text-3xl font-black text-blue-600 dark:text-blue-400">
                        {{ $voter->elections->count() }}
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Assigned elections
                    </p>

                </div>

                <div
                    class="flex h-11 w-11 items-center justify-center
                           rounded-xl
                           bg-blue-100 text-blue-600
                           dark:bg-blue-500/10
                           dark:text-blue-400"
                >

                    <svg
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z"
                        />
                    </svg>

                </div>

            </div>

        </div>


        {{-- Eligible --}}

        <div
            class="rounded-2xl border border-emerald-100
                   bg-gradient-to-br from-emerald-50 to-white
                   p-5 shadow-sm
                   dark:border-emerald-500/10
                   dark:from-emerald-500/10
                   dark:to-[#101a2f]"
        >

            <div class="flex items-start justify-between">

                <div>

                    <p
                        class="text-xs font-bold uppercase tracking-wider
                               text-slate-500 dark:text-slate-400"
                    >
                        Eligible Elections
                    </p>

                    <p class="mt-2 text-3xl font-black text-emerald-600 dark:text-emerald-400">
                        {{ $voter->electionVoters->where('is_eligible', true)->count() }}
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Can participate
                    </p>

                </div>

                <div
                    class="flex h-11 w-11 items-center justify-center
                           rounded-xl
                           bg-emerald-100 text-emerald-600
                           dark:bg-emerald-500/10
                           dark:text-emerald-400"
                >

                    <svg
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M5 12l4 4L19 6"
                        />
                    </svg>

                </div>

            </div>

        </div>


        {{-- Voted --}}

        <div
            class="rounded-2xl border border-purple-100
                   bg-gradient-to-br from-purple-50 to-white
                   p-5 shadow-sm
                   dark:border-purple-500/10
                   dark:from-purple-500/10
                   dark:to-[#101a2f]"
        >

            <div class="flex items-start justify-between">

                <div>

                    <p
                        class="text-xs font-bold uppercase tracking-wider
                               text-slate-500 dark:text-slate-400"
                    >
                        Elections Voted
                    </p>

                    <p class="mt-2 text-3xl font-black text-purple-600 dark:text-purple-400">
                        {{ $voter->electionVoters->where('has_voted', true)->count() }}
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Completed ballots
                    </p>

                </div>

                <div
                    class="flex h-11 w-11 items-center justify-center
                           rounded-xl
                           bg-purple-100 text-purple-600
                           dark:bg-purple-500/10
                           dark:text-purple-400"
                >

                    <svg
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 12l2 2 4-4"
                        />
                        <circle cx="12" cy="12" r="9"/>
                    </svg>

                </div>

            </div>

        </div>

    </div>



    {{-- ============================================================
        ELECTION PARTICIPATION
    ============================================================= --}}

    <div
        class="overflow-hidden rounded-3xl border border-slate-200
               bg-white shadow-sm
               dark:border-white/10 dark:bg-[#101a2f]"
    >

        {{-- Section header --}}

        <div
            class="border-b border-slate-100 px-5 py-5
                   dark:border-white/10 sm:px-6"
        >

            <div
                class="flex flex-col gap-4
                       sm:flex-row sm:items-center
                       sm:justify-between"
            >

                <div>

                    <div class="flex items-center gap-2">

                        <div
                            class="flex h-9 w-9 items-center justify-center
                                   rounded-xl
                                   bg-blue-50 text-blue-600
                                   dark:bg-blue-500/10
                                   dark:text-blue-400"
                        >

                            <svg
                                class="h-4 w-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1-1V6a1 1 0 011-1z"
                                />
                            </svg>

                        </div>

                        <h2 class="text-lg font-black text-slate-900 dark:text-white">
                            Election Participation
                        </h2>

                    </div>

                    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
                        Manage this voter's eligibility, accreditation and voting status for each election.
                    </p>

                </div>


                <a
                    href="{{ route('voters.elections.create', $voter) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl
                           bg-blue-600 px-4 py-2.5
                           text-sm font-bold text-white
                           shadow-lg shadow-blue-600/20
                           transition
                           hover:bg-blue-700"
                >

                    <svg
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 4v16M4 12h16"
                        />
                    </svg>

                    Assign to Election

                </a>

            </div>

        </div>



        {{-- Election cards --}}

        @if($voter->electionVoters->count())

            <div class="space-y-3 p-4 sm:p-5">

                @foreach($voter->electionVoters as $electionVoter)

                    @php

                        $election = $electionVoter->election;

                        /*
                        |--------------------------------------------------------------------------
                        | Election timeline status
                        |--------------------------------------------------------------------------
                        |
                        | This status is based on the actual voting window,
                        | not the technical database status.
                        |
                        */

                        $now = now();

                        $isUpcoming =
                            $election?->starts_at &&
                            $now->lt($election->starts_at);

                        $isOpen =
                            $election?->starts_at &&
                            $election?->ends_at &&
                            $now->between(
                                $election->starts_at,
                                $election->ends_at
                            );

                        $isClosed =
                            $election?->ends_at &&
                            $now->gt($election->ends_at);

                    @endphp


                    @if($election)

                        <div
                            class="group overflow-hidden rounded-2xl
                                   border border-slate-200
                                   bg-white
                                   transition-all duration-200
                                   hover:-translate-y-0.5
                                   hover:border-blue-200
                                   hover:shadow-lg
                                   hover:shadow-slate-200/60
                                   dark:border-white/10
                                   dark:bg-[#0d172a]
                                   dark:hover:border-blue-500/30
                                   dark:hover:shadow-blue-950/20"
                        >

                            <div class="p-4 sm:p-5">

                                {{-- ================================================= --}}
                                {{-- ELECTION IDENTITY --}}
                                {{-- ================================================= --}}

                                <div
                                    class="flex items-start justify-between gap-4"
                                >

                                    <div class="flex min-w-0 items-start gap-4">

                                        <div
                                            class="flex h-12 w-12 shrink-0
                                                   items-center justify-center
                                                   rounded-2xl
                                                   bg-gradient-to-br
                                                   from-blue-600
                                                   to-cyan-500
                                                   text-white
                                                   shadow-md
                                                   shadow-blue-500/20"
                                        >

                                            <svg
                                                class="h-5 w-5"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z"
                                                />
                                            </svg>

                                        </div>


                                        <div class="min-w-0">

                                            <div class="flex flex-wrap items-center gap-2">

                                                <p
                                                    class="text-[10px] font-bold
                                                           uppercase tracking-[0.18em]
                                                           text-blue-600
                                                           dark:text-blue-400"
                                                >
                                                    {{ $election->organization->name ?? 'Organization' }}
                                                </p>


                                                {{-- ================================================= --}}
                                                {{-- VOTER-FACING ELECTION STATUS --}}
                                                {{-- ================================================= --}}

                                                @if($electionVoter->has_voted)

                                                    <span
                                                        class="inline-flex items-center gap-1.5
                                                               rounded-full
                                                               bg-purple-50
                                                               px-2.5 py-1
                                                               text-[10px]
                                                               font-bold
                                                               text-purple-700
                                                               ring-1 ring-inset
                                                               ring-purple-200
                                                               dark:bg-purple-500/10
                                                               dark:text-purple-400
                                                               dark:ring-purple-500/20"
                                                    >
                                                        <span class="h-1.5 w-1.5 rounded-full bg-purple-500"></span>
                                                        Voted
                                                    </span>

                                                @elseif($isClosed)

                                                    <span
                                                        class="inline-flex items-center gap-1.5
                                                               rounded-full
                                                               bg-slate-100
                                                               px-2.5 py-1
                                                               text-[10px]
                                                               font-bold
                                                               text-slate-600
                                                               ring-1 ring-inset
                                                               ring-slate-200
                                                               dark:bg-white/5
                                                               dark:text-slate-400
                                                               dark:ring-white/10"
                                                    >
                                                        <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                                                        Closed
                                                    </span>

                                                @elseif($isOpen)

                                                    <span
                                                        class="inline-flex items-center gap-1.5
                                                               rounded-full
                                                               bg-emerald-50
                                                               px-2.5 py-1
                                                               text-[10px]
                                                               font-bold
                                                               text-emerald-700
                                                               ring-1 ring-inset
                                                               ring-emerald-200
                                                               dark:bg-emerald-500/10
                                                               dark:text-emerald-400
                                                               dark:ring-emerald-500/20"
                                                    >
                                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                                        Voting Open
                                                    </span>

                                                @elseif($isUpcoming)

                                                    <span
                                                        class="inline-flex items-center gap-1.5
                                                               rounded-full
                                                               bg-blue-50
                                                               px-2.5 py-1
                                                               text-[10px]
                                                               font-bold
                                                               text-blue-700
                                                               ring-1 ring-inset
                                                               ring-blue-200
                                                               dark:bg-blue-500/10
                                                               dark:text-blue-400
                                                               dark:ring-blue-500/20"
                                                    >
                                                        <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>
                                                        Upcoming
                                                    </span>

                                                @else

                                                    <span
                                                        class="inline-flex items-center gap-1.5
                                                               rounded-full
                                                               bg-slate-100
                                                               px-2.5 py-1
                                                               text-[10px]
                                                               font-bold
                                                               text-slate-600
                                                               ring-1 ring-inset
                                                               ring-slate-200
                                                               dark:bg-white/5
                                                               dark:text-slate-400"
                                                    >
                                                        <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                                                        Not Scheduled
                                                    </span>

                                                @endif

                                            </div>


                                            <h3
                                                class="mt-1 text-lg font-black
                                                       text-slate-900
                                                       dark:text-white"
                                            >
                                                {{ $election->title }}
                                            </h3>


                                            {{-- Election type + window --}}

                                            <div class="mt-2 flex flex-wrap items-center gap-2">

                                                @if($election->electionType)

                                                    <span
                                                        class="inline-flex items-center rounded-lg
                                                               bg-slate-100
                                                               px-2.5 py-1
                                                               text-[11px] font-semibold
                                                               text-slate-600
                                                               dark:bg-white/5
                                                               dark:text-slate-300"
                                                    >
                                                        {{ $election->electionType->name }}
                                                    </span>

                                                @endif


                                                @if($election->starts_at)

                                                    <span class="text-xs text-slate-400">
                                                        {{ $election->starts_at->format('M d, Y') }}
                                                    </span>

                                                @endif


                                                @if($election->starts_at && $election->ends_at)

                                                    <span class="text-slate-300 dark:text-slate-600">
                                                        →
                                                    </span>

                                                    <span class="text-xs text-slate-400">
                                                        {{ $election->ends_at->format('M d, Y') }}
                                                    </span>

                                                @endif

                                            </div>

                                        </div>

                                    </div>

                                </div>



                                {{-- ================================================= --}}
                                {{-- STATUS GRID --}}
                                {{-- ================================================= --}}

                                <div
                                    class="mt-5 grid grid-cols-3 gap-3"
                                >

                                    {{-- Eligibility --}}

                                    <div
                                        class="rounded-xl
                                               border border-slate-100
                                               bg-slate-50 p-4
                                               dark:border-white/5
                                               dark:bg-white/[0.03]"
                                    >

                                        <p
                                            class="text-[10px] font-bold
                                                   uppercase tracking-wider
                                                   text-slate-400"
                                        >
                                            Eligibility
                                        </p>

                                        <div class="mt-2">

                                            @if($electionVoter->is_eligible)

                                                <span
                                                    class="inline-flex items-center gap-2
                                                           rounded-lg
                                                           bg-emerald-50
                                                           px-2.5 py-1.5
                                                           text-xs font-bold
                                                           text-emerald-700
                                                           dark:bg-emerald-500/10
                                                           dark:text-emerald-400"
                                                >
                                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                                    Eligible
                                                </span>

                                            @else

                                                <span
                                                    class="inline-flex items-center gap-2
                                                           rounded-lg
                                                           bg-red-50
                                                           px-2.5 py-1.5
                                                           text-xs font-bold
                                                           text-red-700
                                                           dark:bg-red-500/10
                                                           dark:text-red-400"
                                                >
                                                    <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>
                                                    Not Eligible
                                                </span>

                                            @endif

                                        </div>

                                    </div>



                                   {{-- ================================================= --}}
{{-- ACCREDITATION --}}
{{-- ================================================= --}}

@if($isClosed)

    {{-- Closed election: no action needed --}}

    <div
        class="rounded-xl
               border border-slate-100
               bg-slate-50 p-4
               dark:border-white/5
               dark:bg-white/[0.03]"
    >

        <p
            class="text-[10px] font-bold
                   uppercase tracking-wider
                   text-slate-400"
        >
            Accreditation
        </p>

        <div class="mt-2">

            <span
                class="inline-flex items-center gap-2
                       rounded-lg
                       bg-slate-100
                       px-2.5 py-1.5
                       text-xs font-bold
                       text-slate-500
                       dark:bg-white/5
                       dark:text-slate-400"
            >

                <span
                    class="h-1.5 w-1.5 rounded-full
                           bg-slate-400"
                ></span>

                Not Required

            </span>

        </div>

    </div>


@elseif($electionVoter->accreditation_status === 'accredited')

    {{-- Accredited --}}

    <div
        class="rounded-xl
               border border-blue-100
               bg-blue-50/60 p-4
               dark:border-blue-500/10
               dark:bg-blue-500/[0.05]"
    >

        <p
            class="text-[10px] font-bold
                   uppercase tracking-wider
                   text-slate-400"
        >
            Accreditation
        </p>

        <div class="mt-2">

            <span
                class="inline-flex items-center gap-2
                       rounded-lg
                       bg-blue-50
                       px-2.5 py-1.5
                       text-xs font-bold
                       text-blue-700
                       dark:bg-blue-500/10
                       dark:text-blue-400"
            >

                <span
                    class="h-1.5 w-1.5 rounded-full
                           bg-blue-500"
                ></span>

                Accredited

            </span>

        </div>

    </div>


@elseif($electionVoter->accreditation_status === 'rejected')

    {{-- Rejected --}}

    <div
        class="rounded-xl
               border border-red-100
               bg-red-50/60 p-4
               dark:border-red-500/10
               dark:bg-red-500/[0.05]"
    >

        <p
            class="text-[10px] font-bold
                   uppercase tracking-wider
                   text-slate-400"
        >
            Accreditation
        </p>

        <div class="mt-2">

            <span
                class="inline-flex items-center gap-2
                       rounded-lg
                       bg-red-50
                       px-2.5 py-1.5
                       text-xs font-bold
                       text-red-700
                       dark:bg-red-500/10
                       dark:text-red-400"
            >

                <span
                    class="h-1.5 w-1.5 rounded-full
                           bg-red-500"
                ></span>

                Rejected

            </span>

        </div>

    </div>


@else

    {{-- ================================================= --}}
    {{-- PENDING — CLICKABLE --}}
    {{-- ================================================= --}}

    <a
        href="{{ route(
            'accreditation.show',
            [
                'voter' => $voter,
                'election' => $election
            ]
        ) }}"
        class="group block rounded-xl
               border border-amber-200
               bg-amber-50/70
               p-4
               transition-all duration-200
               hover:-translate-y-0.5
               hover:border-amber-300
               hover:bg-amber-50
               hover:shadow-md
               hover:shadow-amber-200/40
               dark:border-amber-500/20
               dark:bg-amber-500/[0.06]
               dark:hover:border-amber-500/40
               dark:hover:bg-amber-500/[0.10]"
    >

        <div class="flex items-start justify-between gap-3">

            <div class="min-w-0">

                <p
                    class="text-[10px] font-bold
                           uppercase tracking-wider
                           text-slate-400"
                >
                    Accreditation
                </p>

                <div class="mt-2">

                    <span
                        class="inline-flex items-center gap-2
                               rounded-lg
                               bg-amber-50
                               px-2.5 py-1.5
                               text-xs font-bold
                               text-amber-700
                               ring-1 ring-inset
                               ring-amber-200
                               dark:bg-amber-500/10
                               dark:text-amber-400
                               dark:ring-amber-500/20"
                    >

                        <span
                            class="h-1.5 w-1.5 rounded-full
                                   bg-amber-500"
                        ></span>

                        Pending

                    </span>

                </div>

                <p
                    class="mt-2 text-[11px]
                           font-medium
                           text-amber-700/70
                           dark:text-amber-400/70"
                >
                    Click to open accreditation
                </p>

            </div>


            {{-- Arrow --}}

            <div
                class="flex h-8 w-8 shrink-0
                       items-center justify-center
                       rounded-lg
                       bg-white
                       text-amber-600
                       shadow-sm
                       transition-transform
                       group-hover:translate-x-0.5
                       dark:bg-amber-500/10
                       dark:text-amber-400"
            >

                <x-heroicon-o-arrow-right class="h-4 w-4"/>

            </div>

        </div>

    </a>

@endif
                                        </div>

                                    </div>



                                    {{-- Voting --}}

                                    <div
                                        class="rounded-xl
                                               border border-slate-100
                                               bg-slate-50 p-4
                                               dark:border-white/5
                                               dark:bg-white/[0.03]"
                                    >

                                        <p
                                            class="text-[10px] font-bold
                                                   uppercase tracking-wider
                                                   text-slate-400"
                                        >
                                            Voting Status
                                        </p>

                                        <div class="mt-2">

                                            @if($electionVoter->has_voted)

                                                <span
                                                    class="inline-flex items-center gap-2
                                                           rounded-lg
                                                           bg-purple-50
                                                           px-2.5 py-1.5
                                                           text-xs font-bold
                                                           text-purple-700
                                                           dark:bg-purple-500/10
                                                           dark:text-purple-400"
                                                >

                                                    <span
                                                        class="h-1.5 w-1.5 rounded-full
                                                               bg-purple-500"
                                                    ></span>

                                                    Voted

                                                </span>

                                            @else

                                                <span
                                                    class="inline-flex items-center gap-2
                                                           rounded-lg
                                                           bg-slate-100
                                                           px-2.5 py-1.5
                                                           text-xs font-bold
                                                           text-slate-600
                                                           dark:bg-white/5
                                                           dark:text-slate-400"
                                                >

                                                    <span
                                                        class="h-1.5 w-1.5 rounded-full
                                                               bg-slate-400"
                                                    ></span>

                                                    Not Voted

                                                </span>

                                            @endif

                                        </div>

                                    </div>

                                </div>

						{{-- ================================================= --}}
{{-- VOTING ACTION --}}
{{-- ================================================= --}}

@if(
    $electionVoter->is_eligible &&
    $electionVoter->accreditation_status === 'accredited' &&
    !$electionVoter->has_voted
)

    @if($isOpen)

        {{-- ================================================= --}}
        {{-- READY TO VOTE --}}
        {{-- ================================================= --}}

        <div
            class="mt-4 flex flex-col gap-4
                   rounded-2xl
                   border border-emerald-200
                   bg-gradient-to-r
                   from-emerald-50
                   via-white
                   to-teal-50
                   p-5
                   dark:border-emerald-500/20
                   dark:from-emerald-500/10
                   dark:via-[#101a2f]
                   dark:to-teal-500/10
                   sm:flex-row
                   sm:items-center
                   sm:justify-between"
        >

            <div class="flex items-center gap-3">

                <div
                    class="flex h-11 w-11 shrink-0
                           items-center justify-center
                           rounded-xl
                           bg-emerald-100
                           text-emerald-600
                           dark:bg-emerald-500/10
                           dark:text-emerald-400"
                >

                    <x-heroicon-o-check-badge class="h-6 w-6"/>

                </div>

                <div>

                    <p
                        class="text-sm font-black
                               text-emerald-900
                               dark:text-emerald-300"
                    >
                        You're Ready to Vote
                    </p>

                    <p
                        class="mt-0.5 text-xs
                               text-emerald-700/70
                               dark:text-emerald-400/70"
                    >
                        Your accreditation is complete and voting is now open.
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
                class="group inline-flex
                       items-center justify-center
                       gap-2
                       rounded-xl
                       bg-gradient-to-r
                       from-emerald-600
                       to-teal-500
                       px-6 py-3
                       text-sm font-black
                       text-white
                       shadow-lg
                       shadow-emerald-600/20
                       transition-all duration-200
                       hover:-translate-y-0.5
                       hover:shadow-xl
                       hover:shadow-emerald-600/30"
            >

                <x-heroicon-o-check-badge class="h-5 w-5"/>

                Proceed to Vote

                <x-heroicon-o-arrow-right
                    class="h-4 w-4 transition-transform
                           group-hover:translate-x-0.5"
                />

            </a>

        </div>


    @elseif($isUpcoming)

        {{-- ================================================= --}}
        {{-- WAITING FOR ELECTION TO OPEN --}}
        {{-- ================================================= --}}

        <div
            class="mt-4 flex flex-col gap-4
                   rounded-2xl
                   border border-blue-200
                   bg-gradient-to-r
                   from-blue-50
                   via-white
                   to-cyan-50
                   p-5
                   dark:border-blue-500/20
                   dark:from-blue-500/10
                   dark:via-[#101a2f]
                   dark:to-cyan-500/10
                   sm:flex-row
                   sm:items-center
                   sm:justify-between"
        >

            <div class="flex items-center gap-3">

                <div
                    class="flex h-11 w-11 shrink-0
                           items-center justify-center
                           rounded-xl
                           bg-blue-100
                           text-blue-600
                           dark:bg-blue-500/10
                           dark:text-blue-400"
                >

                    <x-heroicon-o-clock class="h-6 w-6"/>

                </div>

                <div>

                    <p
                        class="text-sm font-black
                               text-blue-900
                               dark:text-blue-300"
                    >
                        You're Accredited
                    </p>

                    <p
                        class="mt-0.5 text-xs
                               text-blue-700/70
                               dark:text-blue-400/70"
                    >
                        Voting opens
                        {{ $election->starts_at?->format('d M Y \a\t h:i A') }}.
                    </p>

                </div>

            </div>


            <span
                class="inline-flex items-center
                       justify-center gap-2
                       rounded-xl
                       border border-blue-200
                       bg-white
                       px-5 py-3
                       text-sm font-bold
                       text-blue-600
                       dark:border-blue-500/20
                       dark:bg-white/5
                       dark:text-blue-400"
            >

                <x-heroicon-o-lock-closed class="h-4 w-4"/>

                Voting Not Open Yet

            </span>

        </div>

    @endif

@endif

                                {{-- ================================================= --}}
                                {{-- BOTTOM METADATA --}}
                                {{-- ================================================= --}}

                                <div
                                    class="mt-4 flex items-center justify-between gap-4
                                           border-t border-slate-100 pt-3
                                           dark:border-white/10"
                                >

                                    <div
                                        class="flex flex-wrap items-center
                                               gap-x-5 gap-y-2
                                               text-xs text-slate-400"
                                    >

                                        <span>
                                            Assigned {{ $electionVoter->created_at->format('M d, Y') }}
                                        </span>


                                        @if($election->starts_at && $isUpcoming)

                                            <span>
                                                Starts {{ $election->starts_at->format('M d, Y g:i A') }}
                                            </span>

                                        @elseif($election->ends_at && $isClosed)

                                            <span>
                                                Closed {{ $election->ends_at->format('M d, Y g:i A') }}
                                            </span>

                                        @elseif($isOpen && $election->ends_at)

                                            <span>
                                                Closes {{ $election->ends_at->format('M d, Y g:i A') }}
                                            </span>

                                        @endif


                                        @if($electionVoter->has_voted && $electionVoter->voted_at)

                                            <span>
                                                Voted {{ $electionVoter->voted_at->format('M d, Y g:i A') }}
                                            </span>

                                        @endif

                                    </div>


                                    {{-- ================================================= --}}
                                    {{-- ELECTION ACTION --}}
                                    {{-- ================================================= --}}

                                    <div>

                                        @if($isClosed)

                                            {{-- Historical election --}}

                                            <span
                                                class="inline-flex items-center gap-2
                                                       rounded-lg
                                                       bg-slate-100
                                                       px-3 py-2
                                                       text-xs font-bold
                                                       text-slate-500
                                                       dark:bg-white/5
                                                       dark:text-slate-400"
                                            >

                                                <svg
                                                    class="h-4 w-4"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                >
                                                    <rect
                                                        x="5"
                                                        y="11"
                                                        width="14"
                                                        height="10"
                                                        rx="2"
                                                    />

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M8 11V8a4 4 0 018 0v3"
                                                    />
                                                </svg>

                                                Historical Record

                                            </span>

                                        @elseif($electionVoter->has_voted)

                                            {{-- Already voted --}}

                                            <span
                                                class="inline-flex items-center gap-2
                                                       rounded-lg
                                                       bg-purple-50
                                                       px-3 py-2
                                                       text-xs font-bold
                                                       text-purple-700
                                                       dark:bg-purple-500/10
                                                       dark:text-purple-400"
                                            >

                                                <x-heroicon-o-check-circle class="h-4 w-4"/>

                                                Voted

                                            </span>

                                        @else

                                            {{-- Active/upcoming election --}}

                                            <form
                                                method="POST"
                                                action="{{ route(
                                                    'voters.elections.destroy',
                                                    [$voter, $election]
                                                ) }}"
                                                onsubmit="return confirm('Remove this voter from {{ addslashes($election->title) }}?');"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center gap-2
                                                           rounded-lg
                                                           border border-red-200
                                                           bg-red-50
                                                           px-3 py-2
                                                           text-xs font-bold
                                                           text-red-600
                                                           transition
                                                           hover:bg-red-100
                                                           dark:border-red-500/20
                                                           dark:bg-red-500/10
                                                           dark:text-red-400
                                                           dark:hover:bg-red-500/20"
                                                >

                                                    <x-heroicon-o-trash class="h-4 w-4"/>

                                                    Remove

                                                </button>

                                            </form>

                                        @endif

                                    </div>

                                </div>

                            </div>

                        </div>

                    @endif

                @endforeach

            </div>

        @else

            {{-- ================================================= --}}
            {{-- EMPTY STATE --}}
            {{-- ================================================= --}}

            <div class="px-6 py-16 text-center">

                <div
                    class="mx-auto flex h-16 w-16 items-center justify-center
                           rounded-2xl
                           bg-blue-50 text-blue-600
                           dark:bg-blue-500/10
                           dark:text-blue-400"
                >

                    <svg
                        class="h-7 w-7"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z"
                        />
                    </svg>

                </div>

                <h3 class="mt-4 text-base font-bold text-slate-900 dark:text-white">
                    No election participation yet
                </h3>

                <p
                    class="mx-auto mt-2 max-w-md
                           text-sm text-slate-500
                           dark:text-slate-400"
                >
                    This voter has not been assigned to any election.
                    Assign an election to define where this voter can participate.
                </p>

                <a
                    href="{{ route('voters.elections.create', $voter) }}"
                    class="mt-5 inline-flex items-center gap-2
                           rounded-xl
                           bg-blue-600
                           px-4 py-2.5
                           text-sm font-bold text-white
                           shadow-lg shadow-blue-600/20
                           transition
                           hover:bg-blue-700"
                >

                    <svg
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 4v16M4 12h16"
                        />
                    </svg>

                    Assign First Election

                </a>

            </div>

        @endif

    </div>



    {{-- ============================================================
        SECURITY NOTICE
    ============================================================= --}}

    <div
        class="rounded-2xl
               border border-blue-100
               bg-blue-50/70
               p-5
               dark:border-blue-500/10
               dark:bg-blue-500/[0.05]"
    >

        <div class="flex gap-3">

            <div
                class="flex h-9 w-9 shrink-0
                       items-center justify-center
                       rounded-xl
                       bg-white
                       text-blue-600
                       shadow-sm
                       dark:bg-blue-500/10
                       dark:text-blue-400"
            >

                <svg
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <circle cx="12" cy="12" r="9"/>

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 10v6m0-9h.01"
                    />
                </svg>

            </div>

            <div>

                <p class="text-sm font-bold text-blue-900 dark:text-blue-300">
                    Election-specific security
                </p>

                <p
                    class="mt-1 text-xs leading-5
                           text-blue-700/70
                           dark:text-slate-400"
                >
                    Eligibility, accreditation and voting status are tracked separately
                    for every election. Being registered as a voter does not automatically
                    make the voter eligible for every election.
                </p>

            </div>

        </div>

    </div>

</div>

@endsection