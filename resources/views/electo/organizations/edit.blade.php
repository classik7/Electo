@extends('electo.layouts.dashboard')

@section('title', 'Edit Organization')
@section('page-title', 'Edit Organization')

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
                           rounded-2xl bg-gradient-to-br from-blue-600 to-cyan-500
                           text-white shadow-lg shadow-blue-500/20">

                    <x-heroicon-o-pencil-square class="h-6 w-6"/>

                </div>

                <div class="min-w-0">

                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-blue-600">
                        Organization Settings
                    </p>

                    <h1 class="mt-1 truncate text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
                        Edit Organization
                    </h1>

                </div>

            </div>

            <p class="mt-3 text-sm text-slate-500">
                Update the information and settings for
                <span class="font-semibold text-slate-700">
                    {{ $organization->name }}
                </span>
            </p>

        </div>


        {{-- Back Button --}}

        <a
            href="{{ route('organizations.show', $organization) }}"
            class="inline-flex h-11 w-fit items-center justify-center gap-2 rounded-xl
                   border border-slate-200 bg-white px-5
                   text-sm font-bold text-slate-700
                   shadow-sm transition-all duration-200
                   hover:-translate-y-0.5 hover:border-slate-300 hover:bg-slate-50">

            <x-heroicon-o-arrow-left class="h-5 w-5"/>

            Back to Organization

        </a>

    </div>


    {{-- =========================================================
         EDIT LAYOUT
    ========================================================== --}}

    <div class="grid min-w-0 grid-cols-1 gap-6 xl:grid-cols-3">


        {{-- =====================================================
             MAIN FORM
        ====================================================== --}}

        <div class="min-w-0 xl:col-span-2">

            <div
                class="overflow-hidden rounded-3xl border border-slate-200
                       bg-white shadow-[0_15px_45px_rgba(15,23,42,0.07)]">


                {{-- Form Header --}}

                <div
                    class="border-b border-slate-100
                           bg-gradient-to-r from-slate-50 to-white
                           px-6 py-6 lg:px-8">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center
                                   rounded-xl bg-blue-50 text-blue-600">

                            <x-heroicon-o-building-office-2 class="h-5 w-5"/>

                        </div>

                        <div>

                            <h2 class="text-lg font-extrabold text-slate-900">
                                Organization Information
                            </h2>

                            <p class="text-sm text-slate-500">
                                Keep your organization details accurate and up to date.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Form --}}

                <form
                    method="POST"
                    action="{{ route('organizations.update', $organization) }}"
                    class="p-6 lg:p-8">

                    @csrf

                    @method('PUT')


                    {{-- Form Fields --}}

                    @include('electo.organizations.partials.form')


                    {{-- Divider --}}

                    <div class="my-8 border-t border-slate-100"></div>


                    {{-- Actions --}}

                    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                        <a
                            href="{{ route('organizations.show', $organization) }}"
                            class="inline-flex h-12 items-center justify-center rounded-xl
                                   border border-slate-200 bg-white px-6
                                   text-sm font-bold text-slate-700
                                   transition hover:bg-slate-50">

                            Cancel

                        </a>


                        <button
                            type="submit"
                            class="inline-flex h-12 items-center justify-center gap-2 rounded-xl
                                   bg-gradient-to-r from-blue-600 to-cyan-500
                                   px-7 text-sm font-bold text-white
                                   shadow-lg shadow-blue-500/20
                                   transition-all duration-200
                                   hover:-translate-y-0.5 hover:shadow-xl">

                            <x-heroicon-o-check class="h-5 w-5"/>

                            Save Changes

                        </button>

                    </div>

                </form>

            </div>

        </div>



        {{-- =====================================================
             SIDEBAR
        ====================================================== --}}

        <div class="min-w-0 space-y-6">


            {{-- Organization Preview --}}

            <div
                class="overflow-hidden rounded-3xl border border-slate-200
                       bg-white shadow-[0_15px_45px_rgba(15,23,42,0.07)]">

                <div
                    class="border-b border-slate-100
                           bg-gradient-to-br from-blue-600 via-blue-600 to-cyan-500
                           px-6 py-7 text-white">

                    <div
                        class="flex h-14 w-14 items-center justify-center
                               rounded-2xl bg-white/15
                               ring-1 ring-white/20 backdrop-blur">

                        <x-heroicon-o-building-office-2 class="h-7 w-7"/>

                    </div>

                    <h3 class="mt-5 break-words text-xl font-extrabold">
                        {{ $organization->name }}
                    </h3>

                    <p class="mt-1 text-sm text-blue-100">
                        Organization Profile
                    </p>

                </div>


                <div class="space-y-5 p-6">


                    {{-- Status --}}

                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Current Status
                        </p>

                        <div class="mt-2">

                            @if(($organization->status ?? '') === 'active')

                                <span
                                    class="inline-flex items-center gap-2 rounded-full
                                           bg-emerald-50 px-3 py-1.5
                                           text-xs font-bold text-emerald-700">

                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                    Active

                                </span>

                            @else

                                <span
                                    class="inline-flex items-center gap-2 rounded-full
                                           bg-slate-100 px-3 py-1.5
                                           text-xs font-bold text-slate-600">

                                    <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>

                                    {{ ucfirst($organization->status ?? 'Inactive') }}

                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- Verification --}}

                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Verification
                        </p>

                        <div class="mt-2">

                            @if(($organization->verification_status ?? 'pending') === 'verified')

                                <span
                                    class="inline-flex items-center gap-2 rounded-full
                                           bg-emerald-50 px-3 py-1.5
                                           text-xs font-bold text-emerald-700">

                                    <x-heroicon-o-check-circle class="h-4 w-4"/>

                                    Verified

                                </span>

                            @else

                                <span
                                    class="inline-flex items-center gap-2 rounded-full
                                           bg-amber-50 px-3 py-1.5
                                           text-xs font-bold text-amber-700">

                                    <x-heroicon-o-clock class="h-4 w-4"/>

                                    {{ ucfirst($organization->verification_status ?? 'Pending') }}

                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- Plan --}}

                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Subscription Plan
                        </p>

                        <p class="mt-2 font-extrabold capitalize text-slate-900">
                            {{ $organization->subscription_plan ?? 'Free' }}
                        </p>

                    </div>

                </div>

            </div>



            {{-- Helpful Information --}}

            <div
                class="overflow-hidden rounded-3xl border border-blue-100
                       bg-gradient-to-br from-blue-50 via-white to-cyan-50
                       p-6 shadow-[0_15px_45px_rgba(37,99,235,0.08)]">

                <div class="flex items-start gap-4">

                    <div
                        class="flex h-11 w-11 shrink-0 items-center justify-center
                               rounded-2xl bg-blue-600 text-white
                               shadow-lg shadow-blue-600/20">

                        <x-heroicon-o-information-circle class="h-5 w-5"/>

                    </div>

                    <div class="min-w-0">

                        <h3 class="font-extrabold text-slate-900">
                            Keep your details current
                        </h3>

                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Accurate organization information helps members,
                            voters and administrators identify your organization
                            correctly across the Electo platform.
                        </p>

                    </div>

                </div>

            </div>



            {{-- Security Notice --}}

            <div
                class="rounded-3xl border border-slate-200
                       bg-white p-6
                       shadow-[0_15px_45px_rgba(15,23,42,0.05)]">

                <div class="flex items-start gap-4">

                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center
                               rounded-xl bg-emerald-50 text-emerald-600">

                        <x-heroicon-o-shield-check class="h-5 w-5"/>

                    </div>

                    <div class="min-w-0">

                        <h3 class="font-extrabold text-slate-900">
                            Your data is secure
                        </h3>

                        <p class="mt-1 text-sm leading-6 text-slate-500">
                            Changes are protected by your authenticated
                            Electo account.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection