@extends('electo.layouts.dashboard')

@section('title', 'Elections')
@section('page-title', 'Elections')

@section('content')

    {{-- ========================================================= --}}
    {{-- PAGE HEADER --}}
    {{-- ========================================================= --}}

    <x-electo.page-header
        title="Elections"
        subtitle="Manage and monitor all your organization's elections">

        <x-slot:actions>

            <a href="{{ route('elections.create') }}">

                <x-electo.button>

                    <span class="flex items-center gap-2">

                        <span class="text-lg">+</span>

                        New Election

                    </span>

                </x-electo.button>

            </a>

        </x-slot:actions>

    </x-electo.page-header>


    {{-- ========================================================= --}}
    {{-- STATISTICS --}}
    {{-- ========================================================= --}}

    <div
        class="mb-6 grid grid-cols-1 gap-4
               sm:grid-cols-2
               xl:grid-cols-4">


        {{-- ===================================================== --}}
        {{-- TOTAL ELECTIONS --}}
        {{-- ===================================================== --}}

        <div
            class="group relative overflow-hidden
                   rounded-2xl
                   border border-slate-200
                   bg-white
                   p-5
                   shadow-sm
                   transition-all
                   duration-300
                   hover:-translate-y-0.5
                   hover:border-slate-300
                   hover:shadow-lg

                   dark:border-white/10
                   dark:bg-[#132544]
                   dark:hover:border-white/20
                   dark:hover:bg-[#172d50]
                   dark:hover:shadow-xl">

            <div class="flex items-center justify-between">

                <div>

                    <p
                        class="text-sm font-medium
                               text-slate-500
                               dark:text-slate-400">

                        Total Elections

                    </p>

                    <p
                        class="mt-2 text-3xl font-black
                               text-slate-900
                               dark:text-white">

                        {{ $totalElections }}

                    </p>

                </div>

                <div
                    class="flex h-11 w-11
                           items-center
                           justify-center
                           rounded-xl
                           bg-slate-100
                           text-xl
                           transition
                           duration-300
                           group-hover:scale-105

                           dark:bg-white/[0.06]">

                    🗳️

                </div>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- ACTIVE ELECTIONS --}}
        {{-- ===================================================== --}}

        <div
            class="group relative overflow-hidden
                   rounded-2xl
                   border border-slate-200
                   bg-white
                   p-5
                   shadow-sm
                   transition-all
                   duration-300
                   hover:-translate-y-0.5
                   hover:border-slate-300
                   hover:shadow-lg

                   dark:border-white/10
                   dark:bg-[#132544]
                   dark:hover:border-white/20
                   dark:hover:bg-[#172d50]
                   dark:hover:shadow-xl">

            <div class="flex items-center justify-between">

                <div>

                    <p
                        class="text-sm font-medium
                               text-slate-500
                               dark:text-slate-400">

                        Active Elections

                    </p>

                    <p
                        class="mt-2 text-3xl font-black
                               text-slate-900
                               dark:text-white">

                        {{ $activeElections }}

                    </p>

                </div>

                <div
                    class="flex h-11 w-11
                           items-center
                           justify-center
                           rounded-xl
                           bg-slate-100
                           dark:bg-white/[0.06]">

                    <span
                        class="h-5 w-5
                               rounded-full
                               bg-green-500
                               shadow-[0_0_0_4px_rgba(34,197,94,0.15)]
                               shadow-green-500/40
                               transition
                               duration-300
                               group-hover:scale-110">
                    </span>

                </div>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- SCHEDULED ELECTIONS --}}
        {{-- ===================================================== --}}

        <div
            class="group relative overflow-hidden
                   rounded-2xl
                   border border-slate-200
                   bg-white
                   p-5
                   shadow-sm
                   transition-all
                   duration-300
                   hover:-translate-y-0.5
                   hover:border-slate-300
                   hover:shadow-lg

                   dark:border-white/10
                   dark:bg-[#132544]
                   dark:hover:border-white/20
                   dark:hover:bg-[#172d50]
                   dark:hover:shadow-xl">

            <div class="flex items-center justify-between">

                <div>

                    <p
                        class="text-sm font-medium
                               text-slate-500
                               dark:text-slate-400">

                        Scheduled

                    </p>

                    <p
                        class="mt-2 text-3xl font-black
                               text-slate-900
                               dark:text-white">

                        {{ $scheduledElections }}

                    </p>

                </div>

                <div
                    class="flex h-11 w-11
                           items-center
                           justify-center
                           rounded-xl
                           bg-slate-100
                           text-xl
                           transition
                           duration-300
                           group-hover:scale-105

                           dark:bg-white/[0.06]">

                    📅

                </div>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- COMPLETED ELECTIONS --}}
        {{-- ===================================================== --}}

        <div
            class="group relative overflow-hidden
                   rounded-2xl
                   border border-slate-200
                   bg-white
                   p-5
                   shadow-sm
                   transition-all
                   duration-300
                   hover:-translate-y-0.5
                   hover:border-slate-300
                   hover:shadow-lg

                   dark:border-white/10
                   dark:bg-[#132544]
                   dark:hover:border-white/20
                   dark:hover:bg-[#172d50]
                   dark:hover:shadow-xl">

            <div class="flex items-center justify-between">

                <div>

                    <p
                        class="text-sm font-medium
                               text-slate-500
                               dark:text-slate-400">

                        Completed

                    </p>

                    <p
                        class="mt-2 text-3xl font-black
                               text-slate-900
                               dark:text-white">

                        {{ $completedElections }}

                    </p>

                </div>

                <div
                    class="flex h-11 w-11
                           items-center
                           justify-center
                           rounded-xl
                           bg-slate-100
                           text-xl
                           transition
                           duration-300
                           group-hover:scale-105

                           dark:bg-white/[0.06]">

                    ✓

                </div>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- SEARCH + FILTER --}}
    {{-- ========================================================= --}}

    <div
        class="mb-6 rounded-2xl
               border border-slate-200
               bg-white
               p-4
               shadow-sm
               transition-all
               duration-300

               dark:border-white/10
               dark:bg-[#132544]
               dark:backdrop-blur-xl
               dark:shadow-xl">

        <form
            method="GET"
            action="{{ route('elections.index') }}"
            class="flex flex-col gap-3 lg:flex-row">


            {{-- Search --}}

            <div class="relative flex-1">

                <span
                    class="pointer-events-none
                           absolute left-4 top-1/2
                           -translate-y-1/2
                           text-slate-500
                           dark:text-slate-400">

                    🔍

                </span>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search elections or organizations..."
                    class="w-full rounded-xl
                           border border-slate-200
                           bg-slate-50
                           py-3 pl-11 pr-4
                           text-sm
                           text-slate-900
                           placeholder:text-slate-400
                           outline-none
                           transition

                           focus:border-cyan-500
                           focus:ring-2
                           focus:ring-cyan-500/20

                           dark:border-white/10
                           dark:bg-slate-950/50
                           dark:text-white
                           dark:placeholder:text-slate-500
                           dark:focus:border-cyan-400/40
                           dark:focus:ring-cyan-400/20">

            </div>


            {{-- Status Filter --}}

            <select
                name="status"
                class="rounded-xl
                       border border-slate-200
                       bg-slate-50
                       px-4 py-3
                       text-sm
                       text-slate-900
                       outline-none
                       transition

                       focus:border-cyan-500
                       focus:ring-2
                       focus:ring-cyan-500/20

                       dark:border-white/10
                       dark:bg-slate-950/50
                       dark:text-white
                       dark:focus:border-cyan-400/40
                       dark:focus:ring-cyan-400/20">

                <option value="">
                    All Statuses
                </option>

                <option
                    value="published"
                    @selected(request('status') === 'published')>

                    Published

                </option>

                <option
                    value="cancelled"
                    @selected(request('status') === 'cancelled')>

                    Cancelled

                </option>

            </select>


            {{-- Search Button --}}

            <x-electo.button type="submit">

                Search

            </x-electo.button>

        </form>

    </div>


    {{-- ========================================================= --}}
    {{-- ELECTIONS TABLE --}}
    {{-- ========================================================= --}}

    <div
        class="overflow-hidden rounded-2xl
               border border-slate-200
               bg-white
               shadow-sm
               transition-all
               duration-300

               dark:border-white/10
               dark:bg-[#132544]
               dark:shadow-xl">


        {{-- TABLE HEADER --}}

        <div
            class="border-b border-slate-200
                   px-6 py-5

                   dark:border-white/10">

            <div
                class="flex items-center
                       justify-between">

                <div>

                    <h2
                        class="text-lg font-bold
                               text-slate-900
                               dark:text-white">

                        All Elections

                    </h2>

                    <p
                        class="mt-1 text-sm
                               text-slate-500
                               dark:text-slate-400">

                        Elections belonging to your organizations.

                    </p>

                </div>

                <span
                    class="rounded-full
                           border border-slate-200
                           bg-slate-50
                           px-3 py-1
                           text-xs
                           text-slate-600

                           dark:border-white/10
                           dark:bg-[#132544]
                           dark:text-slate-400">

                    {{ $elections->total() }} Total

                </span>

            </div>

        </div>


        @if($elections->count())


            {{-- ================================================= --}}
            {{-- DESKTOP TABLE --}}
            {{-- ================================================= --}}

            <div class="hidden overflow-x-auto lg:block">

                <table class="w-full">

                    <thead>

                        <tr
                            class="border-b
                                   border-slate-200
                                   text-left

                                   dark:border-white/10">

                            <th
                                class="px-6 py-4
                                       text-xs
                                       font-semibold
                                       uppercase
                                       tracking-wider
                                       text-slate-500
                                       dark:text-slate-400">

                                Election

                            </th>

                            <th
                                class="px-6 py-4
                                       text-xs
                                       font-semibold
                                       uppercase
                                       tracking-wider
                                       text-slate-500
                                       dark:text-slate-400">

                                Organization

                            </th>

                            <th
                                class="px-6 py-4
                                       text-xs
                                       font-semibold
                                       uppercase
                                       tracking-wider
                                       text-slate-500
                                       dark:text-slate-400">

                                Status

                            </th>

                            <th
                                class="px-6 py-4
                                       text-xs
                                       font-semibold
                                       uppercase
                                       tracking-wider
                                       text-slate-500
                                       dark:text-slate-400">

                                Schedule

                            </th>

                            <th
                                class="px-6 py-4
                                       text-right
                                       text-xs
                                       font-semibold
                                       uppercase
                                       tracking-wider
                                       text-slate-500
                                       dark:text-slate-400">

                                Action

                            </th>

                        </tr>

                    </thead>


                    <tbody
                        class="divide-y
                               divide-slate-200
                               dark:divide-white/5">

                        @foreach($elections as $election)

                            @php

                                if ($election->isOngoing()) {

                                    $statusLabel = 'Active';
                                    $statusClass = 'emerald';

                                } elseif ($election->isScheduled()) {

                                    $statusLabel = 'Scheduled';
                                    $statusClass = 'cyan';

                                } elseif ($election->isCompleted()) {

                                    $statusLabel = 'Completed';
                                    $statusClass = 'violet';

                                } elseif ($election->isCancelled()) {

                                    $statusLabel = 'Cancelled';
                                    $statusClass = 'red';

                                } else {

                                    $statusLabel = ucfirst($election->status);
                                    $statusClass = 'slate';

                                }

                            @endphp


                            {{-- ROW --}}

                            <tr
                                class="group
                                       bg-transparent
                                       transition-all
                                       duration-200

                                       hover:bg-slate-50

                                       dark:hover:bg-[#172d50]
                                       dark:hover:shadow-[inset_0_1px_0_rgba(34,211,238,0.15),inset_0_-1px_0_rgba(59,130,246,0.10)]">


                                {{-- Election --}}

                                <td class="px-6 py-5">

                                    <div
                                        class="flex items-center gap-3">

                                        <div
                                            class="flex h-10 w-10
                                                   items-center
                                                   justify-center
                                                   rounded-xl
                                                   bg-cyan-500/10">

                                            🗳️

                                        </div>

                                        <div>

                                            <p
                                                class="font-semibold
                                                       text-slate-900
                                                       transition-colors
                                                       duration-200

                                                       dark:text-white
                                                       dark:group-hover:text-cyan-100">

                                                {{ $election->title }}

                                            </p>

                                            <p
                                                class="mt-1 text-xs
                                                       text-slate-500
                                                       dark:text-slate-400">

                                                {{ $election->electionType?->name ?? 'Election' }}

                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- Organization --}}

                                <td class="px-6 py-5">

                                    <p
                                        class="text-sm
                                               font-medium
                                               text-slate-700
                                               dark:text-slate-300">

                                        {{ $election->organization?->name ?? '—' }}

                                    </p>

                                </td>


                                {{-- Status --}}

                                <td class="px-6 py-5">

                                    <span
                                        class="
                                        inline-flex
                                        items-center
                                        gap-2
                                        rounded-full
                                        px-3
                                        py-1.5
                                        text-xs
                                        font-semibold

                                        @if($statusClass === 'emerald')

                                            bg-emerald-100
                                            text-emerald-700
                                            dark:bg-emerald-500/10
                                            dark:text-emerald-300

                                        @elseif($statusClass === 'cyan')

                                            bg-cyan-100
                                            text-cyan-700
                                            dark:bg-cyan-500/10
                                            dark:text-cyan-300

                                        @elseif($statusClass === 'violet')

                                            bg-violet-100
                                            text-violet-700
                                            dark:bg-violet-500/10
                                            dark:text-violet-300

                                        @elseif($statusClass === 'red')

                                            bg-red-100
                                            text-red-700
                                            dark:bg-red-500/10
                                            dark:text-red-300

                                        @else

                                            bg-slate-100
                                            text-slate-700
                                            dark:bg-slate-500/10
                                            dark:text-slate-300

                                        @endif
                                        ">

                                        <span
                                            class="h-1.5 w-1.5
                                                   rounded-full

                                                   @if($statusClass === 'emerald')

                                                       bg-emerald-500

                                                   @elseif($statusClass === 'cyan')

                                                       bg-cyan-500

                                                   @elseif($statusClass === 'violet')

                                                       bg-violet-500

                                                   @elseif($statusClass === 'red')

                                                       bg-red-500

                                                   @else

                                                       bg-slate-500

                                                   @endif
                                                   ">

                                        </span>

                                        {{ $statusLabel }}

                                    </span>

                                </td>


                                {{-- Schedule --}}

                                <td class="px-6 py-5">

                                    @if($election->starts_at)

                                        <p
                                            class="text-sm
                                                   text-slate-700
                                                   dark:text-slate-300">

                                            {{ $election->starts_at->format('d M Y') }}

                                        </p>

                                        <p
                                            class="mt-1 text-xs
                                                   text-slate-500
                                                   dark:text-slate-400">

                                            {{ $election->starts_at->format('h:i A') }}

                                        </p>

                                    @else

                                        <span
                                            class="text-sm
                                                   text-slate-500
                                                   dark:text-slate-400">

                                            Not scheduled

                                        </span>

                                    @endif

                                </td>


                                {{-- Action --}}

                                <td
                                    class="px-6 py-5
                                           text-right">

                                    <a
                                        href="{{ route('elections.show', $election) }}"
                                        class="inline-flex
                                               items-center
                                               rounded-xl
                                               border
                                               border-slate-200
                                               bg-slate-50
                                               px-4 py-2
                                               text-sm
                                               font-semibold
                                               text-slate-700
                                               transition-all
                                               duration-200

                                               hover:border-cyan-300
                                               hover:bg-cyan-50
                                               hover:text-cyan-700

                                               dark:border-white/10
                                               dark:bg-white/[0.04]
                                               dark:text-slate-200
                                               dark:hover:border-cyan-400/30
                                               dark:hover:bg-cyan-400/10
                                               dark:hover:text-cyan-300">

                                        View

                                    </a>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- ================================================= --}}
            {{-- MOBILE CARDS --}}
            {{-- ================================================= --}}

            <div
                class="space-y-3 p-4 lg:hidden">

                @foreach($elections as $election)

                    @php

                        if ($election->isOngoing()) {

                            $mobileStatusLabel = 'Active';

                        } elseif ($election->isScheduled()) {

                            $mobileStatusLabel = 'Scheduled';

                        } elseif ($election->isCompleted()) {

                            $mobileStatusLabel = 'Completed';

                        } elseif ($election->isCancelled()) {

                            $mobileStatusLabel = 'Cancelled';

                        } else {

                            $mobileStatusLabel = ucfirst($election->status);

                        }

                    @endphp

                    <div
                        class="rounded-2xl
                               border border-slate-200
                               bg-slate-50
                               p-4

                               dark:border-white/10
                               dark:bg-white/[0.025]">

                        <div
                            class="flex items-start
                                   justify-between
                                   gap-3">

                            <div>

                                <p
                                    class="font-semibold
                                           text-slate-900
                                           dark:text-white">

                                    {{ $election->title }}

                                </p>

                                <p
                                    class="mt-1 text-sm
                                           text-slate-600
                                           dark:text-slate-400">

                                    {{ $election->organization?->name ?? '—' }}

                                </p>

                            </div>


                            <span
                                class="rounded-full
                                       bg-cyan-100
                                       px-3 py-1
                                       text-xs
                                       font-semibold
                                       text-cyan-700

                                       dark:bg-cyan-500/10
                                       dark:text-cyan-300">

                                {{ $mobileStatusLabel }}

                            </span>

                        </div>


                        <div
                            class="mt-4 flex
                                   items-center
                                   justify-between">

                            <span
                                class="text-xs
                                       text-slate-500
                                       dark:text-slate-400">

                                @if($election->starts_at)

                                    {{ $election->starts_at->format('d M Y') }}

                                @else

                                    Not scheduled

                                @endif

                            </span>


                            <a
                                href="{{ route('elections.show', $election) }}"
                                class="text-sm
                                       font-semibold
                                       text-cyan-600

                                       dark:text-cyan-300">

                                View →

                            </a>

                        </div>

                    </div>

                @endforeach

            </div>


            {{-- ================================================= --}}
            {{-- PAGINATION --}}
            {{-- ================================================= --}}

            <div
                class="border-t
                       border-slate-200
                       px-6 py-4

                       dark:border-white/10">

                {{ $elections->links() }}

            </div>


        @else


            {{-- ================================================= --}}
            {{-- EMPTY STATE --}}
            {{-- ================================================= --}}

            <div
                class="px-6 py-20
                       text-center">

                <div
                    class="mx-auto flex h-16 w-16
                           items-center
                           justify-center
                           rounded-2xl
                           bg-cyan-500/10
                           text-3xl">

                    🗳️

                </div>

                <h3
                    class="mt-5 text-xl
                           font-bold
                           text-slate-900
                           dark:text-white">

                    No elections yet

                </h3>

                <p
                    class="mx-auto mt-2
                           max-w-md
                           text-sm
                           leading-6
                           text-slate-600
                           dark:text-slate-400">

                    Create your first election and start managing
                    candidates, voters and results from one secure
                    platform.

                </p>

                <a
                    href="{{ route('elections.create') }}"
                    class="mt-6 inline-block">

                    <x-electo.button>

                        + Create Your First Election

                    </x-electo.button>

                </a>

            </div>

        @endif

    </div>

@endsection