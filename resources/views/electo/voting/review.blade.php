@extends('electo.layouts.app')

@section('title', 'Review Your Vote | Electo')

@section('content')

<div class="mx-auto w-full max-w-6xl space-y-6 pb-8">

    {{-- ============================================================= --}}
    {{-- PREMIUM HEADER --}}
    {{-- ============================================================= --}}

    <div
        class="relative overflow-hidden rounded-3xl
               border border-slate-200
               bg-white
               px-6 py-7
               shadow-sm
               dark:border-white/10
               dark:bg-[#101d35]"
    >

        {{-- Decorative background --}}

        <div
            class="pointer-events-none absolute -right-24 -top-24
                   h-64 w-64 rounded-full
                   bg-blue-500/10 blur-3xl
                   dark:bg-blue-500/10"
        ></div>

        <div
            class="pointer-events-none absolute -bottom-32 -left-20
                   h-64 w-64 rounded-full
                   bg-cyan-400/10 blur-3xl"
        ></div>


        <div class="relative flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

            <div class="min-w-0">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-11 w-11 shrink-0
                               items-center justify-center
                               rounded-2xl
                               bg-gradient-to-br
                               from-blue-600
                               to-cyan-500
                               text-white
                               shadow-lg
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
                                d="M9 12l2 2 4-4"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"
                            />

                        </svg>

                    </div>

                    <div>

                        <p
                            class="text-[11px]
                                   font-bold
                                   uppercase
                                   tracking-[0.2em]
                                   text-blue-600
                                   dark:text-blue-400"
                        >
                            Final Review
                        </p>

                        <h1
                            class="mt-1
                                   text-2xl
                                   font-black
                                   tracking-tight
                                   text-slate-900
                                   dark:text-white
                                   sm:text-3xl"
                        >
                            Review Your Vote
                        </h1>

                    </div>

                </div>


                <p
                    class="mt-3
                           max-w-2xl
                           text-sm
                           leading-6
                           text-slate-500
                           dark:text-gray-400"
                >
                    Carefully review your selections before submitting.
                    Once your vote is submitted, it cannot be changed.
                </p>

            </div>


            {{-- Secure session badge --}}

            <div
                class="inline-flex
                       shrink-0
                       items-center
                       gap-2
                       self-start
                       rounded-full
                       border
                       border-emerald-200
                       bg-emerald-50
                       px-3.5
                       py-2
                       text-xs
                       font-bold
                       text-emerald-700
                       dark:border-emerald-400/20
                       dark:bg-emerald-500/10
                       dark:text-emerald-400"
            >

                <span
                    class="relative flex h-2.5 w-2.5"
                >

                    <span
                        class="absolute inline-flex
                               h-full w-full
                               animate-ping
                               rounded-full
                               bg-emerald-400
                               opacity-60"
                    ></span>

                    <span
                        class="relative inline-flex
                               h-2.5 w-2.5
                               rounded-full
                               bg-emerald-500"
                    ></span>

                </span>

                Secure Session

            </div>

        </div>

    </div>


    {{-- ============================================================= --}}
    {{-- ELECTION + VOTER --}}
    {{-- ============================================================= --}}

    <div class="grid gap-5 lg:grid-cols-2">

        {{-- ELECTION CARD --}}

        <div
            class="group relative overflow-hidden rounded-2xl
                   border border-slate-200
                   bg-white
                   p-5
                   shadow-sm
                   transition
                   hover:-translate-y-0.5
                   hover:shadow-md
                   dark:border-white/10
                   dark:bg-[#101d35]
                   dark:shadow-none"
        >

            <div
                class="absolute right-0 top-0
                       h-28 w-28
                       rounded-full
                       bg-blue-500/5
                       blur-2xl"
            ></div>

            <div class="relative flex items-start gap-4">

                <div
                    class="flex h-12 w-12 shrink-0
                           items-center justify-center
                           rounded-2xl
                           bg-blue-500/10
                           text-blue-600
                           dark:text-blue-400"
                >

                    <svg
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <rect
                            x="3"
                            y="4"
                            width="18"
                            height="17"
                            rx="2"
                        />

                        <path
                            stroke-linecap="round"
                            d="M8 2v4M16 2v4M3 10h18"
                        />

                    </svg>

                </div>


                <div class="min-w-0 flex-1">

                    <p
                        class="text-[10px]
                               font-bold
                               uppercase
                               tracking-[0.18em]
                               text-slate-400
                               dark:text-gray-500"
                    >
                        Election
                    </p>

                    <h2
                        class="mt-1
                               truncate
                               text-lg
                               font-black
                               text-slate-900
                               dark:text-white"
                    >
                        {{ $election->title }}
                    </h2>

                    <div
                        class="mt-3
                               inline-flex
                               items-center
                               gap-2
                               rounded-full
                               bg-emerald-50
                               px-2.5
                               py-1
                               text-[11px]
                               font-semibold
                               text-emerald-700
                               dark:bg-emerald-500/10
                               dark:text-emerald-400"
                    >

                        <span
                            class="h-1.5 w-1.5 rounded-full bg-emerald-500"
                        ></span>

                        Secure voting session active

                    </div>

                </div>

            </div>

        </div>


        {{-- VOTER CARD --}}

        <div
            class="group relative overflow-hidden rounded-2xl
                   border border-slate-200
                   bg-white
                   p-5
                   shadow-sm
                   transition
                   hover:-translate-y-0.5
                   hover:shadow-md
                   dark:border-white/10
                   dark:bg-[#101d35]
                   dark:shadow-none"
        >

            <div
                class="absolute right-0 top-0
                       h-28 w-28
                       rounded-full
                       bg-cyan-500/5
                       blur-2xl"
            ></div>

            <div class="relative flex items-center gap-4">

                <div
                    class="flex h-12 w-12 shrink-0
                           items-center justify-center
                           rounded-2xl
                           bg-gradient-to-br
                           from-blue-600
                           to-cyan-500
                           text-base
                           font-black
                           text-white
                           shadow-md"
                >

                    {{ strtoupper(substr($voter->name, 0, 1)) }}

                </div>


                <div class="min-w-0 flex-1">

                    <p
                        class="text-[10px]
                               font-bold
                               uppercase
                               tracking-[0.18em]
                               text-slate-400
                               dark:text-gray-500"
                    >
                        Voter
                    </p>

                    <p
                        class="mt-1
                               truncate
                               text-base
                               font-bold
                               text-slate-900
                               dark:text-white"
                    >
                        {{ $voter->name }}
                    </p>

                    <p
                        class="mt-1
                               text-xs
                               text-slate-500
                               dark:text-gray-500"
                    >
                        Voter ID:
                        <span class="font-semibold">
                            {{ $voter->voter_id }}
                        </span>
                    </p>

                </div>


                <div
                    class="hidden
                           h-9 w-9
                           shrink-0
                           items-center
                           justify-center
                           rounded-xl
                           bg-blue-500/10
                           text-blue-500
                           sm:flex"
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
                            d="M12 15a3 3 0 100-6 3 3 0 000 6z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19.4 15a1.7 1.7 0 00.34 1.88l.06.06-1.7 1.7-.06-.06a1.7 1.7 0 00-1.88-.34 1.7 1.7 0 00-1.03 1.56V20h-2.4v-.2a1.7 1.7 0 00-1.03-1.56 1.7 1.7 0 00-1.88.34l-.06.06-1.7-1.7.06-.06A1.7 1.7 0 008.6 15a1.7 1.7 0 00-1.56-1.03H6v-2.4h.2A1.7 1.7 0 007.76 10a1.7 1.7 0 00-.34-1.88l-.06-.06 1.7-1.7.06.06A1.7 1.7 0 0011 6.76 1.7 1.7 0 0012.03 5.2V5h2.4v.2A1.7 1.7 0 0015.46 6.76a1.7 1.7 0 001.88-.34l.06-.06 1.7 1.7-.06.06A1.7 1.7 0 0018.7 10a1.7 1.7 0 001.56 1.03h.2v2.4h-.2A1.7 1.7 0 0018.7 15z"
                        />

                    </svg>

                </div>

            </div>

        </div>

    </div>


    {{-- ============================================================= --}}
    {{-- REVIEW NOTICE --}}
    {{-- ============================================================= --}}

    <div
        class="relative overflow-hidden rounded-2xl
               border border-amber-200
               bg-amber-50
               px-5 py-4
               dark:border-amber-400/20
               dark:bg-amber-500/[0.06]"
    >

        <div class="flex items-start gap-4">

            <div
                class="flex h-10 w-10 shrink-0
                       items-center justify-center
                       rounded-xl
                       bg-amber-100
                       text-amber-600
                       dark:bg-amber-500/10
                       dark:text-amber-400"
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
                        d="M12 9v4m0 4h.01"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M10.29 3.86l-8.18 14A2 2 0 003.84 21h16.32a2 2 0 001.73-3.14l-8.18-14a2 2 0 00-3.42 0z"
                    />

                </svg>

            </div>


            <div class="min-w-0">

                <p
                    class="font-bold
                           text-amber-800
                           dark:text-amber-300"
                >
                    Please review carefully
                </p>

                <p
                    class="mt-1
                           text-sm
                           leading-6
                           text-amber-700/80
                           dark:text-amber-400/80"
                >
                    Make sure every candidate shown below is the candidate
                    you intend to vote for. Your vote becomes final after confirmation.
                </p>

            </div>

        </div>

    </div>


    {{-- ============================================================= --}}
    {{-- YOUR SELECTIONS --}}
    {{-- ============================================================= --}}

    <div
        class="overflow-hidden rounded-3xl
               border border-slate-200
               bg-white
               shadow-sm
               dark:border-white/10
               dark:bg-[#101d35]
               dark:shadow-none"
    >

        {{-- Header --}}

        <div
            class="border-b
                   border-slate-200
                   px-5 py-5
                   dark:border-white/10
                   sm:px-6"
        >

            <div class="flex items-center justify-between gap-4">

                <div>

                    <p
                        class="text-[10px]
                               font-bold
                               uppercase
                               tracking-[0.2em]
                               text-blue-600
                               dark:text-blue-400"
                    >
                        Your Selections
                    </p>

                    <h2
                        class="mt-1
                               text-xl
                               font-black
                               text-slate-900
                               dark:text-white"
                    >
                        {{ count($selectedCandidates) }}
                        Position{{ count($selectedCandidates) !== 1 ? 's' : '' }}
                        Selected
                    </h2>

                </div>


                <div
                    class="flex h-11 w-11 shrink-0
                           items-center justify-center
                           rounded-xl
                           bg-emerald-500/10"
                >

                    <svg
                        class="h-5 w-5 text-emerald-500"
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

            </div>

        </div>


        {{-- Selection list --}}

        <div
            class="divide-y
                   divide-slate-200
                   dark:divide-white/10"
        >

            @forelse($selectedCandidates as $selection)

                @php

                    $position =
                        $selection['position'];

                    $candidate =
                        $selection['candidate'];

                @endphp


                <div class="p-5 sm:p-6">

                    <div
                        class="grid
                               gap-4
                               lg:grid-cols-[minmax(0,1fr)_minmax(320px,430px)]
                               lg:items-center"
                    >

                        {{-- POSITION --}}

                        <div class="flex items-center gap-4">

                            <div
                                class="flex h-11 w-11 shrink-0
                                       items-center justify-center
                                       rounded-xl
                                       bg-blue-500/10
                                       text-sm
                                       font-black
                                       text-blue-600
                                       dark:text-blue-400"
                            >

                                {{ $loop->iteration }}

                            </div>


                            <div class="min-w-0">

                                <p
                                    class="text-[10px]
                                           font-bold
                                           uppercase
                                           tracking-[0.18em]
                                           text-slate-400
                                           dark:text-gray-500"
                                >
                                    Position
                                </p>

                                <h3
                                    class="mt-1
                                           text-lg
                                           font-black
                                           text-slate-900
                                           dark:text-white"
                                >
                                    {{ $position->name }}
                                </h3>

                            </div>

                        </div>


                        {{-- CANDIDATE --}}

                        <div
                            class="flex
                                   items-center
                                   gap-4
                                   rounded-2xl
                                   border
                                   border-emerald-200
                                   bg-emerald-50/70
                                   p-3.5
                                   dark:border-emerald-500/20
                                   dark:bg-emerald-500/[0.05]"
                        >

                            {{-- PHOTO --}}

                            <div
                                class="h-14 w-14 shrink-0
                                       overflow-hidden
                                       rounded-xl
                                       bg-slate-100
                                       dark:bg-slate-800"
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
                                               bg-gradient-to-br
                                               from-slate-100
                                               to-slate-200
                                               dark:from-slate-800
                                               dark:to-slate-900"
                                    >

                                        <span
                                            class="text-xl
                                                   font-black
                                                   text-slate-400
                                                   dark:text-slate-500"
                                        >
                                            {{ strtoupper(substr($candidate->name, 0, 1)) }}
                                        </span>

                                    </div>

                                @endif

                            </div>


                            {{-- DETAILS --}}

                            <div class="min-w-0 flex-1">

                                <p
                                    class="text-[10px]
                                           font-bold
                                           uppercase
                                           tracking-[0.16em]
                                           text-slate-400
                                           dark:text-gray-500"
                                >
                                    Selected Candidate
                                </p>

                                <p
                                    class="mt-1
                                           truncate
                                           text-sm
                                           font-black
                                           text-slate-900
                                           dark:text-white"
                                >
                                    {{ $candidate->name }}
                                </p>

                                <div
                                    class="mt-1.5
                                           flex
                                           items-center
                                           gap-1.5
                                           text-xs
                                           font-semibold
                                           text-emerald-600
                                           dark:text-emerald-400"
                                >

                                    <span
                                        class="flex h-5 w-5
                                               items-center justify-center
                                               rounded-full
                                               bg-emerald-500/10"
                                    >

                                        <svg
                                            class="h-3 w-3"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="2.5"
                                        >

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M5 13l4 4L19 7"
                                            />

                                        </svg>

                                    </span>

                                    Selected

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="p-10 text-center">

                    <div
                        class="mx-auto flex h-12 w-12
                               items-center justify-center
                               rounded-2xl
                               bg-red-500/10"
                    >

                        <svg
                            class="h-6 w-6 text-red-500"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >

                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                            />

                            <path
                                stroke-linecap="round"
                                d="M12 8v4m0 4h.01"
                            />

                        </svg>

                    </div>

                    <p
                        class="mt-4
                               font-bold
                               text-red-600
                               dark:text-red-300"
                    >
                        No selections were found.
                    </p>

                    <p
                        class="mt-1
                               text-sm
                               text-slate-500
                               dark:text-gray-500"
                    >
                        Please return to the ballot and make your selections.
                    </p>

                </div>

            @endforelse

        </div>

    </div>


    {{-- ============================================================= --}}
    {{-- FINAL CONFIRMATION --}}
    {{-- ============================================================= --}}

    @if(count($selectedCandidates) > 0)

        <div
            class="rounded-2xl
                   border border-red-200
                   bg-red-50
                   p-5
                   dark:border-red-500/20
                   dark:bg-red-500/[0.04]"
        >

            <div class="flex items-start gap-4">

                <div
                    class="flex h-10 w-10 shrink-0
                           items-center justify-center
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
                            d="M12 9v4m0 4h.01"
                        />

                        <circle
                            cx="12"
                            cy="12"
                            r="9"
                        />

                    </svg>

                </div>


                <div>

                    <p
                        class="font-bold
                               text-red-700
                               dark:text-red-300"
                    >
                        Final submission
                    </p>

                    <p
                        class="mt-1
                               text-sm
                               leading-6
                               text-red-600/80
                               dark:text-red-400/80"
                    >
                        After you confirm and submit your vote, you will not
                        be able to modify or cast another vote in this election.
                    </p>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- ACTION BUTTONS --}}
        {{-- ========================================================= --}}

        <div
            class="flex
                   flex-col-reverse
                   gap-3
                   sm:flex-row
                   sm:items-center
                   sm:justify-between"
        >

            {{-- BACK TO BALLOT --}}

            <a
                href="{{ route('voting.ballot', [$voter, $election, $session]) }}"
                class="inline-flex
                       items-center
                       justify-center
                       gap-2
                       rounded-xl
                       border
                       border-slate-200
                       bg-white
                       px-5
                       py-3
                       text-sm
                       font-bold
                       text-slate-700
                       shadow-sm
                       transition
                       hover:-translate-y-0.5
                       hover:border-slate-300
                       hover:shadow-md
                       dark:border-white/10
                       dark:bg-white/[0.03]
                       dark:text-gray-300
                       dark:hover:bg-white/[0.06]
                       dark:hover:text-white"
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
                        d="M19 12H5m7 7l-7-7 7-7"
                    />

                </svg>

                Back to Ballot

            </a>


            {{-- CONFIRM & SUBMIT --}}

            <form
                method="POST"
                action="{{ route('voting.submit', [$voter, $election, $session]) }}"
                onsubmit="return confirmFinalVote();"
            >

                @csrf

                <button
                    type="submit"
                    class="group
                           inline-flex
                           w-full
                           items-center
                           justify-center
                           gap-2.5
                           rounded-xl
                           bg-gradient-to-r
                           from-emerald-600
                           to-cyan-500
                           px-7
                           py-3.5
                           text-sm
                           font-black
                           text-white
                           shadow-lg
                           shadow-emerald-500/20
                           transition
                           duration-200
                           hover:-translate-y-0.5
                           hover:shadow-xl
                           hover:shadow-emerald-500/25
                           active:translate-y-0
                           sm:w-auto"
                >

                    <svg
                        class="h-5 w-5 transition-transform duration-200 group-hover:scale-110"
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

                    Confirm & Submit Vote

                </button>

            </form>

        </div>

    @endif


    {{-- ============================================================= --}}
    {{-- SECURITY FOOTER --}}
    {{-- ============================================================= --}}

    <div class="pt-1 text-center">

        <div
            class="inline-flex
                   items-center
                   gap-2
                   rounded-full
                   border
                   border-slate-200
                   bg-white
                   px-4
                   py-2
                   text-[11px]
                   font-medium
                   text-slate-500
                   shadow-sm
                   dark:border-white/10
                   dark:bg-white/[0.02]
                   dark:text-gray-500"
        >

            <svg
                class="h-4 w-4 text-blue-500"
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

            </svg>

            Your vote is protected by Electo's secure voting system.

        </div>

    </div>

</div>


{{-- ============================================================= --}}
{{-- CONFIRMATION SCRIPT --}}
{{-- ============================================================= --}}

<script>

function confirmFinalVote() {

    return confirm(
        "Are you sure you want to submit your vote?\n\n" +
        "Once submitted, your vote cannot be changed."
    );

}

</script>

@endsection