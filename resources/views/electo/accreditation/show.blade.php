@extends('electo.layouts.app')

@section('title', 'Voter Accreditation | Electo')

@section('content')

<div class="relative -mt-3 w-full max-w-7xl space-y-5 pb-8">

    {{-- ============================================================= --}}
    {{-- PAGE HEADER --}}
    {{-- ============================================================= --}}

    <div class="mb-4">

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

            <div class="flex min-w-0 flex-1 items-start gap-3">

                {{-- Back --}}
                <a
                    href="{{ route('voters.show', $voter) }}"
                    class="group flex h-11 w-11 shrink-0 items-center justify-center
                           rounded-2xl
                           border border-slate-200
                           bg-white
                           text-slate-500
                           shadow-sm
                           transition-all duration-200
                           hover:-translate-y-0.5
                           hover:border-blue-200
                           hover:bg-blue-50
                           hover:text-blue-600
                           dark:border-white/10
                           dark:bg-white/[0.04]
                           dark:text-slate-400
                           dark:hover:border-blue-500/30
                           dark:hover:bg-blue-500/10
                           dark:hover:text-blue-400"
                    title="Back to voter profile"
                >

                    <svg
                        class="h-5 w-5 transition-transform duration-200 group-hover:-translate-x-0.5"
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


                {{-- Heading --}}
                <div class="min-w-0">

                    <div class="flex flex-wrap items-center gap-2">

                        <span
                            class="inline-flex items-center gap-2 rounded-full
                                   border border-blue-200
                                   bg-blue-50
                                   px-3 py-1.5
                                   text-[10px] font-bold uppercase
                                   tracking-[0.16em]
                                   text-blue-700
                                   dark:border-blue-500/20
                                   dark:bg-blue-500/10
                                   dark:text-blue-400"
                        >

                            <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>

                            Voter Accreditation

                        </span>


                        @if($electionVoter->accreditation_status === 'pending')

                            <span
                                class="inline-flex items-center gap-2 rounded-full
                                       border border-amber-200
                                       bg-amber-50
                                       px-3 py-1.5
                                       text-[10px] font-bold uppercase
                                       tracking-wide
                                       text-amber-700
                                       dark:border-amber-500/20
                                       dark:bg-amber-500/10
                                       dark:text-amber-400"
                            >

                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>

                                Accreditation Required

                            </span>

                        @elseif($electionVoter->accreditation_status === 'accredited')

                            <span
                                class="inline-flex items-center gap-2 rounded-full
                                       border border-emerald-200
                                       bg-emerald-50
                                       px-3 py-1.5
                                       text-[10px] font-bold uppercase
                                       tracking-wide
                                       text-emerald-700
                                       dark:border-emerald-500/20
                                       dark:bg-emerald-500/10
                                       dark:text-emerald-400"
                            >

                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                Accredited

                            </span>

                        @endif

                    </div>


                    <h1
                        class="mt-2 truncate text-2xl font-black tracking-tight
                               text-slate-900
                               sm:text-3xl
                               dark:text-white"
                    >
                        {{ $election->title }}
                    </h1>


                    <p
                        class="mt-1 max-w-2xl text-sm leading-5
                               text-slate-500
                               dark:text-slate-400"
                    >
                        Verify your identity before accessing the ballot.
                        Accreditation confirms your eligibility without recording your vote.
                    </p>

                </div>

            </div>


            {{-- Security Indicator --}}
            <div
                class="hidden shrink-0 items-center gap-3 rounded-2xl
                       border border-slate-200
                       bg-white
                       px-4 py-3
                       shadow-sm
                       sm:flex
                       dark:border-white/10
                       dark:bg-white/[0.04]"
            >

                <div
                    class="flex h-9 w-9 items-center justify-center rounded-xl
                           bg-emerald-50
                           text-emerald-600
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
                            d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6-8 10-8 10z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 12l2 2 4-4"
                        />
                    </svg>

                </div>

                <div>

                    <p class="text-xs font-bold text-slate-800 dark:text-white">
                        Secure Verification
                    </p>

                    <p class="mt-0.5 text-[11px] text-slate-500 dark:text-slate-400">
                        Protected by Electo
                    </p>

                </div>

            </div>

        </div>

    </div>



    {{-- ============================================================= --}}
    {{-- FLASH MESSAGES --}}
    {{-- ============================================================= --}}

    @if(session('success'))

        <div
            class="overflow-hidden rounded-2xl
                   border border-emerald-200
                   bg-emerald-50
                   shadow-sm
                   dark:border-emerald-500/20
                   dark:bg-emerald-500/[0.06]"
        >

            <div class="flex items-start gap-4 p-4">

                <div
                    class="flex h-9 w-9 shrink-0 items-center justify-center
                           rounded-xl
                           bg-emerald-100
                           text-emerald-600
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
                            d="M5 13l4 4L19 7"
                        />
                    </svg>

                </div>

                <div class="min-w-0">

                    <p class="text-sm font-bold text-emerald-800 dark:text-emerald-300">
                        Verification Complete
                    </p>

                    <p class="mt-1 text-sm leading-5 text-emerald-700 dark:text-emerald-400">
                        {{ session('success') }}
                    </p>

                </div>

            </div>

        </div>

    @endif


    @if(session('error'))

        <div
            class="overflow-hidden rounded-2xl
                   border border-red-200
                   bg-red-50
                   shadow-sm
                   dark:border-red-500/20
                   dark:bg-red-500/[0.06]"
        >

            <div class="flex items-start gap-4 p-4">

                <div
                    class="flex h-9 w-9 shrink-0 items-center justify-center
                           rounded-xl
                           bg-red-100
                           text-red-600
                           dark:bg-red-500/10
                           dark:text-red-400"
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
                            d="M12 9v4m0 4h.01M10.29 3.86l-8.18 14A2 2 0 003.84 21h16.32a2 2 0 001.73-3.14l-8.18-14a2 2 0 00-3.42 0z"
                        />
                    </svg>

                </div>

                <div class="min-w-0">

                    <p class="text-sm font-bold text-red-800 dark:text-red-300">
                        Verification Notice
                    </p>

                    <p class="mt-1 text-sm leading-5 text-red-700 dark:text-red-400">
                        {{ session('error') }}
                    </p>

                </div>

            </div>

        </div>

    @endif


    @if(session('info'))

        <div
            class="overflow-hidden rounded-2xl
                   border border-blue-200
                   bg-blue-50
                   shadow-sm
                   dark:border-blue-500/20
                   dark:bg-blue-500/[0.06]"
        >

            <div class="flex items-start gap-4 p-4">

                <div
                    class="flex h-9 w-9 shrink-0 items-center justify-center
                           rounded-xl
                           bg-blue-100
                           text-blue-600
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
                            d="M12 11v5"
                        />

                        <path
                            stroke-linecap="round"
                            d="M12 8h.01"
                        />
                    </svg>

                </div>

                <div class="min-w-0">

                    <p class="text-sm font-bold text-blue-800 dark:text-blue-300">
                        Action Required
                    </p>

                    <p class="mt-1 text-sm leading-5 text-blue-700 dark:text-blue-400">
                        {{ session('info') }}
                    </p>

                </div>

            </div>

        </div>

    @endif



    {{-- ============================================================= --}}
    {{-- VOTER + ELECTION SUMMARY --}}
    {{-- ============================================================= --}}

    <div class="grid gap-4 lg:grid-cols-2">

        {{-- --------------------------------------------------------- --}}
        {{-- VOTER --}}
        {{-- --------------------------------------------------------- --}}

        <div
            class="overflow-hidden rounded-3xl
                   border border-slate-200
                   bg-white
                   shadow-sm
                   dark:border-white/10
                   dark:bg-[#101D35]"
        >

            <div
                class="border-b border-slate-100
                       bg-slate-50/80
                       px-4 py-3.5
                       sm:px-5
                       dark:border-white/10
                       dark:bg-white/[0.025]"
            >

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-9 w-9 items-center justify-center
                               rounded-xl
                               bg-blue-50
                               text-blue-600
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
                            <circle cx="12" cy="8" r="3.5"/>

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M5 20c.7-3.5 3.2-5.5 7-5.5s6.3 2 7 5.5"
                            />
                        </svg>

                    </div>

                    <div>

                        <p
                            class="text-[10px] font-bold uppercase
                                   tracking-[0.16em] text-slate-400"
                        >
                            Voter
                        </p>

                        <h2 class="mt-0.5 text-base font-black text-slate-900 dark:text-white">
                            {{ $voter->name }}
                        </h2>

                    </div>

                </div>

            </div>


            <div class="p-4 sm:p-5">

                <div class="grid gap-3 sm:grid-cols-2">

                    <div
                        class="rounded-2xl
                               border border-slate-100
                               bg-slate-50/70
                               p-3.5
                               dark:border-white/10
                               dark:bg-white/[0.035]"
                    >

                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            Voter ID
                        </p>

                        <p class="mt-2 font-mono text-sm font-bold text-blue-600 dark:text-blue-400">
                            {{ $voter->voter_id }}
                        </p>

                    </div>


                    <div
                        class="rounded-2xl
                               border border-slate-100
                               bg-slate-50/70
                               p-3.5
                               dark:border-white/10
                               dark:bg-white/[0.035]"
                    >

                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            Account Status
                        </p>

                        <div class="mt-2">

                            @if($voter->status === 'active')

                                <span
                                    class="inline-flex items-center gap-2 rounded-full
                                           bg-emerald-50 px-3 py-1.5
                                           text-xs font-bold text-emerald-700
                                           dark:bg-emerald-500/10
                                           dark:text-emerald-400"
                                >

                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                    Active

                                </span>

                            @else

                                <span
                                    class="inline-flex items-center gap-2 rounded-full
                                           bg-slate-100 px-3 py-1.5
                                           text-xs font-bold text-slate-600
                                           dark:bg-white/5
                                           dark:text-slate-400"
                                >

                                    <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>

                                    {{ ucfirst($voter->status) }}

                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- --------------------------------------------------------- --}}
        {{-- ELECTION --}}
        {{-- --------------------------------------------------------- --}}

        <div
            class="overflow-hidden rounded-3xl
                   border border-slate-200
                   bg-white
                   shadow-sm
                   dark:border-white/10
                   dark:bg-[#101D35]"
        >

            <div
                class="border-b border-slate-100
                       bg-slate-50/80
                       px-4 py-3.5
                       sm:px-5
                       dark:border-white/10
                       dark:bg-white/[0.025]"
            >

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-9 w-9 items-center justify-center
                               rounded-xl
                               bg-indigo-50
                               text-indigo-600
                               dark:bg-indigo-500/10
                               dark:text-indigo-400"
                    >

                        <svg
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <rect
                                x="4"
                                y="5"
                                width="16"
                                height="15"
                                rx="2"
                            />

                            <path
                                stroke-linecap="round"
                                d="M8 3v4M16 3v4M4 10h16"
                            />
                        </svg>

                    </div>

                    <div class="min-w-0">

                        <p
                            class="text-[10px] font-bold uppercase
                                   tracking-[0.16em] text-slate-400"
                        >
                            Election
                        </p>

                        <h2
                            class="mt-0.5 truncate text-base font-black
                                   text-slate-900
                                   dark:text-white"
                        >
                            {{ $election->title }}
                        </h2>

                    </div>

                </div>

            </div>


            <div class="p-4 sm:p-5">

                <div class="grid gap-3 sm:grid-cols-2">

                    <div
                        class="rounded-2xl
                               border border-slate-100
                               bg-slate-50/70
                               p-3.5
                               dark:border-white/10
                               dark:bg-white/[0.035]"
                    >

                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            Eligibility
                        </p>

                        <div class="mt-2">

                            @if($electionVoter->is_eligible)

                                <span
                                    class="inline-flex items-center gap-2 rounded-full
                                           bg-emerald-50 px-3 py-1.5
                                           text-xs font-bold text-emerald-700
                                           dark:bg-emerald-500/10
                                           dark:text-emerald-400"
                                >

                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                    Eligible

                                </span>

                            @else

                                <span
                                    class="inline-flex items-center gap-2 rounded-full
                                           bg-red-50 px-3 py-1.5
                                           text-xs font-bold text-red-700
                                           dark:bg-red-500/10
                                           dark:text-red-400"
                                >

                                    <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>

                                    Not Eligible

                                </span>

                            @endif

                        </div>

                    </div>


                    <div
                        class="rounded-2xl
                               border border-slate-100
                               bg-slate-50/70
                               p-3.5
                               dark:border-white/10
                               dark:bg-white/[0.035]"
                    >

                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            Accreditation
                        </p>

                        <div class="mt-2">

                            @if($electionVoter->accreditation_status === 'accredited')

                                <span
                                    class="inline-flex items-center gap-2 rounded-full
                                           bg-emerald-50 px-3 py-1.5
                                           text-xs font-bold text-emerald-700
                                           dark:bg-emerald-500/10
                                           dark:text-emerald-400"
                                >

                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                    Accredited

                                </span>

                            @else

                                <span
                                    class="inline-flex items-center gap-2 rounded-full
                                           bg-amber-50 px-3 py-1.5
                                           text-xs font-bold text-amber-700
                                           dark:bg-amber-500/10
                                           dark:text-amber-400"
                                >

                                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>

                                    Pending

                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    {{-- ============================================================= --}}
    {{-- PENDING ACCREDITATION --}}
    {{-- ============================================================= --}}

    @if($electionVoter->accreditation_status === 'pending')

        <section class="mt-5">

            <div class="mb-3 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">

                <div>

                    <div class="flex items-center gap-2">

                        <span
                            class="flex h-8 w-8 items-center justify-center
                                   rounded-xl
                                   bg-amber-50
                                   text-amber-600
                                   dark:bg-amber-500/10
                                   dark:text-amber-400"
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
                                    d="M12 6v6l4 2"
                                />

                                <circle cx="12" cy="12" r="9"/>
                            </svg>

                        </span>

                        <h2 class="text-lg font-black text-slate-900 dark:text-white">
                            Complete Accreditation
                        </h2>

                    </div>

                    <p class="mt-1.5 text-sm text-slate-500 dark:text-slate-400">
                        Choose one secure method to verify your identity before voting.
                    </p>

                </div>


                <span
                    class="inline-flex w-fit items-center gap-2 rounded-full
                           border border-amber-200
                           bg-amber-50
                           px-3 py-1.5
                           text-xs font-bold
                           text-amber-700
                           dark:border-amber-500/20
                           dark:bg-amber-500/10
                           dark:text-amber-400"
                >

                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>

                    Action Required

                </span>

            </div>


            {{-- Method cards --}}
            <div class="grid gap-4 lg:grid-cols-2">

                {{-- ================================================= --}}
                {{-- PERSONAL DEVICE --}}
                {{-- ================================================= --}}

                <div
                    class="group relative overflow-hidden rounded-3xl
                           border border-blue-200
                           bg-white
                           shadow-sm
                           transition-all duration-300
                           hover:-translate-y-1
                           hover:border-blue-300
                           hover:shadow-xl
                           hover:shadow-blue-500/10
                           dark:border-blue-500/20
                           dark:bg-[#101D35]
                           dark:hover:border-blue-500/40"
                >

                    <div
                        class="absolute inset-x-0 top-0 h-1
                               bg-gradient-to-r
                               from-blue-500
                               to-cyan-400"
                    ></div>


                    <div class="p-5 sm:p-6">

                        <div class="flex items-start justify-between gap-4">

                            <div
                                class="flex h-13 w-13 items-center justify-center
                                       rounded-2xl
                                       bg-blue-50
                                       text-blue-600
                                       ring-1 ring-blue-100
                                       dark:bg-blue-500/10
                                       dark:text-blue-400
                                       dark:ring-blue-500/20"
                            >

                                <svg
                                    class="h-7 w-7"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <rect
                                        x="7"
                                        y="2"
                                        width="10"
                                        height="20"
                                        rx="2"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        d="M11 18h2"
                                    />
                                </svg>

                            </div>


                            <span
                                class="rounded-full
                                       bg-blue-50
                                       px-3 py-1.5
                                       text-[10px]
                                       font-black
                                       uppercase
                                       tracking-wide
                                       text-blue-700
                                       dark:bg-blue-500/10
                                       dark:text-blue-400"
                            >
                                Recommended
                            </span>

                        </div>


                        <h3
                            class="mt-5 text-xl font-black tracking-tight
                                   text-slate-900
                                   dark:text-white"
                        >
                            Use Your Personal Device
                        </h3>


                        <p
                            class="mt-2 text-sm leading-6
                                   text-slate-500
                                   dark:text-slate-400"
                        >
                            Verify yourself using the phone or supported device
                            you are currently using.
                        </p>


                        <div class="mt-5 space-y-2.5">

                            <div class="flex items-center gap-3">

                                <span
                                    class="flex h-7 w-7 shrink-0 items-center
                                           justify-center rounded-full
                                           bg-blue-50
                                           text-blue-600
                                           dark:bg-blue-500/10
                                           dark:text-blue-400"
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
                                            d="M5 13l4 4L19 7"
                                        />
                                    </svg>

                                </span>

                                <span class="text-sm font-medium text-slate-600 dark:text-slate-300">
                                    Face ID, fingerprint or passkey
                                </span>

                            </div>


                            <div class="flex items-center gap-3">

                                <span
                                    class="flex h-7 w-7 shrink-0 items-center
                                           justify-center rounded-full
                                           bg-blue-50
                                           text-blue-600
                                           dark:bg-blue-500/10
                                           dark:text-blue-400"
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
                                            d="M5 13l4 4L19 7"
                                        />
                                    </svg>

                                </span>

                                <span class="text-sm font-medium text-slate-600 dark:text-slate-300">
                                    Fast self-service verification
                                </span>

                            </div>


                            <div class="flex items-center gap-3">

                                <span
                                    class="flex h-7 w-7 shrink-0 items-center
                                           justify-center rounded-full
                                           bg-blue-50
                                           text-blue-600
                                           dark:bg-blue-500/10
                                           dark:text-blue-400"
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
                                            d="M5 13l4 4L19 7"
                                        />
                                    </svg>

                                </span>

                                <span class="text-sm font-medium text-slate-600 dark:text-slate-300">
                                    Secure one-time voting session
                                </span>

                            </div>

                        </div>


                        <form
                            method="POST"
                            action="{{ route('accreditation.personal-device', [$voter, $election]) }}"
                            id="personal-device-form"
                            class="mt-5"
                        >

                            @csrf

                            <button
                                type="button"
                                id="personal-device-button"
                                class="group flex w-full items-center
                                       justify-center gap-2.5
                                       rounded-2xl
                                       bg-gradient-to-r
                                       from-blue-600
                                       to-cyan-500
                                       px-5 py-3.5
                                       text-sm font-black text-white
                                       shadow-lg
                                       shadow-blue-600/20
                                       transition-all duration-200
                                       hover:-translate-y-0.5
                                       hover:shadow-xl
                                       hover:shadow-blue-600/25
                                       focus:outline-none
                                       focus:ring-4
                                       focus:ring-blue-500/20
                                       disabled:cursor-not-allowed
                                       disabled:opacity-60"
                            >

                                <svg
                                    id="personal-device-icon"
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <rect
                                        x="7"
                                        y="2"
                                        width="10"
                                        height="20"
                                        rx="2"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        d="M11 18h2"
                                    />
                                </svg>


                                <span id="personal-device-text">
                                    Authenticate with Personal Device
                                </span>


                                <svg
                                    class="h-4 w-4 transition-transform
                                           duration-200
                                           group-hover:translate-x-0.5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M5 12h14m-6-6l6 6-6 6"
                                    />
                                </svg>

                            </button>

                        </form>


                        <p class="mt-2.5 text-center text-[11px] text-slate-400">
                            Your biometric data remains on your device.
                        </p>

                    </div>

                </div>



                {{-- ================================================= --}}
                {{-- PUBLIC DEVICE --}}
                {{-- ================================================= --}}

                <div
                    class="group relative overflow-hidden rounded-3xl
                           border border-violet-200
                           bg-white
                           shadow-sm
                           transition-all duration-300
                           hover:-translate-y-1
                           hover:border-violet-300
                           hover:shadow-xl
                           hover:shadow-violet-500/10
                           dark:border-violet-500/20
                           dark:bg-[#101D35]
                           dark:hover:border-violet-500/40"
                >

                    <div
                        class="absolute inset-x-0 top-0 h-1
                               bg-gradient-to-r
                               from-violet-500
                               to-fuchsia-500"
                    ></div>


                    <div class="p-5 sm:p-6">

                        <div class="flex items-start justify-between gap-4">

                            <div
                                class="flex h-13 w-13 items-center justify-center
                                       rounded-2xl
                                       bg-violet-50
                                       text-violet-600
                                       ring-1 ring-violet-100
                                       dark:bg-violet-500/10
                                       dark:text-violet-400
                                       dark:ring-violet-500/20"
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
                                        d="M4 5h16v12H4z"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        d="M8 21h8M12 17v4"
                                    />
                                </svg>

                            </div>


                            <span
                                class="rounded-full
                                       bg-violet-50
                                       px-3 py-1.5
                                       text-[10px]
                                       font-black
                                       uppercase
                                       tracking-wide
                                       text-violet-700
                                       dark:bg-violet-500/10
                                       dark:text-violet-400"
                            >
                                Assisted
                            </span>

                        </div>


                        <h3
                            class="mt-5 text-xl font-black tracking-tight
                                   text-slate-900
                                   dark:text-white"
                        >
                            Use a Public Device
                        </h3>


                        <p
                            class="mt-2 text-sm leading-6
                                   text-slate-500
                                   dark:text-slate-400"
                        >
                            Use an approved voting station when you do not
                            have access to a personal device.
                        </p>


                        <div class="mt-5 space-y-2.5">

                            <div class="flex items-center gap-3">

                                <span
                                    class="flex h-7 w-7 shrink-0 items-center
                                           justify-center rounded-full
                                           bg-violet-50
                                           text-violet-600
                                           dark:bg-violet-500/10
                                           dark:text-violet-400"
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
                                            d="M5 13l4 4L19 7"
                                        />
                                    </svg>

                                </span>

                                <span class="text-sm font-medium text-slate-600 dark:text-slate-300">
                                    Official voting station
                                </span>

                            </div>


                            <div class="flex items-center gap-3">

                                <span
                                    class="flex h-7 w-7 shrink-0 items-center
                                           justify-center rounded-full
                                           bg-violet-50
                                           text-violet-600
                                           dark:bg-violet-500/10
                                           dark:text-violet-400"
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
                                            d="M5 13l4 4L19 7"
                                        />
                                    </svg>

                                </span>

                                <span class="text-sm font-medium text-slate-600 dark:text-slate-300">
                                    Authorized operator assistance
                                </span>

                            </div>


                            <div class="flex items-center gap-3">

                                <span
                                    class="flex h-7 w-7 shrink-0 items-center
                                           justify-center rounded-full
                                           bg-violet-50
                                           text-violet-600
                                           dark:bg-violet-500/10
                                           dark:text-violet-400"
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
                                            d="M5 13l4 4L19 7"
                                        />
                                    </svg>

                                </span>

                                <span class="text-sm font-medium text-slate-600 dark:text-slate-300">
                                    Secure one-time voting session
                                </span>

                            </div>

                        </div>


                        <form
                            method="POST"
                            action="{{ route('accreditation.public-device', [$voter, $election]) }}"
                            class="mt-5"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="group flex w-full items-center justify-center
                                       gap-2.5 rounded-2xl
                                       border border-violet-200
                                       bg-violet-50
                                       px-5 py-3.5
                                       text-sm font-black
                                       text-violet-700
                                       shadow-sm
                                       transition-all duration-200
                                       hover:-translate-y-0.5
                                       hover:border-violet-300
                                       hover:bg-violet-100
                                       hover:shadow-lg
                                       focus:outline-none
                                       focus:ring-4
                                       focus:ring-violet-500/10
                                       dark:border-violet-500/20
                                       dark:bg-violet-500/10
                                       dark:text-violet-300
                                       dark:hover:bg-violet-500/15"
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
                                        d="M4 5h16v12H4z"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        d="M8 21h8M12 17v4"
                                    />
                                </svg>


                                <span>
                                    Continue with Public Device
                                </span>


                                <svg
                                    class="h-4 w-4 transition-transform
                                           duration-200
                                           group-hover:translate-x-0.5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M5 12h14m-6-6l6 6-6 6"
                                    />
                                </svg>

                            </button>

                        </form>


                        <p class="mt-2.5 text-center text-[11px] text-slate-400">
                            Available through an authorized voting station.
                        </p>

                    </div>

                </div>

            </div>

        </section>


    {{-- ============================================================= --}}
    {{-- ACCREDITED --}}
    {{-- ============================================================= --}}

    @elseif($electionVoter->accreditation_status === 'accredited')

        <section class="mt-5">

            <div
                class="relative overflow-hidden rounded-3xl
                       border border-emerald-200
                       bg-white
                       shadow-sm
                       dark:border-emerald-500/20
                       dark:bg-[#101D35]"
            >

                <div
                    class="absolute inset-x-0 top-0 h-1
                           bg-gradient-to-r
                           from-emerald-500
                           to-teal-400"
                ></div>


                <div class="p-7 sm:p-9">

                    <div class="flex flex-col items-center text-center">

                        <div
                            class="flex h-20 w-20 items-center justify-center
                                   rounded-3xl
                                   bg-emerald-50
                                   text-emerald-600
                                   ring-8 ring-emerald-50/70
                                   dark:bg-emerald-500/10
                                   dark:text-emerald-400
                                   dark:ring-emerald-500/5"
                        >

                            <svg
                                class="h-10 w-10"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>

                        </div>


                        <div class="mt-6">

                            <span
                                class="inline-flex items-center gap-2 rounded-full
                                       bg-emerald-50
                                       px-3 py-1.5
                                       text-xs font-bold
                                       text-emerald-700
                                       dark:bg-emerald-500/10
                                       dark:text-emerald-400"
                            >

                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                Verification Successful

                            </span>


                            <h2
                                class="mt-4 text-2xl font-black tracking-tight
                                       text-slate-900
                                       dark:text-white"
                            >
                                You are Accredited
                            </h2>


                            <p
                                class="mx-auto mt-2 max-w-xl
                                       text-sm leading-6
                                       text-slate-500
                                       dark:text-slate-400"
                            >
                                Your identity has been verified for this election.
                                You can now continue to the ballot when voting is available.
                            </p>

                        </div>


                        <div
                            class="mt-7 grid w-full max-w-2xl gap-3 sm:grid-cols-2"
                        >

                            <div
                                class="rounded-2xl
                                       border border-slate-100
                                       bg-slate-50/80
                                       p-4
                                       text-left
                                       dark:border-white/10
                                       dark:bg-white/[0.035]"
                            >

                                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                    Verification Method
                                </p>

                                <p
                                    class="mt-2 text-sm font-black
                                           text-slate-800
                                           dark:text-white"
                                >
                                    {{ ucwords(str_replace('_', ' ', $electionVoter->accreditation_method)) }}
                                </p>

                            </div>


                            <div
                                class="rounded-2xl
                                       border border-slate-100
                                       bg-slate-50/80
                                       p-4
                                       text-left
                                       dark:border-white/10
                                       dark:bg-white/[0.035]"
                            >

                                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                    Accredited At
                                </p>

                                <p
                                    class="mt-2 text-sm font-black
                                           text-slate-800
                                           dark:text-white"
                                >
                                    {{ optional($electionVoter->accredited_at)->format('M d, Y h:i A') }}
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    @endif



    {{-- ============================================================= --}}
    {{-- PROCEED TO VOTE --}}
    {{-- ============================================================= --}}

    @if(
        $electionVoter->is_eligible &&
        $electionVoter->accreditation_status === 'accredited' &&
        !$electionVoter->has_voted
    )

        <div class="mt-4">

            <a
                href="{{ route('voting.start', [$voter, $election]) }}"
                class="group flex w-full items-center justify-center
                       gap-3 rounded-2xl
                       bg-gradient-to-r
                       from-emerald-600
                       to-teal-500
                       px-6 py-4
                       text-sm font-black text-white
                       shadow-lg shadow-emerald-600/20
                       transition-all duration-200
                       hover:-translate-y-0.5
                       hover:shadow-xl
                       hover:shadow-emerald-600/25
                       focus:outline-none
                       focus:ring-4
                       focus:ring-emerald-500/20"
            >

                <span
                    class="flex h-9 w-9 items-center justify-center
                           rounded-xl bg-white/15"
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
                    </svg>

                </span>


                <span>
                    Proceed to Vote
                </span>


                <svg
                    class="h-5 w-5 transition-transform
                           duration-200
                           group-hover:translate-x-1"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5 12h14M13 6l6 6-6 6"
                    />
                </svg>

            </a>

        </div>

    @endif



    {{-- ============================================================= --}}
    {{-- SECURITY / TRUST NOTICE --}}
    {{-- ============================================================= --}}

    <div
        class="overflow-hidden rounded-3xl
               border border-slate-200
               bg-white
               shadow-sm
               dark:border-white/10
               dark:bg-[#101D35]"
    >

        <div class="p-5 sm:p-6">

            <div class="flex items-start gap-4">

                <div
                    class="flex h-11 w-11 shrink-0 items-center justify-center
                           rounded-2xl
                           bg-slate-100
                           text-slate-600
                           dark:bg-white/5
                           dark:text-slate-300"
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
                            d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 12l2 2 4-4"
                        />
                    </svg>

                </div>


                <div class="min-w-0">

                    <div class="flex flex-wrap items-center gap-2">

                        <h3 class="text-sm font-black text-slate-800 dark:text-white">
                            Your vote remains separate from accreditation
                        </h3>

                        <span
                            class="rounded-full
                                   bg-slate-100
                                   px-2.5 py-1
                                   text-[10px]
                                   font-bold
                                   uppercase
                                   tracking-wide
                                   text-slate-500
                                   dark:bg-white/5
                                   dark:text-slate-400"
                        >
                            Secure
                        </span>

                    </div>


                    <p
                        class="mt-2 max-w-3xl
                               text-xs leading-6
                               text-slate-500
                               dark:text-slate-400"
                    >
                        Accreditation confirms that the voter is authorized
                        to participate. It does not cast a vote. The vote is
                        only recorded during the separate ballot and submission process.
                    </p>

                </div>

            </div>

        </div>

    </div>



    {{-- ============================================================= --}}
    {{-- MOBILE TRUST STRIP --}}
    {{-- ============================================================= --}}

    <div
        class="flex items-center justify-center gap-2
               text-[11px]
               text-slate-400
               sm:hidden"
    >

        <svg
            class="h-4 w-4 text-emerald-500"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="1.8"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6-8 10-8 10z"
            />
        </svg>

        <span>
            Secure accreditation powered by Electo
        </span>

    </div>

</div>



{{-- ============================================================= --}}
{{-- PERSONAL DEVICE AUTHENTICATION --}}
{{-- ============================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', () => {

    const button = document.getElementById(
        'personal-device-button'
    );

    const text = document.getElementById(
        'personal-device-text'
    );

    const form = document.getElementById(
        'personal-device-form'
    );


    if (!button || !form || !text) {
        return;
    }


    button.addEventListener('click', async () => {

        button.disabled = true;

        text.textContent =
            'Waiting for device authentication...';


        try {

            /*
            |--------------------------------------------------------------------------
            | Check Passkey Support
            |--------------------------------------------------------------------------
            */

            if (
                !window.Passkeys ||
                !window.Passkeys.isSupported()
            ) {

                throw new Error(
                    'This device or browser does not support passkeys.'
                );

            }


            /*
            |--------------------------------------------------------------------------
            | Verify Current User's Passkey
            |--------------------------------------------------------------------------
            */

            await window.Passkeys.verify({

                routes: {

                    options:
                        '/passkeys/confirm/options',

                    submit:
                        '/passkeys/confirm',

                },

            });


            /*
            |--------------------------------------------------------------------------
            | Passkey Successful
            |--------------------------------------------------------------------------
            */

            text.textContent =
                'Authentication successful. Accrediting voter...';


            /*
            |--------------------------------------------------------------------------
            | Submit Accreditation
            |--------------------------------------------------------------------------
            */

            form.submit();


        } catch (error) {

            console.error(
                'Personal device authentication failed:',
                error
            );


            button.disabled = false;

            text.textContent =
                'Authenticate with Personal Device';


            /*
            |--------------------------------------------------------------------------
            | User Cancelled
            |--------------------------------------------------------------------------
            */

            if (
                error?.name === 'NotAllowedError' ||
                error?.name === 'UserCancelledError'
            ) {

                alert(
                    'Device authentication was cancelled.'
                );

                return;

            }


            /*
            |--------------------------------------------------------------------------
            | General Error
            |--------------------------------------------------------------------------
            */

            alert(
                error?.message ||
                'Device authentication failed. Please try again.'
            );

        }

    });

});

</script>

@endsection