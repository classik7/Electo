@extends('electo.layouts.dashboard')

@section('title', 'Election Positions')
@section('page-title', 'Election Positions')

@section('content')
@if ($errors->any())

    <div class="mb-6 rounded-2xl border border-red-500/30 bg-red-500/10 p-5">

        <h3 class="font-bold text-red-400">
            Please fix the following:
        </h3>

        <ul class="mt-3 space-y-2 text-sm text-red-300">

            @foreach ($errors->all() as $error)

                <li>
                    • {{ $error }}
                </li>

            @endforeach

        </ul>

    </div>

@endif

<div
    x-data="{
        positions: @js($selectedType->default_positions ?? []),
        selectedPositions: [],
        customPosition: '',

        init() {
            this.selectedPositions = [...this.positions];
        },

        togglePosition(position) {

            if (this.selectedPositions.includes(position)) {

                this.selectedPositions =
                    this.selectedPositions.filter(
                        item => item !== position
                    );

            } else {

                this.selectedPositions.push(position);

            }
        },

        isSelected(position) {
            return this.selectedPositions.includes(position);
        },

        addCustomPosition() {

            const position = this.customPosition.trim();

            if (!position) {
                return;
            }

            if (!this.positions.includes(position)) {

                this.positions.push(position);

            }

            if (!this.selectedPositions.includes(position)) {

                this.selectedPositions.push(position);

            }

            this.customPosition = '';
        },

        removePosition(position) {

            this.selectedPositions =
                this.selectedPositions.filter(
                    item => item !== position
                );

        },

        clearAll() {

            this.selectedPositions = [];

        }
    }"
>

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <x-electo.page-header
        title="Election Positions"
        subtitle="Choose the positions voters will elect"
    >

        <x-slot:actions>

            <a
                href="{{ route('elections.schedule', [
                    'type' => $selectedType->id,
                    'organization' => $organization->id,
                    'title' => $electionTitle,
                    'description' => $description,
                    'visibility' => $visibility,
                    'start_date' => request('start_date'),
                    'start_time' => request('start_time'),
                    'end_date' => request('end_date'),
                    'end_time' => request('end_time'),
                ]) }}"
            >

                <x-electo.button variant="secondary">

                    <span class="flex items-center gap-2">

                        <x-heroicon-o-arrow-left class="h-5 w-5"/>

                        Back

                    </span>

                </x-electo.button>

            </a>

        </x-slot:actions>

    </x-electo.page-header>


    {{-- ========================================================= --}}
    {{-- WIZARD --}}
    {{-- ========================================================= --}}

    <div class="mb-8">

        <x-electo.wizard-progress :step="4"/>

    </div>


    {{-- ========================================================= --}}
    {{-- MAIN LAYOUT --}}
    {{-- ========================================================= --}}

    <div
        class="
            grid grid-cols-1 gap-5
            lg:grid-cols-[220px_minmax(0,1fr)_250px]
            2xl:grid-cols-[260px_minmax(0,1fr)_280px]
            items-start
        "
    >


        {{-- ===================================================== --}}
        {{-- LEFT: ELECTION SETUP --}}
        {{-- ===================================================== --}}

        <aside class="min-w-0">

            <div
                class="
                    relative overflow-hidden
                    rounded-3xl
                    border border-slate-200 dark:border-white/10
                    bg-white
                    p-5
                    shadow-[0_12px_35px_rgba(15,23,42,0.06)]
                    dark:bg-[#101D35]
                    dark:shadow-xl
                    backdrop-blur-xl
                "
            >

                {{-- Glow --}}

                <div
                    class="
                        pointer-events-none
                        absolute -right-20 -top-20
                        h-40 w-40
                        rounded-full
                        bg-blue-500/10
                        blur-3xl
                    "
                ></div>


                <div class="relative">

                    <div class="mb-6">

                        <p
                            class="
                                text-[10px]
                                font-semibold
                                uppercase
                                tracking-[0.3em]
                                text-slate-500 dark:text-gray-500
                            "
                        >
                            Election Setup
                        </p>

                    </div>


                    {{-- Election Type --}}

                    <div
                        class="
                            mb-3
                            rounded-2xl
                            border border-blue-200
                            bg-blue-50
                            dark:border-blue-500/30
                            dark:bg-blue-500/[0.08]
                            p-4
                        "
                    >

                        <div class="flex items-center gap-3">

                            <div
                                class="
                                    flex h-10 w-10 shrink-0
                                    items-center justify-center
                                    rounded-xl
                                    bg-blue-500/15
                                    text-blue-400
                                "
                            >

                                <x-heroicon-o-academic-cap
                                    class="h-5 w-5"
                                />

                            </div>

                            <div class="min-w-0">

                                <p class="text-[10px] uppercase tracking-wider text-slate-400 dark:text-gray-500">
                                    Election Type
                                </p>

                                <p class="mt-1 truncate font-semibold text-slate-900 dark:text-white">
                                    {{ $selectedType->name }}
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Organization --}}

                    <div
                        class="
                            mb-3
                            rounded-2xl
                            border border-slate-200 dark:border-slate-200
                            bg-slate-50
                            dark:border-white/10
                            dark:bg-white/[0.025]
                            p-4
                        "
                    >

                        <div class="flex items-center gap-3">

                            <div
                                class="
                                    flex h-10 w-10 shrink-0
                                    items-center justify-center
                                    rounded-xl
                                    bg-purple-500/10
                                    text-purple-400
                                "
                            >

                                <x-heroicon-o-building-office-2
                                    class="h-5 w-5"
                                />

                            </div>

                            <div class="min-w-0">

                                <p class="text-[10px] uppercase tracking-wider text-slate-400 dark:text-gray-500">
                                    Organization
                                </p>

                                <p class="mt-1 truncate font-semibold text-slate-900 dark:text-white">
                                    {{ $organization->name }}
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Election Title --}}

                    <div
                        class="
                            mb-3
                            rounded-2xl
                            border border-slate-200 dark:border-slate-200
                            bg-slate-50
                            dark:border-white/10
                            dark:bg-white/[0.025]
                            p-4
                        "
                    >

                        <p class="text-[10px] uppercase tracking-wider text-slate-400 dark:text-gray-500">
                            Election Title
                        </p>

                        <p class="mt-2 break-words text-sm font-semibold text-slate-900 dark:text-white">
                            {{ $electionTitle }}
                        </p>

                    </div>


                    {{-- Visibility --}}

                    <div
                        class="
                            flex items-center justify-between
                            rounded-2xl
                            border border-slate-200 dark:border-slate-200
                            bg-slate-50
                            dark:border-white/10
                            dark:bg-white/[0.025]
                            p-4
                        "
                    >

                        <span class="text-sm text-slate-500 dark:text-gray-400">
                            Visibility
                        </span>

                        <span
                            class="
                                rounded-full
                                border border-blue-500/20
                                bg-blue-500/10
                                px-3 py-1
                                text-xs font-semibold
                                text-blue-400
                            "
                        >
                            {{ ucfirst($visibility) }}
                        </span>

                    </div>

                </div>

            </div>

        </aside>


        {{-- ===================================================== --}}
        {{-- CENTER: POSITION SELECTION --}}
        {{-- ===================================================== --}}

        <main class="min-w-0">

            <div
                class="
                    relative overflow-hidden
                    rounded-3xl
                    border border-slate-200 dark:border-white/10
                    bg-white
                    p-6
                    shadow-[0_18px_50px_rgba(15,23,42,0.07)]
                    dark:bg-[#101D35]
                    dark:shadow-2xl
                    backdrop-blur-xl
                    sm:p-6 2xl:p-8
                "
            >

                {{-- Background glows --}}

                <div
                    class="
                        pointer-events-none
                        absolute -left-24 -top-24
                        h-64 w-64
                        rounded-full
                        bg-blue-600/10
                        blur-3xl
                    "
                ></div>

                <div
                    class="
                        pointer-events-none
                        absolute -bottom-32 -right-20
                        h-72 w-72
                        rounded-full
                        bg-cyan-500/5
                        blur-3xl
                    "
                ></div>


                <div class="relative">


                    {{-- Hero Header --}}

                    <div
                        class="
                            flex flex-col gap-5
                            border-b border-slate-200 dark:border-white/10
                            pb-7
                            sm:flex-row
                            sm:items-center
                            sm:justify-between
                        "
                    >

                        <div>

                            <div class="flex items-center gap-3">

                                <div
                                    class="
                                        flex h-12 w-12
                                        items-center justify-center
                                        rounded-2xl
                                        bg-gradient-to-br
                                        from-blue-600
                                        to-cyan-500
                                        shadow-lg
                                        shadow-blue-600/20
                                    "
                                >

                                    <x-heroicon-o-user-group
                                        class="h-6 w-6 text-white"
                                    />

                                </div>

                                <div>

                                    <p
                                        class="
                                            text-[10px]
                                            font-semibold
                                            uppercase
                                            tracking-[0.25em]
                                            text-blue-400
                                        "
                                    >
                                        Step 4
                                    </p>

                                    <h2 class="mt-1 text-2xl font-bold text-slate-900 dark:text-white">
                                        Select Positions
                                    </h2>

                                </div>

                            </div>

                            <p
                                class="
                                    mt-4 max-w-2xl
                                    text-sm leading-6
                                    text-slate-500 dark:text-gray-400
                                "
                            >
                                Choose the offices that voters will be able
                                to vote for in this election.
                            </p>

                        </div>


                        {{-- Selected Counter --}}

                        <div
                            class="
                                flex shrink-0
                                items-center gap-3
                                rounded-2xl
                                border border-blue-500/20
                                bg-blue-500/[0.08]
                                px-5 py-3
                            "
                        >

                            <div
                                class="
                                    flex h-10 w-10
                                    items-center justify-center
                                    rounded-xl
                                    bg-blue-600
                                    text-lg font-bold text-slate-900 dark:text-white
                                "
                                x-text="selectedPositions.length"
                            >
                                0
                            </div>

                            <div>

                                <p class="text-xs text-slate-500 dark:text-gray-500">
                                    Positions
                                </p>

                                <p class="font-semibold text-slate-900 dark:text-white">
                                    Selected
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Recommended Header --}}

                    <div class="mt-7 mb-5">

                        <div class="flex items-center justify-between">

                            <div>

                                <h3 class="text-lg font-semibold text-slate-900 dark:text-white">
                                    Available Positions
                                </h3>

                                <p class="mt-1 text-sm text-slate-500 dark:text-gray-500">
                                    Recommended for {{ $selectedType->name }}
                                </p>

                            </div>

                            <span
                                class="
                                    hidden
                                    rounded-full
                                    border border-green-500/20
                                    bg-green-500/10
                                    px-3 py-1
                                    text-xs font-semibold
                                    text-green-400
                                    sm:inline-flex
                                "
                            >
                                Recommended
                            </span>

                        </div>

                    </div>


                    {{-- Position Cards --}}

                    <div
                        class="
                            grid grid-cols-1
                            gap-4
                            sm:grid-cols-2
                            2xl:grid-cols-3
                        "
                    >

                        <template
                            x-for="(position, index) in positions"
                            :key="position"
                        >

                            <button
                                type="button"
                                @click="togglePosition(position)"

                                class="
                                    group relative
                                    min-w-0
                                    overflow-hidden
                                    rounded-2xl
                                    border
                                    p-5
                                    text-left
                                    transition-all
                                    duration-300
                                    hover:-translate-y-1
                                "

                                :class="
                                    isSelected(position)
                                        ? 'border-blue-500 bg-blue-500/[0.10] shadow-xl shadow-blue-500/10'
                                        : 'border-slate-200 dark:border-white/10 bg-slate-50 dark:bg-white/[0.025] hover:border-blue-500/30 hover:bg-white/[0.05]'
                                "
                            >

                                {{-- Number --}}

                                <div
                                    class="
                                        absolute right-4 top-4
                                        text-[10px]
                                        font-bold
                                        tracking-wider
                                    "
                                    :class="
                                        isSelected(position)
                                            ? 'text-blue-400'
                                            : 'text-slate-400 dark:text-gray-600'
                                    "
                                    x-text="'0' + (index + 1)"
                                >
                                </div>


                                {{-- Selection indicator --}}

                                <div
                                    class="
                                        flex h-11 w-11
                                        items-center justify-center
                                        rounded-xl
                                        transition-all
                                        duration-300
                                    "
                                    :class="
                                        isSelected(position)
                                            ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30'
                                            : 'bg-slate-100 dark:bg-white/5 text-slate-500 dark:text-gray-500 group-hover:bg-blue-500/10 group-hover:text-blue-400'
                                    "
                                >

                                    <template x-if="isSelected(position)">

                                        <x-heroicon-s-check class="h-5 w-5"/>

                                    </template>

                                    <template x-if="!isSelected(position)">

                                        <x-heroicon-o-user class="h-5 w-5"/>

                                    </template>

                                </div>


                                <div class="mt-5 pr-8">

                                    <h4
                                        class="truncate text-base font-bold"
                                        :class="
                                            isSelected(position)
                                                ? 'text-blue-400'
                                                : 'text-slate-900 dark:text-white'
                                        "
                                        x-text="position"
                                    >
                                    </h4>

                                    <p class="mt-1 text-xs text-slate-500 dark:text-gray-500">
                                        Election position
                                    </p>

                                </div>


                                {{-- Selected label --}}

                                <div class="mt-5">

                                    <span
                                        class="
                                            inline-flex items-center gap-1.5
                                            rounded-full
                                            px-2.5 py-1
                                            text-[10px]
                                            font-semibold
                                            transition
                                        "
                                        :class="
                                            isSelected(position)
                                                ? 'bg-blue-500/10 text-blue-400'
                                                : 'bg-slate-100 dark:bg-white/5 text-slate-500 dark:text-gray-500'
                                        "
                                    >

                                        <span
                                            class="h-1.5 w-1.5 rounded-full"
                                            :class="
                                                isSelected(position)
                                                    ? 'bg-blue-400'
                                                    : 'bg-gray-600'
                                            "
                                        ></span>

                                        <span
                                            x-text="
                                                isSelected(position)
                                                    ? 'Selected'
                                                    : 'Click to select'
                                            "
                                        ></span>

                                    </span>

                                </div>

                            </button>

                        </template>

                    </div>


                    {{-- Custom Position --}}

                    <div
                        class="
                            mt-7
                            rounded-2xl
                            border border-dashed
                            border-blue-500/20
                            bg-blue-500/[0.03]
                            p-5
                        "
                    >

                        <div class="flex items-start gap-3">

                            <div
                                class="
                                    flex h-10 w-10 shrink-0
                                    items-center justify-center
                                    rounded-xl
                                    bg-blue-500/10
                                    text-blue-400
                                "
                            >

                                <x-heroicon-o-plus class="h-5 w-5"/>

                            </div>

                            <div>

                                <h3 class="font-semibold text-slate-900 dark:text-white">
                                    Add Custom Position
                                </h3>

                                <p class="mt-1 text-xs leading-5 text-slate-500 dark:text-gray-500">
                                    Add an office that isn't included in the
                                    recommended list.
                                </p>

                            </div>

                        </div>


                        <div class="mt-4 flex flex-col gap-3 sm:flex-row">

                            <input
                                type="text"
                                x-model="customPosition"
                                @keydown.enter.prevent="addCustomPosition()"

                                placeholder="e.g. Financial Secretary"

                                class="
                                    min-w-0 flex-1
                                    rounded-xl
                                    border border-slate-200 dark:border-white/10
                                    bg-white dark:bg-[#09152d]
                                    px-4 py-3
                                    text-sm text-slate-800 dark:text-white
                                    placeholder:text-slate-400 dark:text-gray-600
                                    outline-none
                                    transition
                                    focus:border-blue-500/60
                                    focus:ring-2
                                    focus:ring-blue-500/10
                                "
                            >

                            <button
                                type="button"
                                @click="addCustomPosition()"

                                class="
                                    inline-flex
                                    items-center
                                    justify-center
                                    gap-2
                                    rounded-xl
                                    bg-blue-600
                                    px-5 py-3
                                    text-sm font-semibold
                                    text-slate-900 dark:text-white
                                    shadow-lg
                                    shadow-blue-600/20
                                    transition
                                    hover:bg-blue-500
                                    hover:-translate-y-0.5
                                "
                            >

                                <x-heroicon-o-plus class="h-4 w-4"/>

                                Add Position

                            </button>

                        </div>

                    </div>


                    {{-- Selected Positions --}}

                    <div class="mt-7">

                        <div
                            class="
                                mb-4
                                flex items-center
                                justify-between
                            "
                        >

                            <div>

                                <h3 class="font-semibold text-slate-900 dark:text-white">
                                    Selected Positions
                                </h3>

                                <p class="mt-1 text-xs text-slate-500 dark:text-gray-500">
                                    These positions will appear on the ballot.
                                </p>

                            </div>

                            <button
                                type="button"
                                @click="clearAll()"
                                x-show="selectedPositions.length > 0"

                                class="
                                    text-xs font-medium
                                    text-red-400
                                    transition
                                    hover:text-red-300
                                "
                            >
                                Clear all
                            </button>

                        </div>


                        {{-- Empty --}}

                        <div
                            x-show="selectedPositions.length === 0"

                            class="
                                rounded-2xl
                                border border-dashed
                                border-slate-200 dark:border-white/10
                                bg-white/[0.02]
                                px-6 py-10
                                text-center
                            "
                        >

                            <div
                                class="
                                    mx-auto flex h-12 w-12
                                    items-center justify-center
                                    rounded-2xl
                                    bg-slate-100 dark:bg-slate-100 dark:bg-white/5
                                "
                            >

                                <x-heroicon-o-clipboard-document-list
                                    class="h-6 w-6 text-slate-400 dark:text-gray-600"
                                />

                            </div>

                            <p class="mt-4 font-medium text-slate-700 dark:text-gray-300">
                                No positions selected
                            </p>

                            <p class="mt-1 text-xs text-slate-500 dark:text-gray-500">
                                Select at least one position above.
                            </p>

                        </div>


                        {{-- Selected chips --}}

                        <div
                            x-show="selectedPositions.length > 0"

                            class="flex flex-wrap gap-2"
                        >

                            <template
                                x-for="position in selectedPositions"
                                :key="'chip-' + position"
                            >

                                <div
                                    class="
                                        inline-flex items-center gap-2
                                        rounded-xl
                                        border border-blue-500/20
                                        bg-blue-500/[0.08]
                                        px-3 py-2
                                    "
                                >

                                    <span
                                        class="
                                            h-1.5 w-1.5
                                            rounded-full
                                            bg-blue-400
                                        "
                                    ></span>

                                    <span
                                        class="text-sm font-medium text-blue-300"
                                        x-text="position"
                                    ></span>

                                    <button
                                        type="button"
                                        @click="removePosition(position)"

                                        class="
                                            ml-1
                                            text-blue-500
                                            transition
                                            hover:text-red-400
                                        "
                                    >

                                        <x-heroicon-o-x-mark
                                            class="h-4 w-4"
                                        />

                                    </button>

                                </div>

                            </template>

                        </div>

                    </div>

                </div>

            </div>

        </main>


        {{-- ===================================================== --}}
        {{-- RIGHT: SUMMARY --}}
        {{-- ===================================================== --}}

        <aside class="min-w-0">

            <div
                class="
                    sticky top-6
                    relative overflow-hidden
                    rounded-3xl
                    border border-slate-200 dark:border-white/10
                    bg-white
                    p-5
                    shadow-[0_12px_35px_rgba(15,23,42,0.06)]
                    dark:bg-[#101D35]
                    dark:shadow-xl
                    backdrop-blur-xl
                "
            >

                {{-- Glow --}}

                <div
                    class="
                        pointer-events-none
                        absolute -right-16 -top-16
                        h-40 w-40
                        rounded-full
                        bg-blue-500/10
                        blur-3xl
                    "
                ></div>


                <div class="relative">

                    {{-- Summary Header --}}

                    <div class="flex items-center gap-3">

                        <div
                            class="
                                flex h-11 w-11
                                items-center justify-center
                                rounded-2xl
                                bg-blue-600
                                shadow-lg
                                shadow-blue-600/20
                            "
                        >

                            <x-heroicon-o-clipboard-document-list
                                class="h-5 w-5 text-white"
                            />

                        </div>

                        <div>

                            <h2 class="font-bold text-slate-900 dark:text-white">
                                Election Summary
                            </h2>

                            <p class="text-xs text-slate-500 dark:text-gray-500">
                                Final setup
                            </p>

                        </div>

                    </div>


                    {{-- Progress --}}

                    <div class="mt-7">

                        <div class="flex items-center justify-between">

                            <span class="text-xs text-slate-500 dark:text-gray-500">
                                Progress
                            </span>

                            <span class="text-xs font-semibold text-blue-400">
                                100%
                            </span>

                        </div>

                        <div class="mt-2 h-2 rounded-full bg-slate-100 dark:bg-white/10">

                            <div
                                class="
                                    h-2 w-full
                                    rounded-full
                                    bg-gradient-to-r
                                    from-blue-600
                                    to-cyan-400
                                "
                            ></div>

                        </div>

                    </div>


                    {{-- Summary details --}}

                    <div class="mt-7 space-y-5">


                        <div>

                            <p class="text-[10px] uppercase tracking-wider text-slate-400 dark:text-gray-600">
                                Status
                            </p>

                            <div class="mt-2 flex items-center gap-2">

                                <span
                                    class="
                                        h-2 w-2
                                        rounded-full
                                        bg-green-400
                                        shadow-lg
                                        shadow-green-400/50
                                    "
                                ></span>

                                <p class="font-semibold text-green-400">
                                    Draft
                                </p>

                            </div>

                        </div>


                        <div>

                            <p class="text-[10px] uppercase tracking-wider text-slate-400 dark:text-gray-600">
                                Election Type
                            </p>

                            <p class="mt-1 break-words font-semibold text-slate-900 dark:text-white">
                                {{ $selectedType->name }}
                            </p>

                        </div>


                        <div>

                            <p class="text-[10px] uppercase tracking-wider text-slate-400 dark:text-gray-600">
                                Organization
                            </p>

                            <p class="mt-1 break-words font-semibold text-slate-900 dark:text-white">
                                {{ $organization->name }}
                            </p>

                        </div>


                        <div>

                            <p class="text-[10px] uppercase tracking-wider text-slate-400 dark:text-gray-600">
                                Election Title
                            </p>

                            <p class="mt-1 break-words text-sm font-semibold text-slate-900 dark:text-white">
                                {{ $electionTitle }}
                            </p>

                        </div>


                        <div>

                            <p class="text-[10px] uppercase tracking-wider text-slate-400 dark:text-gray-600">
                                Visibility
                            </p>

                            <p class="mt-1 font-semibold text-slate-900 dark:text-white">
                                {{ ucfirst($visibility) }}
                            </p>

                        </div>


                        {{-- Position count --}}

                        <div
                            class="
                                rounded-2xl
                                border border-blue-500/20
                                bg-blue-500/[0.06]
                                p-4
                            "
                        >

                            <div class="flex items-center justify-between">

                                <div>

                                    <p class="text-[10px] uppercase tracking-wider text-slate-400 dark:text-gray-600">
                                        Positions
                                    </p>

                                    <p
                                        class="mt-1 text-lg font-bold text-blue-400"
                                        x-text="selectedPositions.length"
                                    >
                                        0
                                    </p>

                                </div>

                                <div
                                    class="
                                        flex h-10 w-10
                                        items-center justify-center
                                        rounded-xl
                                        bg-blue-500/10
                                        text-blue-400
                                    "
                                >

                                    <x-heroicon-o-user-group
                                        class="h-5 w-5"
                                    />

                                </div>

                            </div>

                            <p
                                class="mt-1 text-xs text-slate-500 dark:text-gray-500"
                                x-text="
                                    selectedPositions.length === 1
                                        ? 'Position selected'
                                        : 'Positions selected'
                                "
                            >
                                Positions selected
                            </p>

                        </div>

                    </div>


                    {{-- Divider --}}

                    <div class="my-6 border-t border-slate-200 dark:border-white/10"></div>


                    {{-- Selected preview --}}

                    <div>

                        <div class="mb-3 flex items-center justify-between">

                            <p class="text-xs font-semibold text-slate-700 dark:text-gray-300">
                                Ballot Preview
                            </p>

                            <span class="text-[10px] text-slate-400 dark:text-gray-600">
                                Live
                            </span>

                        </div>


                        <div
                            x-show="selectedPositions.length === 0"
                            class="
                                rounded-xl
                                border border-dashed
                                border-slate-200 dark:border-white/10
                                p-4
                                text-center
                            "
                        >

                            <p class="text-xs text-slate-500 dark:text-gray-500">
                                No positions selected yet.
                            </p>

                        </div>


                        <div
                            x-show="selectedPositions.length > 0"
                            class="space-y-2"
                        >

                            <template
                                x-for="(position, index) in selectedPositions.slice(0, 5)"
                                :key="'preview-' + position"
                            >

                                <div
                                    class="
                                        flex items-center gap-3
                                        rounded-xl
                                        border border-slate-100 dark:border-white/5
                                        bg-slate-50 dark:bg-white/[0.025]
                                        px-3 py-2.5
                                    "
                                >

                                    <span
                                        class="
                                            flex h-6 w-6
                                            shrink-0
                                            items-center justify-center
                                            rounded-lg
                                            bg-blue-500/10
                                            text-[10px]
                                            font-bold
                                            text-blue-400
                                        "
                                        x-text="index + 1"
                                    ></span>

                                    <span
                                        class="truncate text-xs font-medium text-slate-700 dark:text-gray-300"
                                        x-text="position"
                                    ></span>

                                </div>

                            </template>


                            <p
                                x-show="selectedPositions.length > 5"
                                class="pt-1 text-center text-[10px] text-slate-400 dark:text-gray-600"
                                x-text="
                                    '+' +
                                    (selectedPositions.length - 5) +
                                    ' more positions'
                                "
                            ></p>

                        </div>

                    </div>


                    {{-- Tip --}}

                    <div
                        class="
                            mt-6
                            rounded-2xl
                            border border-cyan-500/10
                            bg-cyan-500/[0.03]
                            p-4
                        "
                    >

                        <div class="flex gap-3">

                            <x-heroicon-o-information-circle
                                class="h-5 w-5 shrink-0 text-cyan-400"
                            />

                            <p class="text-xs leading-5 text-slate-500 dark:text-gray-500">

                                These positions will become the offices
                                voters can select on the ballot.

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </aside>

    </div>


    {{-- ========================================================= --}}
    {{-- BOTTOM ACTION BAR --}}
    {{-- ========================================================= --}}

    <div
        class="
            sticky bottom-4 z-20
            mt-6
            flex flex-col gap-3
            rounded-2xl
            border border-slate-200 dark:border-white/10
            bg-white/95 dark:bg-[#0b1730]/90
            p-3
            shadow-2xl
            backdrop-blur-xl
            sm:flex-row
            sm:items-center
            sm:justify-between
        "
    >

        <a
            href="{{ route('elections.schedule', [
                'type' => $selectedType->id,
                'organization' => $organization->id,
                'title' => $electionTitle,
                'description' => $description,
                'visibility' => $visibility,
                'start_date' => request('start_date'),
                'start_time' => request('start_time'),
                'end_date' => request('end_date'),
                'end_time' => request('end_time'),
            ]) }}"
        >

            <x-electo.button variant="secondary">

                <span class="flex items-center gap-2">

                    <x-heroicon-o-arrow-left class="h-5 w-5"/>

                    Back to Schedule

                </span>

            </x-electo.button>

        </a>


      <form
    method="POST"
    action="{{ route('elections.store') }}"
    class="inline-flex"
    @submit="
        if (selectedPositions.length === 0) {
            event.preventDefault();
            alert('Please select at least one position.');
            return;
        }
    "
>

    @csrf

    {{-- Election Type --}}
    <input
        type="hidden"
        name="type"
        value="{{ $selectedType->id }}"
    >

    {{-- Organization --}}
    <input
        type="hidden"
        name="organization"
        value="{{ $organization->id }}"
    >

    {{-- Election Details --}}
    <input
        type="hidden"
        name="title"
        value="{{ $electionTitle }}"
    >

    <input
        type="hidden"
        name="description"
        value="{{ $description }}"
    >

    <input
    type="hidden"
    name="visibility"
    value="{{ strtolower($visibility) }}"
>

    {{-- Schedule --}}
    <input
        type="hidden"
        name="start_date"
        value="{{ request('start_date') }}"
    >

    <input
        type="hidden"
        name="start_time"
        value="{{ request('start_time') }}"
    >

    <input
        type="hidden"
        name="end_date"
        value="{{ request('end_date') }}"
    >

    <input
        type="hidden"
        name="end_time"
        value="{{ request('end_time') }}"
    >

    {{-- Selected Positions --}}
    <template
        x-for="position in selectedPositions"
        :key="'submit-' + position"
    >

        <input
            type="hidden"
            name="positions[]"
            :value="position"
        >

    </template>


    <button
        type="submit"

        class="
            inline-flex
            items-center
            justify-center
            gap-2
            rounded-xl
            bg-gradient-to-r
            from-blue-600
            to-blue-500
            px-6 py-3
            text-sm font-semibold
            text-slate-900 dark:text-white
            shadow-lg
            shadow-blue-600/20
            transition-all
            hover:-translate-y-0.5
            hover:from-blue-500
            hover:to-cyan-500
            hover:shadow-blue-500/30
        "
    >

        Create Election

        <x-heroicon-o-check-circle class="h-5 w-5"/>

    </button>

</form>

    </div>

</div>

@endsection