@extends('electo.layouts.dashboard')

@section('title', 'Candidates - ' . $election->title)
@section('page-title', 'Candidates')

@section('content')

<div class="space-y-6">

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <div class="rounded-3xl border border-white/10 bg-[#132544] p-7">

        <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

            <div class="flex items-start gap-4">

                <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-blue-600">

                    <x-heroicon-o-users class="h-7 w-7 text-white"/>

                </div>

                <div>

                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-blue-400">
                        Election Candidates
                    </p>

                    <h1 class="mt-2 text-2xl font-bold text-white">
                        {{ $election->title }}
                    </h1>

                    <p class="mt-2 text-sm text-gray-400">
                        Manage candidates contesting each election position.
                    </p>

                </div>

            </div>

            <div class="flex flex-wrap gap-3">

                <a href="{{ route('elections.show', $election) }}">

                    <x-electo.button variant="secondary">

                        <span class="flex items-center gap-2">

                            <x-heroicon-o-arrow-left class="h-5 w-5"/>

                            Back to Election

                        </span>

                    </x-electo.button>

                </a>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- SUMMARY --}}
    {{-- ========================================================= --}}

    @php
        $totalCandidates = $election->candidates()->count();
        $totalPositions = $election->positions->count();
    @endphp

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">

        {{-- Candidates --}}

        <div class="rounded-2xl border border-white/10 bg-[#132544] p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-400">
                        Total Candidates
                    </p>

                    <p class="mt-2 text-3xl font-bold text-white">
                        {{ $totalCandidates }}
                    </p>

                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-500/10 text-blue-400">

                    <x-heroicon-o-user-group class="h-6 w-6"/>

                </div>

            </div>

        </div>


        {{-- Positions --}}

        <div class="rounded-2xl border border-white/10 bg-[#132544] p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-400">
                        Election Positions
                    </p>

                    <p class="mt-2 text-3xl font-bold text-white">
                        {{ $totalPositions }}
                    </p>

                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-purple-500/10 text-purple-400">

                    <x-heroicon-o-briefcase class="h-6 w-6"/>

                </div>

            </div>

        </div>


        {{-- Status --}}

        <div class="rounded-2xl border border-white/10 bg-[#132544] p-5">

            <p class="text-sm text-gray-400">
                Election Status
            </p>

            <div class="mt-3">

                @if($election->status === 'draft')

                    <span class="inline-flex rounded-full bg-yellow-500/15 px-4 py-2 text-sm font-semibold text-yellow-400">
                        ● Draft
                    </span>

                @elseif($election->status === 'published')

                    <span class="inline-flex rounded-full bg-emerald-500/15 px-4 py-2 text-sm font-semibold text-emerald-400">
                        ● Published
                    </span>

                @else

                    <span class="inline-flex rounded-full bg-red-500/15 px-4 py-2 text-sm font-semibold text-red-400">
                        ● Cancelled
                    </span>

                @endif

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- POSITIONS --}}
    {{-- ========================================================= --}}

    <div class="rounded-3xl border border-white/10 bg-[#132544] p-7">

        <div class="mb-7">

            <h2 class="text-xl font-bold text-white">
                Candidates by Position
            </h2>

            <p class="mt-1 text-sm text-gray-400">
                Add and manage candidates for each position.
            </p>

        </div>


        @if($election->positions->count())

            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">

                @foreach($election->positions as $position)

                    <div class="overflow-hidden rounded-2xl border border-white/10 bg-[#0B1730]">

                        {{-- Position Header --}}

                        <div class="border-b border-white/10 p-5">

                            <div class="flex items-start justify-between gap-3">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-600/15 font-bold text-blue-400">

                                        {{ $position->sort_order }}

                                    </div>

                                    <div>

                                        <h3 class="font-bold text-white">
                                            {{ $position->name }}
                                        </h3>

                                        <p class="mt-1 text-xs text-gray-500">
                                            {{ $position->candidates->count() }}
                                            {{ $position->candidates->count() === 1 ? 'Candidate' : 'Candidates' }}
                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- Candidates --}}

                        <div class="p-5">

                            @if($position->candidates->count())

                                <div class="space-y-3">

                                    @foreach($position->candidates as $candidate)

                                        <div class="flex items-center gap-3 rounded-xl border border-white/5 bg-white/[0.03] p-3">

                                            <div class="flex h-10 w-10 shrink-0 items-center justify-center overflow-hidden rounded-full bg-blue-600/20 font-semibold text-blue-400">

                                                @if($candidate->photo)

                                                    <img
                                                        src="{{ asset('storage/' . $candidate->photo) }}"
                                                        alt="{{ $candidate->name }}"
                                                        class="h-full w-full object-cover"
                                                    >

                                                @else

                                                    {{ strtoupper(substr($candidate->name, 0, 1)) }}

                                                @endif

                                            </div>

                                            <div class="min-w-0 flex-1">

                                                <p class="truncate font-semibold text-white">
                                                    {{ $candidate->name }}
                                                </p>

                                                <p class="text-xs text-gray-500">
                                                    Candidate
                                                </p>

                                            </div>

                                            @if($candidate->status)

                                                <span class="h-2 w-2 rounded-full bg-emerald-400"></span>

                                            @else

                                                <span class="h-2 w-2 rounded-full bg-gray-500"></span>

                                            @endif

                                        </div>

                                    @endforeach

                                </div>

                            @else

                                <div class="rounded-xl border border-dashed border-white/10 p-5 text-center">

                                    <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full bg-white/5">

                                        <x-heroicon-o-user class="h-5 w-5 text-gray-500"/>

                                    </div>

                                    <p class="mt-3 text-sm text-gray-500">
                                        No candidates added yet.
                                    </p>

                                </div>

                            @endif


                            {{-- Add Candidate --}}

                            <div class="mt-4">

                                <a
                                    href="{{ route('candidates.create', [
                                        'election' => $election->id,
                                        'position' => $position->id,
                                    ]) }}"
                                    class="flex w-full items-center justify-center gap-2 rounded-xl border border-blue-500/30 bg-blue-500/10 px-4 py-3 text-sm font-semibold text-blue-400 transition hover:bg-blue-500/20 hover:text-blue-300"
                                >

                                    <x-heroicon-o-plus class="h-5 w-5"/>

                                    Add Candidate

                                </a>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="rounded-2xl border border-dashed border-white/10 p-10 text-center">

                <p class="text-gray-400">
                    No election positions have been created yet.
                </p>

            </div>

        @endif

    </div>

</div>

@endsection