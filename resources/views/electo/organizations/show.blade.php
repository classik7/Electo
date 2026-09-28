@extends('electo.layouts.dashboard')

@section('title', $organization->name)
@section('page-title', 'Organization Details')

@section('content')

<div class="w-full min-w-0 space-y-8">

    {{-- =========================================================
         PAGE HEADER
    ========================================================== --}}

    <div class="flex flex-col gap-5 xl:flex-row xl:items-end xl:justify-between">

        <div class="min-w-0">

            <div class="flex items-center gap-3">

                <div
                    class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl
                           bg-gradient-to-br from-blue-600 to-cyan-500
                           text-white shadow-lg shadow-blue-500/20">

                    <x-heroicon-o-building-office-2 class="h-6 w-6"/>

                </div>

                <div class="min-w-0">

                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-blue-600">
                        Organization
                    </p>

                    <h1 class="mt-1 truncate text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
                        {{ $organization->name }}
                    </h1>

                </div>

            </div>

            <p class="mt-3 text-sm text-slate-500">
                Organization overview and management
            </p>

        </div>


        {{-- Actions --}}

        <div class="flex flex-wrap items-center gap-3">

            {{-- Delete --}}

            <button
                type="button"
                x-data
                x-on:click="$dispatch('open-modal', 'delete-organization')"
                class="inline-flex h-11 items-center justify-center gap-2 rounded-xl
                       bg-red-600 px-5 text-sm font-bold text-white
                       shadow-lg shadow-red-600/20
                       transition-all duration-200
                       hover:-translate-y-0.5 hover:bg-red-700">

                <x-heroicon-o-trash class="h-5 w-5"/>

                Delete

            </button>


            {{-- Edit --}}

            <a
                href="{{ route('organizations.edit', $organization) }}"
                class="inline-flex h-11 items-center justify-center gap-2 rounded-xl
                       bg-gradient-to-r from-blue-600 to-cyan-500
                       px-5 text-sm font-bold text-white
                       shadow-lg shadow-blue-500/20
                       transition-all duration-200
                       hover:-translate-y-0.5 hover:shadow-xl">

                <x-heroicon-o-pencil-square class="h-5 w-5"/>

                Edit Organization

            </a>


            {{-- Back --}}

            <a
                href="{{ route('organizations.index') }}"
                class="inline-flex h-11 items-center justify-center gap-2 rounded-xl
                       border border-slate-200 bg-white px-5
                       text-sm font-bold text-slate-700
                       shadow-sm
                       transition-all duration-200
                       hover:-translate-y-0.5 hover:border-slate-300 hover:bg-slate-50">

                <x-heroicon-o-arrow-left class="h-5 w-5"/>

                Back

            </a>

        </div>

    </div>


    {{-- =========================================================
         MAIN CONTENT
    ========================================================== --}}

    <div class="grid min-w-0 grid-cols-1 gap-6 xl:grid-cols-3">


        {{-- =====================================================
             LEFT COLUMN
        ====================================================== --}}

        <div class="min-w-0 space-y-6 xl:col-span-2">


            {{-- Organization Information --}}

            <div
                class="overflow-hidden rounded-3xl border border-slate-200
                       bg-white shadow-[0_15px_45px_rgba(15,23,42,0.07)]">

                {{-- Card Header --}}

                <div
                    class="flex flex-col gap-3 border-b border-slate-100
                           bg-gradient-to-r from-slate-50 to-white
                           px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

                    <div>

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-xl
                                       bg-blue-50 text-blue-600">

                                <x-heroicon-o-building-office-2 class="h-5 w-5"/>

                            </div>

                            <div>

                                <h2 class="text-lg font-extrabold text-slate-900">
                                    Organization Information
                                </h2>

                                <p class="text-sm text-slate-500">
                                    Basic information about this organization
                                </p>

                            </div>

                        </div>

                    </div>

                    <span
                        class="inline-flex w-fit items-center rounded-full
                               bg-blue-50 px-3 py-1.5 text-xs font-bold text-blue-700">

                        {{ ucfirst($organization->status ?? 'active') }}

                    </span>

                </div>


                {{-- Information Grid --}}

                <div class="grid min-w-0 grid-cols-1 gap-x-8 gap-y-7 p-6 sm:grid-cols-2 lg:p-8">


                    {{-- Organization Name --}}

                    <div class="min-w-0">

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Organization Name
                        </p>

                        <p class="mt-2 break-words text-base font-bold text-slate-900">
                            {{ $organization->name }}
                        </p>

                    </div>


                    {{-- Email --}}

                    <div class="min-w-0">

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Email
                        </p>

                        <p class="mt-2 break-all text-base font-semibold text-slate-700">
                            {{ $organization->email ?: 'Not provided' }}
                        </p>

                    </div>


                    {{-- Phone --}}

                    <div class="min-w-0">

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Phone Number
                        </p>

                        <p class="mt-2 break-words text-base font-semibold text-slate-700">
                            {{ $organization->phone ?: 'Not provided' }}
                        </p>

                    </div>


                    {{-- Website --}}

                    <div class="min-w-0">

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Website
                        </p>

                        @if($organization->website)

                            <a
                                href="{{ $organization->website }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="mt-2 block break-all text-base font-semibold text-blue-600 hover:text-blue-700 hover:underline">

                                {{ $organization->website }}

                            </a>

                        @else

                            <p class="mt-2 text-base font-semibold text-slate-400">
                                Not provided
                            </p>

                        @endif

                    </div>


                    {{-- Location --}}

                    <div class="min-w-0">

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Location
                        </p>

                        <p class="mt-2 break-words text-base font-semibold text-slate-700">

                            {{ collect([
                                $organization->city,
                                $organization->state,
                                $organization->country
                            ])->filter()->implode(', ') ?: 'Not provided' }}

                        </p>

                    </div>


                    {{-- Address --}}

                    <div class="min-w-0">

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Address
                        </p>

                        <p class="mt-2 break-words text-base font-semibold text-slate-700">
                            {{ $organization->address ?: 'Not provided' }}
                        </p>

                    </div>


                    {{-- Created --}}

                    <div class="min-w-0">

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Created
                        </p>

                        <p class="mt-2 text-base font-semibold text-slate-700">
                            {{ $organization->created_at?->format('d M Y') ?? 'Not available' }}
                        </p>

                    </div>


                    {{-- Subscription --}}

                    <div class="min-w-0">

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Subscription Plan
                        </p>

                        <p class="mt-2 text-base font-bold capitalize text-slate-900">
                            {{ $organization->subscription_plan ?? 'Free' }}
                        </p>

                    </div>

                </div>

            </div>



            {{-- =================================================
                 DESCRIPTION
            ================================================== --}}

            <div
                class="overflow-hidden rounded-3xl border border-slate-200
                       bg-white shadow-[0_15px_45px_rgba(15,23,42,0.07)]">

                <div class="border-b border-slate-100 px-6 py-5 lg:px-8">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl
                                   bg-cyan-50 text-cyan-600">

                            <x-heroicon-o-document-text class="h-5 w-5"/>

                        </div>

                        <div>

                            <h2 class="text-lg font-extrabold text-slate-900">
                                Description
                            </h2>

                            <p class="text-sm text-slate-500">
                                About this organization
                            </p>

                        </div>

                    </div>

                </div>


                <div class="p-6 lg:p-8">

                    @if($organization->description)

                        <p class="whitespace-pre-line break-words text-[15px] leading-8 text-slate-600">
                            {{ $organization->description }}
                        </p>

                    @else

                        <div
                            class="rounded-2xl border border-dashed border-slate-200
                                   bg-slate-50 px-6 py-8 text-center">

                            <x-heroicon-o-document-text
                                class="mx-auto h-8 w-8 text-slate-300"/>

                            <p class="mt-3 text-sm font-semibold text-slate-500">
                                No description has been added yet.
                            </p>

                            <a
                                href="{{ route('organizations.edit', $organization) }}"
                                class="mt-3 inline-block text-sm font-bold text-blue-600 hover:text-blue-700">

                                Add description →

                            </a>

                        </div>

                    @endif

                </div>

            </div>



            {{-- =================================================
                 MANAGEMENT / ACTIVITY
            ================================================== --}}

            <div
                class="overflow-hidden rounded-3xl border border-slate-200
                       bg-gradient-to-br from-slate-900 via-blue-950 to-slate-900
                       p-6 text-white shadow-[0_20px_60px_rgba(15,23,42,0.15)] lg:p-8">

                <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                    <div>

                        <p class="text-xs font-bold uppercase tracking-[0.18em] text-cyan-400">
                            Electo Platform
                        </p>

                        <h2 class="mt-2 text-xl font-extrabold">
                            Ready to manage your elections?
                        </h2>

                        <p class="mt-2 max-w-xl text-sm leading-6 text-slate-300">
                            Create elections, manage candidates, register voters
                            and monitor results from one secure workspace.
                        </p>

                    </div>

                    <a
                        href="#"
                        class="inline-flex shrink-0 items-center justify-center gap-2
                               rounded-xl bg-white px-5 py-3
                               text-sm font-bold text-slate-900
                               transition hover:bg-slate-100">

                        Manage Elections

                        <x-heroicon-o-arrow-right class="h-4 w-4"/>

                    </a>

                </div>

            </div>

        </div>



        {{-- =====================================================
             RIGHT COLUMN
        ====================================================== --}}

        <div class="min-w-0 space-y-6">


            {{-- =================================================
                 STATUS CARD
            ================================================== --}}

            <div
                class="overflow-hidden rounded-3xl border border-slate-200
                       bg-white shadow-[0_15px_45px_rgba(15,23,42,0.07)]">

                <div class="border-b border-slate-100 px-6 py-5">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl
                                   bg-emerald-50 text-emerald-600">

                            <x-heroicon-o-shield-check class="h-5 w-5"/>

                        </div>

                        <div>

                            <h3 class="text-lg font-extrabold text-slate-900">
                                Organization Status
                            </h3>

                            <p class="text-sm text-slate-500">
                                Current account status
                            </p>

                        </div>

                    </div>

                </div>


                <div class="space-y-5 p-6">


                    {{-- Status --}}

                    <div class="flex items-center justify-between gap-4">

                        <span class="text-sm font-semibold text-slate-600">
                            Status
                        </span>

                        @if(($organization->status ?? '') === 'active')

                            <span
                                class="inline-flex shrink-0 items-center gap-1.5 rounded-full
                                       bg-emerald-50 px-3 py-1.5
                                       text-xs font-bold text-emerald-700">

                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                Active

                            </span>

                        @else

                            <span
                                class="inline-flex shrink-0 items-center gap-1.5 rounded-full
                                       bg-red-50 px-3 py-1.5
                                       text-xs font-bold text-red-700">

                                <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>

                                {{ ucfirst($organization->status ?? 'Inactive') }}

                            </span>

                        @endif

                    </div>


                    {{-- Verification --}}

                    <div class="flex items-center justify-between gap-4">

                        <span class="text-sm font-semibold text-slate-600">
                            Verification
                        </span>

                        @if(($organization->verification_status ?? 'pending') === 'verified')

                            <span
                                class="inline-flex shrink-0 items-center gap-1.5 rounded-full
                                       bg-emerald-50 px-3 py-1.5
                                       text-xs font-bold text-emerald-700">

                                <x-heroicon-o-check-circle class="h-4 w-4"/>

                                Verified

                            </span>

                        @else

                            <span
                                class="inline-flex shrink-0 items-center gap-1.5 rounded-full
                                       bg-amber-50 px-3 py-1.5
                                       text-xs font-bold text-amber-700">

                                <x-heroicon-o-clock class="h-4 w-4"/>

                                {{ ucfirst($organization->verification_status ?? 'Pending') }}

                            </span>

                        @endif

                    </div>


                    {{-- Plan --}}

                    <div class="flex items-center justify-between gap-4">

                        <span class="text-sm font-semibold text-slate-600">
                            Plan
                        </span>

                        <span
                            class="inline-flex shrink-0 items-center rounded-full
                                   bg-blue-50 px-3 py-1.5
                                   text-xs font-bold capitalize text-blue-700">

                            {{ $organization->subscription_plan ?? 'Free' }}

                        </span>

                    </div>

                </div>

            </div>



            {{-- =================================================
                 QUICK STATISTICS
            ================================================== --}}

            <div
                class="overflow-hidden rounded-3xl border border-slate-200
                       bg-white shadow-[0_15px_45px_rgba(15,23,42,0.07)]">

                <div class="border-b border-slate-100 px-6 py-5">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl
                                   bg-violet-50 text-violet-600">

                            <x-heroicon-o-chart-bar class="h-5 w-5"/>

                        </div>

                        <div>

                            <h3 class="text-lg font-extrabold text-slate-900">
                                Quick Statistics
                            </h3>

                            <p class="text-sm text-slate-500">
                                Organization overview
                            </p>

                        </div>

                    </div>

                </div>


                <div class="grid grid-cols-2 gap-3 p-6">


                    {{-- Elections --}}

                    <div
                        class="rounded-2xl border border-slate-100
                               bg-slate-50 p-4">

                        <div class="flex items-center justify-between">

                            <span class="text-xs font-bold uppercase tracking-wide text-slate-400">
                                Elections
                            </span>

                            <x-heroicon-o-clipboard-document-list
                                class="h-5 w-5 text-blue-500"/>

                        </div>

                        <p class="mt-3 text-2xl font-extrabold text-slate-900">
                            0
                        </p>

                    </div>


                    {{-- Members --}}

                    <div
                        class="rounded-2xl border border-slate-100
                               bg-slate-50 p-4">

                        <div class="flex items-center justify-between">

                            <span class="text-xs font-bold uppercase tracking-wide text-slate-400">
                                Members
                            </span>

                            <x-heroicon-o-users
                                class="h-5 w-5 text-cyan-500"/>

                        </div>

                        <p class="mt-3 text-2xl font-extrabold text-slate-900">
                            1
                        </p>

                    </div>


                    {{-- Candidates --}}

                    <div
                        class="rounded-2xl border border-slate-100
                               bg-slate-50 p-4">

                        <div class="flex items-center justify-between">

                            <span class="text-xs font-bold uppercase tracking-wide text-slate-400">
                                Candidates
                            </span>

                            <x-heroicon-o-user-group
                                class="h-5 w-5 text-violet-500"/>

                        </div>

                        <p class="mt-3 text-2xl font-extrabold text-slate-900">
                            0
                        </p>

                    </div>


                    {{-- Voters --}}

                    <div
                        class="rounded-2xl border border-slate-100
                               bg-slate-50 p-4">

                        <div class="flex items-center justify-between">

                            <span class="text-xs font-bold uppercase tracking-wide text-slate-400">
                                Voters
                            </span>

                            <x-heroicon-o-identification
                                class="h-5 w-5 text-emerald-500"/>

                        </div>

                        <p class="mt-3 text-2xl font-extrabold text-slate-900">
                            0
                        </p>

                    </div>

                </div>

            </div>



            {{-- =================================================
                 SECURITY CARD
            ================================================== --}}

            <div
                class="overflow-hidden rounded-3xl border border-blue-100
                       bg-gradient-to-br from-blue-50 via-white to-cyan-50
                       p-6 shadow-[0_15px_45px_rgba(37,99,235,0.08)]">

                <div class="flex items-start gap-4">

                    <div
                        class="flex h-11 w-11 shrink-0 items-center justify-center
                               rounded-2xl bg-blue-600 text-white
                               shadow-lg shadow-blue-600/20">

                        <x-heroicon-o-lock-closed class="h-5 w-5"/>

                    </div>

                    <div class="min-w-0">

                        <h3 class="font-extrabold text-slate-900">
                            Secure Organization
                        </h3>

                        <p class="mt-1 text-sm leading-6 text-slate-500">
                            Your organization is protected by Electo's
                            secure election infrastructure.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



{{-- =============================================================
     DELETE CONFIRMATION MODAL
============================================================== --}}

<x-electo.modal
    name="delete-organization"
    title="Delete Organization">

    <div class="space-y-6">


        {{-- Warning --}}

        <div class="flex items-start gap-4">

            <div
                class="flex h-12 w-12 shrink-0 items-center justify-center
                       rounded-2xl bg-red-50 text-red-600">

                <x-heroicon-o-exclamation-triangle class="h-6 w-6"/>

            </div>

            <div class="min-w-0">

                <h3 class="text-lg font-extrabold text-slate-900">
                    Move Organization to Trash?
                </h3>

                <p class="mt-2 text-sm leading-6 text-slate-500">
                    This organization will be moved to the Trash.
                    You can restore it later if needed.
                </p>

            </div>

        </div>


        {{-- Organization preview --}}

        <div
            class="rounded-2xl border border-slate-200 bg-slate-50 p-4">

            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                Organization
            </p>

            <p class="mt-1 break-words font-bold text-slate-900">
                {{ $organization->name }}
            </p>

        </div>


        {{-- Actions --}}

        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

            <button
                type="button"
                x-on:click="$dispatch('close-modal', 'delete-organization')"
                class="inline-flex h-11 items-center justify-center rounded-xl
                       border border-slate-200 bg-white px-5
                       text-sm font-bold text-slate-700
                       hover:bg-slate-50">

                Cancel

            </button>


            <form
                method="POST"
                action="{{ route('organizations.destroy', $organization) }}">

                @csrf

                @method('DELETE')

                <button
                    type="submit"
                    class="inline-flex h-11 w-full items-center justify-center gap-2
                           rounded-xl bg-red-600 px-5
                           text-sm font-bold text-white
                           shadow-lg shadow-red-600/20
                           transition hover:bg-red-700 sm:w-auto">

                    <x-heroicon-o-trash class="h-5 w-5"/>

                    Move to Trash

                </button>

            </form>

        </div>

    </div>

</x-electo.modal>

@endsection