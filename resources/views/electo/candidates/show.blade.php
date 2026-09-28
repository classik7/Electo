@extends('electo.layouts.dashboard')

@section('title', $candidate->name)
@section('page-title', 'Candidate Profile')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-blue-400">
                Candidate Profile
            </p>

            <h1 class="mt-2 text-3xl font-bold text-white">
                {{ $candidate->name }}
            </h1>

            <p class="mt-2 text-sm text-gray-400">
                Candidate contesting in {{ $candidate->election->title }}.
            </p>
        </div>

        <div class="flex gap-3">

            <a href="{{ route('elections.candidates', $candidate->election) }}">
                <x-electo.button variant="secondary">
                    ← Back to Candidates
                </x-electo.button>
            </a>

            <a href="{{ route('candidates.edit', $candidate) }}">
                <x-electo.button>
                    ✎ Edit Candidate
                </x-electo.button>
            </a>

        </div>

    </div>


    {{-- Candidate Profile Card --}}
    <div class="overflow-hidden rounded-3xl border border-white/10 bg-[#132544]">

        <div class="p-8">

            <div class="flex flex-col gap-8 md:flex-row md:items-start">

                {{-- Photo --}}
                <div class="shrink-0">

                    @if($candidate->photo)

                        <img
                            src="{{ asset('storage/' . $candidate->photo) }}"
                            alt="{{ $candidate->name }}"
                            class="h-40 w-40 rounded-3xl object-cover ring-4 ring-blue-500/10"
                        >

                    @else

                        <div class="flex h-40 w-40 items-center justify-center rounded-3xl bg-blue-600 text-5xl font-bold text-white">

                            {{ strtoupper(substr($candidate->name, 0, 1)) }}

                        </div>

                    @endif

                </div>


                {{-- Information --}}
                <div class="flex-1">

                    <div class="flex flex-wrap items-center gap-3">

                        <h2 class="text-3xl font-bold text-white">
                            {{ $candidate->name }}
                        </h2>

                        @if($candidate->status)

                            <span class="rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-semibold text-emerald-400">
                                ● Active
                            </span>

                        @else

                            <span class="rounded-full bg-gray-500/10 px-3 py-1 text-xs font-semibold text-gray-400">
                                ● Inactive
                            </span>

                        @endif

                    </div>


                    {{-- Position --}}
                    <div class="mt-6 rounded-2xl border border-white/10 bg-[#0B1730] p-5">

                        <p class="text-xs uppercase tracking-wider text-gray-500">
                            Contesting Position
                        </p>

                        <div class="mt-3 flex items-center gap-3">

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-600/15 font-bold text-blue-400">

                                {{ $candidate->position->sort_order }}

                            </div>

                            <div>

                                <p class="font-semibold text-white">
                                    {{ $candidate->position->name }}
                                </p>

                                <p class="text-xs text-gray-500">
                                    Election position
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Election --}}
                    <div class="mt-4 rounded-2xl border border-white/10 bg-[#0B1730] p-5">

                        <p class="text-xs uppercase tracking-wider text-gray-500">
                            Election
                        </p>

                        <p class="mt-2 font-semibold text-white">
                            {{ $candidate->election->title }}
                        </p>

                        <p class="mt-1 text-xs text-gray-500">
                            {{ $candidate->election->organization->name ?? '' }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- Biography --}}
            <div class="mt-8 border-t border-white/10 pt-8">

                <h3 class="text-lg font-bold text-white">
                    Biography
                </h3>

                @if($candidate->bio)

                    <p class="mt-3 whitespace-pre-line text-sm leading-7 text-gray-400">
                        {{ $candidate->bio }}
                    </p>

                @else

                    <p class="mt-3 text-sm italic text-gray-500">
                        No biography has been provided for this candidate.
                    </p>

                @endif

            </div>

        </div>

    </div>


    {{-- Delete --}}
    <div class="rounded-2xl border border-red-500/10 bg-red-500/5 p-6">

        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

            <div>

                <h3 class="font-semibold text-white">
                    Remove Candidate
                </h3>

                <p class="mt-1 text-sm text-gray-500">
                    Remove this candidate from the election.
                </p>

            </div>

            <form
                method="POST"
                action="{{ route('candidates.destroy', $candidate) }}"
                onsubmit="return confirm('Are you sure you want to remove this candidate?');"
            >

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="rounded-xl border border-red-500/20 bg-red-500/10 px-5 py-3 text-sm font-semibold text-red-400 transition hover:bg-red-500/20"
                >
                    Remove Candidate
                </button>

            </form>

        </div>

    </div>

</div>

@endsection