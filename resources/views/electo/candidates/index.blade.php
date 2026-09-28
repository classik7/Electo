@extends('electo.layouts.dashboard')

@section('title', 'Candidates')
@section('page-title', 'Candidates')

@section('content')

<div class="space-y-6">

    {{-- ========================================================= --}}
    {{-- SUCCESS MESSAGE --}}
    {{-- ========================================================= --}}

    @if(session('success'))

        <div
            class="rounded-xl
                   border border-emerald-500/30
                   bg-emerald-500/10
                   px-5 py-4"
        >

            <div class="flex items-center gap-3">

                <div
                    class="flex h-8 w-8 shrink-0
                           items-center justify-center
                           rounded-full
                           bg-emerald-500/20"
                >

                    <svg
                        class="h-5 w-5 text-emerald-600 dark:text-emerald-400"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7"
                        />

                    </svg>

                </div>

                <p class="text-sm font-medium text-emerald-600 dark:text-emerald-300">
                    {{ session('success') }}
                </p>

            </div>

        </div>

    @endif


    {{-- ========================================================= --}}
    {{-- ERROR MESSAGE --}}
    {{-- ========================================================= --}}

    @if(session('error'))

        <div
            class="rounded-xl
                   border border-red-500/30
                   bg-red-500/10
                   px-5 py-4"
        >

            <div class="flex items-center gap-3">

                <div
                    class="flex h-8 w-8 shrink-0
                           items-center justify-center
                           rounded-full
                           bg-red-500/20"
                >

                    <svg
                        class="h-5 w-5 text-red-600 dark:text-red-400"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 8v4m0 4h.01"
                        />

                        <circle
                            cx="12"
                            cy="12"
                            r="9"
                        />

                    </svg>

                </div>

                <p class="text-sm font-medium text-red-600 dark:text-red-300">
                    {{ session('error') }}
                </p>

            </div>

        </div>

    @endif


    {{-- ========================================================= --}}
    {{-- PAGE HEADER --}}
    {{-- ========================================================= --}}

    <div
        class="rounded-3xl
               border border-slate-200
               bg-white
               p-6
               shadow-sm
               md:p-7
               dark:border-white/10
               dark:bg-[#132544]
               dark:shadow-none"
    >

        <div
            class="flex flex-col gap-5
                   lg:flex-row
                   lg:items-center
                   lg:justify-between
                   lg:gap-6"
        >

            {{-- ================================================= --}}
            {{-- TITLE --}}
            {{-- ================================================= --}}

            <div
                class="min-w-0
                       flex-1
                       flex items-start gap-4"
            >

                <div
                    class="flex h-14 w-14 shrink-0
                           items-center justify-center
                           rounded-2xl
                           bg-blue-600
                           shadow-lg
                           shadow-blue-600/20"
                >

                    <svg
                        class="h-7 w-7 text-white"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M17 20h5v-1a4 4 0 00-4-4h-1M9 20H2v-1a4 4 0 014-4h3m6-8a3 3 0 11-6 0 3 3 0 016 0zm5 3a2 2 0 10-4 0 2 2 0 004 0z"
                        />

                    </svg>

                </div>


                <div class="min-w-0">

                    <p
                        class="text-xs font-semibold
                               uppercase
                               tracking-[0.2em]
                               text-blue-600
                               dark:text-blue-400"
                    >
                        Election Candidates
                    </p>

                    <h1
                        class="mt-2
                               text-2xl
                               font-bold
                               leading-tight
                               text-slate-900
                               dark:text-white
                               md:text-3xl"
                    >
                        {{ $election->title }}
                    </h1>

                    <p
                        class="mt-2
                               text-sm
                               text-slate-500
                               dark:text-gray-400"
                    >
                        Manage candidates contesting each election position.
                    </p>

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- HEADER ACTIONS --}}
            {{-- ================================================= --}}

            <div
                class="flex
                       shrink-0
                       flex-nowrap
                       items-center
                       gap-2"
            >

                {{-- =================================================
                     BULK CANDIDATE IMPORT
                ================================================== --}}

                <a
                    href="{{ route('admin.candidates.import.create', [
                        'election_id' => $election->id,
                    ]) }}"
                    class="group
                           inline-flex
                           shrink-0
                           items-center
                           justify-center
                           gap-1.5
                           whitespace-nowrap
                           rounded-xl
                           border
                           border-blue-200
                           bg-blue-50
                           px-3
                           py-2.5
                           text-xs
                           font-bold
                           text-blue-700
                           shadow-sm
                           transition-all
                           duration-200
                           hover:-translate-y-0.5
                           hover:border-blue-300
                           hover:bg-blue-100
                           hover:shadow-md
                           dark:border-blue-400/20
                           dark:bg-blue-500/10
                           dark:text-blue-300
                           dark:hover:border-blue-400/30
                           dark:hover:bg-blue-500/15"
                >

                    <svg
                        class="h-4 w-4 shrink-0
                               transition-transform
                               duration-200
                               group-hover:-translate-y-0.5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 3v12"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M7 10l5 5 5-5"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M5 21h14"
                        />

                    </svg>

                    <span>
                        Import Candidates
                    </span>

                    <span
                        class="rounded-full
                               bg-blue-600/10
                               px-2
                               py-0.5
                               text-[9px]
                               font-black
                               uppercase
                               tracking-wider
                               text-blue-700
                               dark:bg-blue-400/10
                               dark:text-blue-300"
                    >
                        Bulk
                    </span>

                </a>


                {{-- =================================================
                     BACK TO CANDIDATES
                ================================================== --}}

                <a
                    href="{{ route('candidates.index') }}"
                    class="shrink-0"
                >

                    <x-electo.button variant="secondary">

                        <span
                            class="flex
                                   items-center
                                   gap-2
                                   whitespace-nowrap"
                        >

                            <x-heroicon-o-arrow-left
                                class="h-5 w-5 shrink-0"
                            />

                            Back to Candidates

                        </span>

                    </x-electo.button>

                </a>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- STATISTICS --}}
    {{-- ========================================================= --}}

    @php

        $totalCandidates =
            $election->candidates->count();

        $totalPositions =
            $election->positions->count();

        $activeCandidates =
            $election->candidates
                ->where('status', true)
                ->count();

        $inactiveCandidates =
            $totalCandidates -
            $activeCandidates;

    @endphp


    <div
        class="grid
               grid-cols-1
               gap-5
               sm:grid-cols-2
               xl:grid-cols-4"
    >

        {{-- TOTAL CANDIDATES --}}

        <div
            class="rounded-2xl
                   border
                   border-slate-200
                   bg-white
                   p-5
                   shadow-sm
                   dark:border-white/10
                   dark:bg-[#132544]
                   dark:shadow-none"
        >

            <div class="flex items-center justify-between">

                <div>

                    <p
                        class="text-sm
                               text-slate-500
                               dark:text-gray-400"
                    >
                        Total Candidates
                    </p>

                    <p
                        class="mt-2
                               text-3xl
                               font-bold
                               text-slate-900
                               dark:text-white"
                    >
                        {{ $totalCandidates }}
                    </p>

                </div>

                <div
                    class="flex h-12 w-12
                           items-center justify-center
                           rounded-xl
                           bg-blue-500/10"
                >

                    <svg
                        class="h-6 w-6 text-blue-400"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M17 20h5v-1a4 4 0 00-4-4h-1M9 20H2v-1a4 4 0 014-4h3m6-8a3 3 0 11-6 0 3 3 0 016 0zm5 3a2 2 0 10-4 0 2 2 0 004 0z"
                        />

                    </svg>

                </div>

            </div>

        </div>


        {{-- ELECTION POSITIONS --}}

        <div
            class="rounded-2xl
                   border
                   border-slate-200
                   bg-white
                   p-5
                   shadow-sm
                   dark:border-white/10
                   dark:bg-[#132544]
                   dark:shadow-none"
        >

            <div class="flex items-center justify-between">

                <div>

                    <p
                        class="text-sm
                               text-slate-500
                               dark:text-gray-400"
                    >
                        Election Positions
                    </p>

                    <p
                        class="mt-2
                               text-3xl
                               font-bold
                               text-slate-900
                               dark:text-white"
                    >
                        {{ $totalPositions }}
                    </p>

                </div>

                <div
                    class="flex h-12 w-12
                           items-center justify-center
                           rounded-xl
                           bg-purple-500/10"
                >

                    <svg
                        class="h-6 w-6 text-purple-400"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M20 7h-9M20 12h-9M20 17h-9M7 7h.01M7 12h.01M7 17h.01"
                        />

                    </svg>

                </div>

            </div>

        </div>


        {{-- ACTIVE CANDIDATES --}}

        <div
            class="rounded-2xl
                   border
                   border-slate-200
                   bg-white
                   p-5
                   shadow-sm
                   dark:border-white/10
                   dark:bg-[#132544]
                   dark:shadow-none"
        >

            <div class="flex items-center justify-between">

                <div>

                    <p
                        class="text-sm
                               text-slate-500
                               dark:text-gray-400"
                    >
                        Active Candidates
                    </p>

                    <p
                        class="mt-2
                               text-3xl
                               font-bold
                               text-emerald-600
                               dark:text-emerald-400"
                    >
                        {{ $activeCandidates }}
                    </p>

                </div>

                <div
                    class="flex h-12 w-12
                           items-center justify-center
                           rounded-xl
                           bg-emerald-500/10"
                >

                    <span
                        class="h-3 w-3
                               rounded-full
                               bg-emerald-400"
                    ></span>

                </div>

            </div>

        </div>


        {{-- INACTIVE CANDIDATES --}}

        <div
            class="rounded-2xl
                   border
                   border-slate-200
                   bg-white
                   p-5
                   shadow-sm
                   dark:border-white/10
                   dark:bg-[#132544]
                   dark:shadow-none"
        >

            <div class="flex items-center justify-between">

                <div>

                    <p
                        class="text-sm
                               text-slate-500
                               dark:text-gray-400"
                    >
                        Inactive Candidates
                    </p>

                    <p
                        class="mt-2
                               text-3xl
                               font-bold
                               text-slate-500
                               dark:text-gray-400"
                    >
                        {{ $inactiveCandidates }}
                    </p>

                </div>

                <div
                    class="flex h-12 w-12
                           items-center justify-center
                           rounded-xl
                           bg-slate-100
                           dark:bg-white/5"
                >

                    <span
                        class="h-3 w-3
                               rounded-full
                               bg-gray-500"
                    ></span>

                </div>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- CANDIDATES BY POSITION --}}
    {{-- ========================================================= --}}

    <div
        class="rounded-3xl
               border
               border-slate-200
               bg-white
               p-6
               shadow-sm
               md:p-7
               dark:border-white/10
               dark:bg-[#132544]
               dark:shadow-none"
    >

        <div class="mb-7">

            <h2
                class="text-xl
                       font-bold
                       text-slate-900
                       dark:text-white"
            >
                Candidates by Position
            </h2>

            <p
                class="mt-1
                       text-sm
                       text-slate-500
                       dark:text-gray-400"
            >
                Add and manage candidates for each election position.
            </p>

        </div>


        @if($election->positions->count() > 0)

            <div
                class="grid
                       grid-cols-1
                       gap-5
                       md:grid-cols-2
                       xl:grid-cols-3"
            >

                @foreach($election->positions as $position)

                    @php

                        $positionCandidates =
                            $position->candidates;

                        $candidateCount =
                            $positionCandidates->count();

                    @endphp


                    {{-- POSITION CARD --}}

                    <div
                        class="overflow-hidden
                               rounded-2xl
                               border
                               border-slate-200
                               bg-slate-50
                               transition-all
                               duration-200
                               hover:border-blue-400/40
                               hover:shadow-lg
                               hover:shadow-blue-500/5
                               dark:border-white/10
                               dark:bg-[#0B1730]
                               dark:hover:border-blue-500/30"
                    >

                        {{-- POSITION HEADER --}}

                        <div
                            class="border-b
                                   border-slate-200
                                   p-5
                                   dark:border-white/10"
                        >

                            <div
                                class="flex
                                       items-start
                                       justify-between
                                       gap-3"
                            >

                                <div
                                    class="flex
                                           items-center
                                           gap-3"
                                >

                                    <div
                                        class="flex
                                               h-11
                                               w-11
                                               shrink-0
                                               items-center
                                               justify-center
                                               rounded-xl
                                               bg-blue-600/15
                                               font-bold
                                               text-blue-600
                                               dark:text-blue-400"
                                    >
                                        {{ $position->sort_order }}
                                    </div>

                                    <div>

                                        <h3
                                            class="font-bold
                                                   text-slate-900
                                                   dark:text-white"
                                        >
                                            {{ $position->name }}
                                        </h3>

                                        <p
                                            class="mt-1
                                                   text-xs
                                                   text-slate-500
                                                   dark:text-gray-500"
                                        >
                                            {{ $candidateCount }}

                                            {{ $candidateCount === 1
                                                ? 'candidate'
                                                : 'candidates'
                                            }}
                                        </p>

                                    </div>

                                </div>


                                <span
                                    class="rounded-full
                                           bg-slate-100
                                           px-3
                                           py-1
                                           text-xs
                                           text-slate-500
                                           dark:bg-white/5
                                           dark:text-gray-400"
                                >
                                    {{ $candidateCount }}
                                </span>

                            </div>

                        </div>


                        {{-- CANDIDATES --}}

                        <div class="p-4">

                            @if($candidateCount > 0)

                                <div class="space-y-2">

                                    @foreach($positionCandidates as $candidate)

                                        <div
                                            class="rounded-xl
                                                   border
                                                   border-slate-200
                                                   bg-slate-50
                                                   p-3
                                                   transition
                                                   hover:border-blue-400/40
                                                   hover:bg-slate-100
                                                   dark:border-white/10
                                                   dark:bg-white/[0.03]
                                                   dark:hover:border-blue-500/20
                                                   dark:hover:bg-white/[0.05]"
                                        >

                                            <div
                                                class="flex
                                                       items-center
                                                       gap-3"
                                            >

                                                {{-- PHOTO --}}

                                                <a
                                                    href="{{ route('candidates.show', $candidate) }}"
                                                    class="shrink-0"
                                                >

                                                    @if($candidate->photo)

                                                        <img
                                                            src="{{ asset('storage/' . $candidate->photo) }}"
                                                            alt="{{ $candidate->name }}"
                                                            class="h-11
                                                                   w-11
                                                                   rounded-full
                                                                   object-cover
                                                                   ring-2
                                                                   ring-slate-200
                                                                   dark:ring-white/5"
                                                        >

                                                    @else

                                                        <div
                                                            class="flex
                                                                   h-11
                                                                   w-11
                                                                   items-center
                                                                   justify-center
                                                                   rounded-full
                                                                   bg-blue-600/20
                                                                   text-sm
                                                                   font-bold
                                                                   text-blue-400"
                                                        >
                                                            {{ strtoupper(substr($candidate->name, 0, 1)) }}
                                                        </div>

                                                    @endif

                                                </a>


                                                {{-- NAME --}}

                                                <div class="min-w-0 flex-1">

                                                    <a
                                                        href="{{ route('candidates.show', $candidate) }}"
                                                        class="block
                                                               truncate
                                                               text-sm
                                                               font-semibold
                                                               text-slate-900
                                                               transition
                                                               hover:text-blue-600
                                                               dark:text-white
                                                               dark:hover:text-blue-300"
                                                    >
                                                        {{ $candidate->name }}
                                                    </a>

                                                    <div
                                                        class="mt-1
                                                               flex
                                                               items-center
                                                               gap-2"
                                                    >

                                                        @if($candidate->status)

                                                            <span
                                                                class="text-xs
                                                                       text-emerald-600
                                                                       dark:text-emerald-400"
                                                            >
                                                                Active
                                                            </span>

                                                        @else

                                                            <span
                                                                class="text-xs
                                                                       text-slate-500
                                                                       dark:text-gray-500"
                                                            >
                                                                Inactive
                                                            </span>

                                                        @endif

                                                    </div>

                                                </div>


                                                {{-- STATUS --}}

                                                @if($candidate->status)

                                                    <span
                                                        title="Active"
                                                        class="h-2.5
                                                               w-2.5
                                                               shrink-0
                                                               rounded-full
                                                               bg-emerald-400"
                                                    ></span>

                                                @else

                                                    <span
                                                        title="Inactive"
                                                        class="h-2.5
                                                               w-2.5
                                                               shrink-0
                                                               rounded-full
                                                               bg-gray-500"
                                                    ></span>

                                                @endif

                                            </div>


                                            {{-- ACTIONS --}}

                                            <div
                                                class="mt-3
                                                       flex
                                                       items-center
                                                       gap-2
                                                       border-t
                                                       border-slate-200
                                                       pt-3
                                                       dark:border-white/5"
                                            >

                                                <a
                                                    href="{{ route('candidates.show', $candidate) }}"
                                                    class="flex
                                                           flex-1
                                                           items-center
                                                           justify-center
                                                           gap-2
                                                           rounded-lg
                                                           bg-slate-100
                                                           px-3
                                                           py-2
                                                           text-xs
                                                           font-semibold
                                                           text-slate-700
                                                           transition
                                                           hover:bg-slate-200
                                                           dark:bg-white/5
                                                           dark:text-gray-300
                                                           dark:hover:bg-white/10"
                                                >

                                                    <x-heroicon-o-eye class="h-4 w-4"/>

                                                    View

                                                </a>


                                                <a
                                                    href="{{ route('candidates.edit', $candidate) }}"
                                                    class="flex
                                                           flex-1
                                                           items-center
                                                           justify-center
                                                           gap-2
                                                           rounded-lg
                                                           bg-blue-500/10
                                                           px-3
                                                           py-2
                                                           text-xs
                                                           font-semibold
                                                           text-blue-600
                                                           transition
                                                           hover:bg-blue-500/20
                                                           dark:text-blue-400"
                                                >

                                                    <x-heroicon-o-pencil-square class="h-4 w-4"/>

                                                    Edit

                                                </a>


                                                <form
                                                    method="POST"
                                                    action="{{ route('candidates.destroy', $candidate) }}"
                                                    class="flex-1"
                                                    onsubmit="return confirm('Are you sure you want to remove {{ addslashes($candidate->name) }} from this election?');"
                                                >

                                                    @csrf

                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="flex
                                                               w-full
                                                               items-center
                                                               justify-center
                                                               gap-2
                                                               rounded-lg
                                                               bg-red-500/10
                                                               px-3
                                                               py-2
                                                               text-xs
                                                               font-semibold
                                                               text-red-600
                                                               transition
                                                               hover:bg-red-500/20
                                                               dark:text-red-400"
                                                    >

                                                        <x-heroicon-o-trash class="h-4 w-4"/>

                                                        Delete

                                                    </button>

                                                </form>

                                            </div>

                                        </div>

                                    @endforeach

                                </div>

                            @else

                                {{-- EMPTY POSITION --}}

                                <div
                                    class="rounded-xl
                                           border
                                           border-dashed
                                           border-slate-200
                                           p-6
                                           text-center
                                           dark:border-white/10"
                                >

                                    <div
                                        class="mx-auto
                                               flex
                                               h-11
                                               w-11
                                               items-center
                                               justify-center
                                               rounded-full
                                               bg-slate-100
                                               dark:bg-white/5"
                                    >

                                        <svg
                                            class="h-5 w-5
                                                   text-slate-500
                                                   dark:text-gray-500"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.8"
                                                d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m7-10a4 4 0 100-8 4 4 0 000 8zm9 3v-1a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"
                                            />

                                        </svg>

                                    </div>

                                    <p
                                        class="mt-3
                                               text-sm
                                               text-slate-500
                                               dark:text-gray-500"
                                    >
                                        No candidates added yet.
                                    </p>

                                </div>

                            @endif


                            {{-- =================================================
                                 ADD CANDIDATE
                            ================================================== --}}

                            <a
                                href="{{ route('candidates.create', [
                                    'election' => $election->id,
                                    'position' => $position->id,
                                ]) }}"
                                class="mt-3
                                       flex
                                       w-full
                                       items-center
                                       justify-center
                                       gap-2
                                       rounded-xl
                                       border
                                       border-blue-500/30
                                       bg-blue-500/10
                                       px-4
                                       py-3
                                       text-sm
                                       font-semibold
                                       text-blue-600
                                       transition
                                       hover:bg-blue-500/20
                                       dark:text-blue-400"
                            >

                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 4v16m8-8H4"
                                    />

                                </svg>

                                Add Candidate

                            </a>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div
                class="rounded-2xl
                       border
                       border-dashed
                       border-slate-200
                       p-10
                       text-center
                       dark:border-white/10"
            >

                <p
                    class="text-gray-400"
                >
                    No positions have been added to this election yet.
                </p>

            </div>

        @endif

    </div>

</div>

@endsection