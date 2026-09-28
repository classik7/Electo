@extends('electo.layouts.dashboard')

@section('title', 'Election Schedule')
@section('page-title', 'Election Schedule')

@section('content')

<div
    x-data="{
        progress: 75,

        startDate: '',
        startTime: '',

        endDate: '',
        endTime: '',

        get duration() {

            if (!this.startDate || !this.startTime || !this.endDate || !this.endTime) {
                return 'Not calculated';
            }

            const start = new Date(`${this.startDate}T${this.startTime}`);
            const end = new Date(`${this.endDate}T${this.endTime}`);

            const difference = end - start;

            if (difference <= 0) {
                return 'Invalid schedule';
            }

            const hours = Math.floor(
                difference / (1000 * 60 * 60)
            );

            const days = Math.floor(hours / 24);

            const remainingHours = hours % 24;

            if (days > 0) {
                return `${days} day${days > 1 ? 's' : ''} ${remainingHours} hour${remainingHours !== 1 ? 's' : ''}`;
            }

            return `${hours} hour${hours !== 1 ? 's' : ''}`;
        }
    }"
    class="w-full"
>

    {{-- ================================================= --}}
    {{-- HEADER --}}
    {{-- ================================================= --}}

    <div
        class="
            mb-8
            flex
            flex-col
            gap-5

            sm:flex-row
            sm:items-center
            sm:justify-between
        "
    >

        <div>

            <div
                class="
                    mb-3
                    inline-flex
                    items-center
                    gap-2

                    rounded-full

                    border
                    border-blue-100
                    bg-blue-50

                    px-3
                    py-1.5

                    text-[11px]
                    font-bold
                    uppercase
                    tracking-[0.18em]
                    text-blue-700

                    dark:border-blue-400/20
                    dark:bg-blue-500/10
                    dark:text-blue-300
                "
            >

                <span
                    class="
                        h-1.5
                        w-1.5
                        rounded-full
                        bg-blue-600
                    "
                ></span>

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
                Election Schedule
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
                Set when your election will begin and end.
            </p>

        </div>


        <a
            href="{{ route('elections.create', ['type' => $selectedType->id]) }}"
        >

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

        <x-electo.wizard-progress :step="3" />

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

                                <x-heroicon-o-calendar-days class="h-7 w-7"/>

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
                                    Election Schedule
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
                                    Choose when voting will open and close.
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- SELECTED ELECTION --}}
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

                        <div
                            class="
                                flex
                                items-center
                                justify-between
                                gap-4
                            "
                        >

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
                                    Election
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
                                    {{ $electionTitle ?: 'Untitled Election' }}
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
                                    {{ $selectedType->name }}
                                </p>


                                <p
                                    class="
                                        mt-1
                                        text-xs
                                        text-slate-500

                                        dark:text-slate-500
                                    "
                                >
                                    {{ $organization->name }}
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
                                Step 3
                            </div>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- START DATE --}}
                    {{-- ================================================= --}}

                    <div class="mb-6">

                        <label
                            for="start_date"
                            class="
                                mb-3
                                block
                                text-sm
                                font-bold
                                text-slate-800

                                dark:text-slate-200
                            "
                        >
                            Election Start
                        </label>


                        <div class="grid gap-4 md:grid-cols-2">

                            {{-- Start Date --}}

                            <div>

                                <label
                                    for="start_date"
                                    class="
                                        mb-2
                                        block
                                        text-xs
                                        font-semibold
                                        text-slate-500

                                        dark:text-slate-500
                                    "
                                >
                                    Start Date
                                </label>


                                <input
                                    id="start_date"
                                    type="date"
                                    x-model="startDate"

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
                                    "
                                >

                            </div>


                            {{-- Start Time --}}

                            <div>

                                <label
                                    for="start_time"
                                    class="
                                        mb-2
                                        block
                                        text-xs
                                        font-semibold
                                        text-slate-500

                                        dark:text-slate-500
                                    "
                                >
                                    Start Time
                                </label>


                                <input
                                    id="start_time"
                                    type="time"
                                    x-model="startTime"

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
                                    "
                                >

                            </div>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- END DATE --}}
                    {{-- ================================================= --}}

                    <div class="mb-8">

                        <label
                            for="end_date"
                            class="
                                mb-3
                                block
                                text-sm
                                font-bold
                                text-slate-800

                                dark:text-slate-200
                            "
                        >
                            Election End
                        </label>


                        <div class="grid gap-4 md:grid-cols-2">

                            {{-- End Date --}}

                            <div>

                                <label
                                    for="end_date"
                                    class="
                                        mb-2
                                        block
                                        text-xs
                                        font-semibold
                                        text-slate-500

                                        dark:text-slate-500
                                    "
                                >
                                    End Date
                                </label>


                                <input
                                    id="end_date"
                                    type="date"
                                    x-model="endDate"

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
                                    "
                                >

                            </div>


                            {{-- End Time --}}

                            <div>

                                <label
                                    for="end_time"
                                    class="
                                        mb-2
                                        block
                                        text-xs
                                        font-semibold
                                        text-slate-500

                                        dark:text-slate-500
                                    "
                                >
                                    End Time
                                </label>


                                <input
                                    id="end_time"
                                    type="time"
                                    x-model="endTime"

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
                                    "
                                >

                            </div>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- DURATION PREVIEW --}}
                    {{-- ================================================= --}}

                    <div
                        class="
                            mb-8
                            rounded-2xl

                            border
                            border-emerald-100

                            bg-gradient-to-r
                            from-emerald-50
                            to-teal-50

                            p-5

                            dark:border-emerald-500/20
                            dark:from-emerald-500/10
                            dark:to-teal-500/5
                        "
                    >

                        <div class="flex items-center gap-4">

                            <div
                                class="
                                    flex
                                    h-11
                                    w-11
                                    shrink-0
                                    items-center
                                    justify-center

                                    rounded-xl

                                    bg-emerald-100
                                    text-emerald-600

                                    dark:bg-emerald-500/10
                                    dark:text-emerald-400
                                "
                            >

                                <x-heroicon-o-clock class="h-6 w-6"/>

                            </div>


                            <div>

                                <p
                                    class="
                                        text-[11px]
                                        font-bold
                                        uppercase
                                        tracking-[0.16em]
                                        text-slate-500

                                        dark:text-slate-500
                                    "
                                >
                                    Election Duration
                                </p>


                                <p
                                    class="
                                        mt-1
                                        font-bold
                                        text-emerald-600

                                        dark:text-emerald-400
                                    "
                                    x-text="duration"
                                >
                                    Not calculated
                                </p>

                            </div>

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

                        <a
                            href="{{ route('elections.details', [
                                'type' => $selectedType->id,
                                'organization' => request('organization'),
                                'title' => request('title'),
                                'description' => request('description'),
                                'visibility' => request('visibility'),
                            ]) }}"
                        >

                            <x-electo.button variant="secondary">

                                <span class="flex items-center gap-2">

                                    <x-heroicon-o-arrow-left class="h-5 w-5"/>

                                    Back

                                </span>

                            </x-electo.button>

                        </a>


                        <a
                            :href="
                                '{{ route('elections.positions') }}' +
                                '?type={{ $selectedType->id }}' +
                                '&organization={{ $organization->id }}' +
                                '&title=' + encodeURIComponent('{{ $electionTitle }}') +
                                '&description=' + encodeURIComponent('{{ $description }}') +
                                '&visibility=' + encodeURIComponent('{{ $visibility }}') +
                                '&start_date=' + encodeURIComponent(startDate) +
                                '&start_time=' + encodeURIComponent(startTime) +
                                '&end_date=' + encodeURIComponent(endDate) +
                                '&end_time=' + encodeURIComponent(endTime)
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

                            Next: Positions

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