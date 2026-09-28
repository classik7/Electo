@extends('electo.layouts.app')

@section('page-title', 'Settings')

@section('content')

<div class="space-y-6">

    {{-- ========================================================= --}}
    {{-- SETTINGS HEADER --}}
    {{-- ========================================================= --}}

    <div
        class="relative overflow-hidden rounded-3xl border border-slate-200 bg-white p-7 shadow-xl shadow-slate-200/50 dark:border-white/10 dark:bg-[#132544]"
    >

        <div class="pointer-events-none absolute -right-20 -top-20 h-56 w-56 rounded-full bg-blue-500/10 blur-3xl"></div>

        <div class="pointer-events-none absolute -bottom-20 -left-20 h-48 w-48 rounded-full bg-cyan-400/10 blur-3xl"></div>

        <div class="relative">

            <p class="text-xs font-bold uppercase tracking-[0.25em] text-cyan-600 dark:text-cyan-400">
                Electo Control Center
            </p>

            <h2 class="mt-1 text-3xl font-black text-slate-900 dark:text-white">
                Settings
            </h2>

            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500 dark:text-slate-400">
                Manage your Electo account, appearance, security,
                notifications and election preferences.
            </p>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- SETTINGS LAYOUT --}}
    {{-- ========================================================= --}}

    <div class="grid gap-6 lg:grid-cols-[240px_minmax(0,1fr)]">

        {{-- ===================================================== --}}
        {{-- SETTINGS NAVIGATION --}}
        {{-- ===================================================== --}}

        <aside
            class="h-fit rounded-2xl border border-slate-200 bg-white p-3 shadow-sm dark:border-white/10 dark:bg-[#132544]"
        >

            <nav class="space-y-1">

                {{-- APPEARANCE --}}

                <button
                    type="button"
                    class="settings-tab flex w-full items-center gap-3 rounded-xl bg-blue-50 px-4 py-3 text-left text-sm font-semibold text-blue-600 transition hover:bg-blue-100 dark:bg-blue-600/15 dark:text-cyan-300 dark:hover:bg-blue-600/20"
                    data-target="appearance"
                >

                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-amber-50 text-amber-500 dark:bg-cyan-400/10 dark:text-cyan-300">
                        ☀️
                    </span>

                    Appearance

                </button>


                {{-- ACCOUNT --}}

                <button
                    type="button"
                    class="settings-tab flex w-full items-center gap-3 rounded-xl px-4 py-3 text-left text-sm font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-white/5 dark:hover:text-white"
                    data-target="account"
                >

                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100 text-slate-500 dark:bg-white/5 dark:text-slate-400">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <circle cx="12" cy="7" r="4"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 21a8 8 0 0116 0"/>
                        </svg>

                    </span>

                    Account

                </button>


                {{-- SECURITY --}}

                <button
                    type="button"
                    class="settings-tab flex w-full items-center gap-3 rounded-xl px-4 py-3 text-left text-sm font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-white/5 dark:hover:text-white"
                    data-target="security"
                >

                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100 text-slate-500 dark:bg-white/5 dark:text-slate-400">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <rect x="4" y="10" width="16" height="10" rx="2"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 10V7a4 4 0 018 0v3"/>
                        </svg>

                    </span>

                    Security

                </button>


                {{-- ================================================= --}}
                {{-- NOTIFICATIONS BUTTON ONLY --}}
                {{-- ================================================= --}}

                <button
                    type="button"
                    class="settings-tab flex w-full items-center gap-3 rounded-xl px-4 py-3 text-left text-sm font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-white/5 dark:hover:text-white"
                    data-target="notifications"
                >

                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100 text-slate-500 dark:bg-white/5 dark:text-slate-400">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 10-12 0v3.2a2 2 0 01-.6 1.4L4 17h5"/>
                            <path stroke-linecap="round" d="M9 21h6"/>
                        </svg>

                    </span>

                    Notifications

                </button>


                {{-- ELECTIONS --}}

                <button
                    type="button"
                    class="settings-tab flex w-full items-center gap-3 rounded-xl px-4 py-3 text-left text-sm font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-white/5 dark:hover:text-white"
                    data-target="elections"
                >

                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100 text-slate-500 dark:bg-white/5 dark:text-slate-400">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 4h14v16H5z"/>
                            <path stroke-linecap="round" d="M8 8h8M8 12h6M8 16h4"/>
                        </svg>

                    </span>

                    Elections

                </button>


                {{-- CERTIFICATES --}}

                <button
                    type="button"
                    class="settings-tab flex w-full items-center gap-3 rounded-xl px-4 py-3 text-left text-sm font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-white/5 dark:hover:text-white"
                    data-target="certificates"
                >

                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100 text-slate-500 dark:bg-white/5 dark:text-slate-400">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 3h12v18H6z"/>
                            <path stroke-linecap="round" d="M9 7h6M9 11h6"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 16l2 2 4-4"/>
                        </svg>

                    </span>

                    Certificates

                </button>

            </nav>

        </aside>


        {{-- ===================================================== --}}
        {{-- RIGHT-HAND SETTINGS CONTENT --}}
        {{-- ===================================================== --}}

        <section class="min-w-0">


            {{-- ================================================= --}}
            {{-- APPEARANCE --}}
            {{-- ================================================= --}}

            <div
                id="appearance"
                class="settings-panel space-y-5"
            >

                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-white/10 dark:bg-[#132544]">

                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-cyan-600 dark:text-cyan-400">
                        Appearance
                    </p>

                    <h3 class="mt-1 text-2xl font-black text-slate-900 dark:text-white">
                        Theme Preferences
                    </h3>

                    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
                        Choose how Electo should appear on your device.
                    </p>


                    <form
                        method="POST"
                        action="{{ route('settings.update') }}"
                        class="mt-6"
                    >

                        @csrf
                        @method('PUT')

                        <div class="grid gap-4 md:grid-cols-3">

                            {{-- LIGHT --}}

                            <label class="cursor-pointer">

                                <input
                                    type="radio"
                                    name="theme"
                                    value="light"
                                    class="peer sr-only"
                                    {{ ($settings->theme ?? 'system') === 'light' ? 'checked' : '' }}
                                >

                                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5 transition peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:bg-white dark:border-white/10 dark:bg-white/5 dark:peer-checked:border-blue-400 dark:peer-checked:bg-blue-500/10">

                                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-100 text-amber-600">
                                        ☀️
                                    </div>

                                    <h4 class="mt-4 font-bold text-slate-900 dark:text-white">
                                        Light
                                    </h4>

                                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                                        Bright and clean interface.
                                    </p>

                                </div>

                            </label>


                            {{-- DARK --}}

                            <label class="cursor-pointer">

                                <input
                                    type="radio"
                                    name="theme"
                                    value="dark"
                                    class="peer sr-only"
                                    {{ ($settings->theme ?? 'system') === 'dark' ? 'checked' : '' }}
                                >

                                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5 transition peer-checked:border-cyan-500 peer-checked:bg-cyan-50 hover:bg-white dark:border-white/10 dark:bg-white/5 dark:peer-checked:border-cyan-400 dark:peer-checked:bg-cyan-500/10">

                                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-cyan-100 text-cyan-600 dark:bg-cyan-400/10 dark:text-cyan-300">
                                        🌙
                                    </div>

                                    <h4 class="mt-4 font-bold text-slate-900 dark:text-white">
                                        Dark
                                    </h4>

                                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                                        Premium dark Electo interface.
                                    </p>

                                </div>

                            </label>


                            {{-- SYSTEM --}}

                            <label class="cursor-pointer">

                                <input
                                    type="radio"
                                    name="theme"
                                    value="system"
                                    class="peer sr-only"
                                    {{ ($settings->theme ?? 'system') === 'system' ? 'checked' : '' }}
                                >

                                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5 transition peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:bg-white dark:border-white/10 dark:bg-white/5 dark:peer-checked:border-blue-400 dark:peer-checked:bg-blue-500/10">

                                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-100 text-blue-600 dark:bg-blue-400/10 dark:text-blue-300">
                                        🖥️
                                    </div>

                                    <h4 class="mt-4 font-bold text-slate-900 dark:text-white">
                                        System
                                    </h4>

                                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                                        Follow your device preference.
                                    </p>

                                </div>

                            </label>

                        </div>


                        <div class="mt-6 flex justify-end border-t border-slate-200 pt-5 dark:border-white/10">

                            <button
                                type="submit"
                                class="rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-blue-500/20 transition hover:-translate-y-0.5"
                            >
                                Save Appearance
                            </button>

                        </div>

                    </form>

                </div>


                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-white/10 dark:bg-[#132544]">

                    <div class="flex items-center justify-between gap-4">

                        <div>

                            <p class="text-sm font-bold text-slate-900 dark:text-white">
                                Current Theme
                            </p>

                            <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                                Your saved Electo appearance preference.
                            </p>

                        </div>

                        <span class="rounded-full border border-cyan-200 bg-cyan-50 px-3 py-1.5 text-xs font-bold capitalize text-cyan-700 dark:border-cyan-400/20 dark:bg-cyan-400/10 dark:text-cyan-300">
                            {{ $settings->theme ?? 'system' }}
                        </span>

                    </div>

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- ACCOUNT --}}
            {{-- ================================================= --}}

            <div
                id="account"
                class="settings-panel hidden space-y-5"
            >

                {{-- PROFILE HERO --}}

                <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-white/10 dark:bg-[#132544]">

                    <div class="pointer-events-none absolute -right-20 -top-20 h-48 w-48 rounded-full bg-blue-500/10 blur-3xl"></div>

                    <div class="relative flex flex-col gap-5 sm:flex-row sm:items-center">

                        @if(auth()->user()->avatar)

                            <img
                                src="{{ asset('storage/' . auth()->user()->avatar) }}"
                                alt="{{ auth()->user()->name }}"
                                class="h-20 w-20 rounded-2xl object-cover shadow-lg ring-4 ring-blue-500/10"
                            >

                        @else

                            <div class="flex h-20 w-20 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-600 to-cyan-500 text-2xl font-black text-white">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>

                        @endif


                        <div>

                            <p class="text-xs font-bold uppercase tracking-[0.2em] text-cyan-600 dark:text-cyan-400">
                                Account Profile
                            </p>

                            <h3 class="mt-1 text-2xl font-black text-slate-900 dark:text-white">
                                {{ auth()->user()->name }}
                            </h3>

                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                {{ auth()->user()->email }}
                            </p>

                        </div>

                    </div>

                </div>


                {{-- PROFILE PHOTO --}}

                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-white/10 dark:bg-[#132544]">

                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-cyan-600 dark:text-cyan-400">
                        Profile Photo
                    </p>

                    <h3 class="mt-1 text-xl font-black text-slate-900 dark:text-white">
                        Personalise your account
                    </h3>

                    <form
                        method="POST"
                        action="{{ route('settings.profile.photo.update') }}"
                        enctype="multipart/form-data"
                        class="mt-6"
                    >

                        @csrf
                        @method('PUT')

                        <div class="flex flex-col gap-6 md:flex-row md:items-center">

                            <div class="shrink-0">

                                @if(auth()->user()->avatar)

                                    <img
                                        id="profilePreview"
                                        src="{{ asset('storage/' . auth()->user()->avatar) }}"
                                        alt="Profile preview"
                                        class="h-28 w-28 rounded-2xl object-cover shadow-xl ring-4 ring-blue-500/10"
                                    >

                                @else

                                    <div
                                        id="profilePreview"
                                        class="flex h-28 w-28 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-600 to-cyan-500 text-4xl font-black text-white shadow-xl"
                                    >
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </div>

                                @endif

                            </div>


                            <div class="flex-1">

                                <label
                                    for="avatar"
                                    class="flex cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50 px-6 py-8 text-center transition hover:border-blue-400 hover:bg-blue-50 dark:border-white/10 dark:bg-white/[0.03]"
                                >

                                    <span class="text-3xl">
                                        📷
                                    </span>

                                    <span class="mt-3 text-sm font-bold text-slate-800 dark:text-white">
                                        Choose a profile photo
                                    </span>

                                    <span class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                                        PNG, JPG or JPEG · Maximum 2MB
                                    </span>

                                    <input
                                        id="avatar"
                                        name="avatar"
                                        type="file"
                                        accept="image/png,image/jpeg,image/jpg"
                                        class="hidden"
                                        onchange="previewAvatar(event)"
                                    >

                                </label>


                                @error('avatar')

                                    <p class="mt-2 text-xs text-red-500">
                                        {{ $message }}
                                    </p>

                                @enderror


                                <div class="mt-4 flex flex-wrap gap-3">

                                    <button
                                        type="submit"
                                        class="rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-blue-500/20"
                                    >
                                        Save Profile Photo
                                    </button>


                                    @if(auth()->user()->avatar)

                                        <button
                                            type="submit"
                                            name="remove_avatar"
                                            value="1"
                                            class="rounded-xl border border-red-200 bg-red-50 px-5 py-2.5 text-sm font-bold text-red-600 dark:border-red-400/20 dark:bg-red-500/10 dark:text-red-400"
                                        >
                                            Remove Photo
                                        </button>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </form>

                </div>


                {{-- PERSONAL INFORMATION --}}

                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-white/10 dark:bg-[#132544]">

                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-cyan-600 dark:text-cyan-400">
                        Profile
                    </p>

                    <h3 class="mt-1 text-xl font-black text-slate-900 dark:text-white">
                        Personal Information
                    </h3>

                    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
                        Manage the personal information associated with your Electo account.
                    </p>


                    <form
                        method="POST"
                        action="{{ route('settings.profile.update') }}"
                        class="mt-6"
                    >

                        @csrf
                        @method('PUT')

                        <div class="grid gap-5 md:grid-cols-2">

                            <div>

                                <label
                                    for="name"
                                    class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300"
                                >
                                    Full Name
                                </label>

                                <input
                                    id="name"
                                    name="name"
                                    type="text"
                                    value="{{ old('name', auth()->user()->name) }}"
                                    required
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 dark:border-white/10 dark:bg-[#0B1730] dark:text-white"
                                >

                                @error('name')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror

                            </div>


                            <div>

                                <label
                                    for="email"
                                    class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300"
                                >
                                    Email Address
                                </label>

                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    value="{{ old('email', auth()->user()->email) }}"
                                    required
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 dark:border-white/10 dark:bg-[#0B1730] dark:text-white"
                                >

                                @error('email')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror

                            </div>

                        </div>


                        <div class="mt-5 grid gap-5 md:grid-cols-2">

                            <div>

                                <p class="mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">
                                    Account Role
                                </p>

                                <div class="flex items-center justify-between rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 dark:border-white/10 dark:bg-[#0B1730]">

                                    <span class="text-sm font-bold text-slate-800 dark:text-white">
                                        {{ ucfirst(auth()->user()->role) }}
                                    </span>

                                    <span class="rounded-full bg-blue-100 px-3 py-1 text-[10px] font-black uppercase tracking-wider text-blue-700 dark:bg-blue-500/10 dark:text-blue-300">
                                        {{ strtoupper(auth()->user()->role) }}
                                    </span>

                                </div>

                            </div>


                            <div>

                                <p class="mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">
                                    Account Status
                                </p>

                                <div class="flex items-center justify-between rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 dark:border-white/10 dark:bg-[#0B1730]">

                                    <div class="flex items-center gap-3">

                                        <span class="h-3 w-3 rounded-full bg-emerald-500"></span>

                                        <span class="text-sm font-bold text-slate-800 dark:text-white">
                                            {{ ucfirst(auth()->user()->status) }}
                                        </span>

                                    </div>

                                    <span class="text-xs text-slate-400">
                                        Account status
                                    </span>

                                </div>

                            </div>

                        </div>


                        <div class="mt-6 flex justify-end border-t border-slate-200 pt-5 dark:border-white/10">

                            <button
                                type="submit"
                                class="rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-blue-500/20"
                            >
                                Save Profile Changes
                            </button>

                        </div>

                    </form>

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- SECURITY --}}
            {{-- ================================================= --}}

            <div
                id="security"
                class="settings-panel hidden space-y-5"
            >

                @include('electo.security.passkeys')

            </div>


            {{-- ================================================= --}}
            {{-- NOTIFICATIONS --}}
            {{-- ================================================= --}}

            <div
    id="notifications"
    class="settings-panel hidden space-y-6"
>

                {{-- NOTIFICATION HERO --}}

                <div class="relative overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm dark:border-white/10 dark:bg-[#132544]">

                    <div class="absolute inset-0 bg-gradient-to-r from-blue-50 via-white to-cyan-50 dark:from-blue-500/10 dark:via-[#132544] dark:to-cyan-500/10"></div>

                    <div class="relative p-6 md:p-8">

                        <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                            <div>

                                <p class="text-xs font-bold uppercase tracking-[0.2em] text-cyan-600 dark:text-cyan-400">
                                    Notification Center
                                </p>

                                <h3 class="mt-1 text-2xl font-black text-slate-900 dark:text-white">
                                    Notification Settings
                                </h3>

                                <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500 dark:text-slate-400">
                                    Choose which Electo updates you want to receive in your notification center.
                                </p>

                            </div>


                            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-600 to-cyan-500 text-white shadow-lg shadow-blue-500/20">
                                🔔
                            </div>

                        </div>

                    </div>

                </div>


                {{-- NOTIFICATION FORM --}}

                <form
                    method="POST"
                    action="{{ route('settings.update') }}"
                >

                    @csrf
                    @method('PUT')


                    {{-- Preserve current theme when updating notifications --}}

                    <input
                        type="hidden"
                        name="theme"
                        value="{{ $settings->theme ?? 'system' }}"
                    >


                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-white/10 dark:bg-[#132544]">

                        <div class="mb-6">

                            <h4 class="text-lg font-black text-slate-900 dark:text-white">
                                Delivery Preferences
                            </h4>

                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                Control the types of notifications that Electo sends to your notification center.
                            </p>

                        </div>


                        <div class="grid gap-4 md:grid-cols-2">


                            {{-- GENERAL --}}

                            <label class="group cursor-pointer">

                                <input
                                    type="hidden"
                                    name="email_notifications"
                                    value="0"
                                >

                                <input
                                    type="checkbox"
                                    name="email_notifications"
                                    value="1"
                                    class="peer sr-only"
                                    {{ $settings->email_notifications ? 'checked' : '' }}
                                >

                                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5 transition hover:-translate-y-0.5 hover:bg-white peer-checked:border-blue-500 peer-checked:bg-blue-50 dark:border-white/10 dark:bg-white/[0.03] dark:peer-checked:border-blue-400 dark:peer-checked:bg-blue-500/10">

                                    <div class="flex items-start justify-between gap-4">

                                        <div class="flex min-w-0 items-center gap-3">

                                            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-slate-200 text-xl dark:bg-white/10">
                                                ✉️
                                            </span>

                                            <div>

                                                <h4 class="font-bold text-slate-900 dark:text-white">
                                                    General Updates
                                                </h4>

                                                <p class="mt-1 text-xs leading-5 text-slate-500 dark:text-slate-400">
                                                    Important account and Electo platform updates.
                                                </p>

                                            </div>

                                        </div>


                                        <span class="relative mt-1 h-6 w-11 shrink-0 rounded-full bg-slate-200 transition peer-checked:bg-blue-600 dark:bg-white/10">

                                            <span class="absolute left-1 top-1 h-4 w-4 rounded-full bg-white shadow transition peer-checked:translate-x-5"></span>

                                        </span>

                                    </div>

                                </div>

                            </label>


                            {{-- ELECTIONS --}}

                            <label class="group cursor-pointer">

                                <input
                                    type="hidden"
                                    name="election_notifications"
                                    value="0"
                                >

                                <input
                                    type="checkbox"
                                    name="election_notifications"
                                    value="1"
                                    class="peer sr-only"
                                    {{ $settings->election_notifications ? 'checked' : '' }}
                                >

                                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5 transition hover:-translate-y-0.5 hover:bg-white peer-checked:border-blue-500 peer-checked:bg-blue-50 dark:border-white/10 dark:bg-white/[0.03] dark:peer-checked:border-blue-400 dark:peer-checked:bg-blue-500/10">

                                    <div class="flex items-start justify-between gap-4">

                                        <div class="flex min-w-0 items-center gap-3">

                                            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-100 text-xl dark:bg-blue-500/10">
                                                🗳️
                                            </span>

                                            <div>

                                                <h4 class="font-bold text-slate-900 dark:text-white">
                                                    Election Updates
                                                </h4>

                                                <p class="mt-1 text-xs leading-5 text-slate-500 dark:text-slate-400">
                                                    Election creation, publishing and schedule updates.
                                                </p>

                                            </div>

                                        </div>


                                        <span class="relative mt-1 h-6 w-11 shrink-0 rounded-full bg-slate-200 transition peer-checked:bg-blue-600 dark:bg-white/10">

                                            <span class="absolute left-1 top-1 h-4 w-4 rounded-full bg-white shadow transition peer-checked:translate-x-5"></span>

                                        </span>

                                    </div>

                                </div>

                            </label>


                            {{-- RESULTS --}}

                            <label class="group cursor-pointer">

                                <input
                                    type="hidden"
                                    name="result_notifications"
                                    value="0"
                                >

                                <input
                                    type="checkbox"
                                    name="result_notifications"
                                    value="1"
                                    class="peer sr-only"
                                    {{ $settings->result_notifications ? 'checked' : '' }}
                                >

                                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5 transition hover:-translate-y-0.5 hover:bg-white peer-checked:border-violet-500 peer-checked:bg-violet-50 dark:border-white/10 dark:bg-white/[0.03] dark:peer-checked:border-violet-400 dark:peer-checked:bg-violet-500/10">

                                    <div class="flex items-start justify-between gap-4">

                                        <div class="flex min-w-0 items-center gap-3">

                                            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-violet-100 text-xl dark:bg-violet-500/10">
                                                📊
                                            </span>

                                            <div>

                                                <h4 class="font-bold text-slate-900 dark:text-white">
                                                    Result Updates
                                                </h4>

                                                <p class="mt-1 text-xs leading-5 text-slate-500 dark:text-slate-400">
                                                    Result publication and important result changes.
                                                </p>

                                            </div>

                                        </div>


                                        <span class="relative mt-1 h-6 w-11 shrink-0 rounded-full bg-slate-200 transition peer-checked:bg-violet-600 dark:bg-white/10">

                                            <span class="absolute left-1 top-1 h-4 w-4 rounded-full bg-white shadow transition peer-checked:translate-x-5"></span>

                                        </span>

                                    </div>

                                </div>

                            </label>


                            {{-- CERTIFICATES --}}

                            <label class="group cursor-pointer">

                                <input
                                    type="hidden"
                                    name="certificate_notifications"
                                    value="0"
                                >

                                <input
                                    type="checkbox"
                                    name="certificate_notifications"
                                    value="1"
                                    class="peer sr-only"
                                    {{ $settings->certificate_notifications ? 'checked' : '' }}
                                >

                                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5 transition hover:-translate-y-0.5 hover:bg-white peer-checked:border-amber-500 peer-checked:bg-amber-50 dark:border-white/10 dark:bg-white/[0.03] dark:peer-checked:border-amber-400 dark:peer-checked:bg-amber-500/10">

                                    <div class="flex items-start justify-between gap-4">

                                        <div class="flex min-w-0 items-center gap-3">

                                            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-amber-100 text-xl dark:bg-amber-500/10">
                                                🏆
                                            </span>

                                            <div>

                                                <h4 class="font-bold text-slate-900 dark:text-white">
                                                    Certificate Updates
                                                </h4>

                                                <p class="mt-1 text-xs leading-5 text-slate-500 dark:text-slate-400">
                                                    Certificate generation and availability updates.
                                                </p>

                                            </div>

                                        </div>


                                        <span class="relative mt-1 h-6 w-11 shrink-0 rounded-full bg-slate-200 transition peer-checked:bg-amber-500 dark:bg-white/10">

                                            <span class="absolute left-1 top-1 h-4 w-4 rounded-full bg-white shadow transition peer-checked:translate-x-5"></span>

                                        </span>

                                    </div>

                                </div>

                            </label>


                            {{-- SECURITY --}}

                            <label class="group cursor-pointer md:col-span-2">

                                <input
                                    type="hidden"
                                    name="security_notifications"
                                    value="0"
                                >

                                <input
                                    type="checkbox"
                                    name="security_notifications"
                                    value="1"
                                    class="peer sr-only"
                                    {{ $settings->security_notifications ? 'checked' : '' }}
                                >

                                <div class="rounded-2xl border border-emerald-100 bg-emerald-50/50 p-5 transition hover:bg-emerald-50 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 dark:border-emerald-500/20 dark:bg-emerald-500/5 dark:peer-checked:border-emerald-400 dark:peer-checked:bg-emerald-500/10">

                                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                                        <div class="flex min-w-0 items-center gap-3">

                                            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-xl dark:bg-emerald-500/10">
                                                🛡️
                                            </span>

                                            <div>

                                                <h4 class="font-bold text-slate-900 dark:text-white">
                                                    Security Alerts
                                                </h4>

                                                <p class="mt-1 text-xs leading-5 text-slate-500 dark:text-slate-400">
                                                    Password changes, two-factor authentication and important account security events.
                                                </p>

                                            </div>

                                        </div>


                                        <span class="relative h-6 w-11 shrink-0 rounded-full bg-slate-200 transition peer-checked:bg-emerald-500 dark:bg-white/10">

                                            <span class="absolute left-1 top-1 h-4 w-4 rounded-full bg-white shadow transition peer-checked:translate-x-5"></span>

                                        </span>

                                    </div>

                                </div>

                            </label>

                        </div>


                        <div class="mt-6 flex flex-col gap-4 rounded-2xl border border-blue-100 bg-blue-50/70 p-5 dark:border-blue-500/20 dark:bg-blue-500/5 sm:flex-row sm:items-center sm:justify-between">

                            <div>

                                <p class="text-sm font-bold text-slate-800 dark:text-slate-200">
                                    Your notification preferences
                                </p>

                                <p class="mt-1 text-xs leading-5 text-slate-500 dark:text-slate-400">
                                    These preferences control which new notifications are generated for your account.
                                </p>

                            </div>


                            <button
                                type="submit"
                                class="shrink-0 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-blue-500/20 transition hover:-translate-y-0.5 hover:shadow-xl"
                            >
                                Save Notification Preferences
                            </button>

                        </div>

                    </div>

                </form>


                {{-- INFO CARDS --}}

                <div class="grid gap-4 md:grid-cols-3">

                    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-white/10 dark:bg-[#132544]">

                        <div class="text-2xl">
                            🔔
                        </div>

                        <p class="mt-3 text-xs font-bold uppercase tracking-wider text-slate-400">
                            Notification Center
                        </p>

                        <h4 class="mt-1 font-bold text-slate-900 dark:text-white">
                            Top-right bell
                        </h4>

                        <p class="mt-1 text-xs leading-5 text-slate-500 dark:text-slate-400">
                            Your recent Electo notifications are available from the notification bell.
                        </p>

                    </div>


                    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-white/10 dark:bg-[#132544]">

                        <div class="text-2xl">
                            🔢
                        </div>

                        <p class="mt-3 text-xs font-bold uppercase tracking-wider text-slate-400">
                            Unread Badge
                        </p>

                        <h4 class="mt-1 font-bold text-slate-900 dark:text-white">
                            Live count
                        </h4>

                        <p class="mt-1 text-xs leading-5 text-slate-500 dark:text-slate-400">
                            Reading a notification updates the unread count.
                        </p>

                    </div>


                    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-white/10 dark:bg-[#132544]">

                        <div class="text-2xl">
                            🔐
                        </div>

                        <p class="mt-3 text-xs font-bold uppercase tracking-wider text-slate-400">
                            Privacy
                        </p>

                        <h4 class="mt-1 font-bold text-slate-900 dark:text-white">
                            Account-specific
                        </h4>

                        <p class="mt-1 text-xs leading-5 text-slate-500 dark:text-slate-400">
                            Only notifications belonging to your account are displayed.
                        </p>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
{{-- ELECTION PREFERENCES --}}
{{-- ========================================================= --}}

<div
    id="elections"
    class="settings-panel hidden space-y-6"
>

    {{-- ========================================================= --}}
    {{-- HERO --}}
    {{-- ========================================================= --}}

    <div
        class="
            relative
            overflow-hidden
            rounded-3xl
            border
            border-slate-200
            bg-white
            shadow-xl
            shadow-slate-200/40

            dark:border-white/10
            dark:bg-[#132544]
            dark:shadow-black/20
        "
    >

        {{-- Decorative glow --}}

        <div
            class="
                pointer-events-none
                absolute
                -right-20
                -top-20
                h-60
                w-60
                rounded-full
                bg-blue-500/10
                blur-3xl
            "
        ></div>

        <div
            class="
                pointer-events-none
                absolute
                -bottom-24
                -left-16
                h-52
                w-52
                rounded-full
                bg-cyan-400/10
                blur-3xl
            "
        ></div>


        <div
            class="
                relative
                flex
                flex-col
                gap-6
                p-6

                md:flex-row
                md:items-center
                md:justify-between
                md:p-8
            "
        >

            <div>

                <div
                    class="
                        inline-flex
                        items-center
                        gap-2
                        rounded-full
                        border
                        border-blue-200
                        bg-blue-50
                        px-3
                        py-1.5
                        text-[10px]
                        font-black
                        uppercase
                        tracking-[0.18em]
                        text-blue-600

                        dark:border-blue-400/20
                        dark:bg-blue-500/10
                        dark:text-cyan-300
                    "
                >

                    <span
                        class="
                            h-1.5
                            w-1.5
                            rounded-full
                            bg-cyan-500
                            shadow-[0_0_8px_rgba(6,182,212,0.8)]
                        "
                    ></span>

                    Election Preferences

                </div>


                <h3
                    class="
                        mt-4
                        text-2xl
                        font-black
                        tracking-tight
                        text-slate-900

                        dark:text-white
                    "
                >
                    Control your voting experience
                </h3>


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
                    Choose how Electo keeps you informed about elections,
                    voter registration, voting activity and election deadlines.
                </p>

            </div>


            {{-- Hero icon --}}

            <div
                class="
                    flex
                    h-16
                    w-16
                    shrink-0
                    items-center
                    justify-center
                    rounded-2xl
                    bg-gradient-to-br
                    from-blue-600
                    via-blue-500
                    to-cyan-500
                    text-white
                    shadow-xl
                    shadow-blue-500/25
                "
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-8 w-8"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.7"
                >

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M4 6.5A2.5 2.5 0 016.5 4h11A2.5 2.5 0 0120 6.5v11a2.5 2.5 0 01-2.5 2.5h-11A2.5 2.5 0 014 17.5v-11z"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M8 9h8M8 12h5"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M14 16l1.5 1.5L19 14"
                    />

                </svg>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- PREFERENCES CARD --}}
    {{-- ========================================================= --}}

    <div
        class="
            overflow-hidden
            rounded-3xl
            border
            border-slate-200
            bg-white
            shadow-xl
            shadow-slate-200/40

            dark:border-white/10
            dark:bg-[#132544]
            dark:shadow-black/20
        "
    >

        <div
            class="
                border-b
                border-slate-200
                px-6
                py-5

                dark:border-white/10

                md:px-8
            "
        >

            <h3
                class="
                    text-lg
                    font-black
                    text-slate-900

                    dark:text-white
                "
            >
                Voting Preferences
            </h3>

            <p
                class="
                    mt-1
                    text-sm
                    text-slate-500

                    dark:text-slate-400
                "
            >
                Personalize the election updates and voting confirmations
                you receive from Electo.
            </p>

        </div>


        <form
            method="POST"
            action="{{ route('settings.update') }}"
            class="p-6 md:p-8"
        >

            @csrf

            @method('PUT')


            {{-- ================================================= --}}
            {{-- PRESERVE EXISTING SETTINGS --}}
            {{-- ================================================= --}}

            <input
                type="hidden"
                name="theme"
                value="{{ $settings->theme ?? 'system' }}"
            >

            <input
                type="hidden"
                name="email_notifications"
                value="{{ $settings->email_notifications ? '1' : '0' }}"
            >

            <input
                type="hidden"
                name="election_notifications"
                value="{{ $settings->election_notifications ? '1' : '0' }}"
            >

            <input
                type="hidden"
                name="result_notifications"
                value="{{ $settings->result_notifications ? '1' : '0' }}"
            >

            <input
                type="hidden"
                name="certificate_notifications"
                value="{{ $settings->certificate_notifications ? '1' : '0' }}"
            >

            <input
                type="hidden"
                name="security_notifications"
                value="{{ $settings->security_notifications ? '1' : '0' }}"
            >


            <div class="grid gap-5 md:grid-cols-2">


                {{-- ================================================= --}}
                {{-- ELECTION REMINDERS --}}
                {{-- ================================================= --}}

                <label
                    class="
                        election-preference-card
                        group
                        cursor-pointer
                    "
                >

                    <input
                        type="hidden"
                        name="election_reminders"
                        value="0"
                    >

                    <input
                        type="checkbox"
                        name="election_reminders"
                        value="1"
                        class="election-preference-checkbox sr-only"
                        {{ $settings->election_reminders ? 'checked' : '' }}
                    >


                    <div
                        class="
                            relative
                            overflow-hidden
                            rounded-2xl
                            border
                            border-slate-200
                            bg-slate-50
                            p-5
                            transition-all
                            duration-300

                            hover:-translate-y-1
                            hover:border-blue-200
                            hover:bg-white
                            hover:shadow-xl
                            hover:shadow-blue-500/10

                            dark:border-white/10
                            dark:bg-white/[0.03]
                            dark:hover:border-blue-400/30
                            dark:hover:bg-white/[0.06]
                        "
                    >

                        <div
                            class="
                                flex
                                items-start
                                justify-between
                                gap-4
                            "
                        >

                            <div class="flex min-w-0 gap-4">

                                <div
                                    class="
                                        flex
                                        h-11
                                        w-11
                                        shrink-0
                                        items-center
                                        justify-center
                                        rounded-xl
                                        bg-blue-100
                                        text-blue-600

                                        dark:bg-blue-500/10
                                        dark:text-cyan-300
                                    "
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 8v4l2.5 2.5"
                                        />

                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="8.5"
                                        />

                                    </svg>

                                </div>


                                <div>

                                    <h4
                                        class="
                                            font-bold
                                            text-slate-900

                                            dark:text-white
                                        "
                                    >
                                        Election Reminders
                                    </h4>

                                    <p
                                        class="
                                            mt-1
                                            text-xs
                                            leading-5
                                            text-slate-500

                                            dark:text-slate-400
                                        "
                                    >
                                        Receive reminders when an election
                                        you can participate in is approaching.
                                    </p>

                                </div>

                            </div>


                            <span
                                class="
                                    election-toggle
                                    relative
                                    mt-1
                                    flex
                                    h-7
                                    w-12
                                    shrink-0
                                    items-center
                                    rounded-full
                                    bg-slate-300
                                    p-1
                                    shadow-inner
                                    transition-all
                                    duration-300

                                    dark:bg-slate-700
                                "
                            >

                                <span
                                    class="
                                        election-toggle-knob
                                        h-5
                                        w-5
                                        rounded-full
                                        bg-white
                                        shadow-md
                                    "
                                ></span>

                            </span>

                        </div>

                    </div>

                </label>


                {{-- ================================================= --}}
                {{-- REGISTRATION UPDATES --}}
                {{-- ================================================= --}}

                <label
                    class="
                        election-preference-card
                        group
                        cursor-pointer
                    "
                >

                    <input
                        type="hidden"
                        name="election_registration_updates"
                        value="0"
                    >

                    <input
                        type="checkbox"
                        name="election_registration_updates"
                        value="1"
                        class="election-preference-checkbox sr-only"
                        {{ $settings->election_registration_updates ? 'checked' : '' }}
                    >


                    <div
                        class="
                            relative
                            overflow-hidden
                            rounded-2xl
                            border
                            border-slate-200
                            bg-slate-50
                            p-5
                            transition-all
                            duration-300

                            hover:-translate-y-1
                            hover:border-indigo-200
                            hover:bg-white
                            hover:shadow-xl
                            hover:shadow-indigo-500/10

                            dark:border-white/10
                            dark:bg-white/[0.03]
                            dark:hover:border-indigo-400/30
                            dark:hover:bg-white/[0.06]
                        "
                    >

                        <div
                            class="
                                flex
                                items-start
                                justify-between
                                gap-4
                            "
                        >

                            <div class="flex min-w-0 gap-4">

                                <div
                                    class="
                                        flex
                                        h-11
                                        w-11
                                        shrink-0
                                        items-center
                                        justify-center
                                        rounded-xl
                                        bg-indigo-100
                                        text-indigo-600

                                        dark:bg-indigo-500/10
                                        dark:text-indigo-300
                                    "
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M6 5h12M6 9h12M6 13h7"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M15 16l2 2 4-4"
                                        />

                                    </svg>

                                </div>


                                <div>

                                    <h4
                                        class="
                                            font-bold
                                            text-slate-900

                                            dark:text-white
                                        "
                                    >
                                        Registration & Eligibility
                                    </h4>

                                    <p
                                        class="
                                            mt-1
                                            text-xs
                                            leading-5
                                            text-slate-500

                                            dark:text-slate-400
                                        "
                                    >
                                        Get updates when your election
                                        registration or eligibility changes.
                                    </p>

                                </div>

                            </div>


                            <span
                                class="
                                    election-toggle
                                    relative
                                    mt-1
                                    flex
                                    h-7
                                    w-12
                                    shrink-0
                                    items-center
                                    rounded-full
                                    bg-slate-300
                                    p-1
                                    shadow-inner
                                    transition-all
                                    duration-300

                                    dark:bg-slate-700
                                "
                            >

                                <span
                                    class="
                                        election-toggle-knob
                                        h-5
                                        w-5
                                        rounded-full
                                        bg-white
                                        shadow-md
                                    "
                                ></span>

                            </span>

                        </div>

                    </div>

                </label>


                {{-- ================================================= --}}
                {{-- VOTING CONFIRMATION --}}
                {{-- ================================================= --}}

                <label
                    class="
                        election-preference-card
                        group
                        cursor-pointer
                    "
                >

                    <input
                        type="hidden"
                        name="voting_confirmation"
                        value="0"
                    >

                    <input
                        type="checkbox"
                        name="voting_confirmation"
                        value="1"
                        class="election-preference-checkbox sr-only"
                        {{ $settings->voting_confirmation ? 'checked' : '' }}
                    >


                    <div
                        class="
                            relative
                            overflow-hidden
                            rounded-2xl
                            border
                            border-slate-200
                            bg-slate-50
                            p-5
                            transition-all
                            duration-300

                            hover:-translate-y-1
                            hover:border-emerald-200
                            hover:bg-white
                            hover:shadow-xl
                            hover:shadow-emerald-500/10

                            dark:border-white/10
                            dark:bg-white/[0.03]
                            dark:hover:border-emerald-400/30
                            dark:hover:bg-white/[0.06]
                        "
                    >

                        <div
                            class="
                                flex
                                items-start
                                justify-between
                                gap-4
                            "
                        >

                            <div class="flex min-w-0 gap-4">

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
                                        dark:text-emerald-300
                                    "
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
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

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 3l8 4v5c0 5.5-3.5 8.5-8 10-4.5-1.5-8-4.5-8-10V7l8-4z"
                                        />

                                    </svg>

                                </div>


                                <div>

                                    <h4
                                        class="
                                            font-bold
                                            text-slate-900

                                            dark:text-white
                                        "
                                    >
                                        Voting Confirmation
                                    </h4>

                                    <p
                                        class="
                                            mt-1
                                            text-xs
                                            leading-5
                                            text-slate-500

                                            dark:text-slate-400
                                        "
                                    >
                                        Receive confirmation after your vote
                                        has been successfully recorded.
                                    </p>

                                </div>

                            </div>


                            <span
                                class="
                                    election-toggle
                                    relative
                                    mt-1
                                    flex
                                    h-7
                                    w-12
                                    shrink-0
                                    items-center
                                    rounded-full
                                    bg-slate-300
                                    p-1
                                    shadow-inner
                                    transition-all
                                    duration-300

                                    dark:bg-slate-700
                                "
                            >

                                <span
                                    class="
                                        election-toggle-knob
                                        h-5
                                        w-5
                                        rounded-full
                                        bg-white
                                        shadow-md
                                    "
                                ></span>

                            </span>

                        </div>

                    </div>

                </label>


                {{-- ================================================= --}}
                {{-- CLOSING REMINDERS --}}
                {{-- ================================================= --}}

                <label
                    class="
                        election-preference-card
                        group
                        cursor-pointer
                    "
                >

                    <input
                        type="hidden"
                        name="election_closing_reminders"
                        value="0"
                    >

                    <input
                        type="checkbox"
                        name="election_closing_reminders"
                        value="1"
                        class="election-preference-checkbox sr-only"
                        {{ $settings->election_closing_reminders ? 'checked' : '' }}
                    >


                    <div
                        class="
                            relative
                            overflow-hidden
                            rounded-2xl
                            border
                            border-slate-200
                            bg-slate-50
                            p-5
                            transition-all
                            duration-300

                            hover:-translate-y-1
                            hover:border-amber-200
                            hover:bg-white
                            hover:shadow-xl
                            hover:shadow-amber-500/10

                            dark:border-white/10
                            dark:bg-white/[0.03]
                            dark:hover:border-amber-400/30
                            dark:hover:bg-white/[0.06]
                        "
                    >

                        <div
                            class="
                                flex
                                items-start
                                justify-between
                                gap-4
                            "
                        >

                            <div class="flex min-w-0 gap-4">

                                <div
                                    class="
                                        flex
                                        h-11
                                        w-11
                                        shrink-0
                                        items-center
                                        justify-center
                                        rounded-xl
                                        bg-amber-100
                                        text-amber-600

                                        dark:bg-amber-500/10
                                        dark:text-amber-300
                                    "
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 6v6l3 2"
                                        />

                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="8.5"
                                        />

                                    </svg>

                                </div>


                                <div>

                                    <h4
                                        class="
                                            font-bold
                                            text-slate-900

                                            dark:text-white
                                        "
                                    >
                                        Election Closing Reminder
                                    </h4>

                                    <p
                                        class="
                                            mt-1
                                            text-xs
                                            leading-5
                                            text-slate-500

                                            dark:text-slate-400
                                        "
                                    >
                                        Receive a reminder before an election
                                        you can vote in closes.
                                    </p>

                                </div>

                            </div>


                            <span
                                class="
                                    election-toggle
                                    relative
                                    mt-1
                                    flex
                                    h-7
                                    w-12
                                    shrink-0
                                    items-center
                                    rounded-full
                                    bg-slate-300
                                    p-1
                                    shadow-inner
                                    transition-all
                                    duration-300

                                    dark:bg-slate-700
                                "
                            >

                                <span
                                    class="
                                        election-toggle-knob
                                        h-5
                                        w-5
                                        rounded-full
                                        bg-white
                                        shadow-md
                                    "
                                ></span>

                            </span>

                        </div>

                    </div>

                </label>

            </div>


            {{-- ================================================= --}}
            {{-- SAVE --}}
            {{-- ================================================= --}}

            <div
                class="
                    mt-7
                    flex
                    flex-col
                    gap-4
                    rounded-2xl
                    border
                    border-blue-100
                    bg-gradient-to-r
                    from-blue-50
                    via-white
                    to-cyan-50
                    p-5

                    dark:border-blue-500/20
                    dark:from-blue-500/5
                    dark:via-white/[0.02]
                    dark:to-cyan-500/5

                    sm:flex-row
                    sm:items-center
                    sm:justify-between
                "
            >

                <div>

                    <p
                        class="
                            text-sm
                            font-bold
                            text-slate-800

                            dark:text-slate-200
                        "
                    >
                        Election preferences
                    </p>

                    <p
                        class="
                            mt-1
                            text-xs
                            leading-5
                            text-slate-500

                            dark:text-slate-400
                        "
                    >
                        Your choices are saved to your Electo account.
                    </p>

                </div>


                <button
                    type="submit"
                    class="
                        inline-flex
                        shrink-0
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
                        font-black
                        text-white
                        shadow-lg
                        shadow-blue-500/20
                        transition-all
                        duration-300

                        hover:-translate-y-0.5
                        hover:shadow-xl
                        hover:shadow-blue-500/30

                        focus:outline-none
                        focus:ring-2
                        focus:ring-blue-500/40
                    "
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
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

                    Save Election Preferences

                </button>

            </div>

        </form>

    </div>


    {{-- ========================================================= --}}
    {{-- QUICK INFORMATION --}}
    {{-- ========================================================= --}}

    <div class="grid gap-4 md:grid-cols-3">

        <div
            class="
                rounded-2xl
                border
                border-slate-200
                bg-white
                p-5
                shadow-sm

                dark:border-white/10
                dark:bg-[#132544]
            "
        >

            <div
                class="
                    text-lg
                "
            >
                🗳️
            </div>

            <h4
                class="
                    mt-3
                    text-sm
                    font-black
                    text-slate-900

                    dark:text-white
                "
            >
                Stay informed
            </h4>

            <p
                class="
                    mt-1
                    text-xs
                    leading-5
                    text-slate-500

                    dark:text-slate-400
                "
            >
                Never miss an important election deadline or voting event.
            </p>

        </div>


        <div
            class="
                rounded-2xl
                border
                border-slate-200
                bg-white
                p-5
                shadow-sm

                dark:border-white/10
                dark:bg-[#132544]
            "
        >

            <div class="text-lg">
                🔐
            </div>

            <h4
                class="
                    mt-3
                    text-sm
                    font-black
                    text-slate-900

                    dark:text-white
                "
            >
                Private to you
            </h4>

            <p
                class="
                    mt-1
                    text-xs
                    leading-5
                    text-slate-500

                    dark:text-slate-400
                "
            >
                These preferences only affect your own Electo account.
            </p>

        </div>


        <div
            class="
                rounded-2xl
                border
                border-slate-200
                bg-white
                p-5
                shadow-sm

                dark:border-white/10
                dark:bg-[#132544]
            "
        >

            <div class="text-lg">
                ⚡
            </div>

            <h4
                class="
                    mt-3
                    text-sm
                    font-black
                    text-slate-900

                    dark:text-white
                "
            >
                Instant confirmation
            </h4>

            <p
                class="
                    mt-1
                    text-xs
                    leading-5
                    text-slate-500

                    dark:text-slate-400
                "
            >
                Voting confirmations can appear in your notification center
                immediately after successful voting.
            </p>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- ELECTION TOGGLE JAVASCRIPT --}}
{{-- ========================================================= --}}

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const cards =
            document.querySelectorAll(
                '#elections .election-preference-card'
            );


        cards.forEach(function (card) {

            const checkbox =
                card.querySelector(
                    '.election-preference-checkbox'
                );

            const toggle =
                card.querySelector(
                    '.election-toggle'
                );

            const knob =
                card.querySelector(
                    '.election-toggle-knob'
                );


            if (
                !checkbox ||
                !toggle ||
                !knob
            ) {
                return;
            }


            /*
            |--------------------------------------------------------------------------
            | Premium Toggle Animation
            |--------------------------------------------------------------------------
            */

            toggle.style.transition =
                'background-color 0.25s ease, box-shadow 0.25s ease';


            knob.style.transition =
                'transform 0.25s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.25s ease';


            function updateElectionToggle() {

                if (checkbox.checked) {

                    toggle.style.backgroundColor =
                        '#2563eb';

                    toggle.style.boxShadow =
                        '0 4px 14px rgba(37,99,235,0.30)';

                    knob.style.transform =
                        'translateX(20px)';

                    knob.style.backgroundColor =
                        '#ffffff';

                    knob.style.boxShadow =
                        '0 2px 7px rgba(0,0,0,0.22)';

                } else {

                    toggle.style.backgroundColor =
                        '#cbd5e1';

                    toggle.style.boxShadow =
                        'inset 0 1px 3px rgba(0,0,0,0.12)';

                    knob.style.transform =
                        'translateX(0px)';

                    knob.style.backgroundColor =
                        '#ffffff';

                    knob.style.boxShadow =
                        '0 2px 5px rgba(0,0,0,0.15)';

                }

            }


            /*
            |--------------------------------------------------------------------------
            | Initial State
            |--------------------------------------------------------------------------
            */

            updateElectionToggle();


            /*
            |--------------------------------------------------------------------------
            | Change State
            |--------------------------------------------------------------------------
            */

            checkbox.addEventListener(
                'change',
                updateElectionToggle
            );

        });

    }
);

</script>


           {{-- ========================================================= --}}
{{-- CERTIFICATES --}}
{{-- ========================================================= --}}

<div
    id="certificates"
    class="settings-panel hidden space-y-6"
>

    {{-- ========================================================= --}}
    {{-- CERTIFICATE HERO --}}
    {{-- ========================================================= --}}

    <div
        class="relative overflow-hidden rounded-3xl
               border border-slate-200
               bg-white
               shadow-xl shadow-slate-200/40
               dark:border-white/10
               dark:bg-[#132544]"
    >

        <div
            class="pointer-events-none absolute -right-20 -top-20
                   h-60 w-60 rounded-full
                   bg-blue-500/10 blur-3xl"
        ></div>

        <div
            class="pointer-events-none absolute -bottom-24 -left-16
                   h-52 w-52 rounded-full
                   bg-cyan-400/10 blur-3xl"
        ></div>


        <div
            class="relative flex flex-col gap-6 p-6
                   md:flex-row md:items-center
                   md:justify-between md:p-8"
        >

            <div>

                <div
                    class="inline-flex items-center gap-2
                           rounded-full
                           border border-blue-200
                           bg-blue-50
                           px-3 py-1.5
                           text-[10px] font-black
                           uppercase tracking-[0.18em]
                           text-blue-600
                           dark:border-blue-400/20
                           dark:bg-blue-500/10
                           dark:text-blue-300"
                >

                    <span
                        class="h-1.5 w-1.5 rounded-full
                               bg-blue-600
                               shadow-[0_0_8px_rgba(37,99,235,0.8)]
                               dark:bg-blue-400"
                    ></span>

                    Certificate Center

                </div>


                <h3
                    class="mt-4 text-2xl font-black
                           tracking-tight text-slate-900
                           dark:text-white"
                >
                    Manage your certificates
                </h3>


                <p
                    class="mt-2 max-w-2xl text-sm
                           leading-6 text-slate-500
                           dark:text-slate-400"
                >
                    Control how Electo keeps you informed about certificates,
                    verification activity and certificate availability.
                </p>

            </div>


            {{-- HERO ICON --}}

            <div
                class="flex h-16 w-16 shrink-0
                       items-center justify-center
                       rounded-2xl
                       bg-gradient-to-br
                       from-blue-600
                       via-blue-500
                       to-cyan-500
                       text-white
                       shadow-xl
                       shadow-blue-500/25"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-8 w-8"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.7"
                >

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 3h9l4 4v14H6V3z"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 3v5h4"
                    />

                    <path
                        stroke-linecap="round"
                        d="M9 12h6M9 16h4"
                    />

                </svg>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- CERTIFICATE PREFERENCES --}}
    {{-- ========================================================= --}}

    <form
        method="POST"
        action="{{ route('settings.update') }}"
        id="certificatePreferencesForm"
    >

        @csrf
        @method('PUT')


        {{-- ===================================================== --}}
        {{-- PRESERVE OTHER SETTINGS --}}
        {{-- ===================================================== --}}

        <input
            type="hidden"
            name="theme"
            value="{{ $settings->theme ?? 'system' }}"
        >

        <input
            type="hidden"
            name="email_notifications"
            value="{{ $settings->email_notifications ? '1' : '0' }}"
        >

        <input
            type="hidden"
            name="election_notifications"
            value="{{ $settings->election_notifications ? '1' : '0' }}"
        >

        <input
            type="hidden"
            name="election_reminders"
            value="{{ $settings->election_reminders ? '1' : '0' }}"
        >

        <input
            type="hidden"
            name="election_registration_updates"
            value="{{ $settings->election_registration_updates ? '1' : '0' }}"
        >

        <input
            type="hidden"
            name="voting_confirmation"
            value="{{ $settings->voting_confirmation ? '1' : '0' }}"
        >

        <input
            type="hidden"
            name="election_closing_reminders"
            value="{{ $settings->election_closing_reminders ? '1' : '0' }}"
        >

        <input
            type="hidden"
            name="result_notifications"
            value="{{ $settings->result_notifications ? '1' : '0' }}"
        >

        <input
            type="hidden"
            name="certificate_notifications"
            value="{{ $settings->certificate_notifications ? '1' : '0' }}"
        >

        <input
            type="hidden"
            name="security_notifications"
            value="{{ $settings->security_notifications ? '1' : '0' }}"
        >


        {{-- ===================================================== --}}
        {{-- MAIN CARD --}}
        {{-- ===================================================== --}}

        <div
            class="overflow-hidden rounded-3xl
                   border border-slate-200
                   bg-white
                   shadow-xl shadow-slate-200/40
                   dark:border-white/10
                   dark:bg-[#132544]"
        >

            {{-- HEADER --}}

            <div
                class="border-b border-slate-200
                       px-6 py-5
                       dark:border-white/10
                       md:px-8"
            >

                <h3
                    class="text-lg font-black
                           text-slate-900
                           dark:text-white"
                >
                    Certificate Preferences
                </h3>

                <p
                    class="mt-1 text-sm
                           text-slate-500
                           dark:text-slate-400"
                >
                    Choose which certificate-related updates you would like
                    Electo to send to your account.
                </p>

            </div>


            {{-- ================================================= --}}
            {{-- PREFERENCE GRID --}}
            {{-- ================================================= --}}

            <div
                class="grid gap-5 p-6 md:grid-cols-2 md:p-8"
            >


                {{-- ================================================= --}}
                {{-- CERTIFICATE ISSUED --}}
                {{-- ================================================= --}}

                <label
                    class="certificate-toggle-card
                           group block cursor-pointer"
                >

                    <input
                        type="hidden"
                        name="certificate_issued_notifications"
                        value="0"
                    >

                    <input
                        type="checkbox"
                        name="certificate_issued_notifications"
                        value="1"
                        class="certificate-toggle-input sr-only"
                        {{ $settings->certificate_issued_notifications ? 'checked' : '' }}
                    >


                    <div
                        class="certificate-card
                               rounded-2xl
                               border border-slate-200
                               bg-slate-50
                               p-5
                               transition-all duration-300

                               hover:-translate-y-1
                               hover:border-blue-300
                               hover:bg-white
                               hover:shadow-xl
                               hover:shadow-blue-500/10

                               dark:border-white/10
                               dark:bg-white/[0.03]
                               dark:hover:border-blue-400/30
                               dark:hover:bg-white/[0.06]"
                    >

                        <div
                            class="flex items-start
                                   justify-between gap-4"
                        >

                            <div
                                class="flex min-w-0 gap-4"
                            >

                                <div
                                    class="flex h-11 w-11 shrink-0
                                           items-center justify-center
                                           rounded-xl
                                           bg-blue-100
                                           text-blue-600
                                           dark:bg-blue-500/10
                                           dark:text-blue-300"
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M6 3h9l4 4v14H6V3z"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M15 3v5h4"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            d="M9 12h6"
                                        />

                                    </svg>

                                </div>


                                <div class="min-w-0">

                                    <h4
                                        class="font-bold
                                               text-slate-900
                                               dark:text-white"
                                    >
                                        Certificate Issued
                                    </h4>

                                    <p
                                        class="mt-1 text-xs
                                               leading-5
                                               text-slate-500
                                               dark:text-slate-400"
                                    >
                                        Get notified when an official
                                        certificate is issued to you.
                                    </p>

                                </div>

                            </div>


                            {{-- SWITCH --}}

                            <span
                                class="certificate-switch relative
                                       mt-1 flex h-7 w-12 shrink-0
                                       items-center rounded-full
                                       bg-slate-300 p-1
                                       shadow-inner"
                            >

                                <span
                                    class="certificate-knob block
                                           h-5 w-5 rounded-full
                                           bg-white shadow-md"
                                ></span>

                            </span>

                        </div>

                    </div>

                </label>


                {{-- ================================================= --}}
                {{-- CERTIFICATE STATUS --}}
                {{-- ================================================= --}}

                <label
                    class="certificate-toggle-card
                           group block cursor-pointer"
                >

                    <input
                        type="hidden"
                        name="certificate_status_updates"
                        value="0"
                    >

                    <input
                        type="checkbox"
                        name="certificate_status_updates"
                        value="1"
                        class="certificate-toggle-input sr-only"
                        {{ $settings->certificate_status_updates ? 'checked' : '' }}
                    >


                    <div
                        class="certificate-card
                               rounded-2xl
                               border border-slate-200
                               bg-slate-50
                               p-5
                               transition-all duration-300

                               hover:-translate-y-1
                               hover:border-blue-300
                               hover:bg-white
                               hover:shadow-xl
                               hover:shadow-blue-500/10

                               dark:border-white/10
                               dark:bg-white/[0.03]
                               dark:hover:border-blue-400/30
                               dark:hover:bg-white/[0.06]"
                    >

                        <div
                            class="flex items-start
                                   justify-between gap-4"
                        >

                            <div
                                class="flex min-w-0 gap-4"
                            >

                                <div
                                    class="flex h-11 w-11 shrink-0
                                           items-center justify-center
                                           rounded-xl
                                           bg-blue-100
                                           text-blue-600
                                           dark:bg-blue-500/10
                                           dark:text-blue-300"
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M9 12l2 2 4-4"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 3l8 4v5c0 5-3.5 8-8 9-4.5-1-8-4-8-9V7l8-4z"
                                        />

                                    </svg>

                                </div>


                                <div class="min-w-0">

                                    <h4
                                        class="font-bold
                                               text-slate-900
                                               dark:text-white"
                                    >
                                        Certificate Status
                                    </h4>

                                    <p
                                        class="mt-1 text-xs
                                               leading-5
                                               text-slate-500
                                               dark:text-slate-400"
                                    >
                                        Receive updates when the status of
                                        your certificate changes.
                                    </p>

                                </div>

                            </div>


                            <span
                                class="certificate-switch relative
                                       mt-1 flex h-7 w-12 shrink-0
                                       items-center rounded-full
                                       bg-slate-300 p-1
                                       shadow-inner"
                            >

                                <span
                                    class="certificate-knob block
                                           h-5 w-5 rounded-full
                                           bg-white shadow-md"
                                ></span>

                            </span>

                        </div>

                    </div>

                </label>


                {{-- ================================================= --}}
                {{-- VERIFICATION UPDATES --}}
                {{-- ================================================= --}}

                <label
                    class="certificate-toggle-card
                           group block cursor-pointer"
                >

                    <input
                        type="hidden"
                        name="certificate_verification_updates"
                        value="0"
                    >

                    <input
                        type="checkbox"
                        name="certificate_verification_updates"
                        value="1"
                        class="certificate-toggle-input sr-only"
                        {{ $settings->certificate_verification_updates ? 'checked' : '' }}
                    >


                    <div
                        class="certificate-card
                               rounded-2xl
                               border border-slate-200
                               bg-slate-50
                               p-5
                               transition-all duration-300

                               hover:-translate-y-1
                               hover:border-blue-300
                               hover:bg-white
                               hover:shadow-xl
                               hover:shadow-blue-500/10

                               dark:border-white/10
                               dark:bg-white/[0.03]
                               dark:hover:border-blue-400/30
                               dark:hover:bg-white/[0.06]"
                    >

                        <div
                            class="flex items-start
                                   justify-between gap-4"
                        >

                            <div
                                class="flex min-w-0 gap-4"
                            >

                                <div
                                    class="flex h-11 w-11 shrink-0
                                           items-center justify-center
                                           rounded-xl
                                           bg-blue-100
                                           text-blue-600
                                           dark:bg-blue-500/10
                                           dark:text-blue-300"
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >

                                        <circle
                                            cx="11"
                                            cy="11"
                                            r="6"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            d="M16 16l4 4"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            d="M11 8v3l2 1"
                                        />

                                    </svg>

                                </div>


                                <div class="min-w-0">

                                    <h4
                                        class="font-bold
                                               text-slate-900
                                               dark:text-white"
                                    >
                                        Verification Updates
                                    </h4>

                                    <p
                                        class="mt-1 text-xs
                                               leading-5
                                               text-slate-500
                                               dark:text-slate-400"
                                    >
                                        Receive important updates related
                                        to certificate verification activity.
                                    </p>

                                </div>

                            </div>


                            <span
                                class="certificate-switch relative
                                       mt-1 flex h-7 w-12 shrink-0
                                       items-center rounded-full
                                       bg-slate-300 p-1
                                       shadow-inner"
                            >

                                <span
                                    class="certificate-knob block
                                           h-5 w-5 rounded-full
                                           bg-white shadow-md"
                                ></span>

                            </span>

                        </div>

                    </div>

                </label>


                {{-- ================================================= --}}
                {{-- CERTIFICATE AVAILABILITY --}}
                {{-- ================================================= --}}

                <label
                    class="certificate-toggle-card
                           group block cursor-pointer"
                >

                    <input
                        type="hidden"
                        name="certificate_availability_updates"
                        value="0"
                    >

                    <input
                        type="checkbox"
                        name="certificate_availability_updates"
                        value="1"
                        class="certificate-toggle-input sr-only"
                        {{ $settings->certificate_availability_updates ? 'checked' : '' }}
                    >


                    <div
                        class="certificate-card
                               rounded-2xl
                               border border-slate-200
                               bg-slate-50
                               p-5
                               transition-all duration-300

                               hover:-translate-y-1
                               hover:border-blue-300
                               hover:bg-white
                               hover:shadow-xl
                               hover:shadow-blue-500/10

                               dark:border-white/10
                               dark:bg-white/[0.03]
                               dark:hover:border-blue-400/30
                               dark:hover:bg-white/[0.06]"
                    >

                        <div
                            class="flex items-start
                                   justify-between gap-4"
                        >

                            <div
                                class="flex min-w-0 gap-4"
                            >

                                <div
                                    class="flex h-11 w-11 shrink-0
                                           items-center justify-center
                                           rounded-xl
                                           bg-blue-100
                                           text-blue-600
                                           dark:bg-blue-500/10
                                           dark:text-blue-300"
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M6 3h9l3 3v15H6V3z"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M9 12h6M9 16h4"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M15 3v4h3"
                                        />

                                    </svg>

                                </div>


                                <div class="min-w-0">

                                    <h4
                                        class="font-bold
                                               text-slate-900
                                               dark:text-white"
                                    >
                                        Certificate Availability
                                    </h4>

                                    <p
                                        class="mt-1 text-xs
                                               leading-5
                                               text-slate-500
                                               dark:text-slate-400"
                                    >
                                        Get notified when your certificate
                                        becomes available to view or download.
                                    </p>

                                </div>

                            </div>


                            <span
                                class="certificate-switch relative
                                       mt-1 flex h-7 w-12 shrink-0
                                       items-center rounded-full
                                       bg-slate-300 p-1
                                       shadow-inner"
                            >

                                <span
                                    class="certificate-knob block
                                           h-5 w-5 rounded-full
                                           bg-white shadow-md"
                                ></span>

                            </span>

                        </div>

                    </div>

                </label>

            </div>


            {{-- ================================================= --}}
            {{-- SAVE BAR --}}
            {{-- ================================================= --}}

            <div
                class="mx-6 mb-6
                       flex flex-col gap-4
                       rounded-2xl
                       border border-blue-100
                       bg-gradient-to-r
                       from-blue-50 to-cyan-50
                       p-5

                       sm:mx-8 sm:mb-8
                       sm:flex-row
                       sm:items-center
                       sm:justify-between

                       dark:border-blue-400/10
                       dark:bg-blue-500/5"
            >

                <div>

                    <p
                        class="text-sm font-black
                               text-slate-800
                               dark:text-white"
                    >
                        Certificate preferences
                    </p>

                    <p
                        class="mt-1 text-xs leading-5
                               text-slate-500
                               dark:text-slate-400"
                    >
                        Your certificate notification choices are saved
                        securely to your Electo account.
                    </p>

                </div>


                <button
                    type="submit"
                    class="inline-flex items-center
                           justify-center gap-2
                           rounded-xl

                           bg-gradient-to-r
                           from-blue-600 to-cyan-500

                           px-6 py-3

                           text-sm font-bold
                           text-white

                           shadow-lg
                           shadow-blue-500/20

                           transition-all duration-200

                           hover:-translate-y-0.5
                           hover:shadow-xl
                           hover:shadow-blue-500/25

                           focus:outline-none
                           focus:ring-4
                           focus:ring-blue-500/20"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
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

                    Save Certificate Preferences

                </button>

            </div>

        </div>

    </form>


    {{-- ========================================================= --}}
    {{-- INFORMATION CARDS --}}
    {{-- ========================================================= --}}

    <div class="grid gap-4 md:grid-cols-3">


        {{-- OFFICIAL CERTIFICATES --}}

        <div
            class="rounded-2xl
                   border border-slate-200
                   bg-white
                   p-5
                   shadow-sm
                   transition
                   hover:-translate-y-1
                   hover:shadow-lg
                   dark:border-white/10
                   dark:bg-[#132544]"
        >

            <div
                class="flex h-11 w-11
                       items-center justify-center
                       rounded-xl
                       bg-blue-100
                       text-blue-600
                       dark:bg-blue-500/10
                       dark:text-blue-300"
            >

                🏆

            </div>

            <p
                class="mt-4 text-xs font-black
                       uppercase tracking-wider
                       text-slate-400"
            >
                Official certificates
            </p>

            <h4
                class="mt-1 font-black
                       text-slate-900
                       dark:text-white"
            >
                Verified achievements
            </h4>

            <p
                class="mt-2 text-xs leading-5
                       text-slate-500
                       dark:text-slate-400"
            >
                Certificates issued through Electo remain linked to the
                corresponding election and winner.
            </p>

        </div>


        {{-- EASY VERIFICATION --}}

        <div
            class="rounded-2xl
                   border border-slate-200
                   bg-white
                   p-5
                   shadow-sm
                   transition
                   hover:-translate-y-1
                   hover:shadow-lg
                   dark:border-white/10
                   dark:bg-[#132544]"
        >

            <div
                class="flex h-11 w-11
                       items-center justify-center
                       rounded-xl
                       bg-blue-100
                       text-blue-600
                       dark:bg-blue-500/10
                       dark:text-blue-300"
            >

                🔎

            </div>

            <p
                class="mt-4 text-xs font-black
                       uppercase tracking-wider
                       text-slate-400"
            >
                Easy verification
            </p>

            <h4
                class="mt-1 font-black
                       text-slate-900
                       dark:text-white"
            >
                Verify with confidence
            </h4>

            <p
                class="mt-2 text-xs leading-5
                       text-slate-500
                       dark:text-slate-400"
            >
                Certificate verification helps confirm the authenticity
                of official Electo certificates.
            </p>

        </div>


        {{-- SECURE RECORDS --}}

        <div
            class="rounded-2xl
                   border border-slate-200
                   bg-white
                   p-5
                   shadow-sm
                   transition
                   hover:-translate-y-1
                   hover:shadow-lg
                   dark:border-white/10
                   dark:bg-[#132544]"
        >

            <div
                class="flex h-11 w-11
                       items-center justify-center
                       rounded-xl
                       bg-blue-100
                       text-blue-600
                       dark:bg-blue-500/10
                       dark:text-blue-300"
            >

                🔐

            </div>

            <p
                class="mt-4 text-xs font-black
                       uppercase tracking-wider
                       text-slate-400"
            >
                Secure records
            </p>

            <h4
                class="mt-1 font-black
                       text-slate-900
                       dark:text-white"
            >
                Private to you
            </h4>

            <p
                class="mt-2 text-xs leading-5
                       text-slate-500
                       dark:text-slate-400"
            >
                Your certificate preferences are stored with your Electo
                account and can be changed at any time.
            </p>

        </div>

    </div>


</div>


{{-- ========================================================= --}}
{{-- CERTIFICATE TOGGLE JAVASCRIPT --}}
{{-- ========================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const certificateCards =
        document.querySelectorAll(
            '.certificate-toggle-card'
        );


    certificateCards.forEach(function (card) {

        const checkbox =
            card.querySelector(
                '.certificate-toggle-input'
            );

        const toggle =
            card.querySelector(
                '.certificate-switch'
            );

        const knob =
            card.querySelector(
                '.certificate-knob'
            );

        const panelCard =
            card.querySelector(
                '.certificate-card'
            );


        if (
            !checkbox ||
            !toggle ||
            !knob
        ) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE SWITCH VISUAL
        |--------------------------------------------------------------------------
        */

        function updateCertificateToggle() {

            if (checkbox.checked) {

                // BLUE ON

                toggle.style.backgroundColor =
                    '#2563eb';

                toggle.style.boxShadow =
                    '0 4px 12px rgba(37,99,235,0.30)';

                knob.style.transform =
                    'translateX(20px)';

                knob.style.backgroundColor =
                    '#ffffff';

                knob.style.boxShadow =
                    '0 2px 6px rgba(0,0,0,0.20)';


                // PREMIUM ACTIVE CARD

                panelCard.style.borderColor =
                    '#3b82f6';

                panelCard.style.backgroundColor =
                    'rgba(239,246,255,0.75)';

                panelCard.style.boxShadow =
                    '0 8px 25px rgba(37,99,235,0.08)';

            } else {

                // GRAY OFF

                toggle.style.backgroundColor =
                    '#cbd5e1';

                toggle.style.boxShadow =
                    'inset 0 1px 3px rgba(0,0,0,0.12)';

                knob.style.transform =
                    'translateX(0px)';

                knob.style.backgroundColor =
                    '#ffffff';

                knob.style.boxShadow =
                    '0 2px 5px rgba(0,0,0,0.15)';


                // NORMAL CARD

                panelCard.style.borderColor =
                    '#e2e8f0';

                panelCard.style.backgroundColor =
                    '#f8fafc';

                panelCard.style.boxShadow =
                    'none';

            }

        }


        /*
        |--------------------------------------------------------------------------
        | TRANSITIONS
        |--------------------------------------------------------------------------
        */

        toggle.style.transition =
            'background-color 0.25s ease, box-shadow 0.25s ease';

        knob.style.transition =
            'transform 0.25s cubic-bezier(0.4,0,0.2,1), box-shadow 0.25s ease';

        panelCard.style.transition =
            'border-color 0.25s ease, background-color 0.25s ease, box-shadow 0.25s ease';


        /*
        |--------------------------------------------------------------------------
        | INITIAL STATE
        |--------------------------------------------------------------------------
        */

        updateCertificateToggle();


        /*
        |--------------------------------------------------------------------------
        | CLICK / CHANGE
        |--------------------------------------------------------------------------
        */

        checkbox.addEventListener(
            'change',
            updateCertificateToggle
        );

    });

});

</script>
            </div>

        </section>

    </div>

</div>


{{-- ========================================================= --}}
{{-- SETTINGS JAVASCRIPT --}}
{{-- ========================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | SETTINGS TABS
    |--------------------------------------------------------------------------
    */

    const tabs = document.querySelectorAll('.settings-tab');
    const panels = document.querySelectorAll('.settings-panel');


    function activateTab(target, updateUrl = true) {

        panels.forEach(function (panel) {
            panel.classList.add('hidden');
        });


        tabs.forEach(function (tab) {

            tab.classList.remove(
                'bg-blue-50',
                'text-blue-600',
                'dark:bg-blue-600/15',
                'dark:text-cyan-300'
            );

            tab.classList.add(
                'text-slate-600',
                'dark:text-slate-400'
            );

        });


        const selectedPanel =
            document.getElementById(target);

        if (selectedPanel) {
            selectedPanel.classList.remove('hidden');
        }


        const selectedTab =
            document.querySelector(
                '.settings-tab[data-target="' + target + '"]'
            );


        if (selectedTab) {

            selectedTab.classList.remove(
                'text-slate-600',
                'dark:text-slate-400'
            );

            selectedTab.classList.add(
                'bg-blue-50',
                'text-blue-600',
                'dark:bg-blue-600/15',
                'dark:text-cyan-300'
            );

        }


        if (updateUrl) {

            const url =
                new URL(window.location.href);

            url.searchParams.set(
                'section',
                target
            );

            window.history.replaceState(
                {},
                '',
                url
            );

        }

    }


    tabs.forEach(function (tab) {

        tab.addEventListener('click', function () {

            activateTab(
                this.dataset.target
            );

        });

    });


    /*
    |--------------------------------------------------------------------------
    | OPEN SETTINGS SECTION FROM URL
    |--------------------------------------------------------------------------
    */

    const params =
        new URLSearchParams(
            window.location.search
        );


    const requestedSection =
        params.get('section');


    const validSections = [
        'appearance',
        'account',
        'security',
        'notifications',
        'elections',
        'certificates'
    ];


    if (
        requestedSection &&
        validSections.includes(requestedSection)
    ) {

        activateTab(
            requestedSection,
            false
        );

    } else {

        activateTab(
            'appearance',
            false
        );

    }


    /*
    |--------------------------------------------------------------------------
    | PREMIUM NOTIFICATION TOGGLES
    |--------------------------------------------------------------------------
    */

    const notificationCards =
        document.querySelectorAll(
            '#notifications label.group'
        );


    notificationCards.forEach(function (card) {

        const checkbox =
            card.querySelector(
                'input[type="checkbox"]'
            );


        const toggle =
            card.querySelector(
                'span.relative.mt-1'
            ) ||
            card.querySelector(
                'span.relative.h-6'
            );


        const knob =
            toggle
                ? toggle.querySelector(
                    'span.absolute'
                )
                : null;


        if (
            !checkbox ||
            !toggle ||
            !knob
        ) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Update the visual switch
        |--------------------------------------------------------------------------
        */

        function updateToggle() {

            if (checkbox.checked) {

                /*
                --------------------------------------------------------------
                ON STATE
                --------------------------------------------------------------
                */

                toggle.style.backgroundColor =
                    checkbox.name ===
                    'security_notifications'
                        ? '#10b981'
                        : '#2563eb';


                toggle.style.boxShadow =
                    checkbox.name ===
                    'security_notifications'
                        ? '0 4px 12px rgba(16,185,129,0.30)'
                        : '0 4px 12px rgba(37,99,235,0.30)';


                knob.style.transform =
                    'translateX(20px)';


                knob.style.backgroundColor =
                    '#ffffff';


                knob.style.boxShadow =
                    '0 2px 6px rgba(0,0,0,0.20)';


            } else {

                /*
                --------------------------------------------------------------
                OFF STATE
                --------------------------------------------------------------
                */

                toggle.style.backgroundColor =
                    '#cbd5e1';


                toggle.style.boxShadow =
                    'inset 0 1px 3px rgba(0,0,0,0.12)';


                knob.style.transform =
                    'translateX(0px)';


                knob.style.backgroundColor =
                    '#ffffff';


                knob.style.boxShadow =
                    '0 2px 5px rgba(0,0,0,0.15)';

            }

        }


        /*
        |--------------------------------------------------------------------------
        | Add smooth animation
        |--------------------------------------------------------------------------
        */

        toggle.style.transition =
            'background-color 0.25s ease, box-shadow 0.25s ease';


        knob.style.transition =
            'transform 0.25s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.25s ease';


        /*
        |--------------------------------------------------------------------------
        | Initial state
        |--------------------------------------------------------------------------
        */

        updateToggle();


        /*
        |--------------------------------------------------------------------------
        | When checkbox changes
        |--------------------------------------------------------------------------
        */

        checkbox.addEventListener(
            'change',
            updateToggle
        );

    });


    /*
    |--------------------------------------------------------------------------
    | AVATAR PREVIEW
    |--------------------------------------------------------------------------
    */

    window.previewAvatar = function (event) {

        const input =
            event.target;


        if (
            !input.files ||
            !input.files[0]
        ) {
            return;
        }


        const file =
            input.files[0];


        if (
            !file.type.startsWith('image/')
        ) {
            return;
        }


        const reader =
            new FileReader();


        reader.onload = function (e) {

            const preview =
                document.getElementById(
                    'profilePreview'
                );


            if (!preview) {
                return;
            }


            const image =
                document.createElement('img');


            image.id =
                'profilePreview';


            image.src =
                e.target.result;


            image.alt =
                'Profile preview';


            image.className =
                'h-28 w-28 rounded-2xl object-cover ring-4 ring-blue-500/10 shadow-xl';


            preview.replaceWith(
                image
            );

        };


        reader.readAsDataURL(file);

    };

});

</script>

@endsection