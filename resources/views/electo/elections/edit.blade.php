@extends('electo.layouts.dashboard')

@section('title', 'Edit Election')
@section('page-title', 'Edit Election')

@section('content')

<div
    class="space-y-8 text-slate-900 dark:text-white"
>

    {{-- ========================================================= --}}
    {{-- PREMIUM HEADER --}}
    {{-- ========================================================= --}}

    <div
        class="
            relative overflow-hidden
            rounded-3xl
            border border-slate-200
            bg-white
            p-6
            shadow-sm
            dark:border-white/10
            dark:bg-[#132544]
            md:p-8
        "
    >

        {{-- Decorative glow --}}
        <div
            class="
                pointer-events-none
                absolute
                -right-20
                -top-20
                h-48
                w-48
                rounded-full
                bg-blue-500/10
                blur-3xl
                dark:bg-blue-500/10
            "
        ></div>

        <div
            class="
                pointer-events-none
                absolute
                -bottom-24
                -left-20
                h-48
                w-48
                rounded-full
                bg-cyan-500/10
                blur-3xl
            "
        ></div>


        <div
            class="
                relative
                flex
                flex-col
                gap-5
                md:flex-row
                md:items-center
                md:justify-between
            "
        >

            <div>

                <div class="flex items-center gap-3">

                    <div
                        class="
                            flex
                            h-12
                            w-12
                            items-center
                            justify-center
                            rounded-2xl
                            bg-blue-50
                            text-blue-600
                            dark:bg-blue-500/15
                            dark:text-blue-400
                        "
                    >

                        <x-heroicon-o-pencil-square class="h-6 w-6"/>

                    </div>

                    <div>

                        <p
                            class="
                                text-xs
                                font-bold
                                uppercase
                                tracking-[0.2em]
                                text-blue-600
                                dark:text-blue-400
                            "
                        >
                            Election Management
                        </p>

                        <h1
                            class="
                                mt-1
                                text-3xl
                                font-extrabold
                                tracking-tight
                                text-slate-900
                                dark:text-white
                            "
                        >
                            Edit Election
                        </h1>

                    </div>

                </div>


                <p
                    class="
                        mt-4
                        max-w-2xl
                        text-sm
                        leading-6
                        text-slate-500
                        dark:text-slate-400
                    "
                >
                    Update the information, schedule, visibility and
                    positions for this election.
                </p>

            </div>


            <div class="flex gap-3">

                <a
                    href="{{ route('elections.show', $election) }}"
                >

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
    {{-- VALIDATION ERRORS --}}
    {{-- ========================================================= --}}

    @if ($errors->any())

        <div
            class="
                rounded-2xl
                border
                border-red-200
                bg-red-50
                p-5
                shadow-sm
                dark:border-red-500/30
                dark:bg-red-500/10
            "
        >

            <div class="flex gap-3">

                <div class="text-red-500 dark:text-red-400">

                    <x-heroicon-o-exclamation-triangle class="h-6 w-6"/>

                </div>

                <div>

                    <h3
                        class="
                            font-semibold
                            text-red-700
                            dark:text-red-400
                        "
                    >
                        Please correct the following:
                    </h3>

                    <ul
                        class="
                            mt-2
                            list-disc
                            space-y-1
                            pl-5
                            text-sm
                            text-red-600
                            dark:text-red-300
                        "
                    >

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif



    {{-- ========================================================= --}}
    {{-- EDIT FORM --}}
    {{-- ========================================================= --}}

    <form
        method="POST"
        action="{{ route('elections.update', $election) }}"

        x-data="{

            positions: {{ json_encode(
                $election->positions
                    ->sortBy('sort_order')
                    ->pluck('name')
                    ->values()
                    ->toArray()
            ) }},

            newPosition: '',

            addPosition() {

                const position = this.newPosition.trim();

                if (!position) {
                    return;
                }

                if (
                    this.positions.some(
                        item =>
                            item.toLowerCase() ===
                            position.toLowerCase()
                    )
                ) {

                    this.newPosition = '';

                    return;
                }

                this.positions.push(position);

                this.newPosition = '';

            },

            removePosition(index) {

                this.positions.splice(index, 1);

            }

        }"

        class="space-y-8"
    >

        @csrf

        @method('PUT')



        {{-- ===================================================== --}}
        {{-- BASIC INFORMATION --}}
        {{-- ===================================================== --}}

        <div
            class="
                overflow-hidden
                rounded-3xl
                border
                border-slate-200
                bg-white
                shadow-sm
                dark:border-white/10
                dark:bg-[#132544]
            "
        >

            <div class="p-6 md:p-8">

                <div class="mb-8">

                    <div class="flex items-start gap-4">

                        <div
                            class="
                                flex
                                h-11
                                w-11
                                shrink-0
                                items-center
                                justify-center
                                rounded-2xl
                                bg-blue-50
                                text-blue-600
                                dark:bg-blue-500/15
                                dark:text-blue-400
                            "
                        >

                            <x-heroicon-o-information-circle class="h-6 w-6"/>

                        </div>

                        <div>

                            <h2
                                class="
                                    text-xl
                                    font-bold
                                    text-slate-900
                                    dark:text-white
                                "
                            >
                                Election Information
                            </h2>

                            <p
                                class="
                                    mt-1
                                    text-sm
                                    text-slate-500
                                    dark:text-slate-400
                                "
                            >
                                Update the basic information about your election.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="grid gap-6 md:grid-cols-2">


                    {{-- Organization --}}

                    <div>

                        <label
                            class="
                                mb-2
                                block
                                text-sm
                                font-semibold
                                text-slate-700
                                dark:text-slate-300
                            "
                        >
                            Organization
                        </label>

                        <select
                            name="organization"

                            class="
                                w-full
                                rounded-2xl
                                border
                                border-slate-200
                                bg-slate-50
                                px-4
                                py-3
                                text-sm
                                font-medium
                                text-slate-900
                                outline-none
                                transition
                                focus:border-blue-500
                                focus:ring-4
                                focus:ring-blue-500/10

                                dark:border-white/10
                                dark:bg-[#0B1730]
                                dark:text-white
                            "
                        >

                            @foreach($organizations as $organization)

                                <option
                                    value="{{ $organization->id }}"
                                    {{ $election->organization_id == $organization->id ? 'selected' : '' }}
                                >
                                    {{ $organization->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>



                    {{-- Election Type --}}

                    <div>

                        <label
                            class="
                                mb-2
                                block
                                text-sm
                                font-semibold
                                text-slate-700
                                dark:text-slate-300
                            "
                        >
                            Election Type
                        </label>

                        <div
                            class="
                                rounded-2xl
                                border
                                border-slate-200
                                bg-slate-50
                                px-4
                                py-3
                                dark:border-white/10
                                dark:bg-[#0B1730]
                            "
                        >

                            <p
                                class="
                                    font-semibold
                                    text-slate-900
                                    dark:text-white
                                "
                            >
                                {{ $election->electionType->name ?? 'Not selected' }}
                            </p>

                            @if($election->electionType?->category)

                                <p
                                    class="
                                        mt-1
                                        text-xs
                                        font-medium
                                        text-blue-600
                                        dark:text-blue-400
                                    "
                                >
                                    {{ $election->electionType->category->name }}
                                </p>

                            @endif

                        </div>


                        <input
                            type="hidden"
                            name="type"
                            value="{{ $election->election_type_id }}"
                        >

                    </div>



                    {{-- Title --}}

                    <div class="md:col-span-2">

                        <label
                            class="
                                mb-2
                                block
                                text-sm
                                font-semibold
                                text-slate-700
                                dark:text-slate-300
                            "
                        >
                            Election Title
                        </label>

                        <input
                            type="text"
                            name="title"
                            value="{{ old('title', $election->title) }}"
                            placeholder="Enter election title"

                            class="
                                w-full
                                rounded-2xl
                                border
                                border-slate-200
                                bg-slate-50
                                px-4
                                py-3
                                text-sm
                                text-slate-900
                                placeholder:text-slate-400
                                outline-none
                                transition
                                focus:border-blue-500
                                focus:ring-4
                                focus:ring-blue-500/10

                                dark:border-white/10
                                dark:bg-[#0B1730]
                                dark:text-white
                                dark:placeholder:text-slate-500
                            "
                        >

                    </div>



                    {{-- Description --}}

                    <div class="md:col-span-2">

                        <label
                            class="
                                mb-2
                                block
                                text-sm
                                font-semibold
                                text-slate-700
                                dark:text-slate-300
                            "
                        >
                            Description
                        </label>

                        <textarea
                            name="description"
                            rows="5"
                            placeholder="Describe this election..."

                            class="
                                w-full
                                resize-none
                                rounded-2xl
                                border
                                border-slate-200
                                bg-slate-50
                                px-4
                                py-3
                                text-sm
                                leading-6
                                text-slate-900
                                placeholder:text-slate-400
                                outline-none
                                transition
                                focus:border-blue-500
                                focus:ring-4
                                focus:ring-blue-500/10

                                dark:border-white/10
                                dark:bg-[#0B1730]
                                dark:text-white
                                dark:placeholder:text-slate-500
                            "
                        >{{ old('description', $election->description) }}</textarea>

                    </div>

                </div>

            </div>

        </div>



        {{-- ===================================================== --}}
        {{-- SCHEDULE & VISIBILITY --}}
        {{-- ===================================================== --}}

        <div
            class="
                overflow-hidden
                rounded-3xl
                border
                border-slate-200
                bg-white
                shadow-sm
                dark:border-white/10
                dark:bg-[#132544]
            "
        >

            <div class="p-6 md:p-8">

                <div class="mb-8">

                    <div class="flex items-start gap-4">

                        <div
                            class="
                                flex
                                h-11
                                w-11
                                shrink-0
                                items-center
                                justify-center
                                rounded-2xl
                                bg-purple-50
                                text-purple-600
                                dark:bg-purple-500/15
                                dark:text-purple-400
                            "
                        >

                            <x-heroicon-o-calendar-days class="h-6 w-6"/>

                        </div>

                        <div>

                            <h2
                                class="
                                    text-xl
                                    font-bold
                                    text-slate-900
                                    dark:text-white
                                "
                            >
                                Schedule & Visibility
                            </h2>

                            <p
                                class="
                                    mt-1
                                    text-sm
                                    text-slate-500
                                    dark:text-slate-400
                                "
                            >
                                Control when the election starts and ends and who can access it.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="grid gap-6 md:grid-cols-2">


                    {{-- Start Date --}}

                    <div>

                        <label
                            class="
                                mb-2
                                block
                                text-sm
                                font-semibold
                                text-slate-700
                                dark:text-slate-300
                            "
                        >
                            Start Date
                        </label>

                        <input
                            type="date"
                            name="start_date"
                            value="{{ old('start_date', optional($election->starts_at)->format('Y-m-d')) }}"

                            class="
                                w-full
                                rounded-2xl
                                border
                                border-slate-200
                                bg-slate-50
                                px-4
                                py-3
                                text-sm
                                text-slate-900
                                outline-none
                                focus:border-blue-500
                                focus:ring-4
                                focus:ring-blue-500/10

                                dark:border-white/10
                                dark:bg-[#0B1730]
                                dark:text-white
                            "
                        >

                    </div>



                    {{-- Start Time --}}

                    <div>

                        <label
                            class="
                                mb-2
                                block
                                text-sm
                                font-semibold
                                text-slate-700
                                dark:text-slate-300
                            "
                        >
                            Start Time
                        </label>

                        <input
                            type="time"
                            name="start_time"
                            value="{{ old('start_time', optional($election->starts_at)->format('H:i')) }}"

                            class="
                                w-full
                                rounded-2xl
                                border
                                border-slate-200
                                bg-slate-50
                                px-4
                                py-3
                                text-sm
                                text-slate-900
                                outline-none
                                focus:border-blue-500
                                focus:ring-4
                                focus:ring-blue-500/10

                                dark:border-white/10
                                dark:bg-[#0B1730]
                                dark:text-white
                            "
                        >

                    </div>



                    {{-- End Date --}}

                    <div>

                        <label
                            class="
                                mb-2
                                block
                                text-sm
                                font-semibold
                                text-slate-700
                                dark:text-slate-300
                            "
                        >
                            End Date
                        </label>

                        <input
                            type="date"
                            name="end_date"
                            value="{{ old('end_date', optional($election->ends_at)->format('Y-m-d')) }}"

                            class="
                                w-full
                                rounded-2xl
                                border
                                border-slate-200
                                bg-slate-50
                                px-4
                                py-3
                                text-sm
                                text-slate-900
                                outline-none
                                focus:border-blue-500
                                focus:ring-4
                                focus:ring-blue-500/10

                                dark:border-white/10
                                dark:bg-[#0B1730]
                                dark:text-white
                            "
                        >

                    </div>



                    {{-- End Time --}}

                    <div>

                        <label
                            class="
                                mb-2
                                block
                                text-sm
                                font-semibold
                                text-slate-700
                                dark:text-slate-300
                            "
                        >
                            End Time
                        </label>

                        <input
                            type="time"
                            name="end_time"
                            value="{{ old('end_time', optional($election->ends_at)->format('H:i')) }}"

                            class="
                                w-full
                                rounded-2xl
                                border
                                border-slate-200
                                bg-slate-50
                                px-4
                                py-3
                                text-sm
                                text-slate-900
                                outline-none
                                focus:border-blue-500
                                focus:ring-4
                                focus:ring-blue-500/10

                                dark:border-white/10
                                dark:bg-[#0B1730]
                                dark:text-white
                            "
                        >

                    </div>



                    {{-- Visibility --}}

                    <div class="md:col-span-2">

                        <label
                            class="
                                mb-2
                                block
                                text-sm
                                font-semibold
                                text-slate-700
                                dark:text-slate-300
                            "
                        >
                            Visibility
                        </label>

                        <select
                            name="visibility"

                            class="
                                w-full
                                rounded-2xl
                                border
                                border-slate-200
                                bg-slate-50
                                px-4
                                py-3
                                text-sm
                                font-medium
                                text-slate-900
                                outline-none
                                focus:border-blue-500
                                focus:ring-4
                                focus:ring-blue-500/10

                                dark:border-white/10
                                dark:bg-[#0B1730]
                                dark:text-white
                            "
                        >

                            <option
                                value="private"
                                {{ old('visibility', strtolower($election->visibility)) === 'private' ? 'selected' : '' }}
                            >
                                Private
                            </option>

                            <option
                                value="public"
                                {{ old('visibility', strtolower($election->visibility)) === 'public' ? 'selected' : '' }}
                            >
                                Public
                            </option>

                        </select>

                    </div>

                </div>

            </div>

        </div>



        {{-- ===================================================== --}}
        {{-- POSITIONS --}}
        {{-- ===================================================== --}}

        <div
            class="
                overflow-hidden
                rounded-3xl
                border
                border-slate-200
                bg-white
                shadow-sm
                dark:border-white/10
                dark:bg-[#132544]
            "
        >

            <div class="p-6 md:p-8">

                <div
                    class="
                        mb-8
                        flex
                        flex-col
                        gap-4
                        sm:flex-row
                        sm:items-center
                        sm:justify-between
                    "
                >

                    <div class="flex items-start gap-4">

                        <div
                            class="
                                flex
                                h-11
                                w-11
                                shrink-0
                                items-center
                                justify-center
                                rounded-2xl
                                bg-emerald-50
                                text-emerald-600
                                dark:bg-emerald-500/15
                                dark:text-emerald-400
                            "
                        >

                            <x-heroicon-o-briefcase class="h-6 w-6"/>

                        </div>

                        <div>

                            <h2
                                class="
                                    text-xl
                                    font-bold
                                    text-slate-900
                                    dark:text-white
                                "
                            >
                                Election Positions
                            </h2>

                            <p
                                class="
                                    mt-1
                                    text-sm
                                    text-slate-500
                                    dark:text-slate-400
                                "
                            >
                                Manage the offices voters will be able to vote for.
                            </p>

                        </div>

                    </div>


                    <div
                        class="
                            rounded-2xl
                            border
                            border-blue-100
                            bg-blue-50
                            px-4
                            py-2
                            dark:border-blue-500/20
                            dark:bg-blue-500/10
                        "
                    >

                        <span
                            class="
                                text-sm
                                font-bold
                                text-blue-600
                                dark:text-blue-400
                            "

                            x-text="
                                positions.length +
                                ' Position' +
                                (positions.length === 1 ? '' : 's')
                            "
                        ></span>

                    </div>

                </div>



                {{-- Add Position --}}

                <div
                    class="
                        rounded-2xl
                        border
                        border-dashed
                        border-blue-200
                        bg-blue-50/50
                        p-5

                        dark:border-blue-500/30
                        dark:bg-[#0B1730]
                    "
                >

                    <label
                        class="
                            mb-3
                            block
                            text-sm
                            font-semibold
                            text-slate-700
                            dark:text-slate-300
                        "
                    >
                        Add New Position
                    </label>

                    <div class="flex flex-col gap-3 sm:flex-row">

                        <input
                            type="text"
                            x-model="newPosition"
                            @keydown.enter.prevent="addPosition()"
                            placeholder="e.g. President, Secretary, Treasurer"

                            class="
                                flex-1
                                rounded-2xl
                                border
                                border-slate-200
                                bg-white
                                px-4
                                py-3
                                text-sm
                                text-slate-900
                                placeholder:text-slate-400
                                outline-none
                                focus:border-blue-500
                                focus:ring-4
                                focus:ring-blue-500/10

                                dark:border-white/10
                                dark:bg-[#132544]
                                dark:text-white
                                dark:placeholder:text-slate-500
                            "
                        >

                        <button
                            type="button"
                            @click="addPosition()"

                            class="
                                rounded-2xl
                                bg-gradient-to-r
                                from-blue-600
                                to-cyan-500
                                px-6
                                py-3
                                font-semibold
                                text-white
                                shadow-lg
                                shadow-blue-500/20
                                transition
                                hover:-translate-y-0.5
                                hover:shadow-xl
                            "
                        >

                            + Add Position

                        </button>

                    </div>

                </div>



                {{-- Position List --}}

                <div class="mt-6">

                    <div
                        x-show="positions.length === 0"

                        class="
                            rounded-2xl
                            border
                            border-slate-200
                            bg-slate-50
                            p-10
                            text-center

                            dark:border-white/10
                            dark:bg-[#0B1730]
                        "
                    >

                        <div
                            class="
                                mx-auto
                                mb-4
                                flex
                                h-14
                                w-14
                                items-center
                                justify-center
                                rounded-2xl
                                bg-slate-100
                                text-slate-400

                                dark:bg-white/5
                                dark:text-slate-500
                            "
                        >

                            <x-heroicon-o-briefcase class="h-7 w-7"/>

                        </div>

                        <p
                            class="
                                font-semibold
                                text-slate-700
                                dark:text-slate-300
                            "
                        >
                            No positions added yet.
                        </p>

                        <p
                            class="
                                mt-1
                                text-sm
                                text-slate-500
                                dark:text-slate-500
                            "
                        >
                            Add at least one position for voters to select.
                        </p>

                    </div>



                    <div class="space-y-3">

                        <template
                            x-for="(position, index) in positions"
                            :key="index"
                        >

                            <div
                                class="
                                    group
                                    flex
                                    items-center
                                    gap-4
                                    rounded-2xl
                                    border
                                    border-slate-200
                                    bg-white
                                    p-4
                                    shadow-sm
                                    transition
                                    hover:border-blue-200
                                    hover:shadow-md

                                    dark:border-white/10
                                    dark:bg-[#0B1730]
                                    dark:hover:border-blue-500/30
                                "
                            >

                                {{-- Number --}}

                                <div
                                    class="
                                        flex
                                        h-11
                                        w-11
                                        shrink-0
                                        items-center
                                        justify-center
                                        rounded-2xl
                                        bg-blue-50
                                        font-bold
                                        text-blue-600

                                        dark:bg-blue-600/20
                                        dark:text-blue-400
                                    "

                                    x-text="index + 1"
                                ></div>



                                {{-- Position Name --}}

                                <div class="min-w-0 flex-1">

                                    <input
                                        type="text"
                                        name="positions[]"
                                        x-model="positions[index]"

                                        class="
                                            w-full
                                            border-0
                                            bg-transparent
                                            p-0
                                            font-semibold
                                            text-slate-900
                                            outline-none
                                            focus:ring-0

                                            dark:text-white
                                        "
                                    >

                                    <p
                                        class="
                                            mt-1
                                            text-xs
                                            text-slate-400
                                            dark:text-slate-500
                                        "
                                    >
                                        Election position
                                    </p>

                                </div>



                                {{-- Remove --}}

                                <button
                                    type="button"
                                    @click="removePosition(index)"

                                    class="
                                        flex
                                        h-10
                                        w-10
                                        shrink-0
                                        items-center
                                        justify-center
                                        rounded-xl
                                        text-red-500
                                        transition
                                        hover:bg-red-50
                                        hover:text-red-600

                                        dark:text-red-400
                                        dark:hover:bg-red-500/10
                                        dark:hover:text-red-300
                                    "

                                    title="Remove position"
                                >

                                    <x-heroicon-o-trash class="h-5 w-5"/>

                                </button>

                            </div>

                        </template>

                    </div>

                </div>

            </div>

        </div>



        {{-- ===================================================== --}}
        {{-- ACTIONS --}}
        {{-- ===================================================== --}}

        <div
            class="
                flex
                flex-col-reverse
                gap-3
                rounded-3xl
                border
                border-slate-200
                bg-white
                p-5
                shadow-sm

                dark:border-white/10
                dark:bg-[#132544]

                sm:flex-row
                sm:justify-end
            "
        >

            <a
                href="{{ route('elections.show', $election) }}"

                class="
                    rounded-2xl
                    border
                    border-slate-200
                    bg-white
                    px-6
                    py-3
                    text-center
                    font-semibold
                    text-slate-600
                    transition
                    hover:bg-slate-50
                    hover:text-slate-900

                    dark:border-white/10
                    dark:bg-white/5
                    dark:text-slate-300
                    dark:hover:bg-white/10
                    dark:hover:text-white
                "
            >
                Cancel
            </a>


            <button
                type="submit"

                class="
                    rounded-2xl
                    bg-gradient-to-r
                    from-blue-600
                    to-cyan-500
                    px-8
                    py-3
                    font-semibold
                    text-white
                    shadow-lg
                    shadow-blue-500/20
                    transition
                    hover:-translate-y-0.5
                    hover:shadow-xl
                "
            >

                <span
                    class="
                        flex
                        items-center
                        justify-center
                        gap-2
                    "
                >

                    <x-heroicon-o-check class="h-5 w-5"/>

                    Save Changes

                </span>

            </button>

        </div>

    </form>

</div>

@endsection