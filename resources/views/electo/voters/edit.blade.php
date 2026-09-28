@extends('electo.layouts.app')

@section('title', 'Edit ' . $voter->name . ' | Voter | Electo')

@section('content')

<div class="mx-auto w-full max-w-6xl space-y-7 pb-10">

    {{-- ============================================================
        PAGE HEADER
    ============================================================= --}}

    <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

        <div class="flex min-w-0 items-center gap-3">

            <a
                href="{{ route('voters.show', $voter) }}"
                class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl
                       border border-slate-200
                       bg-white
                       text-slate-500
                       shadow-sm
                       transition
                       hover:border-blue-200
                       hover:bg-blue-50
                       hover:text-blue-600
                       dark:border-white/10
                       dark:bg-[#101a2f]
                       dark:text-slate-400
                       dark:hover:border-blue-500/30
                       dark:hover:bg-blue-500/10
                       dark:hover:text-blue-400"
                title="Back to voter profile"
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
                        d="M15 19l-7-7 7-7"
                    />
                </svg>
            </a>


            <div class="min-w-0">

                <div class="flex flex-wrap items-center gap-2">

                    <span
                        class="text-[10px] font-bold uppercase tracking-[0.18em]
                               text-blue-600
                               dark:text-blue-400"
                    >
                        Voter Management
                    </span>

                    <span
                        class="hidden h-1 w-1 rounded-full bg-slate-300 sm:block
                               dark:bg-slate-600"
                    ></span>

                    <span class="text-xs text-slate-400">
                        {{ $voter->voter_id }}
                    </span>

                </div>

                <h1
                    class="mt-1 text-3xl font-black tracking-tight
                           text-slate-900
                           dark:text-white"
                >
                    Edit Voter
                </h1>

                <p
                    class="mt-1 text-sm text-slate-500
                           dark:text-slate-400"
                >
                    Update {{ $voter->name }}'s personal information and account status.
                </p>

            </div>

        </div>


        {{-- Current status --}}
        <div
            class="hidden rounded-2xl border border-slate-200 bg-white px-4 py-3 shadow-sm sm:block
                   dark:border-white/10 dark:bg-[#101a2f]"
        >

            <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                Current Status
            </p>

            <div class="mt-1.5 flex items-center gap-2">

                @if($voter->status === 'active')

                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>

                    <span class="text-sm font-bold text-emerald-700 dark:text-emerald-400">
                        Active
                    </span>

                @elseif($voter->status === 'suspended')

                    <span class="h-2 w-2 rounded-full bg-red-500"></span>

                    <span class="text-sm font-bold text-red-700 dark:text-red-400">
                        Suspended
                    </span>

                @else

                    <span class="h-2 w-2 rounded-full bg-slate-400"></span>

                    <span class="text-sm font-bold text-slate-600 dark:text-slate-400">
                        Inactive
                    </span>

                @endif

            </div>

        </div>

    </div>



    {{-- ============================================================
        VALIDATION ERRORS
    ============================================================= --}}

    @if($errors->any())

        <div
            class="overflow-hidden rounded-2xl
                   border border-red-200
                   bg-red-50
                   shadow-sm
                   dark:border-red-500/20
                   dark:bg-red-500/10"
        >

            <div class="h-1 bg-gradient-to-r from-red-500 to-rose-400"></div>

            <div class="flex gap-3 p-5">

                <div
                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl
                           bg-red-100
                           text-red-600
                           dark:bg-red-500/10
                           dark:text-red-400"
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
                            d="M12 9v4m0 4h.01"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M10.3 3.6L2.7 17a2 2 0 001.7 3h15.2a2 2 0 001.7-3L13.7 3.6a2 2 0 00-3.4 0z"
                        />
                    </svg>
                </div>

                <div class="min-w-0">

                    <h3 class="font-bold text-red-800 dark:text-red-300">
                        Please review the highlighted information
                    </h3>

                    <ul class="mt-2 space-y-1 text-sm text-red-700 dark:text-red-400">

                        @foreach($errors->all() as $error)

                            <li>
                                <span class="mr-1">•</span>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif



    {{-- ============================================================
        FORM
    ============================================================= --}}

    <form
        method="POST"
        action="{{ route('voters.update', $voter) }}"
        enctype="multipart/form-data"
        class="space-y-6"
    >

        @csrf
        @method('PUT')


        {{-- ========================================================
            IDENTITY + STATUS
        ========================================================= --}}

        <section
            class="overflow-hidden rounded-3xl
                   border border-slate-200
                   bg-white
                   shadow-sm
                   dark:border-white/10
                   dark:bg-[#101a2f]"
        >

            <div class="h-1 bg-gradient-to-r from-blue-600 via-indigo-500 to-cyan-400"></div>

            <div class="border-b border-slate-100 px-5 py-5 dark:border-white/10 sm:px-6">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-xl
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
                                d="M15 7a3 3 0 11-6 0 3 3 0 016 0z"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M5 21a7 7 0 0114 0"
                            />
                        </svg>
                    </div>

                    <div>

                        <h2 class="font-black text-slate-900 dark:text-white">
                            Personal Information
                        </h2>

                        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                            Keep the voter's identity and registry details accurate.
                        </p>

                    </div>

                </div>

            </div>


            <div class="grid gap-6 p-5 sm:p-6 md:grid-cols-2">

                {{-- Full name --}}

                <div class="md:col-span-2">

                    <label
                        for="name"
                        class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-200"
                    >
                        Full Name
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name', $voter->name) }}"
                        required
                        autocomplete="name"
                        class="w-full rounded-xl
                               border border-slate-200
                               bg-slate-50
                               px-4 py-3.5
                               text-sm font-medium text-slate-800
                               outline-none
                               transition
                               placeholder:text-slate-400
                               focus:border-blue-500
                               focus:bg-white
                               focus:ring-4
                               focus:ring-blue-500/10
                               dark:border-white/10
                               dark:bg-white/[0.03]
                               dark:text-white
                               dark:focus:border-blue-500/40
                               dark:focus:bg-white/[0.05]"
                    >

                    @error('name')
                        <p class="mt-2 text-xs font-semibold text-red-600 dark:text-red-400">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Voter ID --}}

                <div>

                    <label
                        for="voter_id"
                        class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-200"
                    >
                        Voter ID
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        id="voter_id"
                        type="text"
                        name="voter_id"
                        value="{{ old('voter_id', $voter->voter_id) }}"
                        required
                        autocomplete="off"
                        class="w-full rounded-xl
                               border border-slate-200
                               bg-slate-50
                               px-4 py-3.5
                               font-mono text-sm font-semibold
                               uppercase
                               text-slate-800
                               outline-none
                               transition
                               focus:border-blue-500
                               focus:bg-white
                               focus:ring-4
                               focus:ring-blue-500/10
                               dark:border-white/10
                               dark:bg-white/[0.03]
                               dark:text-white
                               dark:focus:border-blue-500/40"
                    >

                    <p class="mt-2 text-xs text-slate-400">
                        This identifier must remain unique.
                    </p>

                    @error('voter_id')
                        <p class="mt-2 text-xs font-semibold text-red-600 dark:text-red-400">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Status --}}

                <div>

                    <label
                        for="status"
                        class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-200"
                    >
                        Account Status
                        <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="status"
                        name="status"
                        required
                        class="w-full rounded-xl
                               border border-slate-200
                               bg-slate-50
                               px-4 py-3.5
                               text-sm font-semibold
                               text-slate-800
                               outline-none
                               transition
                               focus:border-blue-500
                               focus:bg-white
                               focus:ring-4
                               focus:ring-blue-500/10
                               dark:border-white/10
                               dark:bg-white/[0.03]
                               dark:text-white
                               dark:focus:border-blue-500/40"
                    >

                        <option
                            value="active"
                            @selected(old('status', $voter->status) === 'active')
                        >
                            Active
                        </option>

                        <option
                            value="inactive"
                            @selected(old('status', $voter->status) === 'inactive')
                        >
                            Inactive
                        </option>

                        <option
                            value="suspended"
                            @selected(old('status', $voter->status) === 'suspended')
                        >
                            Suspended
                        </option>

                    </select>

                    <p class="mt-2 text-xs text-slate-400">
                        Suspended voters should not be allowed to participate in voting.
                    </p>

                    @error('status')
                        <p class="mt-2 text-xs font-semibold text-red-600 dark:text-red-400">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

        </section>



        {{-- ========================================================
            CONTACT INFORMATION
        ========================================================= --}}

        <section
            class="overflow-hidden rounded-3xl
                   border border-slate-200
                   bg-white
                   shadow-sm
                   dark:border-white/10
                   dark:bg-[#101a2f]"
        >

            <div class="border-b border-slate-100 px-5 py-5 dark:border-white/10 sm:px-6">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-xl
                               bg-emerald-50
                               text-emerald-600
                               dark:bg-emerald-500/10
                               dark:text-emerald-400"
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
                                d="M3 5a2 2 0 012-2h3.28a2 2 0 011.94 1.515l.7 2.805a2 2 0 01-.45 1.8L8.91 10.68a16.02 16.02 0 006.41 6.41l1.56-1.56a2 2 0 011.8-.45l2.805.7A2 2 0 0123 17.72V21a2 2 0 01-2 2h-1C10.163 23 3 15.837 3 7V5z"
                            />
                        </svg>

                    </div>

                    <div>

                        <h2 class="font-black text-slate-900 dark:text-white">
                            Contact Information
                        </h2>

                        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                            Keep communication details current for voter administration.
                        </p>

                    </div>

                </div>

            </div>


            <div class="grid gap-6 p-5 sm:p-6 md:grid-cols-2">

                {{-- Email --}}

                <div>

                    <label
                        for="email"
                        class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-200"
                    >
                        Email Address
                    </label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email', $voter->email) }}"
                        placeholder="voter@example.com"
                        autocomplete="email"
                        class="w-full rounded-xl
                               border border-slate-200
                               bg-slate-50
                               px-4 py-3.5
                               text-sm font-medium text-slate-800
                               outline-none
                               transition
                               placeholder:text-slate-400
                               focus:border-blue-500
                               focus:bg-white
                               focus:ring-4
                               focus:ring-blue-500/10
                               dark:border-white/10
                               dark:bg-white/[0.03]
                               dark:text-white
                               dark:placeholder:text-slate-500
                               dark:focus:border-blue-500/40"
                    >

                    @error('email')
                        <p class="mt-2 text-xs font-semibold text-red-600 dark:text-red-400">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Phone --}}

                <div>

                    <label
                        for="phone"
                        class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-200"
                    >
                        Phone Number
                    </label>

                    <input
                        id="phone"
                        type="tel"
                        name="phone"
                        value="{{ old('phone', $voter->phone) }}"
                        placeholder="08012345678"
                        autocomplete="tel"
                        class="w-full rounded-xl
                               border border-slate-200
                               bg-slate-50
                               px-4 py-3.5
                               text-sm font-medium text-slate-800
                               outline-none
                               transition
                               placeholder:text-slate-400
                               focus:border-blue-500
                               focus:bg-white
                               focus:ring-4
                               focus:ring-blue-500/10
                               dark:border-white/10
                               dark:bg-white/[0.03]
                               dark:text-white
                               dark:placeholder:text-slate-500
                               dark:focus:border-blue-500/40"
                    >

                    @error('phone')
                        <p class="mt-2 text-xs font-semibold text-red-600 dark:text-red-400">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

        </section>



        {{-- ========================================================
            PHOTO
        ========================================================= --}}

        <section
            class="overflow-hidden rounded-3xl
                   border border-slate-200
                   bg-white
                   shadow-sm
                   dark:border-white/10
                   dark:bg-[#101a2f]"
        >

            <div class="border-b border-slate-100 px-5 py-5 dark:border-white/10 sm:px-6">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-xl
                               bg-purple-50
                               text-purple-600
                               dark:bg-purple-500/10
                               dark:text-purple-400"
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
                                d="M4 16l4-4a3 3 0 014 0l4 4"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M17 8h.01"
                            />

                            <rect
                                x="3"
                                y="4"
                                width="18"
                                height="16"
                                rx="2"
                            />
                        </svg>
                    </div>

                    <div>

                        <h2 class="font-black text-slate-900 dark:text-white">
                            Profile Photo
                        </h2>

                        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                            Update the image displayed across Electo voter profiles.
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-5 sm:p-6">

                <div class="grid gap-6 lg:grid-cols-[auto_1fr] lg:items-center">

                    {{-- Current photo --}}

                    <div class="flex justify-center lg:justify-start">

                        @if($voter->photo)

                            <div class="relative">

                                <img
                                    src="{{ asset('storage/' . $voter->photo) }}"
                                    alt="{{ $voter->name }}"
                                    class="h-28 w-28 rounded-3xl object-cover
                                           ring-4 ring-slate-100
                                           dark:ring-white/10"
                                >

                                <span
                                    class="absolute -bottom-2 -right-2
                                           flex h-8 w-8 items-center justify-center
                                           rounded-xl
                                           border-4 border-white
                                           bg-emerald-500
                                           text-white
                                           dark:border-[#101a2f]"
                                >
                                    <svg class="h-3.5 w-3.5"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor"
                                         stroke-width="2">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M5 13l4 4L19 7"/>
                                    </svg>
                                </span>

                            </div>

                        @else

                            <div
                                class="flex h-28 w-28 items-center justify-center rounded-3xl
                                       bg-gradient-to-br from-blue-600 to-cyan-500
                                       text-3xl font-black text-white
                                       shadow-lg shadow-blue-500/20"
                            >
                                {{ strtoupper(substr($voter->name, 0, 1)) }}
                            </div>

                        @endif

                    </div>


                    {{-- Upload zone --}}

                    <div>

                        <label
                            for="photo"
                            class="group flex cursor-pointer items-center gap-4
                                   rounded-2xl
                                   border-2 border-dashed
                                   border-slate-200
                                   bg-slate-50
                                   px-5 py-5
                                   transition
                                   hover:border-blue-300
                                   hover:bg-blue-50/50
                                   dark:border-white/10
                                   dark:bg-white/[0.03]
                                   dark:hover:border-blue-500/30
                                   dark:hover:bg-blue-500/[0.04]"
                        >

                            <div
                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl
                                       bg-white text-blue-600 shadow-sm
                                       dark:bg-white/5 dark:text-blue-400"
                            >
                                <svg
                                    class="h-6 w-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 16V4m0 0L8 8m4-4l4 4"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M4 16v3a1 1 0 001 1h14a1 1 0 001-1v-3"
                                    />
                                </svg>
                            </div>

                            <div class="min-w-0">

                                <p class="text-sm font-bold text-slate-800 dark:text-slate-200">
                                    Choose a new voter photo
                                    <span class="font-normal text-slate-400">
                                        (Optional)
                                    </span>
                                </p>

                                <p class="mt-1 text-xs leading-5 text-slate-500 dark:text-slate-400">
                                    Leave unchanged to keep the current photo.
                                </p>

                                <p class="mt-1 text-xs text-slate-400">
                                    JPG, JPEG or PNG · Maximum 2MB
                                </p>

                            </div>

                            <input
                                id="photo"
                                type="file"
                                name="photo"
                                accept="image/jpeg,image/png,image/jpg"
                                class="hidden"
                            >

                        </label>

                        @error('photo')
                            <p class="mt-2 text-xs font-semibold text-red-600 dark:text-red-400">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </div>

        </section>



        {{-- ========================================================
            IMPORTANT NOTICE
        ========================================================= --}}

        <div
            class="rounded-2xl
                   border border-blue-100
                   bg-blue-50
                   p-5
                   dark:border-blue-500/10
                   dark:bg-blue-500/[0.05]"
        >

            <div class="flex gap-3">

                <div
                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl
                           bg-white
                           text-blue-600
                           shadow-sm
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
                        <circle
                            cx="12"
                            cy="12"
                            r="9"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 10v6m0-9h.01"
                        />
                    </svg>
                </div>

                <div>

                    <p class="text-sm font-bold text-blue-900 dark:text-blue-300">
                        Election participation is managed separately
                    </p>

                    <p class="mt-1 text-xs leading-5 text-blue-700/70 dark:text-slate-400">
                        Updating this profile does not change this voter's
                        election assignments, eligibility, accreditation status
                        or voting history.
                    </p>

                </div>

            </div>

        </div>



        {{-- ========================================================
            ACTION FOOTER
        ========================================================= --}}

        <div
            class="sticky bottom-4 z-20
                   rounded-2xl
                   border border-slate-200
                   bg-white/95
                   p-3
                   shadow-[0_15px_40px_rgba(15,23,42,0.12)]
                   backdrop-blur
                   dark:border-white/10
                   dark:bg-[#101a2f]/95
                   dark:shadow-black/30"
        >

            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-between">

                <a
                    href="{{ route('voters.show', $voter) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl
                           border border-slate-200
                           bg-white
                           px-5 py-3
                           text-sm font-bold
                           text-slate-600
                           transition
                           hover:bg-slate-50
                           dark:border-white/10
                           dark:bg-white/5
                           dark:text-slate-300"
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

                    Cancel

                </a>


                <div class="flex flex-col gap-3 sm:flex-row">

                    <a
                        href="{{ route('voters.show', $voter) }}"
                        class="inline-flex items-center justify-center rounded-xl
                               px-5 py-3
                               text-sm font-semibold
                               text-slate-500
                               transition
                               hover:text-slate-800
                               dark:text-slate-400
                               dark:hover:text-white"
                    >
                        Back to Profile
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl
                               bg-gradient-to-r from-blue-600 to-indigo-600
                               px-6 py-3
                               text-sm font-bold text-white
                               shadow-lg shadow-blue-600/20
                               transition
                               hover:-translate-y-0.5
                               hover:shadow-xl hover:shadow-blue-600/30"
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

                        Save Changes

                    </button>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection