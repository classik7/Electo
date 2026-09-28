@extends('electo.layouts.dashboard')

@section('title', 'Create Election')
@section('page-title', 'Create Election')

@section('content')

@php
    $selectedTypeId = $selectedType->id ?? '';
    $selectedCategoryId = $selectedType->category_id ?? '';
@endphp

<div
    x-data="{
        activeCategory: null,

        selectedType: '{{ $selectedTypeId }}',
        selectedCategory: '{{ $selectedCategoryId }}',

        selectCategory(categoryId) {
            this.activeCategory =
                this.activeCategory === categoryId
                    ? null
                    : categoryId;

            this.selectedCategory =
                this.activeCategory ?? '';
        },

        selectType(typeId) {
            this.selectedType = typeId;

            setTimeout(() => {
                window.location.href =
                    '{{ route('elections.details') }}?type=' + typeId;
            }, 250);
        }
    }"
    class="space-y-6"
>

    {{-- ========================================================= --}}
    {{-- PREMIUM PAGE HEADER --}}
    {{-- ========================================================= --}}

    <section
        class="
            relative overflow-hidden
            rounded-3xl
            border border-slate-200
            bg-white
            shadow-[0_10px_35px_rgba(15,23,42,0.06)]

            dark:border-white/10
            dark:bg-[#0B1730]
            dark:shadow-[0_10px_35px_rgba(0,0,0,0.28)]
        "
    >

        {{-- Accent --}}
        <div
            class="
                absolute inset-x-0 top-0 h-1
                bg-gradient-to-r
                from-blue-600
                via-indigo-500
                to-cyan-400
            "
        ></div>

        {{-- Decorative glow --}}
        <div
            class="
                pointer-events-none
                absolute -right-16 -top-20
                h-56 w-56
                rounded-full
                bg-blue-500/10
                blur-3xl

                dark:bg-blue-500/20
            "
        ></div>

        <div
            class="
                pointer-events-none
                absolute -bottom-20 left-1/3
                h-40 w-40
                rounded-full
                bg-cyan-400/10
                blur-3xl
            "
        ></div>

        <div
            class="
                relative
                flex flex-col
                gap-5
                px-6 py-6
                sm:px-7
                lg:flex-row
                lg:items-center
                lg:justify-between
            "
        >

            <div class="min-w-0">

                {{-- Eyebrow --}}
                <div
                    class="
                        mb-2.5
                        inline-flex items-center gap-2
                        rounded-full
                        border border-blue-100
                        bg-blue-50
                        px-3 py-1.5
                        text-[11px]
                        font-bold uppercase
                        tracking-[0.16em]
                        text-blue-700

                        dark:border-blue-400/20
                        dark:bg-blue-500/10
                        dark:text-blue-300
                    "
                >

                    <span
                        class="
                            h-1.5 w-1.5
                            rounded-full
                            bg-blue-600
                            dark:bg-cyan-400
                        "
                    ></span>

                    Election Setup

                </div>

                <h1
                    class="
                        text-3xl
                        font-extrabold
                        tracking-tight
                        text-slate-900
                        sm:text-4xl

                        dark:text-white
                    "
                >
                    Create Election
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
                    Set up a secure, transparent and verifiable
                    election in a few simple steps.
                </p>

            </div>

            {{-- Back --}}
            <a
                href="{{ route('elections.index') }}"
                class="
                    inline-flex
                    shrink-0
                    items-center
                    justify-center
                    gap-2
                    rounded-xl
                    border border-slate-200
                    bg-white
                    px-5 py-3
                    text-sm
                    font-semibold
                    text-slate-700
                    shadow-sm
                    transition-all duration-200

                    hover:-translate-y-0.5
                    hover:border-blue-200
                    hover:bg-blue-50
                    hover:text-blue-700
                    hover:shadow-md

                    dark:border-white/10
                    dark:bg-white/5
                    dark:text-slate-200
                    dark:hover:border-blue-400/30
                    dark:hover:bg-blue-500/10
                    dark:hover:text-blue-300
                "
            >

                <x-heroicon-o-arrow-left class="h-4 w-4"/>

                Back to Elections

            </a>

        </div>

    </section>


    {{-- ========================================================= --}}
    {{-- WIZARD PROGRESS --}}
    {{-- ========================================================= --}}

    <section
        class="
            rounded-3xl
            border border-slate-200
            bg-white
            px-5 py-5
            shadow-[0_8px_30px_rgba(15,23,42,0.05)]
            sm:px-7

            dark:border-white/10
            dark:bg-[#0B1730]
            dark:shadow-[0_8px_30px_rgba(0,0,0,0.25)]
        "
    >

        <x-electo.wizard-progress :step="1"/>

    </section>


    {{-- ========================================================= --}}
    {{-- MAIN WIZARD --}}
    {{-- ========================================================= --}}

    <div
        class="
            grid
            grid-cols-1
            gap-5
            xl:grid-cols-[190px_minmax(0,1fr)_230px]
            xl:items-start
        "
    >

        {{-- ===================================================== --}}
        {{-- LEFT SIDEBAR --}}
        {{-- ===================================================== --}}

        <aside class="min-w-0">

            <div
                class="
                    sticky top-5
                    overflow-hidden
                    rounded-3xl
                    border border-slate-200
                    bg-white
                    p-3.5
                    shadow-[0_8px_30px_rgba(15,23,42,0.05)]

                    dark:border-white/10
                    dark:bg-[#0B1730]
                    dark:shadow-[0_8px_30px_rgba(0,0,0,0.25)]
                "
            >

                <div class="mb-3 px-2">

                    <p
                        class="
                            text-[10px]
                            font-bold
                            uppercase
                            tracking-[0.18em]
                            text-slate-400

                            dark:text-slate-500
                        "
                    >
                        Categories
                    </p>

                    <p
                        class="
                            mt-1
                            text-[11px]
                            leading-4
                            text-slate-500

                            dark:text-slate-400
                        "
                    >
                        Choose a category to narrow your options.
                    </p>

                </div>

                <x-electo.wizard-sidebar/>

            </div>

        </aside>


        {{-- ===================================================== --}}
        {{-- CENTER CONTENT --}}
        {{-- ===================================================== --}}

        <main class="min-w-0">

            <div
                class="
                    overflow-hidden
                    rounded-3xl
                    border border-slate-200
                    bg-white
                    shadow-[0_12px_45px_rgba(15,23,42,0.07)]

                    dark:border-white/10
                    dark:bg-[#0B1730]
                    dark:shadow-[0_12px_45px_rgba(0,0,0,0.30)]
                "
            >

                {{-- ================================================= --}}
                {{-- HEADER --}}
                {{-- ================================================= --}}

                <div
                    class="
                        relative
                        overflow-hidden
                        border-b border-slate-100
                        px-6 py-6
                        sm:px-7

                        dark:border-white/10
                    "
                >

                    <div
                        class="
                            pointer-events-none
                            absolute
                            -right-10
                            -top-10
                            h-28
                            w-28
                            rounded-full
                            bg-blue-500/10
                            blur-2xl

                            dark:bg-blue-500/20
                        "
                    ></div>

                    <div
                        class="
                            relative
                            flex
                            items-start
                            gap-4
                        "
                    >

                        <div
                            class="
                                flex
                                h-11 w-11
                                shrink-0
                                items-center
                                justify-center
                                rounded-2xl
                                bg-gradient-to-br
                                from-blue-600
                                to-cyan-500
                                text-white
                                shadow-lg
                                shadow-blue-500/20
                            "
                        >

                            <x-heroicon-o-clipboard-document-check
                                class="h-5 w-5"
                            />

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
                                Choose Election Type
                            </h2>

                            <p
                                class="
                                    mt-1
                                    max-w-2xl
                                    text-sm
                                    leading-6
                                    text-slate-500

                                    dark:text-slate-400
                                "
                            >
                                Select the type of election you want to
                                create. You can configure the details
                                in the next steps.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- SEARCH --}}
                {{-- ================================================= --}}

                <div
                    class="
                        border-b
                        border-slate-100
                        bg-slate-50/70
                        px-6 py-4
                        sm:px-7

                        dark:border-white/10
                        dark:bg-[#081225]
                    "
                >

                    <div class="relative">

                        <x-heroicon-o-magnifying-glass
                            class="
                                pointer-events-none
                                absolute
                                left-4
                                top-1/2
                                h-5 w-5
                                -translate-y-1/2
                                text-slate-400

                                dark:text-slate-500
                            "
                        />

                        <input
                            type="text"
                            placeholder="Search election types..."
                            class="
                                w-full
                                rounded-2xl
                                border border-slate-200
                                bg-white
                                py-3.5
                                pl-12 pr-4
                                text-sm
                                text-slate-800
                                placeholder:text-slate-400
                                shadow-sm
                                outline-none
                                transition

                                focus:border-blue-400
                                focus:ring-4
                                focus:ring-blue-500/10

                                dark:border-white/10
                                dark:bg-[#0F1D35]
                                dark:text-white
                                dark:placeholder:text-slate-500
                                dark:focus:border-blue-500
                                dark:focus:ring-blue-500/10
                            "
                        >

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- CONTENT --}}
                {{-- ================================================= --}}

                <div
                    class="
                        px-6 py-6
                        sm:px-7
                    "
                >

                    {{-- ================================================= --}}
                    {{-- POPULAR --}}
                    {{-- ================================================= --}}

                    <div
                        x-show="activeCategory === null"
                        x-cloak
                        x-transition
                    >

                        <div
                            class="
                                mb-5
                                flex
                                flex-col
                                gap-2
                                sm:flex-row
                                sm:items-end
                                sm:justify-between
                            "
                        >

                            <div>

                                <div
                                    class="
                                        mb-1.5
                                        flex
                                        items-center
                                        gap-2
                                    "
                                >

                                    <span
                                        class="
                                            flex
                                            h-7 w-7
                                            items-center
                                            justify-center
                                            rounded-lg
                                            bg-amber-50
                                            text-amber-500

                                            dark:bg-amber-500/10
                                            dark:text-amber-400
                                        "
                                    >
                                        ★
                                    </span>

                                    <h3
                                        class="
                                            text-lg
                                            font-bold
                                            text-slate-900

                                            dark:text-white
                                        "
                                    >
                                        Popular Election Types
                                    </h3>

                                </div>

                                <p
                                    class="
                                        text-sm
                                        text-slate-500

                                        dark:text-slate-400
                                    "
                                >
                                    Frequently used election formats.
                                </p>

                            </div>

                            <span
                                class="
                                    text-xs
                                    font-medium
                                    text-slate-400
                                "
                            >
                                Recommended
                            </span>

                        </div>


                        @php

                            $popular = $electionTypes
                                ->flatten()
                                ->filter(fn($type) => in_array(
                                    $type->name,
                                    [
                                        'Secondary School',
                                        'University',
                                        'Association',
                                        'Political',
                                    ]
                                ));

                        @endphp


                        @if($popular->count())

                            <div
                                class="
                                    grid
                                    grid-cols-1
                                    gap-4
                                    md:grid-cols-2
                                "
                            >

                                @foreach($popular as $type)

                                    <div
                                        x-show="activeCategory === null"
                                        x-transition
                                    >

                                        <x-electo.election-type-card
                                            :type="$type"
                                        />

                                    </div>

                                @endforeach

                            </div>

                        @endif

                    </div>


                    {{-- ================================================= --}}
                    {{-- ALL ELECTION TYPES --}}
                    {{-- ================================================= --}}

                    <div class="mt-9">

                        <div
                            class="
                                mb-5
                                flex
                                flex-col
                                gap-3
                                sm:flex-row
                                sm:items-center
                                sm:justify-between
                            "
                        >

                            <div>

                                <h3
                                    class="
                                        text-lg
                                        font-extrabold
                                        text-slate-900

                                        dark:text-white
                                    "
                                    x-show="activeCategory === null"
                                    x-cloak
                                >
                                    Browse All Election Types
                                </h3>

                                <h3
                                    class="
                                        text-lg
                                        font-extrabold
                                        text-slate-900

                                        dark:text-white
                                    "
                                    x-show="activeCategory !== null"
                                    x-cloak
                                >
                                    Selected Election Category
                                </h3>

                                <p
                                    class="
                                        mt-1
                                        text-sm
                                        text-slate-500

                                        dark:text-slate-400
                                    "
                                >
                                    Choose the format that best fits
                                    your organization.
                                </p>

                            </div>


                            {{-- Show All --}}

                            <button
                                type="button"
                                x-show="activeCategory !== null"
                                x-cloak
                                @click="
                                    activeCategory = null;
                                    selectedCategory = '';
                                "
                                class="
                                    inline-flex
                                    items-center
                                    justify-center
                                    gap-2
                                    rounded-xl
                                    border border-blue-100
                                    bg-blue-50
                                    px-4 py-2.5
                                    text-sm
                                    font-semibold
                                    text-blue-700
                                    transition

                                    hover:bg-blue-100

                                    dark:border-blue-400/20
                                    dark:bg-blue-500/10
                                    dark:text-blue-300
                                    dark:hover:bg-blue-500/20
                                "
                            >

                                <x-heroicon-o-squares-2x2
                                    class="h-4 w-4"
                                />

                                Show All

                            </button>

                        </div>


                        {{-- ================================================= --}}
                        {{-- CATEGORY GROUPS --}}
                        {{-- ================================================= --}}

                        @foreach($electionTypes as $categoryId => $types)

                            @php
                                $category = $types->first()->category;
                            @endphp

                            <div
                                x-show="
                                    activeCategory === null ||
                                    activeCategory === {{ $categoryId }}
                                "
                                x-cloak
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                class="mb-9"
                            >

                                {{-- Category header --}}

                                <div
                                    class="
                                        mb-4
                                        flex
                                        items-center
                                        justify-between
                                    "
                                >

                                    <div
                                        class="
                                            flex
                                            items-center
                                            gap-3
                                        "
                                    >

                                        <div
                                            class="
                                                flex
                                                h-9 w-9
                                                items-center
                                                justify-center
                                                rounded-xl
                                                bg-blue-50
                                                text-blue-600

                                                dark:bg-blue-500/10
                                                dark:text-blue-400
                                            "
                                        >

                                            <x-heroicon-o-squares-2x2
                                                class="h-5 w-5"
                                            />

                                        </div>

                                        <div>

                                            <h4
                                                class="
                                                    font-bold
                                                    text-slate-900

                                                    dark:text-white
                                                "
                                            >
                                                {{ $category->name }}
                                            </h4>

                                            <p
                                                class="
                                                    text-xs
                                                    text-slate-500

                                                    dark:text-slate-400
                                                "
                                            >
                                                Available election formats
                                            </p>

                                        </div>

                                    </div>

                                    <span
                                        class="
                                            rounded-full
                                            bg-slate-100
                                            px-3 py-1
                                            text-xs
                                            font-semibold
                                            text-slate-500

                                            dark:bg-white/5
                                            dark:text-slate-400
                                        "
                                    >
                                        {{ $types->count() }}
                                        {{ Str::plural('Type', $types->count()) }}
                                    </span>

                                </div>


                                {{-- Cards --}}

                                <div
                                    class="
                                        grid
                                        grid-cols-1
                                        gap-4
                                        md:grid-cols-2
                                    "
                                >

                                    @foreach($types as $type)

                                        <div
                                            x-show="
                                                activeCategory === null ||
                                                activeCategory === {{ $categoryId }}
                                            "
                                            x-transition
                                        >

                                            <x-electo.election-type-card
                                                :type="$type"
                                            />

                                        </div>

                                    @endforeach

                                </div>

                            </div>

                        @endforeach


                        {{-- ================================================= --}}
                        {{-- EMPTY STATE --}}
                        {{-- ================================================= --}}

                        <div
                            x-show="activeCategory !== null"
                            x-cloak
                            class="
                                mt-6
                                rounded-2xl
                                border border-dashed
                                border-slate-200
                                bg-slate-50
                                px-6 py-10
                                text-center

                                dark:border-white/10
                                dark:bg-white/[0.02]
                            "
                        >

                            <div
                                class="
                                    mx-auto
                                    mb-4
                                    flex
                                    h-12 w-12
                                    items-center
                                    justify-center
                                    rounded-2xl
                                    bg-blue-50
                                    text-blue-600

                                    dark:bg-blue-500/10
                                    dark:text-blue-400
                                "
                            >

                                <x-heroicon-o-squares-2x2
                                    class="h-6 w-6"
                                />

                            </div>

                            <p
                                class="
                                    text-sm
                                    font-semibold
                                    text-slate-700

                                    dark:text-slate-200
                                "
                            >
                                Choose an election type above
                            </p>

                            <p
                                class="
                                    mt-1
                                    text-xs
                                    text-slate-500

                                    dark:text-slate-400
                                "
                            >
                                Select a card to continue to the next step.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </main>


        {{-- ===================================================== --}}
        {{-- RIGHT SUMMARY --}}
        {{-- ===================================================== --}}

        <aside class="min-w-0">

            <div class="sticky top-5">

                <x-electo.wizard-summary/>

            </div>

        </aside>

    </div>

</div>

@endsection