@extends('electo.layouts.dashboard')

@section('title', 'Election Details')
@section('page-title', 'Election Details')

@section('content')

<div
    x-data="{
        progress: 50,
        electionType: @js($selectedType->name),
        organization: '',
        electionTitle: '',
        description: '',
        visibility: 'Private'
    }"
    class="w-full"
>

    {{-- ================================================= --}}
    {{-- HEADER --}}
    {{-- ================================================= --}}

    <div class="mb-8 flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <div
                class="
                    mb-3 inline-flex items-center gap-2
                    rounded-full
                    border border-blue-100
                    bg-blue-50
                    px-3 py-1.5
                    text-[11px]
                    font-bold uppercase
                    tracking-[0.18em]
                    text-blue-700

                    dark:border-blue-400/20
                    dark:bg-blue-500/10
                    dark:text-blue-300
                "
            >
                <span class="h-1.5 w-1.5 rounded-full bg-blue-600"></span>

                Election Setup
            </div>

            <h1
                class="
                    text-2xl
                    font-extrabold
                    tracking-tight
                    text-slate-900
                    sm:text-3xl

                    dark:text-white
                "
            >
                Election Details
            </h1>

            <p
                class="
                    mt-2
                    max-w-2xl
                    text-sm
                    leading-6
                    text-slate-500

                    dark:text-slate-400
                "
            >
                Tell us about the election you are creating.
            </p>

        </div>


        <a href="{{ route('elections.create') }}">

            <x-electo.button variant="secondary">

                <span class="flex items-center gap-2">

                    <x-heroicon-o-arrow-left class="h-5 w-5"/>

                    Back

                </span>

            </x-electo.button>

        </a>

    </div>


    {{-- ================================================= --}}
    {{-- PROGRESS --}}
    {{-- ================================================= --}}

    <div class="mb-8">

        <x-electo.wizard-progress :step="2" />

    </div>


    {{-- ================================================= --}}
    {{-- MAIN GRID --}}
    {{-- ================================================= --}}

    <div
        class="
            grid
            grid-cols-1
            gap-6
            xl:grid-cols-12
            xl:items-start
        "
    >

        {{-- ================================================= --}}
        {{-- LEFT SIDEBAR --}}
        {{-- ================================================= --}}

        <aside class="xl:col-span-2">

            <x-electo.wizard-sidebar />

        </aside>


        {{-- ================================================= --}}
        {{-- CENTER --}}
        {{-- ================================================= --}}

        <main class="xl:col-span-7">

            <div
                class="
                    relative
                    overflow-hidden
                    rounded-3xl

                    border
                    border-slate-200
                    bg-white

                    shadow-[0_12px_40px_rgba(15,23,42,0.06)]

                    dark:border-white/10
                    dark:bg-[#101D35]
                    dark:shadow-[0_18px_50px_rgba(0,0,0,0.22)]
                "
            >

                {{-- Top accent --}}

                <div
                    class="
                        absolute
                        inset-x-0
                        top-0
                        h-1
                        bg-gradient-to-r
                        from-blue-600
                        via-indigo-500
                        to-cyan-400
                    "
                ></div>


                <div class="p-6 sm:p-8">

                    {{-- ================================================= --}}
                    {{-- HEADER --}}
                    {{-- ================================================= --}}

                    <div class="mb-8">

                        <div class="flex items-start gap-4">

                            <div
                                class="
                                    flex
                                    h-14
                                    w-14
                                    shrink-0
                                    items-center
                                    justify-center
                                    rounded-2xl

                                    bg-blue-50
                                    text-blue-600

                                    shadow-sm

                                    dark:bg-blue-500/10
                                    dark:text-blue-400
                                "
                            >

                                <x-heroicon-o-document-text class="h-7 w-7"/>

                            </div>


                            <div class="min-w-0">

                                <h2
                                    class="
                                        text-xl
                                        font-extrabold
                                        tracking-tight
                                        text-slate-900
                                        sm:text-2xl

                                        dark:text-white
                                    "
                                >
                                    Election Details
                                </h2>

                                <p
                                    class="
                                        mt-1
                                        text-sm
                                        leading-6
                                        text-slate-500

                                        dark:text-slate-400
                                    "
                                >
                                    Configure the basic information for your election.
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- SELECTED TYPE --}}
                    {{-- ================================================= --}}

                    <div
                        class="
                            mb-8
                            rounded-2xl

                            border
                            border-blue-100

                            bg-gradient-to-r
                            from-blue-50
                            to-cyan-50

                            p-5

                            dark:border-blue-500/20
                            dark:from-blue-500/10
                            dark:to-cyan-500/5
                        "
                    >

                        <div class="flex items-center justify-between gap-4">

                            <div class="min-w-0">

                                <p
                                    class="
                                        text-[11px]
                                        font-bold
                                        uppercase
                                        tracking-[0.16em]
                                        text-slate-400

                                        dark:text-slate-500
                                    "
                                >
                                    Selected Election Type
                                </p>

                                <h3
                                    class="
                                        mt-2
                                        truncate
                                        text-lg
                                        font-extrabold
                                        text-slate-900

                                        dark:text-white
                                    "
                                >
                                    {{ $selectedType->name }}
                                </h3>

                                <p
                                    class="
                                        mt-1
                                        text-sm
                                        font-medium
                                        text-blue-600

                                        dark:text-blue-400
                                    "
                                >
                                    {{ $selectedType->category?->name ?? 'General' }}
                                </p>

                            </div>


                            <div
                                class="
                                    shrink-0
                                    rounded-xl

                                    border
                                    border-blue-100
                                    bg-white

                                    px-4
                                    py-2

                                    text-xs
                                    font-bold
                                    text-blue-700

                                    shadow-sm

                                    dark:border-blue-400/20
                                    dark:bg-blue-500/10
                                    dark:text-blue-300
                                "
                            >
                                Step 2
                            </div>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- ORGANIZATION --}}
                    {{-- ================================================= --}}

                    <div class="mb-6">

                        <label
                            for="organization"
                            class="
                                mb-2
                                block
                                text-sm
                                font-bold
                                text-slate-800

                                dark:text-slate-200
                            "
                        >
                            Organization
                        </label>


                        <div class="relative">

                            <select
                                id="organization"
                                name="organization_id"
                                x-model="organization"

                                class="
                                    w-full
                                    appearance-none
                                    rounded-2xl

                                    border
                                    border-slate-200

                                    bg-white

                                    px-5
                                    py-4
                                    pr-12

                                    text-sm
                                    font-medium
                                    text-slate-800

                                    shadow-sm

                                    outline-none
                                    transition

                                    hover:border-slate-300

                                    focus:border-blue-500
                                    focus:ring-4
                                    focus:ring-blue-500/10

                                    dark:border-white/10
                                    dark:bg-[#0B1730]
                                    dark:text-white

                                    dark:hover:border-white/20
                                    dark:focus:border-blue-500
                                "
                            >

                                <option
                                    value=""
                                    class="
                                        bg-white
                                        text-slate-800

                                        dark:bg-[#0B1730]
                                        dark:text-white
                                    "
                                >
                                    Select an organization
                                </option>

                                @foreach($organizations as $organization)

                                    <option
                                        value="{{ $organization->id }}"
                                        class="
                                            bg-white
                                            text-slate-800

                                            dark:bg-[#0B1730]
                                            dark:text-white
                                        "
                                    >
                                        {{ $organization->name }}
                                    </option>

                                @endforeach

                            </select>


                            <div
                                class="
                                    pointer-events-none
                                    absolute
                                    inset-y-0
                                    right-4
                                    flex
                                    items-center
                                    text-slate-400

                                    dark:text-slate-500
                                "
                            >

                                <x-heroicon-o-chevron-down class="h-5 w-5"/>

                            </div>

                        </div>


                        <p
                            class="
                                mt-2
                                text-xs
                                text-slate-400

                                dark:text-slate-500
                            "
                        >
                            Select the organization that owns this election.
                        </p>

                    </div>


                    {{-- ================================================= --}}
                    {{-- TITLE --}}
                    {{-- ================================================= --}}

                    <div class="mb-6">

                        <label
                            for="title"
                            class="
                                mb-2
                                block
                                text-sm
                                font-bold
                                text-slate-800

                                dark:text-slate-200
                            "
                        >
                            Election Title
                        </label>


                        <input
                            id="title"
                            type="text"
                            name="title"
                            x-model="electionTitle"
                            placeholder="e.g. 2026 Student Union Election"

                            class="
                                w-full
                                rounded-2xl

                                border
                                border-slate-200

                                bg-white

                                px-5
                                py-4

                                text-sm
                                font-medium
                                text-slate-800

                                placeholder:text-slate-400

                                shadow-sm

                                outline-none
                                transition

                                hover:border-slate-300

                                focus:border-blue-500
                                focus:ring-4
                                focus:ring-blue-500/10

                                dark:border-white/10
                                dark:bg-[#0B1730]
                                dark:text-white
                                dark:placeholder:text-slate-500

                                dark:hover:border-white/20
                            "
                        />

                    </div>


                    {{-- ================================================= --}}
                    {{-- DESCRIPTION --}}
                    {{-- ================================================= --}}

                    <div class="mb-6">

                        <label
                            for="description"
                            class="
                                mb-2
                                block
                                text-sm
                                font-bold
                                text-slate-800

                                dark:text-slate-200
                            "
                        >

                            Description

                            <span
                                class="
                                    font-normal
                                    text-slate-400

                                    dark:text-slate-500
                                "
                            >
                                (Optional)
                            </span>

                        </label>


                        <textarea
                            id="description"
                            name="description"
                            rows="5"
                            x-model="description"
                            placeholder="Briefly describe the purpose of this election..."

                            class="
                                w-full
                                resize-none
                                rounded-2xl

                                border
                                border-slate-200

                                bg-white

                                px-5
                                py-4

                                text-sm
                                leading-6
                                text-slate-800

                                placeholder:text-slate-400

                                shadow-sm

                                outline-none
                                transition

                                hover:border-slate-300

                                focus:border-blue-500
                                focus:ring-4
                                focus:ring-blue-500/10

                                dark:border-white/10
                                dark:bg-[#0B1730]
                                dark:text-white
                                dark:placeholder:text-slate-500

                                dark:hover:border-white/20
                            "
                        ></textarea>

                    </div>


                    {{-- ================================================= --}}
                    {{-- VISIBILITY --}}
                    {{-- ================================================= --}}

                    <div class="mb-8">

                        <label
                            class="
                                mb-3
                                block
                                text-sm
                                font-bold
                                text-slate-800

                                dark:text-slate-200
                            "
                        >
                            Election Visibility
                        </label>


                        <div class="grid gap-4 md:grid-cols-2">


                            {{-- PRIVATE --}}

                            <label class="cursor-pointer">

                                <input
                                    type="radio"
                                    name="visibility"
                                    value="Private"
                                    x-model="visibility"
                                    class="peer hidden"
                                >


                                <div
                                    class="
                                        rounded-2xl

                                        border
                                        border-slate-200

                                        bg-white

                                        p-5

                                        shadow-sm

                                        transition-all

                                        hover:-translate-y-0.5
                                        hover:border-slate-300
                                        hover:shadow-md

                                        peer-checked:border-blue-500
                                        peer-checked:bg-blue-50
                                        peer-checked:ring-4
                                        peer-checked:ring-blue-500/10

                                        dark:border-white/10
                                        dark:bg-[#0B1730]

                                        dark:hover:border-white/20

                                        dark:peer-checked:border-blue-500
                                        dark:peer-checked:bg-blue-500/10
                                    "
                                >

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="
                                                flex
                                                h-11
                                                w-11
                                                shrink-0
                                                items-center
                                                justify-center
                                                rounded-xl

                                                bg-blue-50
                                                text-blue-600

                                                dark:bg-blue-500/10
                                                dark:text-blue-400
                                            "
                                        >

                                            <x-heroicon-o-lock-closed class="h-5 w-5"/>

                                        </div>


                                        <div class="min-w-0">

                                            <p
                                                class="
                                                    font-bold
                                                    text-slate-900

                                                    dark:text-white
                                                "
                                            >
                                                Private
                                            </p>

                                            <p
                                                class="
                                                    mt-1
                                                    text-xs
                                                    leading-5
                                                    text-slate-500

                                                    dark:text-slate-500
                                                "
                                            >
                                                Only invited voters can access it.
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </label>


                            {{-- PUBLIC --}}

                            <label class="cursor-pointer">

                                <input
                                    type="radio"
                                    name="visibility"
                                    value="Public"
                                    x-model="visibility"
                                    class="peer hidden"
                                >


                                <div
                                    class="
                                        rounded-2xl

                                        border
                                        border-slate-200

                                        bg-white

                                        p-5

                                        shadow-sm

                                        transition-all

                                        hover:-translate-y-0.5
                                        hover:border-slate-300
                                        hover:shadow-md

                                        peer-checked:border-blue-500
                                        peer-checked:bg-blue-50
                                        peer-checked:ring-4
                                        peer-checked:ring-blue-500/10

                                        dark:border-white/10
                                        dark:bg-[#0B1730]

                                        dark:hover:border-white/20

                                        dark:peer-checked:border-blue-500
                                        dark:peer-checked:bg-blue-500/10
                                    "
                                >

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="
                                                flex
                                                h-11
                                                w-11
                                                shrink-0
                                                items-center
                                                justify-center
                                                rounded-xl

                                                bg-emerald-50
                                                text-emerald-600

                                                dark:bg-emerald-500/10
                                                dark:text-emerald-400
                                            "
                                        >

                                            <x-heroicon-o-globe-alt class="h-5 w-5"/>

                                        </div>


                                        <div class="min-w-0">

                                            <p
                                                class="
                                                    font-bold
                                                    text-slate-900

                                                    dark:text-white
                                                "
                                            >
                                                Public
                                            </p>

                                            <p
                                                class="
                                                    mt-1
                                                    text-xs
                                                    leading-5
                                                    text-slate-500

                                                    dark:text-slate-500
                                                "
                                            >
                                                Anyone with access can participate.
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </label>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- NAVIGATION --}}
                    {{-- ================================================= --}}

                    <div
                        class="
                            flex
                            flex-col
                            gap-3
                            border-t
                            border-slate-200
                            pt-6

                            sm:flex-row
                            sm:items-center
                            sm:justify-between

                            dark:border-white/10
                        "
                    >

                        <a href="{{ route('elections.create') }}">

                            <x-electo.button variant="secondary">

                                <span class="flex items-center gap-2">

                                    <x-heroicon-o-arrow-left class="h-5 w-5"/>

                                    Back

                                </span>

                            </x-electo.button>

                        </a>


                        <a
                            :href="
                                '{{ route('elections.schedule') }}' +
                                '?type={{ $selectedType->id }}' +
                                '&organization=' + organization +
                                '&title=' + encodeURIComponent(electionTitle) +
                                '&description=' + encodeURIComponent(description) +
                                '&visibility=' + visibility
                            "

                            class="
                                inline-flex
                                items-center
                                justify-center
                                gap-2

                                rounded-xl

                                bg-gradient-to-r
                                from-blue-600
                                to-cyan-500

                                px-6
                                py-3

                                text-sm
                                font-bold
                                text-white

                                shadow-lg
                                shadow-blue-500/20

                                transition-all

                                hover:-translate-y-0.5
                                hover:from-blue-700
                                hover:to-cyan-600
                                hover:shadow-xl
                            "
                        >

                            Next: Schedule

                            <x-heroicon-o-arrow-right class="h-5 w-5"/>

                        </a>

                    </div>

                </div>

            </div>

        </main>


        {{-- ================================================= --}}
        {{-- SUMMARY --}}
        {{-- ================================================= --}}

        <aside class="xl:col-span-3">

            <div
                class="
                    overflow-hidden
                    rounded-3xl

                    border
                    border-slate-200

                    bg-white

                    shadow-[0_12px_40px_rgba(15,23,42,0.06)]

                    dark:border-white/10
                    dark:bg-[#101D35]
                    dark:shadow-[0_18px_50px_rgba(0,0,0,0.22)]
                "
            >

                <x-electo.wizard-summary />

            </div>

        </aside>

    </div>

</div>

@endsection