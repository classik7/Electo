@extends('electo.layouts.app')

@section('title', 'Add Voter | Electo')

@section('content')

<div class="mx-auto max-w-5xl space-y-8">

    {{-- ============================================================= --}}
    {{-- PAGE HEADER --}}
    {{-- ============================================================= --}}

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <div class="flex items-center gap-3">

                <a
                    href="{{ route('voters.index') }}"
                    class="flex h-10 w-10 items-center justify-center rounded-xl border border-white/10 bg-white/5 text-gray-400 transition hover:bg-white/10 hover:text-white"
                    title="Back to voters"
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

                <div>

                    <h1 class="text-3xl font-black tracking-tight text-white">
                        Add Voter
                    </h1>

                    <p class="mt-1 text-sm text-gray-400">
                        Register a new voter in Electo.
                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- ============================================================= --}}
    {{-- VALIDATION ERRORS --}}
    {{-- ============================================================= --}}

    @if($errors->any())

        <div class="rounded-2xl border border-red-500/20 bg-red-500/10 p-5">

            <div class="flex gap-3">

                <div class="mt-0.5 shrink-0">

                    <svg
                        class="h-5 w-5 text-red-400"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 9v4m0 4h.01M10.29 3.86l-8.18 14A2 2 0 003.84 21h16.32a2 2 0 001.73-3.14l-8.18-14a2 2 0 00-3.42 0z"
                        />
                    </svg>

                </div>

                <div>

                    <h3 class="font-semibold text-red-300">
                        Please correct the following:
                    </h3>

                    <ul class="mt-2 space-y-1 text-sm text-red-400">

                        @foreach($errors->all() as $error)

                            <li>
                                • {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- ============================================================= --}}
    {{-- FORM --}}
    {{-- ============================================================= --}}

    <form
        method="POST"
        action="{{ route('voters.store') }}"
        enctype="multipart/form-data"
        class="space-y-6"
    >

        @csrf


        {{-- ========================================================= --}}
        {{-- PERSONAL INFORMATION --}}
        {{-- ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-white/10 bg-white/[0.03]">

            <div class="border-b border-white/10 px-6 py-5">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-500/10">

                        <svg
                            class="h-5 w-5 text-blue-400"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 7a3 3 0 11-6 0 3 3 0 016 0zM5 21a7 7 0 0114 0"
                            />
                        </svg>

                    </div>

                    <div>

                        <h2 class="font-bold text-white">
                            Personal Information
                        </h2>

                        <p class="mt-1 text-xs text-gray-500">
                            Basic information used to identify the voter.
                        </p>

                    </div>

                </div>

            </div>


            <div class="grid gap-6 p-6 md:grid-cols-2">

                {{-- Name --}}

                <div class="md:col-span-2">

                    <label
                        for="name"
                        class="mb-2 block text-sm font-semibold text-gray-300"
                    >
                        Full Name
                        <span class="text-red-400">*</span>
                    </label>

                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        autofocus
                        placeholder="e.g. Awelewa Johnson"
                        class="w-full rounded-xl border border-white/10 bg-[#081225] px-4 py-3 text-sm text-white placeholder-gray-600 outline-none transition focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/10"
                    >

                </div>


                {{-- Voter ID --}}

                <div>

                    <label
                        for="voter_id"
                        class="mb-2 block text-sm font-semibold text-gray-300"
                    >
                        Voter ID
                        <span class="text-red-400">*</span>
                    </label>

                    <input
                        id="voter_id"
                        type="text"
                        name="voter_id"
                        value="{{ old('voter_id') }}"
                        required
                        placeholder="e.g. VTR-000001"
                        class="w-full rounded-xl border border-white/10 bg-[#081225] px-4 py-3 font-mono text-sm text-white placeholder-gray-600 uppercase outline-none transition focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/10"
                    >

                    <p class="mt-2 text-xs text-gray-500">
                        This ID must be unique.
                    </p>

                </div>


                {{-- Status --}}

                <div>

                    <label
                        for="status"
                        class="mb-2 block text-sm font-semibold text-gray-300"
                    >
                        Status
                        <span class="text-red-400">*</span>
                    </label>

                    <select
                        id="status"
                        name="status"
                        required
                        class="w-full rounded-xl border border-white/10 bg-[#081225] px-4 py-3 text-sm text-white outline-none transition focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/10"
                    >

                        <option
                            value="active"
                            @selected(old('status', 'active') === 'active')
                        >
                            Active
                        </option>

                        <option
                            value="inactive"
                            @selected(old('status') === 'inactive')
                        >
                            Inactive
                        </option>

                        <option
                            value="suspended"
                            @selected(old('status') === 'suspended')
                        >
                            Suspended
                        </option>

                    </select>

                    <p class="mt-2 text-xs text-gray-500">
                        Only active voters should normally participate in elections.
                    </p>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- CONTACT INFORMATION --}}
        {{-- ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-white/10 bg-white/[0.03]">

            <div class="border-b border-white/10 px-6 py-5">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-500/10">

                        <svg
                            class="h-5 w-5 text-emerald-400"
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

                        <h2 class="font-bold text-white">
                            Contact Information
                        </h2>

                        <p class="mt-1 text-xs text-gray-500">
                            Optional contact details for communication and verification.
                        </p>

                    </div>

                </div>

            </div>


            <div class="grid gap-6 p-6 md:grid-cols-2">

                {{-- Email --}}

                <div>

                    <label
                        for="email"
                        class="mb-2 block text-sm font-semibold text-gray-300"
                    >
                        Email Address
                    </label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="voter@example.com"
                        class="w-full rounded-xl border border-white/10 bg-[#081225] px-4 py-3 text-sm text-white placeholder-gray-600 outline-none transition focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/10"
                    >

                </div>


                {{-- Phone --}}

                <div>

                    <label
                        for="phone"
                        class="mb-2 block text-sm font-semibold text-gray-300"
                    >
                        Phone Number
                    </label>

                    <input
                        id="phone"
                        type="tel"
                        name="phone"
                        value="{{ old('phone') }}"
                        placeholder="08012345678"
                        class="w-full rounded-xl border border-white/10 bg-[#081225] px-4 py-3 text-sm text-white placeholder-gray-600 outline-none transition focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/10"
                    >

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- PHOTO --}}
        {{-- ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-white/10 bg-white/[0.03]">

            <div class="border-b border-white/10 px-6 py-5">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-purple-500/10">

                        <svg
                            class="h-5 w-5 text-purple-400"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4 16l4-4a3 3 0 014 0l4 4m-1-9h.01M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                            />
                        </svg>

                    </div>

                    <div>

                        <h2 class="font-bold text-white">
                            Voter Photo
                        </h2>

                        <p class="mt-1 text-xs text-gray-500">
                            Optional profile photo for voter identification.
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-6">

                <label
                    for="photo"
                    class="group flex cursor-pointer flex-col items-center justify-center rounded-2xl border border-dashed border-white/10 bg-white/[0.02] px-6 py-10 text-center transition hover:border-blue-500/30 hover:bg-blue-500/[0.03]"
                >

                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white/5 transition group-hover:bg-blue-500/10">

                        <svg
                            class="h-7 w-7 text-gray-500 transition group-hover:text-blue-400"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 16V4m0 0L8 8m4-4l4 4M4 16v3a1 1 0 001 1h14a1 1 0 001-1v-3"
                            />
                        </svg>

                    </div>

                    <p class="mt-4 text-sm font-semibold text-gray-300">
                        Upload voter photo
                    </p>
					
					<p class="mt-1 text-xs text-gray-600">
					You can skip this if a voter photo is not available. its optional
					</p>

                    <p class="mt-1 text-xs text-gray-600">
                        JPG, JPEG, PNG · Maximum 2MB
                    </p>

                    <input
                        id="photo"
                        type="file"
                        name="photo"
                        accept="image/jpeg,image/png,image/jpg"
                        class="hidden"
                    >

                </label>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- INFORMATION NOTICE --}}
        {{-- ========================================================= --}}

        <div class="rounded-2xl border border-blue-500/10 bg-blue-500/[0.05] p-5">

            <div class="flex gap-3">

                <svg
                    class="mt-0.5 h-5 w-5 shrink-0 text-blue-400"
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

                <div>

                    <p class="text-sm font-semibold text-blue-300">
                        Election eligibility is managed separately.
                    </p>

                    <p class="mt-1 text-xs leading-5 text-gray-500">
                        Registering a voter here does not automatically make them
                        eligible to vote in every election. You will assign voters
                        to specific elections later.
                    </p>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- ACTIONS --}}
        {{-- ========================================================= --}}

        <div class="flex flex-col-reverse gap-3 border-t border-white/10 pt-6 sm:flex-row sm:justify-end">

            <a
                href="{{ route('voters.index') }}"
                class="inline-flex items-center justify-center rounded-xl border border-white/10 bg-white/5 px-6 py-3 text-sm font-semibold text-gray-300 transition hover:bg-white/10 hover:text-white"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-7 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-500"
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

                Register Voter

            </button>

        </div>

    </form>

</div>

@endsection