@extends('electo.layouts.app')

@section('title', 'Bulk Voter Import')
@section('page-title', 'Bulk Voter Import')

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
                       text-slate-900 dark:text-white
                       sm:text-4xl">

                Bulk Voter Import

            </h1>


            <p class="mt-2 max-w-2xl text-sm leading-6
                      text-slate-500 dark:text-slate-400">

                Import large numbers of voters into an election
                securely using an Excel or CSV spreadsheet.

            </p>

        </div>


        {{-- Back --}}

        <a
            href="{{ route('voters.index') }}"
            class="inline-flex items-center justify-center gap-2
                   rounded-xl
                   border border-slate-200
                   bg-white
                   px-5 py-3
                   text-sm font-bold
                   text-slate-700
                   shadow-sm
                   transition
                   hover:border-blue-200
                   hover:bg-blue-50
                   hover:text-blue-700
                   dark:border-white/10
                   dark:bg-white/5
                   dark:text-slate-300
                   dark:hover:bg-blue-500/10
                   dark:hover:text-blue-400"
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
                    d="M15 19l-7-7 7-7"
                />
            </svg>

            Back to Voters

        </a>

    </div>



    {{-- ============================================================
        FLASH ERROR
    ============================================================= --}}

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
                class="flex h-8 w-8 shrink-0 items-center
                       justify-center rounded-xl
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
        VALIDATION ERRORS
    ============================================================= --}}

    @if($errors->any())

        <div
            class="rounded-2xl
                   border border-red-200
                   bg-red-50
                   px-5 py-4
                   dark:border-red-500/20
                   dark:bg-red-500/10"
        >

            <div class="flex items-center gap-2">

                <svg
                    class="h-5 w-5 text-red-600 dark:text-red-400"
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
                        d="M12 8v4"
                    />

                    <path
                        stroke-linecap="round"
                        d="M12 16h.01"
                    />
                </svg>

                <p class="text-sm font-bold text-red-700 dark:text-red-400">
                    Please correct the following:
                </p>

            </div>


            <ul class="mt-3 space-y-1 pl-7 text-xs
                       text-red-600 dark:text-red-400">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif



    {{-- ============================================================
        IMPORT RESULT
    ============================================================= --}}

    @if(session('import_results'))

        @php

            $importData =
                session('import_results');

            $results =
                $importData['results'] ?? [];

            $importElection =
                $importData['election'] ?? null;

        @endphp


        <div
            class="overflow-hidden rounded-3xl
                   border border-slate-200
                   bg-white
                   shadow-sm
                   dark:border-white/10
                   dark:bg-[#101a2f]"
        >

            {{-- Result header --}}

            <div
                class="border-b border-slate-100
                       bg-gradient-to-r
                       from-emerald-50
                       to-white
                       px-5 py-5
                       dark:border-white/10
                       dark:from-emerald-500/[0.08]
                       dark:to-transparent
                       sm:px-6"
            >

                <div class="flex flex-col gap-3
                            sm:flex-row sm:items-center
                            sm:justify-between">

                    <div>

                        <div
                            class="inline-flex items-center gap-2
                                   rounded-full
                                   bg-emerald-100
                                   px-3 py-1.5
                                   text-[10px]
                                   font-bold
                                   uppercase
                                   tracking-wider
                                   text-emerald-700
                                   dark:bg-emerald-500/10
                                   dark:text-emerald-400"
                        >

                            <span
                                class="h-1.5 w-1.5 rounded-full
                                       bg-emerald-500"
                            ></span>

                            Import Completed

                        </div>


                        <h2
                            class="mt-3 text-xl font-black
                                   text-slate-900
                                   dark:text-white"
                        >

                            Voter Import Report

                        </h2>


                        @if($importElection)

                            <p
                                class="mt-1 text-sm
                                       text-slate-500
                                       dark:text-slate-400"
                            >

                                Election:

                                <span class="font-bold
                                             text-slate-700
                                             dark:text-slate-200">

                                    {{ $importElection->title }}

                                </span>

                            </p>

                        @endif

                    </div>


                    <div
                        class="inline-flex items-center gap-2
                               rounded-xl
                               bg-emerald-100
                               px-4 py-2
                               text-xs font-bold
                               text-emerald-700
                               dark:bg-emerald-500/10
                               dark:text-emerald-400"
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

                        Processing Complete

                    </div>

                </div>

            </div>



            {{-- Statistics --}}

            <div class="grid grid-cols-2 gap-3
                        p-5
                        sm:grid-cols-3
                        xl:grid-cols-5
                        sm:p-6">

                {{-- Total --}}

                <div
                    class="rounded-2xl
                           border border-blue-100
                           bg-blue-50/70
                           p-4
                           dark:border-blue-500/10
                           dark:bg-blue-500/[0.06]"
                >

                    <p
                        class="text-[10px] font-bold uppercase
                               tracking-wider
                               text-slate-400"
                    >
                        Total Rows
                    </p>

                    <p
                        class="mt-2 text-2xl font-black
                               text-blue-600
                               dark:text-blue-400"
                    >
                        {{ $results['total'] ?? 0 }}
                    </p>

                </div>


                {{-- Imported --}}

                <div
                    class="rounded-2xl
                           border border-emerald-100
                           bg-emerald-50/70
                           p-4
                           dark:border-emerald-500/10
                           dark:bg-emerald-500/[0.06]"
                >

                    <p
                        class="text-[10px] font-bold uppercase
                               tracking-wider
                               text-slate-400"
                    >
                        Imported
                    </p>

                    <p
                        class="mt-2 text-2xl font-black
                               text-emerald-600
                               dark:text-emerald-400"
                    >
                        {{ $results['success'] ?? 0 }}
                    </p>

                </div>


                {{-- New --}}

                <div
                    class="rounded-2xl
                           border border-cyan-100
                           bg-cyan-50/70
                           p-4
                           dark:border-cyan-500/10
                           dark:bg-cyan-500/[0.06]"
                >

                    <p
                        class="text-[10px] font-bold uppercase
                               tracking-wider
                               text-slate-400"
                    >
                        New Voters
                    </p>

                    <p
                        class="mt-2 text-2xl font-black
                               text-cyan-600
                               dark:text-cyan-400"
                    >
                        {{ $results['new_voters'] ?? 0 }}
                    </p>

                </div>


                {{-- Existing --}}

                <div
                    class="rounded-2xl
                           border border-violet-100
                           bg-violet-50/70
                           p-4
                           dark:border-violet-500/10
                           dark:bg-violet-500/[0.06]"
                >

                    <p
                        class="text-[10px] font-bold uppercase
                               tracking-wider
                               text-slate-400"
                    >
                        Existing
                    </p>

                    <p
                        class="mt-2 text-2xl font-black
                               text-violet-600
                               dark:text-violet-400"
                    >
                        {{ $results['existing_voters'] ?? 0 }}
                    </p>

                </div>


                {{-- Problems --}}

                <div
                    class="rounded-2xl
                           border border-red-100
                           bg-red-50/70
                           p-4
                           dark:border-red-500/10
                           dark:bg-red-500/[0.06]"
                >

                    <p
                        class="text-[10px] font-bold uppercase
                               tracking-wider
                               text-slate-400"
                    >
                        Problems
                    </p>

                    <p
                        class="mt-2 text-2xl font-black
                               text-red-600
                               dark:text-red-400"
                    >
                        {{
                            ($results['failed'] ?? 0)
                            +
                            ($results['duplicates'] ?? 0)
                        }}
                    </p>

                </div>

            </div>



            {{-- Errors --}}

            @if(!empty($results['errors']))

                <div
                    class="border-t border-slate-100
                           dark:border-white/10"
                >

                    <div class="px-5 py-5 sm:px-6">

                        <div class="flex items-center
                                    justify-between gap-3">

                            <div>

                                <h3
                                    class="text-sm font-black
                                           text-slate-900
                                           dark:text-white"
                                >
                                    Rows Requiring Attention
                                </h3>

                                <p
                                    class="mt-1 text-xs
                                           text-slate-500
                                           dark:text-slate-400"
                                >
                                    These rows were not imported.
                                </p>

                            </div>


                            <span
                                class="rounded-full
                                       bg-red-50
                                       px-3 py-1.5
                                       text-[10px]
                                       font-bold
                                       text-red-700
                                       dark:bg-red-500/10
                                       dark:text-red-400"
                            >

                                {{ count($results['errors']) }}
                                issue{{ count($results['errors']) === 1 ? '' : 's' }}

                            </span>

                        </div>


                        <div
                            class="mt-5 overflow-hidden
                                   rounded-2xl
                                   border border-slate-200
                                   dark:border-white/10"
                        >

                            <div class="max-h-80 overflow-y-auto">

                                <table class="w-full text-left">

                                    <thead
                                        class="sticky top-0
                                               border-b
                                               border-slate-200
                                               bg-slate-50
                                               dark:border-white/10
                                               dark:bg-[#111c31]"
                                    >

                                        <tr>

                                            <th
                                                class="px-4 py-3
                                                       text-[10px]
                                                       font-bold
                                                       uppercase
                                                       tracking-wider
                                                       text-slate-400"
                                            >
                                                Row
                                            </th>

                                            <th
                                                class="px-4 py-3
                                                       text-[10px]
                                                       font-bold
                                                       uppercase
                                                       tracking-wider
                                                       text-slate-400"
                                            >
                                                Type
                                            </th>

                                            <th
                                                class="px-4 py-3
                                                       text-[10px]
                                                       font-bold
                                                       uppercase
                                                       tracking-wider
                                                       text-slate-400"
                                            >
                                                Message
                                            </th>

                                        </tr>

                                    </thead>


                                    <tbody
                                        class="divide-y
                                               divide-slate-100
                                               dark:divide-white/5"
                                    >

                                        @foreach($results['errors'] as $error)

                                            <tr
                                                class="hover:bg-slate-50
                                                       dark:hover:bg-white/[0.02]"
                                            >

                                                <td
                                                    class="px-4 py-3
                                                           text-xs font-bold
                                                           text-slate-700
                                                           dark:text-slate-200"
                                                >

                                                    {{ $error['row'] ?? '—' }}

                                                </td>


                                                <td class="px-4 py-3">

                                                    @if(($error['type'] ?? '') === 'duplicate')

                                                        <span
                                                            class="inline-flex
                                                                   rounded-full
                                                                   bg-amber-50
                                                                   px-2.5 py-1
                                                                   text-[10px]
                                                                   font-bold
                                                                   text-amber-700
                                                                   dark:bg-amber-500/10
                                                                   dark:text-amber-400"
                                                        >
                                                            Duplicate
                                                        </span>

                                                    @else

                                                        <span
                                                            class="inline-flex
                                                                   rounded-full
                                                                   bg-red-50
                                                                   px-2.5 py-1
                                                                   text-[10px]
                                                                   font-bold
                                                                   text-red-700
                                                                   dark:bg-red-500/10
                                                                   dark:text-red-400"
                                                        >
                                                            Validation
                                                        </span>

                                                    @endif

                                                </td>


                                                <td
                                                    class="px-4 py-3
                                                           text-xs
                                                           leading-5
                                                           text-slate-600
                                                           dark:text-slate-300"
                                                >

                                                    {{ $error['message'] ?? 'Unknown error.' }}

                                                </td>

                                            </tr>

                                        @endforeach

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

            @else

                <div
                    class="border-t border-slate-100
                           px-5 py-5
                           dark:border-white/10"
                >

                    <div
                        class="flex items-center gap-3
                               rounded-2xl
                               border border-emerald-100
                               bg-emerald-50/70
                               px-4 py-4
                               dark:border-emerald-500/10
                               dark:bg-emerald-500/[0.06]"
                    >

                        <div
                            class="flex h-9 w-9 shrink-0
                                   items-center justify-center
                                   rounded-xl
                                   bg-emerald-100
                                   text-emerald-600
                                   dark:bg-emerald-500/10
                                   dark:text-emerald-400"
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
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>

                        </div>

                        <div>

                            <p
                                class="text-sm font-bold
                                       text-emerald-800
                                       dark:text-emerald-300"
                            >
                                All rows processed successfully.
                            </p>

                            <p
                                class="mt-0.5 text-xs
                                       text-emerald-700/70
                                       dark:text-emerald-400/70"
                            >
                                No duplicate or validation issues were detected.
                            </p>

                        </div>

                    </div>

                </div>

            @endif

        </div>

    @endif



    {{-- ============================================================
        MAIN IMPORT CARD
    ============================================================= --}}

    <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">

        {{-- ========================================================
            IMPORT FORM
        ========================================================= --}}

        <div
            class="xl:col-span-2
                   overflow-hidden rounded-3xl
                   border border-slate-200
                   bg-white shadow-sm
                   dark:border-white/10
                   dark:bg-[#101a2f]"
        >

            <div
                class="border-b border-slate-100
                       px-5 py-5
                       dark:border-white/10
                       sm:px-6"
            >

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-11 w-11 shrink-0
                               items-center justify-center
                               rounded-2xl
                               bg-blue-50
                               text-blue-600
                               dark:bg-blue-500/10
                               dark:text-blue-400"
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

                    </div>


                    <div>

                        <h2
                            class="text-lg font-black
                                   text-slate-900
                                   dark:text-white"
                        >
                            Import Voters
                        </h2>

                        <p
                            class="mt-0.5 text-xs
                                   text-slate-500
                                   dark:text-slate-400"
                        >
                            Select an election and upload your voter list.
                        </p>

                    </div>

                </div>

            </div>



            <form
                method="POST"
                action="{{ route('admin.voters.import.store') }}"
                enctype="multipart/form-data"
                id="voterImportForm"
                class="p-5 sm:p-6"
            >

                @csrf


                {{-- Election --}}

                <div>

                    <div class="flex items-center justify-between gap-3">

                        <label
                            for="election_id"
                            class="text-xs font-bold uppercase
                                   tracking-wider
                                   text-slate-500
                                   dark:text-slate-400"
                        >
                            Target Election
                        </label>

                        <span
                            class="rounded-full
                                   bg-blue-50
                                   px-2.5 py-1
                                   text-[10px]
                                   font-bold
                                   text-blue-700
                                   dark:bg-blue-500/10
                                   dark:text-blue-400"
                        >
                            Required
                        </span>

                    </div>


                    <select
                        name="election_id"
                        id="election_id"
                        required
                        class="mt-2 w-full rounded-xl
                               border border-slate-200
                               bg-slate-50
                               px-4 py-3
                               text-sm font-medium
                               text-slate-800
                               outline-none
                               transition
                               focus:border-blue-500
                               focus:bg-white
                               focus:ring-4
                               focus:ring-blue-500/10
                               dark:border-white/10
                               dark:bg-white/[0.03]
                               dark:text-white"
                    >

                        <option value="">
                            Select an election
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

                </div>



                {{-- Template --}}

                <div
                    class="mt-6 rounded-2xl
                           border border-blue-100
                           bg-blue-50/60
                           p-4
                           dark:border-blue-500/10
                           dark:bg-blue-500/[0.05]"
                >

                    <div
                        class="flex flex-col gap-4
                               sm:flex-row
                               sm:items-center
                               sm:justify-between"
                    >

                        <div class="flex items-start gap-3">

                            <div
                                class="flex h-9 w-9 shrink-0
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
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M4 4h16v16H4z"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        d="M8 8h8M8 12h8M8 16h5"
                                    />
                                </svg>

                            </div>


                            <div>

                                <p
                                    class="text-sm font-bold
                                           text-blue-900
                                           dark:text-blue-300"
                                >
                                    Use the official template
                                </p>

                                <p
                                    class="mt-1 text-xs leading-5
                                           text-blue-700/70
                                           dark:text-slate-400"
                                >
                                    Download the template to ensure your
                                    column names are correct.
                                </p>

                            </div>

                        </div>


                        <button
                            type="button"
                            id="downloadTemplate"
                            class="inline-flex shrink-0
                                   items-center justify-center gap-2
                                   rounded-xl
                                   bg-blue-600
                                   px-4 py-2.5
                                   text-xs font-bold
                                   text-white
                                   shadow-lg
                                   shadow-blue-600/15
                                   transition
                                   hover:-translate-y-0.5
                                   hover:bg-blue-700"
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

                            Download Template

                        </button>

                    </div>

                </div>



                {{-- Upload --}}

                <div class="mt-6">

                    <label
                        for="file"
                        class="text-xs font-bold uppercase
                               tracking-wider
                               text-slate-500
                               dark:text-slate-400"
                    >
                        Voter Spreadsheet
                    </label>


                    <label
                        for="file"
                        id="dropZone"
                        class="group mt-2 flex cursor-pointer
                               flex-col items-center
                               justify-center
                               rounded-2xl
                               border-2
                               border-dashed
                               border-slate-300
                               bg-slate-50
                               px-6 py-10
                               text-center
                               transition
                               hover:border-blue-400
                               hover:bg-blue-50/50
                               dark:border-white/10
                               dark:bg-white/[0.02]
                               dark:hover:border-blue-500/50
                               dark:hover:bg-blue-500/[0.04]"
                    >

                        <div
                            class="flex h-14 w-14 items-center
                                   justify-center rounded-2xl
                                   bg-white
                                   text-slate-400
                                   shadow-sm
                                   transition
                                   group-hover:scale-105
                                   group-hover:text-blue-600
                                   dark:bg-white/5
                                   dark:text-slate-500
                                   dark:group-hover:text-blue-400"
                        >

                            <svg
                                class="h-7 w-7"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 16V4"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M7 9l5-5 5 5"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4 16v3a1 1 0 001 1h14a1 1 0 001-1v-3"
                                />
                            </svg>

                        </div>


                        <p
                            id="fileName"
                            class="mt-4 text-sm font-bold
                                   text-slate-700
                                   dark:text-slate-200"
                        >
                            Drop your voter spreadsheet here
                        </p>


                        <p
                            class="mt-1 text-xs
                                   text-slate-400"
                        >
                            or
                            <span class="font-bold text-blue-600
                                         dark:text-blue-400">
                                choose a file
                            </span>
                        </p>


                        <p
                            class="mt-3 text-[10px]
                                   font-semibold uppercase
                                   tracking-wider
                                   text-slate-400"
                        >
                            XLSX · XLS · CSV · Maximum 10 MB
                        </p>


                        <input
                            type="file"
                            name="file"
                            id="file"
                            accept=".xlsx,.xls,.csv"
                            required
                            class="hidden"
                        >

                    </label>

                </div>



                {{-- Import button --}}

                <button
                    type="submit"
                    id="importButton"
                    class="mt-6 inline-flex w-full
                           items-center justify-center
                           gap-2 rounded-xl
                           bg-gradient-to-r
                           from-blue-600
                           to-indigo-600
                           px-6 py-3.5
                           text-sm font-bold
                           text-white
                           shadow-lg
                           shadow-blue-600/20
                           transition
                           hover:-translate-y-0.5
                           hover:shadow-xl
                           hover:shadow-blue-600/30
                           disabled:cursor-not-allowed
                           disabled:opacity-50"
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
                            d="M12 16V4"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M7 9l5-5 5 5"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4 16v3a1 1 0 001 1h14a1 1 0 001-1v-3"
                        />
                    </svg>

                    Import Voters

                </button>


                <p
                    class="mt-3 text-center text-[11px]
                           leading-5 text-slate-400"
                >
                    Voters will be added as
                    <span class="font-bold">eligible</span>
                    with
                    <span class="font-bold">pending accreditation</span>.
                    Existing voting records are never reset.
                </p>

            </form>

        </div>



        {{-- ========================================================
            INFORMATION PANEL
        ========================================================= --}}

        <div class="space-y-6">

            {{-- Spreadsheet format --}}

            <div
                class="overflow-hidden rounded-3xl
                       border border-slate-200
                       bg-white shadow-sm
                       dark:border-white/10
                       dark:bg-[#101a2f]"
            >

                <div
                    class="border-b border-slate-100
                           px-5 py-5
                           dark:border-white/10"
                >

                    <h2
                        class="text-base font-black
                               text-slate-900
                               dark:text-white"
                    >
                        Spreadsheet Format
                    </h2>

                    <p
                        class="mt-1 text-xs leading-5
                               text-slate-500
                               dark:text-slate-400"
                    >
                        Your spreadsheet must contain these columns.
                    </p>

                </div>


                <div class="space-y-2 p-5">

                    @foreach([
                        ['name', 'Voter full name', true],
                        ['voter_id', 'Unique voter ID', true],
                        ['email', 'Email address', false],
                        ['phone', 'Phone number', true],
                    ] as $field)

                        <div
                            class="flex items-center justify-between
                                   gap-3 rounded-xl
                                   bg-slate-50
                                   px-3 py-3
                                   dark:bg-white/[0.03]"
                        >

                            <div class="min-w-0">

                                <p
                                    class="font-mono text-xs font-bold
                                           text-slate-700
                                           dark:text-slate-200"
                                >
                                    {{ $field[0] }}
                                </p>

                                <p
                                    class="mt-0.5 text-[10px]
                                           text-slate-400"
                                >
                                    {{ $field[1] }}
                                </p>

                            </div>


                            @if($field[2])

                                <span
                                    class="shrink-0 rounded-full
                                           bg-blue-50 px-2 py-1
                                           text-[9px] font-bold
                                           text-blue-700
                                           dark:bg-blue-500/10
                                           dark:text-blue-400"
                                >
                                    Required
                                </span>

                            @else

                                <span
                                    class="shrink-0 rounded-full
                                           bg-slate-100 px-2 py-1
                                           text-[9px] font-bold
                                           text-slate-500
                                           dark:bg-white/5
                                           dark:text-slate-400"
                                >
                                    Optional
                                </span>

                            @endif

                        </div>

                    @endforeach

                </div>

            </div>



            {{-- Import behavior --}}

            <div
                class="overflow-hidden rounded-3xl
                       border border-slate-200
                       bg-white shadow-sm
                       dark:border-white/10
                       dark:bg-[#101a2f]"
            >

                <div
                    class="border-b border-slate-100
                           px-5 py-5
                           dark:border-white/10"
                >

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-9 w-9 items-center
                                   justify-center rounded-xl
                                   bg-emerald-50
                                   text-emerald-600
                                   dark:bg-emerald-500/10
                                   dark:text-emerald-400"
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
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>

                        </div>


                        <div>

                            <h2
                                class="text-base font-black
                                       text-slate-900
                                       dark:text-white"
                            >
                                Import Rules
                            </h2>

                            <p
                                class="mt-1 text-xs
                                       text-slate-500
                                       dark:text-slate-400"
                            >
                                Your existing data stays protected.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="space-y-4 p-5">

                    @foreach([
                        [
                            'title' => 'Existing voters are reused',
                            'text' => 'Matching voter IDs, emails or phone numbers will not create another voter profile.'
                        ],
                        [
                            'title' => 'Election assignment is separate',
                            'text' => 'A voter can participate in multiple elections without creating duplicate profiles.'
                        ],
                        [
                            'title' => 'Accreditation stays untouched',
                            'text' => 'Existing accreditation records are never reset by an import.'
                        ],
                        [
                            'title' => 'Voting history stays untouched',
                            'text' => 'Existing votes and voting timestamps are never overwritten.'
                        ],
                    ] as $rule)

                        <div class="flex items-start gap-3">

                            <div
                                class="mt-0.5 flex h-6 w-6
                                       shrink-0 items-center
                                       justify-center rounded-lg
                                       bg-emerald-50
                                       text-emerald-600
                                       dark:bg-emerald-500/10
                                       dark:text-emerald-400"
                            >

                                <svg
                                    class="h-3.5 w-3.5"
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


                            <div>

                                <p
                                    class="text-xs font-bold
                                           text-slate-800
                                           dark:text-slate-200"
                                >
                                    {{ $rule['title'] }}
                                </p>

                                <p
                                    class="mt-1 text-[11px]
                                           leading-5
                                           text-slate-400"
                                >
                                    {{ $rule['text'] }}
                                </p>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>



            {{-- Security notice --}}

            <div
                class="rounded-3xl
                       border border-amber-100
                       bg-amber-50/70
                       p-5
                       dark:border-amber-500/10
                       dark:bg-amber-500/[0.05]"
            >

                <div class="flex items-start gap-3">

                    <div
                        class="flex h-9 w-9 shrink-0
                               items-center justify-center
                               rounded-xl
                               bg-amber-100
                               text-amber-700
                               dark:bg-amber-500/10
                               dark:text-amber-400"
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
                                d="M12 3l8 4v5c0 5-3.5 8-8 9-4.5-1-8-4-8-9V7l8-4z"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 12l2 2 4-4"
                            />
                        </svg>

                    </div>


                    <div>

                        <p
                            class="text-xs font-black
                                   text-amber-900
                                   dark:text-amber-300"
                        >
                            Election data protection
                        </p>

                        <p
                            class="mt-1 text-[11px]
                                   leading-5
                                   text-amber-800/70
                                   dark:text-amber-400/70"
                        >
                            Review your spreadsheet before importing.
                            Voter assignments are connected directly
                            to the selected election.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>



    {{-- ============================================================
        JAVASCRIPT
    ============================================================= --}}

    <script>

        document.addEventListener('DOMContentLoaded', () => {

            const election =
                document.getElementById('election_id');

            const file =
                document.getElementById('file');

            const dropZone =
                document.getElementById('dropZone');

            const fileName =
                document.getElementById('fileName');

            const importButton =
                document.getElementById('importButton');

            const form =
                document.getElementById('voterImportForm');

            const downloadTemplate =
                document.getElementById('downloadTemplate');


            /*
            |--------------------------------------------------------------------------
            | File selection
            |--------------------------------------------------------------------------
            */

            function updateFileName(selectedFile) {

                if (!selectedFile) {

                    fileName.textContent =
                        'Drop your voter spreadsheet here';

                    return;
                }

                fileName.textContent =
                    selectedFile.name;

                fileName.classList.add(
                    'text-blue-600',
                    'dark:text-blue-400'
                );
            }


            file?.addEventListener(
                'change',
                function () {

                    updateFileName(
                        this.files?.[0]
                    );

                }
            );


            /*
            |--------------------------------------------------------------------------
            | Drag and Drop
            |--------------------------------------------------------------------------
            */

            [
                'dragenter',
                'dragover'
            ].forEach(eventName => {

                dropZone?.addEventListener(
                    eventName,
                    event => {

                        event.preventDefault();

                        dropZone.classList.add(
                            'border-blue-500',
                            'bg-blue-50',
                            'dark:border-blue-500/50',
                            'dark:bg-blue-500/[0.06]'
                        );

                    }
                );

            });


            [
                'dragleave',
                'drop'
            ].forEach(eventName => {

                dropZone?.addEventListener(
                    eventName,
                    event => {

                        event.preventDefault();

                        dropZone.classList.remove(
                            'border-blue-500',
                            'bg-blue-50',
                            'dark:border-blue-500/50',
                            'dark:bg-blue-500/[0.06]'
                        );

                    }
                );

            });


            dropZone?.addEventListener(
                'drop',
                event => {

                    const files =
                        event.dataTransfer.files;

                    if (!files.length) {
                        return;
                    }

                    file.files = files;

                    updateFileName(
                        files[0]
                    );

                }
            );


            /*
            |--------------------------------------------------------------------------
            | Download template
            |--------------------------------------------------------------------------
            */

            downloadTemplate?.addEventListener(
                'click',
                () => {

                    if (!election.value) {

                        alert(
                            'Please select an election first.'
                        );

                        election.focus();

                        return;
                    }

                    const url =
                        @json(route(
                            'admin.voters.import.template'
                        ));

                    window.location.href =
                        url +
                        '?election_id=' +
                        encodeURIComponent(
                            election.value
                        );

                }
            );


            /*
            |--------------------------------------------------------------------------
            | Submit protection
            |--------------------------------------------------------------------------
            */

            form?.addEventListener(
                'submit',
                event => {

                    if (!election.value) {

                        event.preventDefault();

                        alert(
                            'Please select an election.'
                        );

                        election.focus();

                        return;
                    }


                    if (
                        !file.files ||
                        !file.files.length
                    ) {

                        event.preventDefault();

                        alert(
                            'Please select a voter spreadsheet.'
                        );

                        file.click();

                        return;
                    }


                    importButton.disabled =
                        true;

                    importButton.innerHTML = `

                        <svg
                            class="h-5 w-5 animate-spin"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                                stroke="currentColor"
                                stroke-opacity=".25"
                                stroke-width="2"
                            ></circle>

                            <path
                                d="M21 12a9 9 0 00-9-9"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                            ></path>

                        </svg>

                        Importing Voters...

                    `;

                }
            );

        });

    </script>

</div>

@endsection