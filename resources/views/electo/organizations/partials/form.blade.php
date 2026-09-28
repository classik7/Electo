<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- Organization Name --}}
    <x-electo.input
        label="Organization Name"
        name="name"
        :value="$organization->name ?? ''"
        required
    />

    {{-- Email Address --}}
    <x-electo.input
        label="Email Address"
        name="email"
        type="email"
        :value="$organization->email ?? ''"
    />

    {{-- Phone Number --}}
    <x-electo.input
        label="Phone Number"
        name="phone"
        :value="$organization->phone ?? ''"
    />

    {{-- Website --}}

<div class="space-y-2">

    <label
        for="website"
        class="block text-sm font-semibold text-slate-700">

        Website

    </label>

    <div
        class="flex overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm
               transition
               focus-within:border-blue-500
               focus-within:ring-4
               focus-within:ring-blue-500/10">

        {{-- Fixed HTTPS prefix --}}

        <span
            class="flex items-center border-r border-slate-200
                   bg-slate-50 px-4
                   text-sm font-semibold text-slate-500">

            https://

        </span>

        {{-- Website input --}}

        <input
            id="website"
            name="website"
            type="text"
            value="{{ old('website', isset($organization) && $organization->website ? preg_replace('/^https?:\/\//i', '', $organization->website) : '') }}"
            placeholder="example.com"
            autocomplete="url"
            class="min-w-0 flex-1 border-0 bg-white px-4 py-3
                   text-sm text-slate-800
                   placeholder:text-slate-400
                   focus:outline-none focus:ring-0"
        >

    </div>

    @error('website')

        <p class="text-sm font-medium text-red-500">
            {{ $message }}
        </p>

    @enderror

    <p class="text-xs text-slate-400">
        Enter your website address without
        <strong>https://</strong>.
    </p>

</div>

    {{-- Country --}}
    <x-electo.input
        label="Country"
        name="country"
        :value="$organization->country ?? ''"
    />

    {{-- State --}}
    <x-electo.input
        label="State"
        name="state"
        :value="$organization->state ?? ''"
    />

    {{-- City --}}
    <x-electo.input
        label="City"
        name="city"
        :value="$organization->city ?? ''"
    />

    {{-- Address --}}
    <x-electo.input
        label="Address"
        name="address"
        :value="$organization->address ?? ''"
    />

</div>


{{-- =========================================================
     DESCRIPTION
========================================================= --}}

<div class="mt-6">

    <label
        for="description"
        class="mb-2 block text-sm font-semibold text-slate-700"
    >
        Description
    </label>

    <textarea
        id="description"
        name="description"
        rows="5"
        placeholder="Tell us a little about your organization..."
        class="w-full resize-none rounded-xl
               border border-slate-200
               bg-white
               px-4 py-3
               text-sm text-slate-800
               placeholder:text-slate-400
               shadow-sm
               outline-none
               transition
               focus:border-blue-500
               focus:ring-4
               focus:ring-blue-500/10"
    >{{ old('description', $organization->description ?? '') }}</textarea>

    @error('description')
        <p class="mt-2 text-sm text-red-500">
            {{ $message }}
        </p>
    @enderror

</div>