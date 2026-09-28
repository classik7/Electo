@extends('electo.layouts.app')

@section('title', 'Voters')
@section('page-title', 'Voters')

@section('content')

<div class="mx-auto w-full max-w-7xl space-y-7 pb-10">

    {{-- ============================================================
        PAGE HEADER
    ============================================================= --}}

    <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">

        <div>

            <div class="inline-flex items-center gap-2 rounded-full
                        border border-blue-100 bg-blue-50
                        px-3 py-1.5
                        dark:border-blue-400/20 dark:bg-blue-500/10">

                <span class="h-1.5 w-1.5 rounded-full
                             bg-blue-600 dark:bg-blue-400"></span>

                <span class="text-[10px] font-bold uppercase
                             tracking-[0.18em]
                             text-blue-700 dark:text-blue-300">
                    Voter Management
                </span>

            </div>

            <h1 class="mt-3 text-3xl font-black tracking-tight
                       text-slate-900 dark:text-white sm:text-4xl">
                Voters
            </h1>

            <p class="mt-2 max-w-2xl text-sm leading-6
                      text-slate-500 dark:text-slate-400">
                Manage registered voters, election eligibility,
                accreditation and participation.
            </p>

        </div>


        {{-- =========================================================
            HEADER ACTIONS
        ========================================================== --}}

        <div class="flex flex-wrap items-center gap-3">

            {{-- =====================================================
                BULK IMPORT
            ====================================================== --}}

            <a
                href="{{ route('admin.voters.import.create') }}"
                class="group inline-flex items-center justify-center gap-2
                       rounded-xl
                       border border-blue-200
                       bg-blue-50
                       px-4 py-3
                       text-sm font-bold
                       text-blue-700
                       shadow-sm
                       transition-all duration-200
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
                    class="h-5 w-5 transition-transform duration-200
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
                    Import Multiple Voters
                </span>

                <span
                    class="hidden rounded-full
                           bg-blue-600/10
                           px-2 py-0.5
                           text-[9px]
                           font-black
                           uppercase
                           tracking-wider
                           text-blue-700
                           sm:inline-flex
                           dark:bg-blue-400/10
                           dark:text-blue-300"
                >
                    Bulk
                </span>

            </a>


            {{-- =====================================================
                ADD SINGLE VOTER
            ====================================================== --}}

            <a
                href="{{ route('voters.create') }}"
                class="group inline-flex items-center justify-center gap-2
                       rounded-xl
                       bg-blue-600
                       px-5 py-3
                       text-sm font-bold
                       text-white
                       shadow-lg
                       shadow-blue-600/20
                       transition
                       hover:-translate-y-0.5
                       hover:bg-blue-700
                       hover:shadow-blue-600/30"
            >

                <svg
                    class="h-5 w-5 transition-transform duration-200
                           group-hover:rotate-90"
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

                Add Voter

            </a>

        </div>

    </div>



    {{-- ============================================================
        FLASH MESSAGES
    ============================================================= --}}

    @if(session('success'))

        <div
            class="flex items-start gap-3 rounded-2xl
                   border border-emerald-200
                   bg-emerald-50
                   px-4 py-4
                   text-sm text-emerald-700
                   dark:border-emerald-500/20
                   dark:bg-emerald-500/10
                   dark:text-emerald-400"
        >

            <div
                class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl
                       bg-emerald-100 text-emerald-600
                       dark:bg-emerald-500/10 dark:text-emerald-400"
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

            </div>

            <p class="pt-1 font-semibold">
                {{ session('success') }}
            </p>

        </div>

    @endif


    @if(session('error'))

        <div
            class="flex items-start gap-3 rounded-2xl
                   border border-red-200
                   bg-red-50
                   px-4 py-4
                   text-sm text-red-700
                   dark:border-red-500/20
                   dark:bg-red-500/10
                   dark:text-red-400"
        >

            <div
                class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl
                       bg-red-100 text-red-600
                       dark:bg-red-500/10 dark:text-red-400"
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
                        d="M12 8v4m0 4h.01"
                    />

                    <circle
                        cx="12"
                        cy="12"
                        r="9"
                    />
                </svg>

            </div>

            <p class="pt-1 font-semibold">
                {{ session('error') }}
            </p>

        </div>

    @endif



    {{-- ============================================================
        STATISTICS
    ============================================================= --}}

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

        {{-- Total --}}

        <div
            class="rounded-2xl border border-blue-100
                   bg-gradient-to-br from-blue-50 to-white
                   p-5 shadow-sm
                   dark:border-blue-500/10
                   dark:from-blue-500/10 dark:to-[#101a2f]"
        >

            <div class="flex items-start justify-between">

                <div>

                    <p
                        class="text-xs font-bold uppercase tracking-wider
                               text-slate-500 dark:text-slate-400"
                    >
                        Total Voters
                    </p>

                    <p
                        class="mt-2 text-3xl font-black
                               text-blue-600 dark:text-blue-400"
                    >
                        {{ $totalVoters }}
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Registered voter profiles
                    </p>

                </div>

                <div
                    class="flex h-11 w-11 items-center justify-center rounded-xl
                           bg-blue-100 text-blue-600
                           dark:bg-blue-500/10 dark:text-blue-400"
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
                            d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"
                        />

                        <circle
                            cx="9"
                            cy="7"
                            r="4"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M22 21v-2a4 4 0 00-3-3.87"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M16 3.13a4 4 0 010 7.75"
                        />
                    </svg>

                </div>

            </div>

        </div>


        {{-- Active --}}

        <div
            class="rounded-2xl border border-emerald-100
                   bg-gradient-to-br from-emerald-50 to-white
                   p-5 shadow-sm
                   dark:border-emerald-500/10
                   dark:from-emerald-500/10 dark:to-[#101a2f]"
        >

            <div class="flex items-start justify-between">

                <div>

                    <p
                        class="text-xs font-bold uppercase tracking-wider
                               text-slate-500 dark:text-slate-400"
                    >
                        Active
                    </p>

                    <p
                        class="mt-2 text-3xl font-black
                               text-emerald-600 dark:text-emerald-400"
                    >
                        {{ $activeVoters }}
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Active voter accounts
                    </p>

                </div>

                <div
                    class="flex h-11 w-11 items-center justify-center rounded-xl
                           bg-emerald-100 text-emerald-600
                           dark:bg-emerald-500/10 dark:text-emerald-400"
                >

                    <span
                        class="h-3 w-3 rounded-full bg-emerald-500
                               shadow-lg shadow-emerald-500/30"
                    ></span>

                </div>

            </div>

        </div>


        {{-- Inactive --}}

        <div
            class="rounded-2xl border border-slate-200
                   bg-gradient-to-br from-slate-50 to-white
                   p-5 shadow-sm
                   dark:border-white/10
                   dark:from-white/5 dark:to-[#101a2f]"
        >

            <div class="flex items-start justify-between">

                <div>

                    <p
                        class="text-xs font-bold uppercase tracking-wider
                               text-slate-500 dark:text-slate-400"
                    >
                        Inactive
                    </p>

                    <p
                        class="mt-2 text-3xl font-black
                               text-slate-700 dark:text-slate-200"
                    >
                        {{ $inactiveVoters }}
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Inactive voter accounts
                    </p>

                </div>

                <div
                    class="flex h-11 w-11 items-center justify-center rounded-xl
                           bg-slate-100 text-slate-500
                           dark:bg-white/5 dark:text-slate-400"
                >

                    <span
                        class="h-3 w-3 rounded-full bg-slate-400"
                    ></span>

                </div>

            </div>

        </div>


        {{-- Suspended --}}

        <div
            class="rounded-2xl border border-red-100
                   bg-gradient-to-br from-red-50 to-white
                   p-5 shadow-sm
                   dark:border-red-500/10
                   dark:from-red-500/10 dark:to-[#101a2f]"
        >

            <div class="flex items-start justify-between">

                <div>

                    <p
                        class="text-xs font-bold uppercase tracking-wider
                               text-slate-500 dark:text-slate-400"
                    >
                        Suspended
                    </p>

                    <p
                        class="mt-2 text-3xl font-black
                               text-red-600 dark:text-red-400"
                    >
                        {{ $suspendedVoters }}
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Restricted voter accounts
                    </p>

                </div>

                <div
                    class="flex h-11 w-11 items-center justify-center rounded-xl
                           bg-red-100 text-red-600
                           dark:bg-red-500/10 dark:text-red-400"
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
                            d="M10.3 3.6L2.7 17a2 2 0 001.7 3h15.2a2 2 0 001.7-3L13.7 3.6a2 2 0 00-3.4 0z"
                        />
                    </svg>

                </div>

            </div>

        </div>

    </div>



    {{-- ============================================================
        SEARCH
    ============================================================= --}}

    <div
        class="rounded-2xl border border-slate-200
               bg-white p-4 shadow-sm
               dark:border-white/10 dark:bg-[#101a2f]"
    >

        <form
            method="GET"
            action="{{ route('voters.index') }}"
            class="flex flex-col gap-3 xl:flex-row"
        >

            {{-- Search --}}

            <div class="relative flex-1">

                <div
                    class="pointer-events-none absolute inset-y-0 left-0
                           flex items-center pl-4 text-slate-400"
                >

                    <svg
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <circle
                            cx="11"
                            cy="11"
                            r="7"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M20 20l-4-4"
                        />
                    </svg>

                </div>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search by name, voter ID, email or phone..."
                    class="w-full rounded-xl border border-slate-200
                           bg-slate-50 px-4 py-3 pl-11
                           text-sm text-slate-800
                           outline-none transition
                           placeholder:text-slate-400
                           focus:border-blue-500
                           focus:bg-white
                           focus:ring-4
                           focus:ring-blue-500/10
                           dark:border-white/10
                           dark:bg-white/[0.03]
                           dark:text-white
                           dark:placeholder:text-slate-500"
                >

            </div>


            {{-- Status --}}

            <select
                name="status"
                class="rounded-xl border border-slate-200
                       bg-slate-50 px-4 py-3
                       text-sm font-medium
                       text-slate-700
                       outline-none
                       focus:border-blue-500
                       focus:ring-4
                       focus:ring-blue-500/10
                       dark:border-white/10
                       dark:bg-white/[0.03]
                       dark:text-slate-200"
            >

                <option value="">All Statuses</option>

                <option
                    value="active"
                    {{ request('status') === 'active' ? 'selected' : '' }}
                >
                    Active
                </option>

                <option
                    value="inactive"
                    {{ request('status') === 'inactive' ? 'selected' : '' }}
                >
                    Inactive
                </option>

                <option
                    value="suspended"
                    {{ request('status') === 'suspended' ? 'selected' : '' }}
                >
                    Suspended
                </option>

            </select>


            <button
                type="submit"
                class="inline-flex items-center justify-center gap-2
                       rounded-xl
                       bg-blue-600
                       px-6 py-3
                       text-sm font-bold
                       text-white
                       shadow-lg
                       shadow-blue-600/15
                       transition
                       hover:bg-blue-700"
            >

                Search

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
                        d="M5 12h14M13 6l6 6-6 6"
                    />
                </svg>

            </button>


            @if(request('search') || request('status'))

                <a
                    href="{{ route('voters.index') }}"
                    class="inline-flex items-center justify-center
                           rounded-xl
                           border border-slate-200
                           bg-white
                           px-5 py-3
                           text-sm font-semibold
                           text-slate-600
                           transition
                           hover:bg-slate-50
                           dark:border-white/10
                           dark:bg-white/5
                           dark:text-slate-300"
                >
                    Clear
                </a>

            @endif

        </form>

    </div>



    {{-- ============================================================
        VOTERS
    ============================================================= --}}

    <div
        class="overflow-hidden rounded-3xl
               border border-slate-200
               bg-white shadow-sm
               dark:border-white/10
               dark:bg-[#101a2f]"
    >

        {{-- Section header --}}

        <div
            class="border-b border-slate-100
                   px-5 py-5
                   dark:border-white/10
                   sm:px-6"
        >

            <div
                class="flex flex-col gap-2
                       sm:flex-row sm:items-center
                       sm:justify-between"
            >

                <div>

                    <h2
                        class="text-lg font-black
                               text-slate-900
                               dark:text-white"
                    >
                        Registered Voters
                    </h2>

                    <p
                        class="mt-1 text-sm
                               text-slate-500
                               dark:text-slate-400"
                    >
                        {{ $voters->total() }}
                        voter{{ $voters->total() === 1 ? '' : 's' }}
                        found.
                    </p>

                </div>


                <div
                    class="inline-flex w-fit items-center
                           rounded-full
                           bg-slate-100
                           px-3 py-1.5
                           text-xs font-bold
                           text-slate-600
                           dark:bg-white/5
                           dark:text-slate-300"
                >
                    Click a voter to open their profile
                </div>

            </div>

        </div>


        @if($voters->count())

            {{-- ====================================================
                 DESKTOP TABLE
            ===================================================== --}}

            <div class="hidden lg:block">

                <table class="w-full table-fixed text-left">

                    <thead
                        class="border-b border-slate-100
                               bg-slate-50/80
                               dark:border-white/10
                               dark:bg-white/[0.02]"
                    >

                        <tr>

                            <th
                                class="w-[30%] px-5 py-4
                                       text-[11px] font-bold
                                       uppercase tracking-wider
                                       text-slate-400"
                            >
                                Voter
                            </th>

                            <th
                                class="w-[13%] px-4 py-4
                                       text-[11px] font-bold
                                       uppercase tracking-wider
                                       text-slate-400"
                            >
                                Voter ID
                            </th>

                            <th
                                class="w-[25%] px-4 py-4
                                       text-[11px] font-bold
                                       uppercase tracking-wider
                                       text-slate-400"
                            >
                                Contact
                            </th>

                            <th
                                class="w-[12%] px-4 py-4
                                       text-[11px] font-bold
                                       uppercase tracking-wider
                                       text-slate-400"
                            >
                                Status
                            </th>

                            <th
                                class="w-[20%] px-4 py-4
                                       text-right
                                       text-[11px] font-bold
                                       uppercase tracking-wider
                                       text-slate-400"
                            >
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody
                        class="divide-y
                               divide-slate-100
                               dark:divide-white/5"
                    >

                        @foreach($voters as $voter)

                            <tr
                                class="group transition-colors
                                       hover:bg-blue-50/40
                                       dark:hover:bg-blue-500/[0.03]"
                            >

                                {{-- Voter --}}

                                <td class="px-5 py-4">

                                    <a
                                        href="{{ route('voters.show', $voter) }}"
                                        class="flex min-w-0 items-center gap-3"
                                    >

                                        @if($voter->photo)

                                            <img
                                                src="{{ asset('storage/' . $voter->photo) }}"
                                                alt="{{ $voter->name }}"
                                                class="h-11 w-11 shrink-0 rounded-xl
                                                       object-cover
                                                       ring-1 ring-slate-200
                                                       dark:ring-white/10"
                                            >

                                        @else

                                            <div
                                                class="flex h-11 w-11 shrink-0
                                                       items-center justify-center
                                                       rounded-xl
                                                       bg-gradient-to-br
                                                       from-blue-600
                                                       to-cyan-500
                                                       text-sm font-black
                                                       text-white
                                                       shadow-sm"
                                            >
                                                {{ strtoupper(substr($voter->name, 0, 1)) }}
                                            </div>

                                        @endif


                                        <div class="min-w-0">

                                            <div
                                                class="flex min-w-0
                                                       items-center gap-1.5"
                                            >

                                                <p
                                                    class="truncate text-sm font-bold
                                                           text-slate-900
                                                           transition
                                                           group-hover:text-blue-700
                                                           dark:text-white
                                                           dark:group-hover:text-blue-400"
                                                    title="{{ $voter->name }}"
                                                >
                                                    {{ $voter->name }}
                                                </p>

                                                <svg
                                                    class="h-3.5 w-3.5 shrink-0
                                                           text-slate-300
                                                           transition
                                                           group-hover:translate-x-0.5
                                                           group-hover:text-blue-500"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M9 5l7 7-7 7"
                                                    />
                                                </svg>

                                            </div>

                                            <p
                                                class="mt-0.5 truncate
                                                       text-[11px]
                                                       text-slate-400"
                                            >
                                                View profile
                                            </p>

                                        </div>

                                    </a>

                                </td>


                                {{-- Voter ID --}}

                                <td class="px-4 py-4">

                                    <span
                                        class="inline-flex max-w-full
                                               items-center rounded-lg
                                               bg-slate-100
                                               px-2.5 py-1.5
                                               font-mono text-[11px]
                                               font-semibold
                                               text-slate-600
                                               dark:bg-white/5
                                               dark:text-slate-300"
                                        title="{{ $voter->voter_id }}"
                                    >

                                        <span class="truncate">
                                            {{ $voter->voter_id }}
                                        </span>

                                    </span>

                                </td>


                                {{-- Contact --}}

                                <td class="px-4 py-4">

                                    <div class="min-w-0">

                                        @if($voter->email)

                                            <p
                                                class="truncate text-xs
                                                       font-semibold
                                                       text-slate-700
                                                       dark:text-slate-200"
                                                title="{{ $voter->email }}"
                                            >
                                                {{ $voter->email }}
                                            </p>

                                        @endif

                                        @if($voter->phone)

                                            <p
                                                class="mt-1 text-[11px]
                                                       text-slate-400"
                                            >
                                                {{ $voter->phone }}
                                            </p>

                                        @endif

                                        @if(!$voter->email && !$voter->phone)

                                            <p class="text-xs text-slate-400">
                                                No contact information
                                            </p>

                                        @endif

                                    </div>

                                </td>


                                {{-- Status --}}

                                <td class="px-4 py-4">

                                    @if($voter->status === 'active')

                                        <span
                                            class="inline-flex items-center gap-1.5
                                                   rounded-full
                                                   bg-emerald-50
                                                   px-2.5 py-1.5
                                                   text-[11px] font-bold
                                                   text-emerald-700
                                                   dark:bg-emerald-500/10
                                                   dark:text-emerald-400"
                                        >

                                            <span
                                                class="h-1.5 w-1.5
                                                       rounded-full
                                                       bg-emerald-500"
                                            ></span>

                                            Active

                                        </span>

                                    @elseif($voter->status === 'suspended')

                                        <span
                                            class="inline-flex items-center gap-1.5
                                                   rounded-full
                                                   bg-red-50
                                                   px-2.5 py-1.5
                                                   text-[11px] font-bold
                                                   text-red-700
                                                   dark:bg-red-500/10
                                                   dark:text-red-400"
                                        >

                                            <span
                                                class="h-1.5 w-1.5
                                                       rounded-full
                                                       bg-red-500"
                                            ></span>

                                            Suspended

                                        </span>

                                    @else

                                        <span
                                            class="inline-flex items-center gap-1.5
                                                   rounded-full
                                                   bg-slate-100
                                                   px-2.5 py-1.5
                                                   text-[11px] font-bold
                                                   text-slate-600
                                                   dark:bg-white/5
                                                   dark:text-slate-400"
                                        >

                                            <span
                                                class="h-1.5 w-1.5
                                                       rounded-full
                                                       bg-slate-400"
                                            ></span>

                                            Inactive

                                        </span>

                                    @endif

                                </td>


                                {{-- Actions --}}

                                <td class="px-4 py-4">

                                    <div
                                        class="flex items-center
                                               justify-end gap-1.5"
                                    >

                                        {{-- View --}}

                                        <a
                                            href="{{ route('voters.show', $voter) }}"
                                            class="inline-flex items-center gap-1.5
                                                   rounded-lg
                                                   bg-blue-50
                                                   px-3 py-2
                                                   text-[11px] font-bold
                                                   text-blue-700
                                                   transition
                                                   hover:bg-blue-100
                                                   dark:bg-blue-500/10
                                                   dark:text-blue-400
                                                   dark:hover:bg-blue-500/20"
                                        >

                                            <svg
                                                class="h-3.5 w-3.5"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6z"
                                                />

                                                <circle
                                                    cx="12"
                                                    cy="12"
                                                    r="2.5"
                                                />
                                            </svg>

                                            <span>
                                                View
                                            </span>

                                        </a>


                                        {{-- Edit --}}

                                        <a
                                            href="{{ route('voters.edit', $voter) }}"
                                            class="flex h-8 w-8 items-center
                                                   justify-center rounded-lg
                                                   border border-slate-200
                                                   bg-white
                                                   text-slate-500
                                                   transition
                                                   hover:border-blue-200
                                                   hover:bg-blue-50
                                                   hover:text-blue-600
                                                   dark:border-white/10
                                                   dark:bg-white/5
                                                   dark:text-slate-400"
                                            title="Edit voter"
                                        >

                                            <svg
                                                class="h-3.5 w-3.5"
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

                                        </a>


                                        {{-- Delete --}}

                                        <form
                                            method="POST"
                                            action="{{ route('voters.destroy', $voter) }}"
                                            onsubmit="return confirm('Are you sure you want to delete {{ addslashes($voter->name) }}?');"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="flex h-8 w-8
                                                       items-center justify-center
                                                       rounded-lg
                                                       border border-red-200
                                                       bg-red-50
                                                       text-red-600
                                                       transition
                                                       hover:bg-red-100
                                                       dark:border-red-500/20
                                                       dark:bg-red-500/10
                                                       dark:text-red-400"
                                                title="Delete voter"
                                            >

                                                <svg
                                                    class="h-3.5 w-3.5"
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

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- ====================================================
                 MOBILE / TABLET CARDS
            ===================================================== --}}

            <div
                class="divide-y divide-slate-100
                       lg:hidden
                       dark:divide-white/5"
            >

                @foreach($voters as $voter)

                    <div class="p-4 sm:p-5">

                        <div
                            class="rounded-2xl
                                   border border-slate-200
                                   bg-white p-4 shadow-sm
                                   dark:border-white/10
                                   dark:bg-[#0d172a]"
                        >

                            <a
                                href="{{ route('voters.show', $voter) }}"
                                class="group block"
                            >

                                <div class="flex items-start gap-4">

                                    @if($voter->photo)

                                        <img
                                            src="{{ asset('storage/' . $voter->photo) }}"
                                            alt="{{ $voter->name }}"
                                            class="h-14 w-14 shrink-0
                                                   rounded-xl object-cover
                                                   ring-1 ring-slate-200
                                                   dark:ring-white/10"
                                        >

                                    @else

                                        <div
                                            class="flex h-14 w-14 shrink-0
                                                   items-center justify-center
                                                   rounded-xl
                                                   bg-gradient-to-br
                                                   from-blue-600
                                                   to-cyan-500
                                                   text-lg font-black
                                                   text-white"
                                        >
                                            {{ strtoupper(substr($voter->name, 0, 1)) }}
                                        </div>

                                    @endif


                                    <div class="min-w-0 flex-1">

                                        <div
                                            class="flex items-start
                                                   justify-between gap-3"
                                        >

                                            <div class="min-w-0">

                                                <h3
                                                    class="truncate text-base
                                                           font-black
                                                           text-slate-900
                                                           dark:text-white"
                                                >
                                                    {{ $voter->name }}
                                                </h3>

                                                <p
                                                    class="mt-1 font-mono
                                                           text-xs
                                                           text-slate-400"
                                                >
                                                    {{ $voter->voter_id }}
                                                </p>

                                            </div>


                                            @if($voter->status === 'active')

                                                <span
                                                    class="shrink-0 rounded-full
                                                           bg-emerald-50
                                                           px-2.5 py-1
                                                           text-[10px] font-bold
                                                           text-emerald-700
                                                           dark:bg-emerald-500/10
                                                           dark:text-emerald-400"
                                                >
                                                    Active
                                                </span>

                                            @elseif($voter->status === 'suspended')

                                                <span
                                                    class="shrink-0 rounded-full
                                                           bg-red-50
                                                           px-2.5 py-1
                                                           text-[10px] font-bold
                                                           text-red-700
                                                           dark:bg-red-500/10
                                                           dark:text-red-400"
                                                >
                                                    Suspended
                                                </span>

                                            @else

                                                <span
                                                    class="shrink-0 rounded-full
                                                           bg-slate-100
                                                           px-2.5 py-1
                                                           text-[10px] font-bold
                                                           text-slate-600
                                                           dark:bg-white/5
                                                           dark:text-slate-400"
                                                >
                                                    Inactive
                                                </span>

                                            @endif

                                        </div>

                                    </div>

                                </div>


                                <div
                                    class="mt-4 grid grid-cols-1
                                           gap-2 sm:grid-cols-2"
                                >

                                    <div
                                        class="rounded-xl bg-slate-50
                                               p-3
                                               dark:bg-white/[0.03]"
                                    >

                                        <p
                                            class="text-[10px]
                                                   font-bold uppercase
                                                   tracking-wider
                                                   text-slate-400"
                                        >
                                            Email
                                        </p>

                                        <p
                                            class="mt-1 truncate
                                                   text-xs font-medium
                                                   text-slate-700
                                                   dark:text-slate-200"
                                        >
                                            {{ $voter->email ?: 'Not provided' }}
                                        </p>

                                    </div>


                                    <div
                                        class="rounded-xl bg-slate-50
                                               p-3
                                               dark:bg-white/[0.03]"
                                    >

                                        <p
                                            class="text-[10px]
                                                   font-bold uppercase
                                                   tracking-wider
                                                   text-slate-400"
                                        >
                                            Phone
                                        </p>

                                        <p
                                            class="mt-1 text-xs font-medium
                                                   text-slate-700
                                                   dark:text-slate-200"
                                        >
                                            {{ $voter->phone ?: 'Not provided' }}
                                        </p>

                                    </div>

                                </div>


                                <div
                                    class="mt-4 flex items-center
                                           justify-between"
                                >

                                    <span
                                        class="text-xs font-semibold
                                               text-blue-600
                                               dark:text-blue-400"
                                    >
                                        View voter profile
                                    </span>

                                    <svg
                                        class="h-4 w-4 text-blue-500
                                               transition-transform
                                               group-hover:translate-x-1"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M9 5l7 7-7 7"
                                        />
                                    </svg>

                                </div>

                            </a>


                            {{-- Mobile actions --}}

                            <div
                                class="mt-4 flex gap-2
                                       border-t border-slate-100
                                       pt-4
                                       dark:border-white/10"
                            >

                                <a
                                    href="{{ route('voters.show', $voter) }}"
                                    class="flex-1 rounded-xl
                                           bg-blue-600 px-4 py-2.5
                                           text-center text-xs
                                           font-bold text-white
                                           shadow-sm
                                           transition
                                           hover:bg-blue-700"
                                >
                                    View Profile
                                </a>


                                <a
                                    href="{{ route('voters.edit', $voter) }}"
                                    class="flex h-10 w-10
                                           items-center justify-center
                                           rounded-xl
                                           border border-slate-200
                                           bg-white
                                           text-slate-500
                                           transition
                                           hover:border-blue-200
                                           hover:bg-blue-50
                                           hover:text-blue-600
                                           dark:border-white/10
                                           dark:bg-white/5
                                           dark:text-slate-400"
                                    title="Edit voter"
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

                                </a>


                                <form
                                    method="POST"
                                    action="{{ route('voters.destroy', $voter) }}"
                                    onsubmit="return confirm('Are you sure you want to delete {{ addslashes($voter->name) }}?');"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="flex h-10 w-10
                                               items-center justify-center
                                               rounded-xl
                                               border border-red-200
                                               bg-red-50
                                               text-red-600
                                               transition
                                               hover:bg-red-100
                                               dark:border-red-500/20
                                               dark:bg-red-500/10
                                               dark:text-red-400"
                                        title="Delete voter"
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

                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>


            {{-- ====================================================
                 PAGINATION
            ===================================================== --}}

            @if($voters->hasPages())

                <div
                    class="border-t border-slate-100
                           px-5 py-5
                           dark:border-white/10
                           sm:px-6"
                >
                    {{ $voters->links() }}
                </div>

            @endif

        @else

            {{-- ====================================================
                 EMPTY STATE
            ===================================================== --}}

            <div class="px-6 py-16 text-center">

                <div
                    class="mx-auto flex h-16 w-16
                           items-center justify-center
                           rounded-2xl
                           bg-blue-50
                           text-blue-600
                           dark:bg-blue-500/10
                           dark:text-blue-400"
                >

                    <svg
                        class="h-8 w-8"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"
                        />

                        <circle
                            cx="9"
                            cy="7"
                            r="4"
                        />
                    </svg>

                </div>

                <h3
                    class="mt-5 text-xl font-black
                           text-slate-900
                           dark:text-white"
                >
                    No Voters Found
                </h3>

                <p
                    class="mx-auto mt-2 max-w-md
                           text-sm leading-6
                           text-slate-500
                           dark:text-slate-400"
                >
                    No voters match your current search and filter.
                    Try clearing the filters or add a new voter.
                </p>


                <div
                    class="mt-6 flex flex-wrap
                           items-center justify-center gap-3"
                >

                    <a
                        href="{{ route('voters.index') }}"
                        class="rounded-xl
                               border border-slate-200
                               bg-white
                               px-4 py-2.5
                               text-sm font-semibold
                               text-slate-600
                               shadow-sm
                               transition
                               hover:bg-slate-50
                               dark:border-white/10
                               dark:bg-white/5
                               dark:text-slate-300"
                    >
                        Clear Filters
                    </a>


                    {{-- Bulk Import --}}

                    <a
                        href="{{ route('admin.voters.import.create') }}"
                        class="inline-flex items-center
                               gap-2 rounded-xl
                               border border-blue-200
                               bg-blue-50
                               px-4 py-2.5
                               text-sm font-bold
                               text-blue-700
                               transition
                               hover:bg-blue-100
                               dark:border-blue-400/20
                               dark:bg-blue-500/10
                               dark:text-blue-300"
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

                        Import Multiple Voters

                    </a>


                    {{-- Add Voter --}}

                    <a
                        href="{{ route('voters.create') }}"
                        class="rounded-xl
                               bg-blue-600
                               px-4 py-2.5
                               text-sm font-bold
                               text-white
                               shadow-lg
                               shadow-blue-600/20
                               transition
                               hover:bg-blue-700"
                    >
                        Add Voter
                    </a>

                </div>

            </div>

        @endif

    </div>



    {{-- ============================================================
        UX HINT
    ============================================================= --}}

    @if($voters->count())

        <div
            class="flex items-start gap-3 rounded-2xl
                   border border-blue-100
                   bg-blue-50/70
                   px-4 py-4
                   dark:border-blue-500/10
                   dark:bg-blue-500/[0.05]"
        >

            <div
                class="flex h-8 w-8 shrink-0
                       items-center justify-center
                       rounded-xl
                       bg-white
                       text-blue-600
                       shadow-sm
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
                    <circle
                        cx="12"
                        cy="12"
                        r="9"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 10v6m0-9h.01"
                    />
                </svg>

            </div>

            <div>

                <p
                    class="text-xs font-bold
                           text-blue-900
                           dark:text-blue-300"
                >
                    Quick navigation
                </p>

                <p
                    class="mt-1 text-xs leading-5
                           text-blue-700/70
                           dark:text-slate-400"
                >
                    Select a voter's name or use
                    <strong>View Profile</strong>
                    to manage their election assignments,
                    eligibility, accreditation and voting history.
                </p>

            </div>

        </div>

    @endif

</div>

@endsection