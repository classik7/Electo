@props(['type'])

@php
    $icons = [
        'Education' => 'academic-cap',
        'Organization' => 'users',
        'Government' => 'building-library',
        'Community' => 'user-group',
        'Religious' => 'building-library',
        'Professional' => 'briefcase',
    ];

    $icon = $icons[$type->category->name ?? ''] ?? 'clipboard-document-check';

    $iconComponents = [
        'academic-cap' => 'heroicon-o-academic-cap',
        'users' => 'heroicon-o-users',
        'building-library' => 'heroicon-o-building-library',
        'user-group' => 'heroicon-o-user-group',
        'briefcase' => 'heroicon-o-briefcase',
        'clipboard-document-check' => 'heroicon-o-clipboard-document-check',
    ];

    $iconComponent = $iconComponents[$icon] ?? 'heroicon-o-clipboard-document-check';
@endphp


<div
    @click="selectType({{ $type->id }})"

    class="
        group
        relative
        flex
        min-h-[280px]
        cursor-pointer
        flex-col
        overflow-hidden

        rounded-[22px]

        border
        border-slate-200

        bg-white

        shadow-[0_6px_24px_rgba(15,23,42,0.05)]

        transition-all
        duration-300
        ease-out

        hover:-translate-y-1
        hover:border-blue-200
        hover:shadow-[0_18px_45px_rgba(37,99,235,0.12)]

        focus:outline-none
        focus:ring-4
        focus:ring-blue-500/10

        dark:border-white/10
        dark:bg-[#101D35]
        dark:shadow-[0_8px_28px_rgba(0,0,0,0.18)]

        dark:hover:border-blue-500/35
        dark:hover:bg-[#122442]
        dark:hover:shadow-[0_20px_50px_rgba(37,99,235,0.16)]
    "
>


    {{-- ========================================================= --}}
    {{-- TOP ACCENT --}}
    {{-- ========================================================= --}}

    <div
        class="
            absolute
            inset-x-0
            top-0
            h-[3px]

            bg-gradient-to-r
            from-blue-600
            via-indigo-500
            to-cyan-400

            opacity-0

            transition-opacity
            duration-300

            group-hover:opacity-100
        "
    ></div>


    {{-- ========================================================= --}}
    {{-- DECORATIVE GLOW --}}
    {{-- ========================================================= --}}

    <div
        class="
            pointer-events-none
            absolute
            -right-12
            -top-12
            h-32
            w-32

            rounded-full

            bg-blue-500/10

            blur-3xl

            opacity-0

            transition-opacity
            duration-300

            group-hover:opacity-100

            dark:bg-blue-500/20
        "
    ></div>


    {{-- ========================================================= --}}
    {{-- CARD BODY --}}
    {{-- ========================================================= --}}

    <div class="relative flex flex-1 flex-col p-5">


        {{-- ===================================================== --}}
        {{-- HEADER --}}
        {{-- ===================================================== --}}

        <div
            class="
                flex
                items-start
                justify-between
                gap-4
            "
        >

            {{-- ICON --}}

            <div
                class="
                    flex
                    h-11
                    w-11
                    shrink-0
                    items-center
                    justify-center

                    rounded-[14px]

                    bg-blue-50
                    text-blue-600

                    ring-1
                    ring-inset
                    ring-blue-100

                    transition-all
                    duration-300

                    group-hover:bg-blue-600
                    group-hover:text-white
                    group-hover:ring-blue-600
                    group-hover:shadow-lg
                    group-hover:shadow-blue-500/20

                    dark:bg-blue-500/10
                    dark:text-blue-400
                    dark:ring-blue-400/10

                    dark:group-hover:bg-blue-600
                    dark:group-hover:text-white
                    dark:group-hover:ring-blue-500/30
                "
            >

                @if($iconComponent === 'heroicon-o-academic-cap')

                    <x-heroicon-o-academic-cap class="h-5 w-5"/>

                @elseif($iconComponent === 'heroicon-o-users')

                    <x-heroicon-o-users class="h-5 w-5"/>

                @elseif($iconComponent === 'heroicon-o-building-library')

                    <x-heroicon-o-building-library class="h-5 w-5"/>

                @elseif($iconComponent === 'heroicon-o-user-group')

                    <x-heroicon-o-user-group class="h-5 w-5"/>

                @elseif($iconComponent === 'heroicon-o-briefcase')

                    <x-heroicon-o-briefcase class="h-5 w-5"/>

                @else

                    <x-heroicon-o-clipboard-document-check class="h-5 w-5"/>

                @endif

            </div>


            {{-- NEW BADGE --}}

            @if(in_array($type->name, ['Association', 'Political']))

                <span
                    class="
                        inline-flex
                        shrink-0
                        items-center
                        rounded-full

                        border
                        border-blue-100

                        bg-blue-50

                        px-2.5
                        py-1

                        text-[10px]
                        font-bold
                        uppercase
                        tracking-wide

                        text-blue-700

                        dark:border-blue-400/20
                        dark:bg-blue-500/10
                        dark:text-blue-300
                    "
                >
                    New
                </span>

            @endif

        </div>


        {{-- ===================================================== --}}
        {{-- TITLE + CATEGORY --}}
        {{-- ===================================================== --}}

        <div class="mt-5">

            <h3
                class="
                    text-[17px]
                    font-extrabold
                    leading-6
                    tracking-tight

                    text-slate-900

                    transition-colors
                    duration-200

                    group-hover:text-blue-700

                    dark:text-white
                    dark:group-hover:text-blue-300
                "
            >
                {{ $type->name }}
            </h3>


            <div class="mt-2">

                <span
                    class="
                        inline-flex
                        items-center

                        rounded-full

                        bg-slate-100

                        px-2.5
                        py-1

                        text-[10px]
                        font-semibold
                        tracking-wide

                        text-slate-600

                        dark:bg-white/[0.06]
                        dark:text-slate-300
                    "
                >
                    {{ $type->category->name ?? 'General' }}
                </span>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- DESCRIPTION --}}
        {{-- ===================================================== --}}

        <p
            class="
                mt-4

                line-clamp-2

                min-h-[44px]

                text-[13px]
                leading-[1.7]

                text-slate-500

                dark:text-slate-400
            "
        >
            {{ $type->description ?: 'Create and manage this type of election securely.' }}
        </p>


        {{-- ===================================================== --}}
        {{-- SPACER --}}
        {{-- ===================================================== --}}

        <div class="flex-1"></div>


        {{-- ===================================================== --}}
        {{-- FOOTER --}}
        {{-- ===================================================== --}}

        <div
            class="
                mt-5
                flex
                items-center
                justify-between
                gap-3

                border-t
                border-slate-100

                pt-4

                dark:border-white/10
            "
        >

            {{-- Election count --}}

            <div
                class="
                    flex
                    min-w-0
                    items-center
                    gap-2

                    text-[11px]
                    font-medium

                    text-slate-400

                    dark:text-slate-500
                "
            >

                <span
                    class="
                        flex
                        h-7
                        w-7
                        shrink-0
                        items-center
                        justify-center

                        rounded-lg

                        bg-slate-50
                        text-slate-400

                        dark:bg-white/[0.05]
                        dark:text-slate-500
                    "
                >

                    <x-heroicon-o-chart-bar
                        class="h-3.5 w-3.5"
                    />

                </span>

                <span class="truncate">
                    {{ number_format($type->elections_count ?? 0) }}
                    elections
                </span>

            </div>


            {{-- SELECT ACTION --}}

            <div
                class="
                    inline-flex
                    shrink-0
                    items-center
                    gap-1.5

                    rounded-xl

                    bg-blue-50

                    px-3
                    py-2

                    text-xs
                    font-bold

                    text-blue-600

                    transition-all
                    duration-200

                    group-hover:bg-blue-600
                    group-hover:text-white
                    group-hover:shadow-md
                    group-hover:shadow-blue-500/20

                    dark:bg-blue-500/10
                    dark:text-blue-400

                    dark:group-hover:bg-blue-600
                    dark:group-hover:text-white
                "
            >

                Select

                <x-heroicon-o-arrow-right
                    class="
                        h-3.5
                        w-3.5

                        transition-transform
                        duration-200

                        group-hover:translate-x-0.5
                    "
                />

            </div>

        </div>

    </div>

</div>