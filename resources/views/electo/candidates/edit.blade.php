@extends('electo.layouts.dashboard')

@section('title', 'Edit Candidate')
@section('page-title', 'Edit Candidate')

@section('content')

<div class="mx-auto w-full max-w-6xl space-y-8">

    {{-- ========================================================= --}}
    {{-- PAGE HEADER --}}
    {{-- ========================================================= --}}

    <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">

        <div class="min-w-0">

            <div class="mb-3 flex items-center gap-2">

                <span
                    class="inline-flex items-center gap-2 rounded-full
                           border border-blue-200 bg-blue-50
                           px-3 py-1.5
                           text-[11px] font-bold uppercase tracking-[0.16em]
                           text-blue-700
                           dark:border-blue-400/20
                           dark:bg-blue-500/10
                           dark:text-blue-300"
                >

                    <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>

                    Candidate Management

                </span>

            </div>


            <h1
                class="text-3xl font-black tracking-tight text-slate-950
                       sm:text-4xl
                       dark:text-white"
            >
                Edit Candidate
            </h1>


            <p
                class="mt-2 max-w-2xl text-sm leading-6 text-slate-500
                       dark:text-slate-400"
            >
                Update this candidate's information, contesting position,
                biography and voting status.
            </p>

        </div>


        <a
            href="{{ route('candidates.show', $candidate) }}"
            class="group inline-flex shrink-0 items-center justify-center gap-2
                   rounded-xl
                   border border-slate-200
                   bg-white
                   px-5 py-3
                   text-sm font-bold
                   text-slate-700
                   shadow-sm
                   transition-all duration-200
                   hover:-translate-y-0.5
                   hover:border-blue-200
                   hover:bg-blue-50
                   hover:text-blue-700
                   hover:shadow-md
                   dark:border-white/10
                   dark:bg-white/[0.04]
                   dark:text-slate-200
                   dark:hover:border-blue-400/30
                   dark:hover:bg-blue-500/10
                   dark:hover:text-blue-300"
        >

            <x-heroicon-o-arrow-left
                class="h-5 w-5 transition-transform duration-200
                       group-hover:-translate-x-0.5"
            />

            Back to Candidate

        </a>

    </div>


    {{-- ========================================================= --}}
    {{-- VALIDATION ERRORS --}}
    {{-- ========================================================= --}}

    @if ($errors->any())

        <div
            class="rounded-2xl
                   border border-red-200
                   bg-red-50
                   p-5
                   shadow-sm
                   dark:border-red-400/20
                   dark:bg-red-500/10"
        >

            <div class="flex items-start gap-4">

                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center
                           rounded-xl
                           bg-red-100
                           text-red-600
                           dark:bg-red-500/15
                           dark:text-red-400"
                >

                    <x-heroicon-o-exclamation-triangle
                        class="h-5 w-5"
                    />

                </div>


                <div class="min-w-0">

                    <h3
                        class="font-bold text-red-800
                               dark:text-red-300"
                    >
                        Please correct the following
                    </h3>


                    <ul
                        class="mt-2 list-disc space-y-1 pl-5
                               text-sm text-red-700
                               dark:text-red-300"
                    >

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- ========================================================= --}}
    {{-- ELECTION CONTEXT --}}
    {{-- ========================================================= --}}

    <div class="grid gap-5 lg:grid-cols-2">

        {{-- Election --}}

        <div
            class="group relative overflow-hidden rounded-2xl
                   border border-slate-200
                   bg-white
                   p-6
                   shadow-sm
                   transition-all duration-200
                   hover:shadow-md
                   dark:border-white/10
                   dark:bg-[#101c32]"
        >

            <div
                class="absolute right-0 top-0 h-24 w-24
                       rounded-full
                       bg-blue-500/10
                       blur-2xl
                       dark:bg-blue-500/10"
            ></div>


            <div class="relative">

                <div class="flex items-start gap-4">

                    <div
                        class="flex h-11 w-11 shrink-0 items-center justify-center
                               rounded-xl
                               bg-blue-50
                               text-blue-600
                               dark:bg-blue-500/10
                               dark:text-blue-400"
                    >

                        <x-heroicon-o-building-office-2
                            class="h-5 w-5"
                        />

                    </div>


                    <div class="min-w-0">

                        <p
                            class="text-[11px] font-bold uppercase tracking-[0.15em]
                                   text-slate-400
                                   dark:text-slate-500"
                        >
                            Election
                        </p>


                        <p
                            class="mt-1 truncate text-base font-bold
                                   text-slate-900
                                   dark:text-white"
                        >
                            {{ $candidate->election->title }}
                        </p>


                        <p
                            class="mt-1 text-xs text-slate-500
                                   dark:text-slate-400"
                        >
                            {{ $candidate->election->organization->name ?? 'Organization' }}
                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- Current Position --}}

        <div
            class="group relative overflow-hidden rounded-2xl
                   border border-indigo-200
                   bg-gradient-to-br from-indigo-50 to-blue-50
                   p-6
                   shadow-sm
                   transition-all duration-200
                   hover:shadow-md
                   dark:border-indigo-400/20
                   dark:from-indigo-500/10
                   dark:to-blue-500/10"
        >

            <div
                class="absolute right-0 top-0 h-24 w-24
                       rounded-full
                       bg-indigo-500/10
                       blur-2xl"
            ></div>


            <div class="relative">

                <div class="flex items-start gap-4">

                    <div
                        class="flex h-11 w-11 shrink-0 items-center justify-center
                               rounded-xl
                               bg-white
                               text-indigo-600
                               shadow-sm
                               dark:bg-white/10
                               dark:text-indigo-300"
                    >

                        <x-heroicon-o-identification
                            class="h-5 w-5"
                        />

                    </div>


                    <div class="min-w-0">

                        <p
                            class="text-[11px] font-bold uppercase tracking-[0.15em]
                                   text-slate-400
                                   dark:text-slate-500"
                        >
                            Current Position
                        </p>


                        <p
                            class="mt-1 text-base font-bold
                                   text-slate-900
                                   dark:text-white"
                        >
                            {{ $candidate->position->name }}
                        </p>


                        <p
                            class="mt-1 text-xs text-slate-500
                                   dark:text-slate-400"
                        >
                            You can change the contesting position below.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- MAIN FORM --}}
    {{-- ========================================================= --}}

    <form
        method="POST"
        action="{{ route('candidates.update', $candidate) }}"
        enctype="multipart/form-data"
        class="overflow-hidden rounded-3xl
               border border-slate-200
               bg-white
               shadow-sm
               dark:border-white/10
               dark:bg-[#101c32]"
    >

        @csrf

        @method('PUT')


        {{-- ===================================================== --}}
        {{-- FORM HEADER --}}
        {{-- ===================================================== --}}

        <div
            class="border-b border-slate-100
                   bg-slate-50/70
                   px-6 py-6
                   md:px-8
                   dark:border-white/10
                   dark:bg-white/[0.025]"
        >

            <div class="flex items-center gap-4">

                <div
                    class="flex h-11 w-11 shrink-0 items-center justify-center
                           rounded-xl
                           bg-blue-600
                           text-white
                           shadow-lg
                           shadow-blue-600/20"
                >

                    <x-heroicon-o-user-circle
                        class="h-6 w-6"
                    />

                </div>


                <div>

                    <h2
                        class="text-lg font-black text-slate-900
                               dark:text-white"
                    >
                        Candidate Information
                    </h2>


                    <p
                        class="mt-1 text-sm text-slate-500
                               dark:text-slate-400"
                    >
                        Keep the candidate's information accurate and
                        election-ready.
                    </p>

                </div>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- FORM BODY --}}
        {{-- ===================================================== --}}

        <div class="p-6 md:p-8">

            <div class="grid gap-7 md:grid-cols-2">


                {{-- ================================================= --}}
                {{-- CANDIDATE NAME --}}
                {{-- ================================================= --}}

                <div class="md:col-span-2">

                    <label
                        for="name"
                        class="mb-2 block text-sm font-bold
                               text-slate-700
                               dark:text-slate-200"
                    >

                        Candidate Name

                        <span class="ml-1 text-red-500">*</span>

                    </label>


                    <div class="relative">

                        <div
                            class="pointer-events-none absolute inset-y-0 left-0
                                   flex items-center pl-4
                                   text-slate-400
                                   dark:text-slate-500"
                        >

                            <x-heroicon-o-user
                                class="h-5 w-5"
                            />

                        </div>


                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name', $candidate->name) }}"
                            required
                            autocomplete="off"
                            placeholder="Enter candidate's full name"
                            class="w-full rounded-xl
                                   border border-slate-200
                                   bg-white
                                   py-3.5 pl-12 pr-4
                                   text-sm font-medium
                                   text-slate-900
                                   placeholder:text-slate-400
                                   shadow-sm
                                   outline-none
                                   transition
                                   focus:border-blue-500
                                   focus:ring-4
                                   focus:ring-blue-500/10
                                   dark:border-white/10
                                   dark:bg-[#0b1528]
                                   dark:text-white
                                   dark:placeholder:text-slate-500
                                   dark:focus:border-blue-400
                                   dark:focus:ring-blue-400/10"
                        >

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- POSITION --}}
                {{-- ================================================= --}}

                <div class="md:col-span-2">

                    <label
                        for="election_position_id"
                        class="mb-2 block text-sm font-bold
                               text-slate-700
                               dark:text-slate-200"
                    >

                        Contesting Position

                        <span class="ml-1 text-red-500">*</span>

                    </label>


                    <div class="relative">

                        <div
                            class="pointer-events-none absolute inset-y-0 left-0
                                   z-10 flex items-center pl-4
                                   text-slate-400
                                   dark:text-slate-500"
                        >

                            <x-heroicon-o-briefcase
                                class="h-5 w-5"
                            />

                        </div>


                        <select
                            id="election_position_id"
                            name="election_position_id"
                            required
                            class="w-full appearance-none rounded-xl
                                   border border-slate-200
                                   bg-white
                                   px-12 py-3.5
                                   text-sm font-medium
                                   text-slate-900
                                   shadow-sm
                                   outline-none
                                   transition
                                   focus:border-blue-500
                                   focus:ring-4
                                   focus:ring-blue-500/10
                                   dark:border-white/10
                                   dark:bg-[#0b1528]
                                   dark:text-white
                                   dark:focus:border-blue-400
                                   dark:focus:ring-blue-400/10"
                        >

                            @foreach($positions as $position)

                                <option
                                    value="{{ $position->id }}"
                                    @selected(
                                        old(
                                            'election_position_id',
                                            $candidate->election_position_id
                                        ) == $position->id
                                    )
                                >

                                    {{ $position->sort_order }}.
                                    {{ $position->name }}

                                </option>

                            @endforeach

                        </select>


                        <div
                            class="pointer-events-none absolute inset-y-0 right-0
                                   flex items-center pr-4
                                   text-slate-400"
                        >

                            <x-heroicon-o-chevron-down
                                class="h-5 w-5"
                            />

                        </div>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- PHOTO --}}
                {{-- ================================================= --}}

                <div class="md:col-span-2">

                    <label
                        for="photo"
                        class="mb-2 block text-sm font-bold
                               text-slate-700
                               dark:text-slate-200"
                    >

                        Candidate Photo

                        <span
                            class="ml-1 font-normal text-slate-400
                                   dark:text-slate-500"
                        >
                            (Optional)
                        </span>

                    </label>


                    <div
                        x-data="{
                            preview: @js(
                                $candidate->photo
                                    ? asset('storage/' . $candidate->photo)
                                    : ''
                            ),

                            previewImage(event) {

                                const file = event.target.files[0];

                                if (!file) {
                                    return;
                                }

                                if (this.preview && this.preview.startsWith('blob:')) {
                                    URL.revokeObjectURL(this.preview);
                                }

                                this.preview = URL.createObjectURL(file);
                            }
                        }"
                        class="relative overflow-hidden rounded-2xl
                               border border-dashed
                               border-slate-300
                               bg-slate-50
                               p-6
                               transition
                               hover:border-blue-300
                               hover:bg-blue-50/30
                               dark:border-white/10
                               dark:bg-[#0b1528]
                               dark:hover:border-blue-400/30
                               dark:hover:bg-blue-500/5"
                    >

                        <div class="flex flex-col items-center text-center">


                            {{-- Photo Preview --}}

                            <div class="relative mb-5">

                                <div
                                    class="absolute -inset-2 rounded-full
                                           bg-blue-500/10
                                           blur-md"
                                ></div>


                                <template x-if="preview">

                                    <img
                                        :src="preview"
                                        alt="Candidate photo preview"
                                        class="relative h-28 w-28 rounded-full
                                               border-4
                                               border-white
                                               object-cover
                                               shadow-xl
                                               ring-1
                                               ring-slate-200
                                               dark:border-[#101c32]
                                               dark:ring-white/10"
                                    >

                                </template>


                                <template x-if="!preview">

                                    <div
                                        class="relative flex h-28 w-28
                                               items-center justify-center
                                               rounded-full
                                               bg-gradient-to-br
                                               from-blue-500
                                               to-indigo-600
                                               text-4xl font-black
                                               text-white
                                               shadow-xl
                                               shadow-blue-500/20"
                                    >

                                        {{ strtoupper(substr($candidate->name, 0, 1)) }}

                                    </div>

                                </template>

                            </div>


                            <p
                                class="font-bold text-slate-900
                                       dark:text-white"
                            >
                                Candidate Photo
                            </p>


                            <p
                                class="mt-1 max-w-md text-sm
                                       text-slate-500
                                       dark:text-slate-400"
                            >
                                Upload a clear professional photograph.
                                JPG, JPEG, PNG or WEBP — maximum 2MB.
                            </p>


                            <label
                                for="photo"
                                class="mt-5 inline-flex cursor-pointer
                                       items-center gap-2
                                       rounded-xl
                                       bg-blue-600
                                       px-5 py-3
                                       text-sm font-bold
                                       text-white
                                       shadow-lg
                                       shadow-blue-600/20
                                       transition-all duration-200
                                       hover:-translate-y-0.5
                                       hover:bg-blue-700
                                       hover:shadow-xl
                                       dark:bg-blue-500
                                       dark:hover:bg-blue-400"
                            >

                                <x-heroicon-o-camera
                                    class="h-5 w-5"
                                />

                                Change Photo

                            </label>


                            <input
                                id="photo"
                                type="file"
                                name="photo"
                                accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                                class="hidden"
                                @change="previewImage($event)"
                            >

                        </div>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- BIOGRAPHY --}}
                {{-- ================================================= --}}

                <div class="md:col-span-2">

                    <label
                        for="bio"
                        class="mb-2 block text-sm font-bold
                               text-slate-700
                               dark:text-slate-200"
                    >

                        Candidate Biography

                        <span
                            class="ml-1 font-normal text-slate-400
                                   dark:text-slate-500"
                        >
                            (Optional)
                        </span>

                    </label>


                    <textarea
                        id="bio"
                        name="bio"
                        rows="6"
                        placeholder="Enter candidate biography, experience, achievements and relevant information..."
                        class="w-full resize-none rounded-xl
                               border border-slate-200
                               bg-white
                               px-4 py-3.5
                               text-sm leading-6
                               text-slate-900
                               placeholder:text-slate-400
                               shadow-sm
                               outline-none
                               transition
                               focus:border-blue-500
                               focus:ring-4
                               focus:ring-blue-500/10
                               dark:border-white/10
                               dark:bg-[#0b1528]
                               dark:text-white
                               dark:placeholder:text-slate-500
                               dark:focus:border-blue-400
                               dark:focus:ring-blue-400/10"
                    >{{ old('bio', $candidate->bio) }}</textarea>


                    <div
                        class="mt-2 flex items-center gap-2
                               text-xs text-slate-400
                               dark:text-slate-500"
                    >

                        <x-heroicon-o-information-circle
                            class="h-4 w-4"
                        />

                        A concise and factual biography helps voters
                        understand the candidate.

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- STATUS --}}
                {{-- ================================================= --}}

                <div class="md:col-span-2">

                    <label
                        for="status"
                        class="mb-2 block text-sm font-bold
                               text-slate-700
                               dark:text-slate-200"
                    >

                        Candidate Status

                    </label>


                    <div class="relative">

                        <div
                            class="pointer-events-none absolute inset-y-0 left-0
                                   z-10 flex items-center pl-4
                                   text-slate-400
                                   dark:text-slate-500"
                        >

                            <x-heroicon-o-check-badge
                                class="h-5 w-5"
                            />

                        </div>


                        <select
                            id="status"
                            name="status"
                            required
                            class="w-full appearance-none rounded-xl
                                   border border-slate-200
                                   bg-white
                                   px-12 py-3.5
                                   text-sm font-medium
                                   text-slate-900
                                   shadow-sm
                                   outline-none
                                   transition
                                   focus:border-blue-500
                                   focus:ring-4
                                   focus:ring-blue-500/10
                                   dark:border-white/10
                                   dark:bg-[#0b1528]
                                   dark:text-white
                                   dark:focus:border-blue-400
                                   dark:focus:ring-blue-400/10"
                        >

                            <option
                                value="1"
                                @selected(
                                    old(
                                        'status',
                                        $candidate->status
                                    ) == 1
                                )
                            >
                                Active
                            </option>


                            <option
                                value="0"
                                @selected(
                                    old(
                                        'status',
                                        $candidate->status
                                    ) == 0
                                )
                            >
                                Inactive
                            </option>

                        </select>


                        <div
                            class="pointer-events-none absolute inset-y-0 right-0
                                   flex items-center pr-4
                                   text-slate-400"
                        >

                            <x-heroicon-o-chevron-down
                                class="h-5 w-5"
                            />

                        </div>

                    </div>


                    <p
                        class="mt-2 text-xs text-slate-500
                               dark:text-slate-400"
                    >
                        Inactive candidates will not be available for voting.
                    </p>

                </div>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- FORM ACTIONS --}}
        {{-- ===================================================== --}}

        <div
            class="flex flex-col-reverse gap-3
                   border-t border-slate-100
                   bg-slate-50/70
                   px-6 py-5
                   sm:flex-row sm:justify-end
                   md:px-8
                   dark:border-white/10
                   dark:bg-white/[0.025]"
        >

            <a
                href="{{ route('candidates.show', $candidate) }}"
                class="inline-flex items-center justify-center gap-2
                       rounded-xl
                       border border-slate-200
                       bg-white
                       px-6 py-3
                       text-sm font-bold
                       text-slate-700
                       shadow-sm
                       transition-all duration-200
                       hover:border-slate-300
                       hover:bg-slate-100
                       dark:border-white/10
                       dark:bg-white/[0.04]
                       dark:text-slate-200
                       dark:hover:bg-white/[0.08]"
            >

                <x-heroicon-o-x-mark
                    class="h-5 w-5"
                />

                Cancel

            </a>


            <button
                type="submit"
                class="group inline-flex items-center justify-center gap-2
                       rounded-xl
                       bg-gradient-to-r
                       from-blue-600
                       to-indigo-600
                       px-7 py-3
                       text-sm font-bold
                       text-white
                       shadow-lg
                       shadow-blue-600/20
                       transition-all duration-200
                       hover:-translate-y-0.5
                       hover:from-blue-700
                       hover:to-indigo-700
                       hover:shadow-xl
                       hover:shadow-blue-600/25
                       focus:outline-none
                       focus:ring-4
                       focus:ring-blue-500/20
                       dark:from-blue-500
                       dark:to-indigo-500
                       dark:hover:from-blue-400
                       dark:hover:to-indigo-400"
            >

                <x-heroicon-o-check
                    class="h-5 w-5 transition-transform duration-200
                           group-hover:scale-110"
                />

                Save Changes

            </button>

        </div>

    </form>


    {{-- ========================================================= --}}
    {{-- SECURITY / INFORMATION CARD --}}
    {{-- ========================================================= --}}

    <div
        class="flex items-start gap-4 rounded-2xl
               border border-blue-200
               bg-blue-50/70
               p-5
               dark:border-blue-400/20
               dark:bg-blue-500/5"
    >

        <div
            class="flex h-10 w-10 shrink-0 items-center justify-center
                   rounded-xl
                   bg-blue-100
                   text-blue-600
                   dark:bg-blue-500/10
                   dark:text-blue-400"
        >

            <x-heroicon-o-shield-check
                class="h-5 w-5"
            />

        </div>


        <div>

            <h3
                class="text-sm font-bold text-blue-900
                       dark:text-blue-300"
            >
                Candidate information
            </h3>


            <p
                class="mt-1 text-xs leading-5 text-blue-700
                       dark:text-blue-400"
            >
                Candidate changes are applied to this election only.
                Ensure the candidate's position and status are correct
                before saving.
            </p>

        </div>

    </div>

</div>

@endsection