@extends('electo.layouts.app')

@section('title', 'Cast Your Vote | Electo')

@section('content')

<div
    class="mx-auto w-full max-w-6xl space-y-8"
    x-data="votingBallot()"
>

    {{-- ============================================================= --}}
    {{-- HEADER --}}
    {{-- ============================================================= --}}

    <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

        <div>

            <p
                class="text-xs font-semibold uppercase tracking-widest
                       text-cyan-500 dark:text-cyan-400"
            >
                Secure Voting
            </p>

           <h1
    class="mt-2 text-3xl font-black tracking-tight
           text-white"
>
    {{ $election->title }}
</h1>

            <p
    class="mt-2 text-sm text-slate-400"
>
                Select one candidate for each position.
            </p>

        </div>


        {{-- ========================================================= --}}
        {{-- SESSION TIMER --}}
        {{-- ========================================================= --}}

        <div
            class="flex items-center gap-3 rounded-2xl
                   border border-amber-300
                   bg-amber-50
                   px-5 py-4
                   shadow-sm

                   dark:border-amber-500/20
                   dark:bg-amber-500/[0.05]"
        >

            <div
                class="flex h-10 w-10 items-center justify-center
                       rounded-xl
                       bg-amber-100
                       dark:bg-amber-500/10"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 text-amber-500 dark:text-amber-400"
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
                        d="M12 7v5l3 2"
                    />

                </svg>

            </div>

            <div>

                <p
                    class="text-xs uppercase tracking-wider
                           text-slate-500 dark:text-gray-500"
                >
                    Session expires in
                </p>

                <p
                    class="mt-1 font-mono text-lg font-bold
                           text-amber-600 dark:text-amber-400"
                    x-text="formattedTime"
                >
                    30:00
                </p>

            </div>

        </div>

    </div>


    {{-- ============================================================= --}}
    {{-- VOTER INFORMATION --}}
    {{-- ============================================================= --}}

    <div
        class="flex flex-col gap-4 rounded-2xl
               border border-slate-200
               bg-white
               p-5
               shadow-sm

               sm:flex-row
               sm:items-center
               sm:justify-between

               dark:border-white/10
               dark:bg-white/[0.03]"
    >

        <div class="flex items-center gap-4">

            <div
                class="flex h-12 w-12 shrink-0 items-center justify-center
                       rounded-full
                       bg-gradient-to-br from-blue-600 to-cyan-500
                       text-lg font-black text-white"
            >
                {{ strtoupper(substr($voter->name, 0, 1)) }}
            </div>

            <div>

                <p
                    class="text-xs uppercase tracking-wider
                           text-slate-500 dark:text-gray-500"
                >
                    Voting as
                </p>

                <p
                    class="mt-1 font-semibold
                           text-slate-900 dark:text-white"
                >
                    {{ $voter->name }}
                </p>

            </div>

        </div>


        <div class="flex items-center gap-3">

            <span
                class="h-2.5 w-2.5 rounded-full
                       bg-emerald-500 dark:bg-emerald-400"
            ></span>

            <span
                class="text-sm font-medium
                       text-emerald-600 dark:text-emerald-400"
            >
                Accredited
            </span>

        </div>

    </div>


    {{-- ============================================================= --}}
    {{-- ERROR MESSAGE --}}
    {{-- ============================================================= --}}

    @if($errors->any())

        <div
            class="rounded-2xl
                   border border-red-200
                   bg-red-50
                   p-5

                   dark:border-red-500/20
                   dark:bg-red-500/10"
        >

            <div class="flex items-start gap-3">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 shrink-0 text-red-500 dark:text-red-400"
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

                <div>

                    <p
                        class="text-sm font-semibold
                               text-red-700 dark:text-red-300"
                    >
                        Please review your selections.
                    </p>

                    @foreach($errors->all() as $error)

                        <p
                            class="mt-1 text-xs
                                   text-red-600 dark:text-red-400"
                        >
                            {{ $error }}
                        </p>

                    @endforeach

                </div>

            </div>

        </div>

    @endif


    {{-- ============================================================= --}}
    {{-- PROGRESS --}}
    {{-- ============================================================= --}}

    <div
        class="rounded-2xl
               border border-slate-200
               bg-white
               p-5
               shadow-sm

               dark:border-white/10
               dark:bg-white/[0.03]"
    >

        <div class="flex items-center justify-between">

            <div>

                <p
                    class="text-sm font-semibold
                           text-slate-900 dark:text-white"
                >
                    Voting Progress
                </p>

                <p
                    class="mt-1 text-xs
                           text-slate-500 dark:text-gray-500"
                >
                    Select a candidate for every position.
                </p>

            </div>

            <p
                class="text-sm font-bold
                       text-blue-600 dark:text-blue-400"
            >
                <span x-text="selectedCount"></span>
                /
                {{ $positions->count() }}
            </p>

        </div>


        <div
            class="mt-4 h-2 overflow-hidden rounded-full
                   bg-slate-200 dark:bg-white/10"
        >

            <div
                class="h-full rounded-full
                       bg-gradient-to-r from-blue-600 to-cyan-400
                       transition-all duration-500"
                :style="'width: ' + progress + '%'"
            ></div>

        </div>

    </div>


    {{-- ============================================================= --}}
    {{-- BALLOT --}}
    {{-- ============================================================= --}}

    <form
        method="POST"
        action="{{ route('voting.review', [$voter, $election, $session]) }}"
        @submit="submitting = true"
    >

        @csrf


        <div class="space-y-8">

            @forelse($positions as $position)

                {{-- ================================================= --}}
                {{-- POSITION --}}
                {{-- ================================================= --}}

                <section
                    class="overflow-hidden rounded-3xl
                           border border-slate-200
                           bg-white
                           shadow-sm

                           dark:border-white/10
                           dark:bg-white/[0.03]"
                >

                    <div
                        class="border-b border-slate-200
                               bg-slate-50
                               px-6 py-5

                               dark:border-white/10
                               dark:bg-white/[0.02]"
                    >

                        <div class="flex items-start gap-4">

                            <div
                                class="flex h-10 w-10 shrink-0
                                       items-center justify-center
                                       rounded-xl
                                       bg-blue-50
                                       text-sm font-black
                                       text-blue-600

                                       dark:bg-blue-500/10
                                       dark:text-blue-400"
                            >
                                {{ $loop->iteration }}
                            </div>

                            <div>

                                <h2
                                    class="text-xl font-bold
                                           text-slate-900 dark:text-white"
                                >
                                    {{ $position->name }}
                                </h2>

                                @if($position->description)

                                    <p
                                        class="mt-1 text-sm leading-6
                                               text-slate-500
                                               dark:text-gray-500"
                                    >
                                        {{ $position->description }}
                                    </p>

                                @else

                                    <p
                                        class="mt-1 text-sm
                                               text-slate-500
                                               dark:text-gray-500"
                                    >
                                        Select one candidate for this position.
                                    </p>

                                @endif

                            </div>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- CANDIDATES --}}
                    {{-- ================================================= --}}

                    <div
                        class="grid gap-4 p-6 md:grid-cols-2 lg:grid-cols-3"
                    >

                        @forelse($position->candidates as $candidate)

                            <label
                                class="group relative cursor-pointer"
                            >

                                <input
                                    type="radio"
                                    name="votes[{{ $position->id }}]"
                                    value="{{ $candidate->id }}"
                                    class="peer sr-only"
                                    @change="selectPosition({{ $position->id }})"
                                    required
                                >


                                {{-- Candidate Card --}}

                                <div
                                    class="h-full overflow-hidden rounded-2xl
                                           border border-slate-200
                                           bg-white
                                           shadow-sm

                                           transition-all duration-300

                                           hover:-translate-y-1
                                           hover:border-blue-300
                                           hover:bg-slate-50
                                           hover:shadow-lg

                                           peer-checked:border-blue-500
                                           peer-checked:bg-blue-50
                                           peer-checked:ring-2
                                           peer-checked:ring-blue-500/20

                                           dark:border-white/10
                                           dark:bg-slate-900/50

                                           dark:hover:border-blue-400/40
                                           dark:hover:bg-slate-800/80
                                           dark:hover:shadow-[0_15px_40px_rgba(0,0,0,.30)]

                                           dark:peer-checked:border-blue-500
                                           dark:peer-checked:bg-blue-500/[0.08]
                                           dark:peer-checked:ring-blue-500/20"
                                >

                                    {{-- Candidate Photo --}}

                                    <div
                                        class="relative aspect-[4/3]
                                               overflow-hidden
                                               bg-slate-100

                                               dark:bg-slate-800"
                                    >

                                        @if($candidate->photo)

                                            <img
                                                src="{{ asset('storage/' . $candidate->photo) }}"
                                                alt="{{ $candidate->name }}"
                                                class="h-full w-full object-cover
                                                       transition duration-500
                                                       group-hover:scale-105"
                                            >

                                        @else

                                            <div
                                                class="flex h-full w-full
                                                       items-center justify-center
                                                       bg-gradient-to-br
                                                       from-slate-200
                                                       to-slate-100

                                                       dark:from-slate-800
                                                       dark:to-slate-900"
                                            >

                                                <span
                                                    class="text-5xl font-black
                                                           text-slate-300
                                                           dark:text-slate-600"
                                                >
                                                    {{ strtoupper(substr($candidate->name, 0, 1)) }}
                                                </span>

                                            </div>

                                        @endif


                                        {{-- Selected Indicator --}}

                                        <div
                                            class="absolute right-3 top-3
                                                   flex h-8 w-8
                                                   items-center justify-center
                                                   rounded-full

                                                   border border-white/60
                                                   bg-white/90

                                                   opacity-0
                                                   transition

                                                   peer-checked:opacity-100

                                                   dark:border-white/20
                                                   dark:bg-slate-950/80"
                                        >

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5 text-emerald-500 dark:text-emerald-400"
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

                                        </div>

                                    </div>


                                    {{-- Candidate Details --}}

                                    <div class="p-5">

                                        <div
                                            class="flex items-start justify-between gap-3"
                                        >

                                            <div class="min-w-0">

                                                <h3
                                                    class="font-bold
                                                           text-slate-900
                                                           dark:text-white"
                                                >
                                                    {{ $candidate->name }}
                                                </h3>

                                                @if($candidate->bio)

                                                    <p
                                                        class="mt-2 line-clamp-3
                                                               text-xs leading-5
                                                               text-slate-500
                                                               dark:text-gray-500"
                                                    >
                                                        {{ $candidate->bio }}
                                                    </p>

                                                @endif

                                            </div>


                                            {{-- Radio Indicator --}}

                                            <div
                                                class="mt-1 h-5 w-5 shrink-0
                                                       rounded-full
                                                       border-2
                                                       border-slate-300
                                                       transition

                                                       peer-checked:border-blue-500
                                                       peer-checked:bg-blue-500

                                                       dark:border-gray-600
                                                       dark:peer-checked:border-blue-400"
                                            ></div>

                                        </div>

                                    </div>

                                </div>

                            </label>

                        @empty

                            <div
                                class="col-span-full rounded-2xl
                                       border border-amber-200
                                       bg-amber-50
                                       p-5

                                       dark:border-amber-500/20
                                       dark:bg-amber-500/[0.05]"
                            >

                                <p
                                    class="text-sm
                                           text-amber-700
                                           dark:text-amber-400"
                                >
                                    No active candidates are available for this position.
                                </p>

                            </div>

                        @endforelse

                    </div>

                </section>

            @empty

                <div
                    class="rounded-2xl
                           border border-red-200
                           bg-red-50
                           p-6

                           dark:border-red-500/20
                           dark:bg-red-500/10"
                >

                    <p
                        class="font-semibold
                               text-red-700
                               dark:text-red-300"
                    >
                        No voting positions are available for this election.
                    </p>

                </div>

            @endforelse

        </div>


        {{-- ============================================================= --}}
        {{-- SUBMIT / REVIEW --}}
        {{-- ============================================================= --}}

        @if($positions->count() > 0)

            <div
                class="mt-8 flex flex-col gap-4
                       rounded-2xl
                       border border-slate-200
                       bg-white
                       p-6
                       shadow-sm

                       sm:flex-row
                       sm:items-center
                       sm:justify-between

                       dark:border-white/10
                       dark:bg-white/[0.03]"
            >

                <div>

                    <p
                        class="font-semibold
                               text-slate-900
                               dark:text-white"
                    >
                        Ready to review?
                    </p>

                    <p
                        class="mt-1 text-sm
                               text-slate-500
                               dark:text-gray-500"
                    >
                        Your selections will be shown before the final submission.
                    </p>

                </div>


                <button
                    type="submit"
                    :disabled="selectedCount < {{ $positions->count() }} || submitting"
                    class="inline-flex items-center justify-center gap-3
                           rounded-xl
                           bg-gradient-to-r from-blue-600 to-cyan-500
                           px-7 py-3.5
                           text-sm font-bold text-white
                           shadow-lg shadow-blue-600/20
                           transition

                           hover:-translate-y-0.5
                           hover:shadow-xl
                           hover:shadow-blue-600/30

                           disabled:cursor-not-allowed
                           disabled:opacity-40"
                >

                    <span x-show="!submitting">
                        Review Vote
                    </span>

                    <span x-show="submitting">
                        Preparing Review...
                    </span>

                    <svg
                        x-show="!submitting"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
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

                </button>

            </div>

        @endif

    </form>


    {{-- ============================================================= --}}
    {{-- SECURITY NOTICE --}}
    {{-- ============================================================= --}}

    <div
        class="rounded-2xl
               border border-slate-200
               bg-slate-50
               p-5

               dark:border-white/10
               dark:bg-white/[0.02]"
    >

        <div class="flex items-start gap-3">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="mt-0.5 h-5 w-5
                       text-slate-500
                       dark:text-gray-500"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="1.8"
            >

                <path
                    d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"
                />

                <path
                    d="M9 12l2 2 4-4"
                />

            </svg>

            <div>

                <p
                    class="text-sm font-semibold
                           text-slate-800
                           dark:text-gray-300"
                >
                    Your vote is secure
                </p>

                <p
                    class="mt-1 text-xs leading-5
                           text-slate-500
                           dark:text-gray-500"
                >
                    Your vote will not be recorded until you review and
                    explicitly confirm your selections.
                </p>

            </div>

        </div>

    </div>


</div>


{{-- ============================================================= --}}
{{-- BALLOT JAVASCRIPT --}}
{{-- ============================================================= --}}

<script>

function votingBallot() {

    return {

        selected: {},

        selectedCount: 0,

        progress: 0,

        submitting: false,

        remainingSeconds: {{ $session->expires_at
            ? max(0, now()->diffInSeconds($session->expires_at, false))
            : 1800
        }},


        get formattedTime() {

            const minutes =
                Math.floor(this.remainingSeconds / 60)
                .toString()
                .padStart(2, '0');

            const seconds =
                (this.remainingSeconds % 60)
                .toString()
                .padStart(2, '0');

            return `${minutes}:${seconds}`;

        },


        selectPosition(positionId) {

            this.selected[positionId] = true;

            this.selectedCount =
                Object.keys(this.selected).length;

            this.progress =
                Math.round(
                    (
                        this.selectedCount /
                        {{ $positions->count() }}
                    ) * 100
                );

        },


        startTimer() {

            setInterval(() => {

                if (this.remainingSeconds > 0) {

                    this.remainingSeconds--;

                } else {

                    window.location.href =
                        "{{ route('accreditation.show', [$voter, $election]) }}";

                }

            }, 1000);

        },

    };

}


document.addEventListener(
    'alpine:init',
    () => {

        Alpine.data(
            'votingBallot',
            votingBallot
        );

    }
);


document.addEventListener(
    'DOMContentLoaded',
    () => {

        const component =
            document.querySelector('[x-data="votingBallot()"]');

        if (!component) {
            return;
        }

        const timer =
            component._x_dataStack?.[0];

        if (timer) {

            timer.startTimer();

        }

    }
);

</script>

@endsection