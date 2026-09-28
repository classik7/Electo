@extends('electo.layouts.dashboard')

@section('title', 'Organization Trash')
@section('page-title', 'Organization Trash')

@section('content')

<div class="w-full min-w-0 space-y-8">

    {{-- =========================================================
         PAGE HEADER
    ========================================================== --}}

    <div class="flex flex-col gap-5 xl:flex-row xl:items-end xl:justify-between">

        <div class="min-w-0">

            <div class="flex items-center gap-3">

                <div
                    class="flex h-12 w-12 shrink-0 items-center justify-center
                           rounded-2xl bg-gradient-to-br from-slate-700 to-slate-900
                           text-white shadow-lg shadow-slate-500/20">

                    <x-heroicon-o-trash class="h-6 w-6"/>

                </div>

                <div class="min-w-0">

                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-blue-600">
                        Organization Management
                    </p>

                    <h1 class="mt-1 text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
                        Organization Trash
                    </h1>

                </div>

            </div>

            <p class="mt-3 text-sm text-slate-500">
                Restore organizations or permanently remove them from Electo.
            </p>

        </div>


        {{-- Back --}}

        <a
            href="{{ route('organizations.index') }}"
            class="inline-flex h-11 w-fit items-center justify-center gap-2 rounded-xl
                   border border-slate-200 bg-white px-5
                   text-sm font-bold text-slate-700
                   shadow-sm transition-all duration-200
                   hover:-translate-y-0.5 hover:border-slate-300 hover:bg-slate-50">

            <x-heroicon-o-arrow-left class="h-5 w-5"/>

            Back to Organizations

        </a>

    </div>


    {{-- =========================================================
         SUCCESS MESSAGE
    ========================================================== --}}

    @if(session('success'))

        <div
            class="flex items-start gap-4 rounded-2xl border border-emerald-200
                   bg-emerald-50 px-5 py-4 text-emerald-800
                   shadow-sm">

            <div
                class="flex h-9 w-9 shrink-0 items-center justify-center
                       rounded-xl bg-emerald-100 text-emerald-600">

                <x-heroicon-o-check-circle class="h-5 w-5"/>

            </div>

            <div class="min-w-0">

                <p class="font-bold">
                    Success
                </p>

                <p class="mt-0.5 text-sm text-emerald-700">
                    {{ session('success') }}
                </p>

            </div>

        </div>

    @endif


    {{-- =========================================================
         TRASH CONTENT
    ========================================================== --}}

    @if($organizations->count())

        <div
            class="overflow-hidden rounded-3xl border border-slate-200
                   bg-white shadow-[0_15px_45px_rgba(15,23,42,0.07)]">


            {{-- Table Header --}}

            <div
                class="flex flex-col gap-3 border-b border-slate-100
                       bg-gradient-to-r from-slate-50 to-white
                       px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-10 w-10 items-center justify-center
                               rounded-xl bg-slate-100 text-slate-600">

                        <x-heroicon-o-archive-box class="h-5 w-5"/>

                    </div>

                    <div>

                        <h2 class="text-lg font-extrabold text-slate-900">
                            Deleted Organizations
                        </h2>

                        <p class="text-sm text-slate-500">
                            Organizations currently in the trash
                        </p>

                    </div>

                </div>


                <span
                    class="inline-flex w-fit items-center rounded-full
                           bg-slate-100 px-3 py-1.5
                           text-xs font-bold text-slate-600">

                    {{ $organizations->total() }}
                    {{ Str::plural('Organization', $organizations->total()) }}

                </span>

            </div>


            {{-- Desktop Table --}}

            <div class="hidden overflow-x-auto md:block">

                <table class="w-full min-w-[760px]">

                    <thead>

                        <tr class="border-b border-slate-100 bg-slate-50/70">

                            <th
                                class="px-6 py-4 text-left text-xs font-extrabold
                                       uppercase tracking-wider text-slate-400">

                                Organization

                            </th>

                            <th
                                class="px-6 py-4 text-left text-xs font-extrabold
                                       uppercase tracking-wider text-slate-400">

                                Deleted

                            </th>

                            <th
                                class="px-6 py-4 text-right text-xs font-extrabold
                                       uppercase tracking-wider text-slate-400">

                                Actions

                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @foreach($organizations as $organization)

                            <tr class="transition-colors hover:bg-slate-50/70">


                                {{-- Organization --}}

                                <td class="px-6 py-5">

                                    <div class="flex min-w-0 items-center gap-4">

                                        <div
                                            class="flex h-11 w-11 shrink-0 items-center
                                                   justify-center rounded-xl
                                                   bg-gradient-to-br from-slate-100 to-slate-200
                                                   text-slate-600">

                                            <x-heroicon-o-building-office-2 class="h-5 w-5"/>

                                        </div>

                                        <div class="min-w-0">

                                            <h3
                                                class="break-words text-sm font-extrabold
                                                       text-slate-900">

                                                {{ $organization->name }}

                                            </h3>

                                            <p
                                                class="mt-1 break-all text-sm text-slate-500">

                                                {{ $organization->email ?: 'No email provided' }}

                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- Deleted --}}

                                <td class="px-6 py-5">

                                    <div class="flex items-center gap-2">

                                        <div
                                            class="flex h-8 w-8 items-center justify-center
                                                   rounded-lg bg-amber-50 text-amber-600">

                                            <x-heroicon-o-clock class="h-4 w-4"/>

                                        </div>

                                        <span class="text-sm font-semibold text-slate-600">

                                            {{ $organization->deleted_at->diffForHumans() }}

                                        </span>

                                    </div>

                                </td>


                                {{-- Actions --}}

                                <td class="px-6 py-5">

                                    <div class="flex flex-wrap justify-end gap-2">


                                        {{-- Restore --}}

                                        <form
                                            method="POST"
                                            action="{{ route('organizations.restore', $organization->id) }}">

                                            @csrf

                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="inline-flex h-10 items-center justify-center
                                                       gap-2 rounded-xl bg-emerald-600 px-4
                                                       text-sm font-bold text-white
                                                       shadow-sm shadow-emerald-600/20
                                                       transition-all
                                                       hover:-translate-y-0.5
                                                       hover:bg-emerald-700">

                                                <x-heroicon-o-arrow-path class="h-4 w-4"/>

                                                Restore

                                            </button>

                                        </form>


                                        {{-- Permanent Delete --}}

                                        <form
                                            method="POST"
                                            action="{{ route('organizations.force-delete', $organization->id) }}"
                                            onsubmit="return confirm('Permanently delete this organization? This action cannot be undone.')">

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="inline-flex h-10 items-center justify-center
                                                       gap-2 rounded-xl bg-red-600 px-4
                                                       text-sm font-bold text-white
                                                       shadow-sm shadow-red-600/20
                                                       transition-all
                                                       hover:-translate-y-0.5
                                                       hover:bg-red-700">

                                                <x-heroicon-o-trash class="h-4 w-4"/>

                                                Delete Forever

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- =================================================
                 MOBILE CARDS
            ================================================== --}}

            <div class="divide-y divide-slate-100 md:hidden">

                @foreach($organizations as $organization)

                    <div class="space-y-5 p-5">


                        <div class="flex min-w-0 items-start gap-4">

                            <div
                                class="flex h-11 w-11 shrink-0 items-center
                                       justify-center rounded-xl
                                       bg-slate-100 text-slate-600">

                                <x-heroicon-o-building-office-2 class="h-5 w-5"/>

                            </div>

                            <div class="min-w-0 flex-1">

                                <h3
                                    class="break-words font-extrabold text-slate-900">

                                    {{ $organization->name }}

                                </h3>

                                <p
                                    class="mt-1 break-all text-sm text-slate-500">

                                    {{ $organization->email ?: 'No email provided' }}

                                </p>

                            </div>

                        </div>


                        <div
                            class="flex items-center gap-2 rounded-xl
                                   bg-slate-50 px-4 py-3">

                            <x-heroicon-o-clock
                                class="h-4 w-4 text-amber-500"/>

                            <span class="text-sm font-semibold text-slate-600">

                                Deleted {{ $organization->deleted_at->diffForHumans() }}

                            </span>

                        </div>


                        <div class="grid grid-cols-2 gap-3">


                            <form
                                method="POST"
                                action="{{ route('organizations.restore', $organization->id) }}">

                                @csrf

                                @method('PATCH')

                                <button
                                    type="submit"
                                    class="inline-flex h-11 w-full items-center
                                           justify-center gap-2 rounded-xl
                                           bg-emerald-600 text-sm font-bold
                                           text-white shadow-sm
                                           hover:bg-emerald-700">

                                    <x-heroicon-o-arrow-path class="h-4 w-4"/>

                                    Restore

                                </button>

                            </form>


                            <form
                                method="POST"
                                action="{{ route('organizations.force-delete', $organization->id) }}"
                                onsubmit="return confirm('Permanently delete this organization? This action cannot be undone.')">

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="inline-flex h-11 w-full items-center
                                           justify-center gap-2 rounded-xl
                                           bg-red-600 text-sm font-bold
                                           text-white shadow-sm
                                           hover:bg-red-700">

                                    <x-heroicon-o-trash class="h-4 w-4"/>

                                    Delete Forever

                                </button>

                            </form>

                        </div>

                    </div>

                @endforeach

            </div>


            {{-- Pagination --}}

            @if($organizations->hasPages())

                <div
                    class="border-t border-slate-100 bg-slate-50/50
                           px-6 py-5">

                    {{ $organizations->links() }}

                </div>

            @endif

        </div>

    @else

        {{-- =====================================================
             EMPTY TRASH
        ====================================================== --}}

        <div
            class="overflow-hidden rounded-3xl border border-slate-200
                   bg-white shadow-[0_15px_45px_rgba(15,23,42,0.07)]">

            <div class="px-6 py-16 text-center sm:px-10">

                <div
                    class="mx-auto flex h-20 w-20 items-center justify-center
                           rounded-3xl bg-slate-100 text-slate-400">

                    <x-heroicon-o-trash class="h-9 w-9"/>

                </div>

                <h2 class="mt-6 text-2xl font-extrabold text-slate-900">
                    Trash is Empty
                </h2>

                <p class="mx-auto mt-3 max-w-lg text-sm leading-7 text-slate-500">
                    Deleted organizations will appear here until they are
                    restored or permanently deleted.
                </p>

                <a
                    href="{{ route('organizations.index') }}"
                    class="mt-7 inline-flex h-11 items-center justify-center
                           gap-2 rounded-xl
                           bg-gradient-to-r from-blue-600 to-cyan-500
                           px-6 text-sm font-bold text-white
                           shadow-lg shadow-blue-500/20
                           transition-all hover:-translate-y-0.5 hover:shadow-xl">

                    <x-heroicon-o-building-office-2 class="h-5 w-5"/>

                    View Organizations

                </a>

            </div>

        </div>

    @endif

</div>

@endsection