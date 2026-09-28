@extends('electo.layouts.app')

@section('title', 'Assign Voter to Election | Electo')

@section('content')

<div class="mx-auto w-full max-w-5xl space-y-8">

    {{-- ============================================================= --}}
    {{-- PAGE HEADER --}}
    {{-- ============================================================= --}}

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center">

        {{-- Back + Title --}}

        <div class="flex min-w-0 flex-1 items-center gap-3">

            <a
                href="{{ route('voters.show', $voter) }}"
                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-white/10 bg-white/5 text-gray-400 transition hover:bg-white/10 hover:text-white"
                title="Back to voter"
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

                <p class="text-xs font-semibold uppercase tracking-widest text-blue-400">
                    Voter Management
                </p>

                <h1 class="mt-1 truncate text-3xl font-black tracking-tight text-white">
                    Assign to Election
                </h1>

                <p class="mt-1 text-sm text-gray-400">
                    Select an election and determine this voter's eligibility.
                </p>

            </div>

        </div>

    </div>


    {{-- ============================================================= --}}
    {{-- VALIDATION ERRORS --}}
    {{-- ============================================================= --}}

    @if($errors->any())

        <div class="rounded-2xl border border-red-500/20 bg-red-500/10 p-5">

            <div class="flex gap-3">

                <svg
                    class="mt-0.5 h-5 w-5 shrink-0 text-red-400"
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

                    <h3 class="font-semibold text-red-300">
                        Please correct the following:
                    </h3>

                    <ul class="mt-2 space-y-1 text-sm text-red-400">

                        @foreach($errors->all() as $error)

                            <li>
                                • {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- ============================================================= --}}
    {{-- VOTER SUMMARY --}}
    {{-- ============================================================= --}}

    <div class="rounded-2xl border border-white/10 bg-white/[0.03]">

        <div class="border-b border-white/10 px-6 py-5">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-500/10">

                    <svg
                        class="h-5 w-5 text-blue-400"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 7a3 3 0 11-6 0 3 3 0 016 0zM5 21a7 7 0 0114 0"
                        />
                    </svg>

                </div>

                <div>

                    <h2 class="font-bold text-white">
                        Voter Information
                    </h2>

                    <p class="mt-1 text-xs text-gray-500">
                        Confirm the voter before assigning an election.
                    </p>

                </div>

            </div>

        </div>


        <div class="grid gap-5 p-6 sm:grid-cols-3">

            {{-- Name --}}

            <div>

                <p class="text-xs uppercase tracking-wider text-gray-500">
                    Name
                </p>

                <p class="mt-2 truncate font-semibold text-white">
                    {{ $voter->name }}
                </p>

            </div>


            {{-- Voter ID --}}

            <div>

                <p class="text-xs uppercase tracking-wider text-gray-500">
                    Voter ID
                </p>

                <p class="mt-2 font-mono text-sm font-semibold text-blue-400">
                    {{ $voter->voter_id }}
                </p>

            </div>


            {{-- Status --}}

            <div>

                <p class="text-xs uppercase tracking-wider text-gray-500">
                    Status
                </p>

                <div class="mt-2">

                    @if($voter->status === 'active')

                        <span class="inline-flex items-center gap-2 rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-semibold text-emerald-400">

                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>

                            Active

                        </span>

                    @elseif($voter->status === 'suspended')

                        <span class="inline-flex items-center gap-2 rounded-full bg-red-500/10 px-3 py-1 text-xs font-semibold text-red-400">

                            <span class="h-1.5 w-1.5 rounded-full bg-red-400"></span>

                            Suspended

                        </span>

                    @else

                        <span class="inline-flex items-center gap-2 rounded-full bg-gray-500/10 px-3 py-1 text-xs font-semibold text-gray-400">

                            <span class="h-1.5 w-1.5 rounded-full bg-gray-400"></span>

                            Inactive

                        </span>

                    @endif

                </div>

            </div>

        </div>

    </div>


    {{-- ============================================================= --}}
    {{-- ASSIGNMENT FORM --}}
    {{-- ============================================================= --}}

    <form
        method="POST"
        action="{{ route('voters.elections.store', $voter) }}"
        class="space-y-6"
    >

        @csrf


        {{-- ========================================================= --}}
        {{-- ELECTION SELECTION --}}
        {{-- ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-white/10 bg-white/[0.03]">

            <div class="border-b border-white/10 px-6 py-5">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-purple-500/10">

                        <svg
                            class="h-5 w-5 text-purple-400"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 12l2 2 4-4M4 5h16v14H4z"
                            />
                        </svg>

                    </div>

                    <div>

                        <h2 class="font-bold text-white">
                            Election Assignment
                        </h2>

                        <p class="mt-1 text-xs text-gray-500">
                            Choose the election this voter should participate in.
                        </p>

                    </div>

                </div>

            </div>


            <div class="space-y-6 p-6">

                {{-- Election --}}

                <div>

                    <label
                        for="election_id"
                        class="mb-2 block text-sm font-semibold text-gray-300"
                    >
                        Election
                        <span class="text-red-400">*</span>
                    </label>

                    @if($elections->count())

                        <select
                            id="election_id"
                            name="election_id"
                            required
                            class="w-full rounded-xl border border-white/10 bg-[#081225] px-4 py-3 text-sm text-white outline-none transition focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/10"
                        >

                            <option value="">
                                Select an election
                            </option>

                            @foreach($elections as $election)

                                <option
                                    value="{{ $election->id }}"
                                    @selected(old('election_id') == $election->id)
                                >
                                    {{ $election->title }}
                                    @if($election->status)
                                        — {{ ucfirst($election->status) }}
                                    @endif
                                </option>

                            @endforeach

                        </select>

                        <p class="mt-2 text-xs text-gray-500">
                            Elections already assigned to this voter are not shown.
                        </p>

                    @else

                        <div class="rounded-xl border border-dashed border-white/10 bg-white/[0.02] p-6">

                            <div class="flex items-start gap-3">

                                <svg
                                    class="mt-0.5 h-5 w-5 shrink-0 text-gray-500"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 8v4l3 3"
                                    />

                                    <circle
                                        cx="12"
                                        cy="12"
                                        r="9"
                                    />
                                </svg>

                                <div>

                                    <p class="text-sm font-semibold text-gray-300">
                                        No available elections
                                    </p>

                                    <p class="mt-1 text-xs leading-5 text-gray-500">
                                        This voter is already assigned to all available elections,
                                        or no elections have been created yet.
                                    </p>

                                </div>

                            </div>

                        </div>

                    @endif

                </div>


                {{-- ================================================= --}}
                {{-- ELIGIBILITY --}}
                {{-- ================================================= --}}

                <div class="rounded-2xl border border-white/10 bg-[#081225]/60 p-5">

                    <div class="flex items-start gap-4">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-500/10">

                            <svg
                                class="h-5 w-5 text-emerald-400"
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


                        <div class="min-w-0 flex-1">

                            <label
                                for="is_eligible"
                                class="cursor-pointer"
                            >

                                <p class="text-sm font-semibold text-white">
                                    Eligible to Vote
                                </p>

                                <p class="mt-1 text-xs leading-5 text-gray-500">
                                    Allow this voter to participate in the selected election.
                                    Eligibility can be changed later by an administrator.
                                </p>

                            </label>

                        </div>


                        <label class="relative inline-flex shrink-0 cursor-pointer items-center">

                            <input
                                id="is_eligible"
                                type="checkbox"
                                name="is_eligible"
                                value="1"
                                class="peer sr-only"
                                @checked(old('is_eligible', true))
                            >

                            <div class="h-6 w-11 rounded-full bg-gray-700 transition peer-checked:bg-emerald-500 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-emerald-500/20">

                            </div>

                            <div class="absolute left-1 top-1 h-4 w-4 rounded-full bg-white transition peer-checked:translate-x-5">

                            </div>

                        </label>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- ACCREDITATION INFORMATION --}}
                {{-- ================================================= --}}

                <div class="rounded-2xl border border-blue-500/10 bg-blue-500/[0.04] p-5">

                    <div class="flex items-start gap-3">

                        <svg
                            class="mt-0.5 h-5 w-5 shrink-0 text-blue-400"
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

                        <div>

                            <p class="text-sm font-semibold text-blue-300">
                                Accreditation will be completed separately.
                            </p>

                            <p class="mt-1 text-xs leading-5 text-gray-500">
                                This assignment will begin with an accreditation status of
                                <span class="font-semibold text-blue-400">
                                    Pending
                                </span>.
                                The voter will still need to complete the appropriate
                                authentication process before voting.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- ACTIONS --}}
        {{-- ========================================================= --}}

        <div class="flex flex-col-reverse gap-3 border-t border-white/10 pt-6 sm:flex-row sm:justify-end">

            <a
                href="{{ route('voters.show', $voter) }}"
                class="inline-flex items-center justify-center rounded-xl border border-white/10 bg-white/5 px-6 py-3 text-sm font-semibold text-gray-300 transition hover:bg-white/10 hover:text-white"
            >
                Cancel
            </a>


            @if($elections->count())

                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-7 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-500"
                >

                    <svg
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 4v16m8-8H4"
                        />
                    </svg>

                    Assign Voter

                </button>

            @endif

        </div>

    </form>

</div>

@endsection