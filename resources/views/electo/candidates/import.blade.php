@extends('electo.layouts.dashboard')

@section('title', 'Bulk Candidate Import')
@section('page-title', 'Bulk Candidate Import')

@section('content')

<div
    class="mx-auto w-full max-w-7xl space-y-8"
>

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <div
        class="
            flex
            flex-col
            gap-6
            lg:flex-row
            lg:items-center
            lg:justify-between
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
                    border-blue-200
                    bg-blue-50
                    px-3
                    py-1.5
                    text-xs
                    font-bold
                    uppercase
                    tracking-wider
                    text-blue-700
                    dark:border-blue-500/20
                    dark:bg-blue-500/10
                    dark:text-blue-400
                "
            >

                <x-heroicon-o-arrow-up-tray
                    class="h-4 w-4"
                />

                Candidate Management

            </div>


            <h1
                class="
                    text-3xl
                    font-black
                    tracking-tight
                    text-slate-900
                    dark:text-white
                    sm:text-4xl
                "
            >
                Bulk Candidate Import
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
                Import multiple candidates into an election using
                an Excel or CSV spreadsheet.
            </p>

        </div>


        {{-- BACK --}}

        <a
            href="{{ url()->previous() }}"
            class="
                inline-flex
                items-center
                justify-center
                gap-2
                rounded-xl
                border
                border-slate-200
                bg-white
                px-5
                py-3
                text-sm
                font-bold
                text-slate-700
                shadow-sm
                transition
                hover:-translate-y-0.5
                hover:border-blue-200
                hover:bg-blue-50
                hover:text-blue-700
                dark:border-white/10
                dark:bg-white/5
                dark:text-slate-300
                dark:hover:bg-white/10
            "
        >

            <x-heroicon-o-arrow-left
                class="h-5 w-5"
            />

            Back

        </a>

    </div>



    {{-- ========================================================= --}}
    {{-- SUCCESS / ERROR --}}
    {{-- ========================================================= --}}

    @if(session('success'))

        <div
            class="
                rounded-2xl
                border
                border-emerald-200
                bg-emerald-50
                p-5
                text-emerald-800
                dark:border-emerald-500/20
                dark:bg-emerald-500/10
                dark:text-emerald-300
            "
        >

            <div class="flex items-start gap-3">

                <x-heroicon-o-check-circle
                    class="mt-0.5 h-6 w-6 shrink-0"
                />

                <div>

                    <p class="font-bold">
                        Import completed
                    </p>

                    <p class="mt-1 text-sm">
                        {{ session('success') }}
                    </p>

                </div>

            </div>

        </div>

    @endif


    @if(session('error'))

        <div
            class="
                rounded-2xl
                border
                border-red-200
                bg-red-50
                p-5
                text-red-800
                dark:border-red-500/20
                dark:bg-red-500/10
                dark:text-red-300
            "
        >

            <div class="flex items-start gap-3">

                <x-heroicon-o-exclamation-triangle
                    class="mt-0.5 h-6 w-6 shrink-0"
                />

                <div>

                    <p class="font-bold">
                        Import failed
                    </p>

                    <p class="mt-1 text-sm">
                        {{ session('error') }}
                    </p>

                </div>

            </div>

        </div>

    @endif



    {{-- ========================================================= --}}
    {{-- IMPORT RESULT --}}
    {{-- ========================================================= --}}

    @if(session('import_results'))

        @php
            $import = session('import_results');
            $results = $import['results'];
        @endphp


        <div
            class="
                overflow-hidden
                rounded-[2rem]
                border
                border-slate-200
                bg-white
                shadow-sm
                dark:border-white/10
                dark:bg-[#0d1a30]
            "
        >

            <div
                class="
                    border-b
                    border-slate-200
                    px-6
                    py-5
                    dark:border-white/10
                "
            >

                <div
                    class="
                        flex
                        flex-col
                        gap-3
                        sm:flex-row
                        sm:items-center
                        sm:justify-between
                    "
                >

                    <div>

                        <p
                            class="
                                text-xs
                                font-bold
                                uppercase
                                tracking-wider
                                text-slate-400
                            "
                        >
                            Import Report
                        </p>

                        <h2
                            class="
                                mt-1
                                text-xl
                                font-black
                                text-slate-900
                                dark:text-white
                            "
                        >
                            {{ $import['election']->title }}
                        </h2>

                    </div>

                    <span
                        class="
                            inline-flex
                            w-fit
                            items-center
                            gap-2
                            rounded-full
                            bg-emerald-50
                            px-3
                            py-1.5
                            text-xs
                            font-bold
                            text-emerald-700
                            dark:bg-emerald-500/10
                            dark:text-emerald-400
                        "
                    >

                        <x-heroicon-o-check-circle
                            class="h-4 w-4"
                        />

                        Import Complete

                    </span>

                </div>

            </div>


            {{-- STATS --}}

            <div
                class="
                    grid
                    grid-cols-2
                    divide-x
                    divide-y
                    divide-slate-100
                    sm:grid-cols-4
                    sm:divide-y-0
                    dark:divide-white/10
                "
            >

                <div class="p-6">

                    <p class="text-xs font-semibold text-slate-400">
                        Total Rows
                    </p>

                    <p
                        class="
                            mt-2
                            text-3xl
                            font-black
                            text-slate-900
                            dark:text-white
                        "
                    >
                        {{ $results['total'] }}
                    </p>

                </div>


                <div class="p-6">

                    <p class="text-xs font-semibold text-slate-400">
                        Imported
                    </p>

                    <p
                        class="
                            mt-2
                            text-3xl
                            font-black
                            text-emerald-600
                            dark:text-emerald-400
                        "
                    >
                        {{ $results['success'] }}
                    </p>

                </div>


                <div class="p-6">

                    <p class="text-xs font-semibold text-slate-400">
                        Failed
                    </p>

                    <p
                        class="
                            mt-2
                            text-3xl
                            font-black
                            text-red-600
                            dark:text-red-400
                        "
                    >
                        {{ $results['failed'] }}
                    </p>

                </div>


                <div class="p-6">

                    <p class="text-xs font-semibold text-slate-400">
                        Duplicates
                    </p>

                    <p
                        class="
                            mt-2
                            text-3xl
                            font-black
                            text-amber-600
                            dark:text-amber-400
                        "
                    >
                        {{ $results['duplicates'] }}
                    </p>

                </div>

            </div>


            {{-- ERRORS --}}

            @if(count($results['errors']))

                <div
                    class="
                        border-t
                        border-slate-200
                        p-6
                        dark:border-white/10
                    "
                >

                    <h3
                        class="
                            text-sm
                            font-black
                            text-slate-900
                            dark:text-white
                        "
                    >
                        Issues Found
                    </h3>


                    <div class="mt-4 space-y-2">

                        @foreach($results['errors'] as $error)

                            <div
                                class="
                                    flex
                                    items-start
                                    gap-3
                                    rounded-xl
                                    border
                                    border-slate-200
                                    bg-slate-50
                                    p-4
                                    dark:border-white/10
                                    dark:bg-white/5
                                "
                            >

                                <span
                                    class="
                                        shrink-0
                                        rounded-lg
                                        bg-red-100
                                        px-2
                                        py-1
                                        text-xs
                                        font-black
                                        text-red-700
                                        dark:bg-red-500/10
                                        dark:text-red-400
                                    "
                                >
                                    Row {{ $error['row'] ?? '—' }}
                                </span>

                                <p
                                    class="
                                        text-sm
                                        text-slate-600
                                        dark:text-slate-300
                                    "
                                >
                                    {{ $error['message'] ?? 'Unknown error.' }}
                                </p>

                            </div>

                        @endforeach

                    </div>

                </div>

            @endif

        </div>

    @endif



    {{-- ========================================================= --}}
    {{-- MAIN IMPORT CARD --}}
    {{-- ========================================================= --}}

    <div
        class="
            grid
            gap-8
            lg:grid-cols-[1fr_360px]
        "
    >

        {{-- ===================================================== --}}
        {{-- LEFT --}}
        {{-- ===================================================== --}}

        <div
            class="
                rounded-[2rem]
                border
                border-slate-200
                bg-white
                p-6
                shadow-sm
                sm:p-8
                dark:border-white/10
                dark:bg-[#0d1a30]
            "
        >

            <form
                action="{{ route('admin.candidates.import.store') }}"
                method="POST"
                enctype="multipart/form-data"
                id="candidateImportForm"
                class="space-y-7"
            >

                @csrf


                {{-- ================================================= --}}
                {{-- ELECTION --}}
                {{-- ================================================= --}}

                <div>

                    <label
                        for="election_id"
                        class="
                            mb-2
                            block
                            text-sm
                            font-bold
                            text-slate-800
                            dark:text-slate-200
                        "
                    >
                        Select Election
                    </label>


                    <select
                        name="election_id"
                        id="election_id"
                        required
                        class="
                            w-full
                            rounded-xl
                            border
                            border-slate-200
                            bg-white
                            px-4
                            py-3.5
                            text-sm
                            font-semibold
                            text-slate-800
                            outline-none
                            transition
                            focus:border-blue-500
                            focus:ring-4
                            focus:ring-blue-500/10
                            dark:border-white/10
                            dark:bg-white/5
                            dark:text-white
                        "
                    >

                        <option value="">
                            Choose an election
                        </option>

                        @foreach($elections as $election)

                            <option
                                value="{{ $election->id }}"
                                {{ old('election_id') == $election->id ? 'selected' : '' }}
                            >
                                {{ $election->title }}
                            </option>

                        @endforeach

                    </select>


                    @error('election_id')

                        <p
                            class="
                                mt-2
                                text-sm
                                font-semibold
                                text-red-600
                                dark:text-red-400
                            "
                        >
                            {{ $message }}
                        </p>

                    @enderror

                </div>



                {{-- ================================================= --}}
                {{-- DROPZONE --}}
                {{-- ================================================= --}}

                <div>

                    <label
                        class="
                            mb-2
                            block
                            text-sm
                            font-bold
                            text-slate-800
                            dark:text-slate-200
                        "
                    >
                        Candidate File
                    </label>


                    <label
                        for="candidate_file"
                        id="dropzone"
                        class="
                            group
                            relative
                            flex
                            min-h-[300px]
                            cursor-pointer
                            flex-col
                            items-center
                            justify-center
                            rounded-[1.5rem]
                            border-2
                            border-dashed
                            border-slate-300
                            bg-slate-50
                            px-6
                            py-10
                            text-center
                            transition
                            hover:border-blue-400
                            hover:bg-blue-50/50
                            dark:border-white/15
                            dark:bg-white/[0.03]
                            dark:hover:border-blue-500/50
                            dark:hover:bg-blue-500/5
                        "
                    >

                        <input
                            type="file"
                            name="file"
                            id="candidate_file"
                            accept=".xlsx,.xls,.csv"
                            class="hidden"
                            required
                        />


                        <div
                            class="
                                flex
                                h-16
                                w-16
                                items-center
                                justify-center
                                rounded-2xl
                                bg-blue-100
                                text-blue-600
                                transition
                                group-hover:scale-105
                                dark:bg-blue-500/10
                                dark:text-blue-400
                            "
                        >

                            <x-heroicon-o-document-arrow-up
                                class="h-8 w-8"
                            />

                        </div>


                        <h3
                            class="
                                mt-5
                                text-lg
                                font-black
                                text-slate-900
                                dark:text-white
                            "
                        >
                            Drop your candidate file here
                        </h3>


                        <p
                            class="
                                mt-2
                                max-w-md
                                text-sm
                                leading-6
                                text-slate-500
                                dark:text-slate-400
                            "
                        >
                            Upload an Excel or CSV file containing
                            your candidate information.
                        </p>


                        <span
                            class="
                                mt-5
                                inline-flex
                                items-center
                                gap-2
                                rounded-xl
                                bg-blue-600
                                px-5
                                py-3
                                text-sm
                                font-bold
                                text-white
                                shadow-lg
                                shadow-blue-600/20
                            "
                        >

                            <x-heroicon-o-folder-open
                                class="h-5 w-5"
                            />

                            Browse File

                        </span>


                        <p
                            id="selectedFile"
                            class="
                                mt-4
                                hidden
                                text-sm
                                font-bold
                                text-emerald-600
                                dark:text-emerald-400
                            "
                        ></p>

                    </label>


                    @error('file')

                        <p
                            class="
                                mt-2
                                text-sm
                                font-semibold
                                text-red-600
                                dark:text-red-400
                            "
                        >
                            {{ $message }}
                        </p>

                    @enderror

                </div>



                {{-- ================================================= --}}
                {{-- SUBMIT --}}
                {{-- ================================================= --}}

                <button
                    type="submit"
                    id="importButton"
                    class="
                        inline-flex
                        w-full
                        items-center
                        justify-center
                        gap-2
                        rounded-xl
                        bg-gradient-to-r
                        from-blue-600
                        to-indigo-600
                        px-6
                        py-4
                        text-sm
                        font-black
                        text-white
                        shadow-lg
                        shadow-blue-600/20
                        transition
                        hover:-translate-y-0.5
                        hover:shadow-xl
                        disabled:cursor-not-allowed
                        disabled:opacity-60
                    "
                >

                    <x-heroicon-o-arrow-up-tray
                        class="h-5 w-5"
                    />

                    Import Candidates

                </button>

            </form>

        </div>



        {{-- ===================================================== --}}
        {{-- RIGHT SIDEBAR --}}
        {{-- ===================================================== --}}

        <div class="space-y-6">


            {{-- ================================================= --}}
            {{-- TEMPLATE --}}
            {{-- ================================================= --}}

            <div
                class="
                    rounded-[2rem]
                    border
                    border-blue-200
                    bg-gradient-to-br
                    from-blue-50
                    to-indigo-50
                    p-6
                    dark:border-blue-500/20
                    dark:from-blue-500/10
                    dark:to-indigo-500/10
                "
            >

                <div
                    class="
                        flex
                        h-12
                        w-12
                        items-center
                        justify-center
                        rounded-2xl
                        bg-blue-600
                        text-white
                        shadow-lg
                        shadow-blue-600/20
                    "
                >

                    <x-heroicon-o-document-arrow-down
                        class="h-6 w-6"
                    />

                </div>


                <h3
                    class="
                        mt-5
                        text-lg
                        font-black
                        text-slate-900
                        dark:text-white
                    "
                >
                    Need the template?
                </h3>


                <p
                    class="
                        mt-2
                        text-sm
                        leading-6
                        text-slate-600
                        dark:text-slate-400
                    "
                >
                    Select an election first, then download a
                    spreadsheet containing its available positions.
                </p>


                <a
                    href="{{ route('admin.candidates.import.template') }}"
                    id="templateButton"
                    class="
                        mt-5
                        inline-flex
                        w-full
                        items-center
                        justify-center
                        gap-2
                        rounded-xl
                        border
                        border-blue-200
                        bg-white
                        px-4
                        py-3
                        text-sm
                        font-bold
                        text-blue-700
                        shadow-sm
                        transition
                        hover:-translate-y-0.5
                        hover:bg-blue-50
                        dark:border-blue-500/20
                        dark:bg-white/5
                        dark:text-blue-400
                    "
                >

                    <x-heroicon-o-arrow-down-tray
                        class="h-5 w-5"
                    />

                    Download Template

                </a>

            </div>



            {{-- ================================================= --}}
            {{-- FORMAT --}}
            {{-- ================================================= --}}

            <div
                class="
                    rounded-[2rem]
                    border
                    border-slate-200
                    bg-white
                    p-6
                    dark:border-white/10
                    dark:bg-[#0d1a30]
                "
            >

                <h3
                    class="
                        text-sm
                        font-black
                        text-slate-900
                        dark:text-white
                    "
                >
                    Spreadsheet Format
                </h3>


                <div class="mt-5 space-y-4">

                    @foreach([
                        ['name', 'Required', 'Candidate full name'],
                        ['position', 'Required', 'Election position'],
                        ['bio', 'Optional', 'Candidate biography'],
                        ['photo', 'Optional', 'Photo filename'],
                    ] as $field)

                        <div
                            class="
                                flex
                                items-start
                                justify-between
                                gap-4
                            "
                        >

                            <div>

                                <p
                                    class="
                                        text-sm
                                        font-bold
                                        text-slate-700
                                        dark:text-slate-200
                                    "
                                >
                                    {{ $field[0] }}
                                </p>

                                <p
                                    class="
                                        mt-0.5
                                        text-xs
                                        text-slate-400
                                    "
                                >
                                    {{ $field[2] }}
                                </p>

                            </div>


                            <span
                                class="
                                    rounded-full
                                    px-2.5
                                    py-1
                                    text-[10px]
                                    font-black
                                    uppercase
                                    tracking-wide
                                    {{ $field[1] === 'Required'
                                        ? 'bg-red-50 text-red-600 dark:bg-red-500/10 dark:text-red-400'
                                        : 'bg-slate-100 text-slate-500 dark:bg-white/5 dark:text-slate-400'
                                    }}
                                "
                            >
                                {{ $field[1] }}
                            </span>

                        </div>

                    @endforeach

                </div>

            </div>



            {{-- ================================================= --}}
            {{-- SAFETY --}}
            {{-- ================================================= --}}

            <div
                class="
                    rounded-[2rem]
                    border
                    border-amber-200
                    bg-amber-50
                    p-6
                    dark:border-amber-500/20
                    dark:bg-amber-500/10
                "
            >

                <div class="flex gap-3">

                    <x-heroicon-o-shield-check
                        class="
                            h-6
                            w-6
                            shrink-0
                            text-amber-600
                            dark:text-amber-400
                        "
                    />

                    <div>

                        <h3
                            class="
                                text-sm
                                font-black
                                text-amber-900
                                dark:text-amber-300
                            "
                        >
                            Import safety
                        </h3>

                        <p
                            class="
                                mt-2
                                text-xs
                                leading-5
                                text-amber-800
                                dark:text-amber-300/80
                            "
                        >
                            Candidates are matched against positions
                            belonging to the selected election.
                            Duplicate candidates are automatically detected.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- ============================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ============================================================= --}}

<script>

document.addEventListener(
    'DOMContentLoaded',
    () => {

        const fileInput =
            document.getElementById(
                'candidate_file'
            );

        const selectedFile =
            document.getElementById(
                'selectedFile'
            );

        const importForm =
            document.getElementById(
                'candidateImportForm'
            );

        const importButton =
            document.getElementById(
                'importButton'
            );

        const electionSelect =
            document.getElementById(
                'election_id'
            );

        const templateButton =
            document.getElementById(
                'templateButton'
            );


        /*
        |--------------------------------------------------------------------------
        | File Selection
        |--------------------------------------------------------------------------
        */

        fileInput?.addEventListener(
            'change',
            function () {

                const file =
                    this.files?.[0];

                if (!file) {

                    selectedFile.classList.add(
                        'hidden'
                    );

                    selectedFile.textContent =
                        '';

                    return;
                }


                selectedFile.textContent =
                    `Selected: ${file.name}`;


                selectedFile.classList.remove(
                    'hidden'
                );

            }
        );


        /*
        |--------------------------------------------------------------------------
        | Template Link
        |--------------------------------------------------------------------------
        */

        electionSelect?.addEventListener(
            'change',
            function () {

                const electionId =
                    this.value;


                if (!electionId) {

                    templateButton.href =
                        '#';

                    templateButton.classList.add(
                        'opacity-50',
                        'pointer-events-none'
                    );

                    return;

                }


                templateButton.href =
                    `{{ route('admin.candidates.import.template') }}?election_id=${electionId}`;


                templateButton.classList.remove(
                    'opacity-50',
                    'pointer-events-none'
                );

            }
        );


        /*
        |--------------------------------------------------------------------------
        | Submit Loading State
        |--------------------------------------------------------------------------
        */

        importForm?.addEventListener(
            'submit',
            function () {

                importButton.disabled =
                    true;


                importButton.innerHTML = `

                    <svg
                        class="h-5 w-5 animate-spin"
                        viewBox="0 0 24 24"
                        fill="none"
                    >
                        <circle
                            cx="12"
                            cy="12"
                            r="9"
                            stroke="currentColor"
                            stroke-width="3"
                            opacity=".25"
                        ></circle>

                        <path
                            d="M21 12a9 9 0 0 1-9 9"
                            stroke="currentColor"
                            stroke-width="3"
                        ></path>

                    </svg>

                    Importing Candidates...

                `;

            }
        );

    }
);

</script>

@endsection