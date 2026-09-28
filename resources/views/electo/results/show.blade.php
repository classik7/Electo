@extends('layouts.app')

@section('page-title', 'Election Results')

@section('content')

<div class="min-h-screen bg-[#0B1730] px-6 py-8">

    <!-- ===================================================== -->
<!-- COMPACT PREMIUM RESULTS HEADER -->
<!-- ===================================================== -->

<div class="mb-6">

    <div
        class="relative overflow-hidden rounded-3xl
               border border-white/10
               bg-white/[0.035]
               px-6 py-4
               backdrop-blur-xl
               shadow-[0_12px_40px_rgba(0,0,0,0.16)]"
    >

        <!-- Subtle background glow -->

        <div
            class="pointer-events-none absolute
                   -left-16 -top-16
                   h-32 w-32
                   rounded-full
                   bg-blue-500/10
                   blur-3xl"
        ></div>

        <div
            class="pointer-events-none absolute
                   -right-16 -bottom-16
                   h-32 w-32
                   rounded-full
                   bg-cyan-400/10
                   blur-3xl"
        ></div>


        <!-- ================================================= -->
        <!-- MAIN ROW -->
        <!-- ================================================= -->

        <div
            class="relative flex
                   min-h-[82px]
                   items-center
                   justify-between
                   gap-6"
        >


            <!-- ================================================= -->
            <!-- LEFT — ELECTO -->
            <!-- ================================================= -->

            <div
                class="flex
                       shrink-0
                       items-center
                       gap-3"
            >

                <!-- Logo -->

                <div
                    class="flex h-11 w-11
                           items-center
                           justify-center
                           rounded-xl
                           border border-cyan-300/20
                           bg-gradient-to-br
                           from-blue-600
                           via-blue-500
                           to-cyan-400
                           shadow-[0_6px_20px_rgba(6,182,212,0.20)]"
                >

                    <span class="text-xl">
                        🗳️
                    </span>

                </div>


                <!-- Brand -->

                <div>

                    <div class="flex items-center gap-2">

                        <h1
                            class="text-lg
                                   font-black
                                   tracking-tight
                                   text-white"
                        >
                            Electo
                        </h1>

                        <span
                            class="rounded-full
                                   border border-cyan-400/20
                                   bg-cyan-400/10
                                   px-2 py-0.5
                                   text-[7px]
                                   font-semibold
                                   uppercase
                                   tracking-wider
                                   text-cyan-300"
                        >
                            Results
                        </span>

                    </div>


                    <p
                        class="mt-0.5
                               text-[8px]
                               uppercase
                               tracking-[0.14em]
                               text-slate-500"
                    >
                        Secure Digital Elections
                    </p>

                </div>

            </div>



            <!-- ================================================= -->
<!-- CENTER — ELECTION -->
<!-- ================================================= -->

<div
    class="absolute
           left-1/2
           top-1/2
           w-full
           max-w-xl
           -translate-x-1/2
           -translate-y-1/2
           px-4
           text-center"
>

    <!-- Badges -->

    <div
        class="mb-1
               flex
               items-center
               justify-center
               gap-2"
    >

        <span
            class="rounded-full
                   border border-cyan-400/20
                   bg-cyan-400/10
                   px-2.5 py-0.5
                   text-[8px]
                   font-semibold
                   uppercase
                   tracking-[0.14em]
                   text-cyan-300"
        >
            Election Results
        </span>


        @if($election->status === 'published')

            <span
                class="rounded-full
                       border border-emerald-400/20
                       bg-emerald-400/10
                       px-2.5 py-0.5
                       text-[8px]
                       font-semibold
                       uppercase
                       tracking-wider
                       text-emerald-300"
            >
                Published
            </span>

        @else

            <span
                class="rounded-full
                       border border-amber-400/20
                       bg-amber-400/10
                       px-2.5 py-0.5
                       text-[8px]
                       font-semibold
                       uppercase
                       tracking-wider
                       text-amber-300"
            >
                {{ ucfirst($election->status) }}
            </span>

        @endif

    </div>


    <!-- Election Title -->

    <h2
        class="text-xl
               font-black
               leading-none
               tracking-tight
               text-white
               lg:text-2xl"
    >
        {{ $election->title }}
    </h2>


   

</div>



            <!-- ================================================= -->
            <!-- RIGHT — BACK -->
            <!-- ================================================= -->

            <div
                class="ml-auto
                       shrink-0"
            >

                <a
                    href="{{ route('elections.show', $election) }}"
                    class="group inline-flex
                           items-center
                           gap-2
                           rounded-xl
                           border border-white/10
                           bg-white/[0.04]
                           px-3.5 py-2
                           text-[11px]
                           font-semibold
                           text-slate-300
                           backdrop-blur-xl
                           transition-all
                           duration-300
                           hover:-translate-y-0.5
                           hover:border-cyan-400/30
                           hover:bg-white/[0.08]
                           hover:text-white"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-3.5 w-3.5
                               transition-transform
                               duration-300
                               group-hover:-translate-x-1"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 19l-7-7 7-7"
                        />

                    </svg>

                    Back to Election

                </a>

            </div>

        </div>



        <!-- ================================================= -->
        <!-- VERIFICATION -->
        <!-- ================================================= -->

        <div
    class="relative
           mt-3
           border-t border-white/5
           pt-2.5
           flex
           items-center
           justify-center
           gap-2"
>

            <span
                class="h-1.5 w-1.5
                       rounded-full
                       bg-emerald-400
                       shadow-[0_0_8px_rgba(52,211,153,0.7)]"
            ></span>

            <span
                class="text-[8px]
                       font-medium
                       uppercase
                       tracking-[0.14em]
                       text-slate-500"
            >
                Results verified from submitted ballots
            </span>

        </div>

    </div>

</div>

<!-- ===================================================== -->
<!-- WINNERS SUMMARY -->
<!-- ===================================================== -->

@if($winners->isNotEmpty())

    <section
        class="mt-10 overflow-hidden rounded-3xl
               border border-cyan-400/10
               bg-gradient-to-br
               from-cyan-400/[0.04]
               via-white/[0.025]
               to-blue-500/[0.04]
               backdrop-blur-xl
               shadow-[0_15px_50px_rgba(0,0,0,0.18)]"
    >

        <!-- Header -->

        <div
            class="border-b border-white/10
                   px-6 py-5"
        >

            <div class="flex items-center justify-between">

                <div>

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-10 w-10
                                   items-center justify-center
                                   rounded-xl
                                   border border-amber-400/20
                                   bg-amber-400/10"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 text-amber-300"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M8 21h8M12 17v4M7 4h10v4a5 5 0 01-10 0V4z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M7 6H4v2a4 4 0 004 4M17 6h3v2a4 4 0 01-4 4"
                                />

                            </svg>

                        </div>


                        <div>

                            <h3
                                class="text-lg
                                       font-black
                                       text-white"
                            >
                                Winners Summary
                            </h3>

                            <p class="text-xs text-slate-500">

                                Official winners based on submitted ballots

                            </p>

                        </div>

                    </div>

                </div>


                <!-- Winner Count -->

                <div
                    class="rounded-xl
                           border border-emerald-400/20
                           bg-emerald-400/10
                           px-3 py-2"
                >

                    <span
                        class="text-xs
                               font-semibold
                               text-emerald-300"
                    >

                        {{ $winners->count() }}
                        {{ $winners->count() === 1 ? 'Winner' : 'Winners' }}

                    </span>

                </div>

            </div>

        </div>


        <!-- Winners -->

        <div
            class="grid
                   divide-y
                   divide-white/5
                   sm:grid-cols-2
                   sm:divide-y-0
                   sm:divide-x
                   sm:divide-white/5
                   lg:grid-cols-4"
        >

            @foreach($winners as $winner)

                <div
                    class="group
                           p-5
                           transition
                           hover:bg-white/[0.025]"
                >

                    <!-- Position -->

                    <p
                        class="text-[9px]
                               font-semibold
                               uppercase
                               tracking-[0.15em]
                               text-cyan-300/70"
                    >

                        {{ $winner['position']->name }}

                    </p>


                    <div class="mt-3 flex items-center gap-3">

                        <!-- Candidate Photo -->

                        <div
                            class="h-11 w-11
                                   shrink-0
                                   overflow-hidden
                                   rounded-xl
                                   border border-white/10
                                   bg-[#132544]"
                        >

                            @if($winner['candidate']->photo)

                                <img
                                    src="{{ asset('storage/' . $winner['candidate']->photo) }}"
                                    alt="{{ $winner['candidate']->name }}"
                                    class="h-full w-full object-cover"
                                >

                            @else

                                <div
                                    class="flex h-full w-full
                                           items-center justify-center
                                           text-sm font-bold
                                           text-cyan-300"
                                >

                                    {{ strtoupper(substr($winner['candidate']->name, 0, 1)) }}

                                </div>

                            @endif

                        </div>


                       <!-- Winner Information -->

<div class="min-w-0 flex-1">

    <p
        class="truncate
               text-sm
               font-bold
               text-white"
    >
        {{ $winner['candidate']->name }}
    </p>

    <p
        class="mt-0.5
               text-[10px]
               text-emerald-300"
    >
        {{ $winner['votes'] }}
        {{ $winner['votes'] === 1 ? 'vote' : 'votes' }}
    </p>


    <!-- Certificate Action -->

    @if(auth()->user()->hasAnyRole(['admin', 'election_official']))

        @php
            $certificate = \App\Models\Certificate::where('election_id', $election->id)
                ->where('candidate_id', $winner['candidate']->id)
                ->where('election_position_id', $winner['position']->id)
                ->first();
        @endphp


        @if($certificate)

            <!-- Already Issued -->

            <a
                href="{{ route('certificates.show', $certificate) }}"
                class="mt-2 inline-flex
                       items-center
                       gap-1.5
                       rounded-lg
                       border border-emerald-400/20
                       bg-emerald-400/10
                       px-2.5 py-1.5
                       text-[9px]
                       font-bold
                       text-emerald-300
                       transition
                       hover:bg-emerald-400/15"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-3.5 w-3.5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 12l2 2 4-4"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 22a10 10 0 100-20 10 10 0 000 20z"
                    />
                </svg>

                Certificate Issued

            </a>

        @else

            <!-- Issue Certificate -->

            <form
                method="POST"
                action="{{ route(
                    'certificates.issue',
                    [
                        'election' => $election->id,
                        'position' => $winner['position']->id,
                        'candidate' => $winner['candidate']->id,
                    ]
                ) }}"
                class="mt-2"
            >

                @csrf

                <button
                    type="submit"
                    class="group inline-flex
                           items-center
                           gap-1.5
                           rounded-lg
                           border border-cyan-400/20
                           bg-cyan-400/10
                           px-2.5 py-1.5
                           text-[9px]
                           font-bold
                           text-cyan-300
                           transition
                           hover:-translate-y-0.5
                           hover:border-cyan-300/40
                           hover:bg-cyan-400/15
                           hover:shadow-lg
                           hover:shadow-cyan-500/10"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-3.5 w-3.5
                               transition-transform
                               duration-300
                               group-hover:scale-110"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <!-- Certificate -->

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 3.5h12a2 2 0 012 2v13a2 2 0 01-2 2H6a2 2 0 01-2-2v-13a2 2 0 012-2z"
                        />

                        <path
                            stroke-linecap="round"
                            d="M8 8h8M8 11h6"
                        />

                        <!-- Seal -->

                        <circle
                            cx="16"
                            cy="16"
                            r="2.5"
                        />

                        <path
                            stroke-linecap="round"
                            d="M14.5 18l-.5 3 2-1 2 1-.5-3"
                        />

                    </svg>

                    Issue Certificate

                </button>

            </form>

        @endif

    @endif

</div>

                    </div>

                </div>

            @endforeach

        </div>

    </section>

@endif


    <!-- ===================================================== -->
    <!-- STATISTICS -->
    <!-- ===================================================== -->

    <div class="mb-10 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">


        <!-- Submitted Votes -->

        <div
            class="rounded-2xl border border-white/10
                   bg-white/[0.04]
                   p-5 backdrop-blur-xl
                   shadow-[0_10px_40px_rgba(0,0,0,0.15)]"
        >

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs uppercase tracking-wider text-slate-500">
                        Submitted Ballots
                    </p>

                    <p class="mt-2 text-3xl font-black text-white">
                        {{ number_format($submittedBallots) }}
                    </p>

                </div>


                <div
                    class="flex h-11 w-11 items-center justify-center
                           rounded-xl border border-cyan-400/20
                           bg-cyan-400/10"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 text-cyan-300"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M5 4.5h14A1.5 1.5 0 0120.5 6v12A1.5 1.5 0 0119 19.5H5A1.5 1.5 0 013.5 18V6A1.5 1.5 0 015 4.5z"
                        />

                        <path
                            stroke-linecap="round"
                            d="M8 9h8M8 12h5"
                        />

                    </svg>

                </div>

            </div>

        </div>


        <!-- Positions -->

        <div
            class="rounded-2xl border border-white/10
                   bg-white/[0.04]
                   p-5 backdrop-blur-xl
                   shadow-[0_10px_40px_rgba(0,0,0,0.15)]"
        >

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs uppercase tracking-wider text-slate-500">
                        Positions
                    </p>

                    <p class="mt-2 text-3xl font-black text-white">
                        {{ $positions->count() }}
                    </p>

                </div>


                <div
                    class="flex h-11 w-11 items-center justify-center
                           rounded-xl border border-blue-400/20
                           bg-blue-400/10"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 text-blue-300"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <path
                            stroke-linecap="round"
                            d="M8 6h12M8 12h12M8 18h12"
                        />

                        <path
                            stroke-linecap="round"
                            d="M4 6h.01M4 12h.01M4 18h.01"
                        />

                    </svg>

                </div>

            </div>

        </div>


        <!-- Candidates -->

        <div
            class="rounded-2xl border border-white/10
                   bg-white/[0.04]
                   p-5 backdrop-blur-xl
                   shadow-[0_10px_40px_rgba(0,0,0,0.15)]"
        >

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs uppercase tracking-wider text-slate-500">
                        Candidates
                    </p>

                    <p class="mt-2 text-3xl font-black text-white">
                        {{ number_format($totalCandidates) }}
                    </p>

                </div>


                <div
                    class="flex h-11 w-11 items-center justify-center
                           rounded-xl border border-purple-400/20
                           bg-purple-400/10"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 text-purple-300"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <path
                            stroke-linecap="round"
                            d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"
                        />

                        <circle
                            cx="9"
                            cy="7"
                            r="4"
                        />

                        <path
                            stroke-linecap="round"
                            d="M22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"
                        />

                    </svg>

                </div>

            </div>

        </div>


        <!-- Total Votes -->

        <div
            class="rounded-2xl border border-white/10
                   bg-white/[0.04]
                   p-5 backdrop-blur-xl
                   shadow-[0_10px_40px_rgba(0,0,0,0.15)]"
        >

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs uppercase tracking-wider text-slate-500">
                        Recorded Votes
                    </p>

                    <p class="mt-2 text-3xl font-black text-white">

                        {{ number_format(collect($results)->sum('total_votes')) }}

                    </p>

                </div>


                <div
                    class="flex h-11 w-11 items-center justify-center
                           rounded-xl border border-emerald-400/20
                           bg-emerald-400/10"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 text-emerald-300"
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

    </div>


    <!-- ===================================================== -->
    <!-- RESULTS -->
    <!-- ===================================================== -->

    <div class="space-y-8">

        @forelse($results as $result)

            @php

                $position = $result['position'];

                $candidates = $result['candidates'];

                $winner = $result['winner'];

                $totalVotes = $result['total_votes'];

            @endphp


            <section
                class="overflow-hidden rounded-3xl
                       border border-white/10
                       bg-white/[0.035]
                       backdrop-blur-xl
                       shadow-[0_15px_50px_rgba(0,0,0,0.18)]"
            >

                <!-- Position Header -->

                <div
                    class="flex flex-col gap-3
                           border-b border-white/10
                           bg-white/[0.025]
                           px-6 py-5
                           sm:flex-row
                           sm:items-center
                           sm:justify-between"
                >

                    <div>

                        <div class="flex items-center gap-3">

                            <span
                                class="flex h-9 w-9
                                       items-center justify-center
                                       rounded-xl
                                       bg-gradient-to-br
                                       from-blue-500/20
                                       to-cyan-400/20
                                       text-sm font-black
                                       text-cyan-300"
                            >
                                {{ $loop->iteration }}
                            </span>

                            <div>

                                <h3 class="text-lg font-bold text-white">

                                    {{ $position->name }}

                                </h3>

                                <p class="text-xs text-slate-500">

                                    {{ $totalVotes }}
                                    {{ $totalVotes === 1 ? 'vote' : 'votes' }}
                                    recorded

                                </p>

                            </div>

                        </div>

                    </div>


                    <!-- Winner -->

                    @if($winner)

                        <div
                            class="inline-flex items-center gap-2
                                   rounded-xl
                                   border border-emerald-400/20
                                   bg-emerald-400/10
                                   px-3 py-2"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 text-emerald-300"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M5 12l4 4L19 6"
                                />

                            </svg>

                            <span class="text-xs font-semibold text-emerald-300">

                                Winner:
                                {{ $winner['candidate']->name }}

                            </span>

                        </div>

                    @else

                        <span
                            class="rounded-xl
                                   border border-amber-400/20
                                   bg-amber-400/10
                                   px-3 py-2
                                   text-xs font-semibold
                                   text-amber-300"
                        >
                            No votes recorded
                        </span>

                    @endif

                </div>


                <!-- Candidates -->

                <div class="divide-y divide-white/5">

                    @foreach($candidates as $candidateResult)

                        @php

                            $candidate = $candidateResult['candidate'];

                            $votes = $candidateResult['votes'];

                            $percentage = $submittedBallots > 0
                                ? round(($votes / $submittedBallots) * 100, 1)
                                : 0;

                            $isWinner =
                                $winner &&
                                $winner['candidate']->id === $candidate->id;

                        @endphp


                        <div
                            class="group px-6 py-5
                                   transition hover:bg-white/[0.025]"
                        >

                            <div class="flex items-center gap-4">


                                <!-- Candidate Photo -->

                                <div
                                    class="h-12 w-12 shrink-0
                                           overflow-hidden
                                           rounded-xl
                                           border border-white/10
                                           bg-[#132544]"
                                >

                                    @if($candidate->photo)

                                        <img
                                            src="{{ asset('storage/' . $candidate->photo) }}"
                                            alt="{{ $candidate->name }}"
                                            class="h-full w-full object-cover"
                                        >

                                    @else

                                        <div
                                            class="flex h-full w-full
                                                   items-center justify-center
                                                   text-sm font-bold
                                                   text-cyan-300"
                                        >

                                            {{ strtoupper(substr($candidate->name, 0, 1)) }}

                                        </div>

                                    @endif

                                </div>


                                <!-- Candidate -->

                                <div class="min-w-0 flex-1">

                                    <div class="flex items-center justify-between gap-4">

                                        <div class="min-w-0">

                                            <p
                                                class="truncate
                                                       text-sm font-semibold
                                                       {{ $isWinner ? 'text-white' : 'text-slate-300' }}"
                                            >

                                                {{ $candidate->name }}

                                                @if($isWinner)

                                                    <span
                                                        class="ml-2
                                                               rounded-full
                                                               bg-emerald-400/10
                                                               px-2 py-0.5
                                                               text-[9px]
                                                               uppercase
                                                               tracking-wider
                                                               text-emerald-300"
                                                    >
                                                        Winner
                                                    </span>

                                                @endif

                                            </p>

                                        </div>


                                        <!-- Votes -->

                                        <div class="shrink-0 text-right">

                                            <p class="text-sm font-bold text-white">

                                                {{ number_format($votes) }}

                                            </p>

                                            <p class="text-[10px] text-slate-500">

                                                {{ $percentage }}%

                                            </p>

                                        </div>

                                    </div>


                                    <!-- Progress -->

                                    <div
                                        class="mt-3 h-1.5
                                               overflow-hidden
                                               rounded-full
                                               bg-white/5"
                                    >

                                        <div
                                            class="h-full rounded-full
                                                   bg-gradient-to-r
                                                   from-blue-500
                                                   to-cyan-400
                                                   transition-all duration-700"
                                            style="width: {{ $percentage }}%"
                                        >
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            </section>

        @empty

            <div
                class="rounded-3xl
                       border border-white/10
                       bg-white/[0.04]
                       p-12
                       text-center
                       backdrop-blur-xl"
            >

                <div
                    class="mx-auto mb-4
                           flex h-14 w-14
                           items-center justify-center
                           rounded-2xl
                           bg-white/5"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-7 w-7 text-slate-500"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <path
                            stroke-linecap="round"
                            d="M8 6h12M8 12h12M8 18h12"
                        />

                    </svg>

                </div>

                <h3 class="text-lg font-bold text-white">
                    No positions found
                </h3>

                <p class="mt-2 text-sm text-slate-500">
                    This election does not have any configured positions yet.
                </p>

            </div>

        @endforelse

    </div>

</div>



@endsection