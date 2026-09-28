@extends('electo.layouts.dashboard')

@section('title', 'Add Candidate')
@section('page-title', 'Add Candidate')

@section('content')

<div class="w-full max-w-7xl mx-auto space-y-8">

    {{-- ========================================================= --}}
    {{-- PAGE HEADER --}}
    {{-- ========================================================= --}}

    <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">

        <div class="min-w-0">

            <div class="inline-flex items-center gap-2 rounded-full
                        border border-blue-100
                        bg-blue-50
                        px-3 py-1.5
                        dark:border-blue-400/20
                        dark:bg-blue-500/10">

                <span class="h-1.5 w-1.5 rounded-full bg-blue-600
                             dark:bg-blue-400"></span>

                <span class="text-[11px] font-bold uppercase
                             tracking-[0.18em]
                             text-blue-700
                             dark:text-blue-300">
                    Candidate Management
                </span>

            </div>

            <h1 class="mt-4 text-3xl font-extrabold tracking-tight
                       text-slate-900
                       sm:text-4xl
                       dark:text-white">

                Add Candidate

            </h1>

            <p class="mt-2 max-w-2xl text-sm leading-6
                      text-slate-500
                      dark:text-slate-400">

                Add a candidate contesting for a position in this election.

            </p>

        </div>


        {{-- Back Button --}}

        <div class="shrink-0">

            <a href="{{ route('elections.candidates', $election) }}">

                <x-electo.button variant="secondary">

                    <span class="flex items-center gap-2">

                        <x-heroicon-o-arrow-left class="h-5 w-5"/>

                        Back to Candidates

                    </span>

                </x-electo.button>

            </a>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- ELECTION / POSITION CONTEXT --}}
    {{-- ========================================================= --}}

    <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">


        {{-- Election Card --}}

        <div
            class="
                group relative overflow-hidden
                rounded-3xl
                border border-slate-200
                bg-white
                p-6
                shadow-sm
                transition-all duration-300
                hover:-translate-y-0.5
                hover:border-blue-200
                hover:shadow-xl hover:shadow-slate-200/60

                dark:border-white/10
                dark:bg-[#101D35]
                dark:hover:border-blue-500/30
                dark:hover:shadow-blue-950/20
            "
        >

            <div
                class="
                    absolute inset-x-0 top-0 h-1
                    bg-gradient-to-r
                    from-blue-600
                    to-cyan-400
                "
            ></div>


            <div class="flex items-start gap-4">

                <div
                    class="
                        flex h-12 w-12 shrink-0
                        items-center justify-center
                        rounded-2xl
                        bg-blue-50
                        text-blue-600
                        ring-1 ring-blue-100

                        dark:bg-blue-500/10
                        dark:text-blue-400
                        dark:ring-blue-400/20
                    "
                >

                    <x-heroicon-o-clipboard-document-list
                        class="h-6 w-6"
                    />

                </div>


                <div class="min-w-0 flex-1">

                    <p
                        class="
                            text-[11px]
                            font-bold
                            uppercase
                            tracking-[0.16em]
                            text-slate-400
                            dark:text-slate-500
                        "
                    >
                        Election
                    </p>

                    <p
                        class="
                            mt-2
                            truncate
                            text-lg
                            font-bold
                            text-slate-900
                            dark:text-white
                        "
                    >
                        {{ $election->title }}
                    </p>

                    <div class="mt-2 flex items-center gap-2">

                        <span
                            class="
                                inline-flex items-center
                                rounded-full
                                bg-slate-100
                                px-2.5 py-1
                                text-xs font-semibold
                                text-slate-600

                                dark:bg-white/5
                                dark:text-slate-300
                            "
                        >
                            {{ $election->organization->name ?? 'Organization' }}
                        </span>

                    </div>

                </div>

            </div>

        </div>


        {{-- Position Card --}}

        <div
            class="
                group relative overflow-hidden
                rounded-3xl
                border border-blue-100
                bg-gradient-to-br
                from-blue-50
                via-white
                to-cyan-50
                p-6
                shadow-sm
                transition-all duration-300
                hover:-translate-y-0.5
                hover:shadow-xl hover:shadow-blue-100/50

                dark:border-blue-400/20
                dark:from-blue-500/10
                dark:via-[#101D35]
                dark:to-cyan-500/5
            "
        >

            <div
                class="
                    absolute right-0 top-0
                    h-28 w-28
                    rounded-full
                    bg-blue-400/10
                    blur-3xl
                    dark:bg-blue-400/10
                "
            ></div>


            <div class="relative flex items-start gap-4">

                <div
                    class="
                        flex h-12 w-12 shrink-0
                        items-center justify-center
                        rounded-2xl
                        bg-blue-600
                        text-lg font-bold
                        text-white
                        shadow-lg
                        shadow-blue-600/20
                    "
                >
                    {{ $position->sort_order }}
                </div>


                <div class="min-w-0 flex-1">

                    <p
                        class="
                            text-[11px]
                            font-bold
                            uppercase
                            tracking-[0.16em]
                            text-blue-600
                            dark:text-blue-400
                        "
                    >
                        Contesting Position
                    </p>

                    <p
                        class="
                            mt-2
                            truncate
                            text-lg
                            font-bold
                            text-slate-900
                            dark:text-white
                        "
                    >
                        {{ $position->name }}
                    </p>

                    <p
                        class="
                            mt-1
                            text-sm
                            text-slate-500
                            dark:text-slate-400
                        "
                    >
                        Candidates will contest this position
                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- VALIDATION ERRORS --}}
    {{-- ========================================================= --}}

    @if ($errors->any())

        <div
            class="
                rounded-2xl
                border border-red-200
                bg-red-50
                p-5
                dark:border-red-400/20
                dark:bg-red-500/10
            "
        >

            <div class="flex items-start gap-4">

                <div
                    class="
                        flex h-10 w-10 shrink-0
                        items-center justify-center
                        rounded-xl
                        bg-red-100
                        text-red-600
                        dark:bg-red-500/10
                        dark:text-red-400
                    "
                >

                    <x-heroicon-o-exclamation-triangle
                        class="h-5 w-5"
                    />

                </div>


                <div class="min-w-0">

                    <h3
                        class="
                            font-bold
                            text-red-700
                            dark:text-red-300
                        "
                    >
                        Please correct the following:
                    </h3>

                    <ul
                        class="
                            mt-2
                            list-disc
                            space-y-1
                            pl-5
                            text-sm
                            text-red-600
                            dark:text-red-300
                        "
                    >

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- ========================================================= --}}
    {{-- MAIN FORM --}}
    {{-- ========================================================= --}}

    <form
        method="POST"
        action="{{ route('candidates.store') }}"
        enctype="multipart/form-data"
        class="
            overflow-hidden
            rounded-3xl
            border border-slate-200
            bg-white
            shadow-sm
            dark:border-white/10
            dark:bg-[#101D35]
        "
    >

        @csrf


        {{-- Hidden Relationships --}}

        <input
            type="hidden"
            name="election_id"
            value="{{ $election->id }}"
        >

        <input
            type="hidden"
            name="election_position_id"
            value="{{ $position->id }}"
        >


        {{-- ===================================================== --}}
        {{-- FORM HEADER --}}
        {{-- ===================================================== --}}

        <div
            class="
                border-b
                border-slate-100
                bg-gradient-to-r
                from-slate-50
                to-white
                px-6 py-6
                sm:px-8

                dark:border-white/10
                dark:from-[#132544]
                dark:to-[#101D35]
            "
        >

            <div class="flex items-start gap-4">

                <div
                    class="
                        flex h-12 w-12 shrink-0
                        items-center justify-center
                        rounded-2xl
                        bg-blue-50
                        text-blue-600
                        ring-1 ring-blue-100

                        dark:bg-blue-500/10
                        dark:text-blue-400
                        dark:ring-blue-400/20
                    "
                >

                    <x-heroicon-o-user-plus class="h-6 w-6"/>

                </div>


                <div>

                    <h2
                        class="
                            text-xl
                            font-extrabold
                            text-slate-900
                            dark:text-white
                        "
                    >
                        Candidate Information
                    </h2>

                    <p
                        class="
                            mt-1
                            text-sm
                            text-slate-500
                            dark:text-slate-400
                        "
                    >
                        Enter the candidate's information below.
                    </p>

                </div>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- FORM BODY --}}
        {{-- ===================================================== --}}

        <div class="p-6 sm:p-8 lg:p-10">

            <div class="grid grid-cols-1 gap-8">


                {{-- ================================================= --}}
                {{-- CANDIDATE NAME --}}
                {{-- ================================================= --}}

                <div>

                    <label
                        for="name"
                        class="
                            mb-2.5
                            block
                            text-sm
                            font-semibold
                            text-slate-700
                            dark:text-slate-200
                        "
                    >

                        Candidate Name

                        <span class="text-red-500">*</span>

                    </label>


                    <div class="relative">

                        <div
                            class="
                                pointer-events-none
                                absolute inset-y-0 left-0
                                flex items-center
                                pl-4
                                text-slate-400
                            "
                        >

                            <x-heroicon-o-user
                                class="h-5 w-5"
                            />

                        </div>


                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            autofocus
                            placeholder="Enter candidate's full name"
                            class="
                                w-full
                                rounded-2xl
                                border border-slate-200
                                bg-white
                                py-3.5
                                pl-12 pr-4
                                text-sm
                                text-slate-900
                                shadow-sm
                                outline-none
                                transition-all

                                placeholder:text-slate-400

                                focus:border-blue-500
                                focus:ring-4
                                focus:ring-blue-500/10

                                dark:border-white/10
                                dark:bg-[#0B1730]
                                dark:text-white
                                dark:placeholder:text-slate-500
                                dark:focus:border-blue-500
                                dark:focus:ring-blue-500/10
                            "
                        />

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- CANDIDATE PHOTO --}}
                {{-- ================================================= --}}

                <div>

                    <div class="flex items-center justify-between gap-3">

                        <label
                            for="photo"
                            class="
                                block
                                text-sm
                                font-semibold
                                text-slate-700
                                dark:text-slate-200
                            "
                        >

                            Candidate Photo

                            <span
                                class="
                                    ml-1
                                    font-normal
                                    text-slate-400
                                "
                            >
                                (Optional)
                            </span>

                        </label>

                    </div>


                    <div
                        class="
                            mt-2.5
                            rounded-3xl
                            border-2
                            border-dashed
                            border-slate-200
                            bg-slate-50
                            p-8
                            transition-all duration-300

                            hover:border-blue-300
                            hover:bg-blue-50/40

                            dark:border-white/10
                            dark:bg-[#0B1730]
                            dark:hover:border-blue-500/40
                            dark:hover:bg-blue-500/5
                        "
                        x-data="{
                            preview: null,

                            previewImage(event) {

                                const file = event.target.files[0];

                                if (!file) {
                                    this.preview = null;
                                    return;
                                }

                                this.preview = URL.createObjectURL(file);
                            }
                        }"
                    >

                        <div
                            class="
                                flex
                                flex-col
                                items-center
                                justify-center
                                text-center
                            "
                        >


                            {{-- Preview --}}

                            <template x-if="preview">

                                <div class="mb-5">

                                    <img
                                        :src="preview"
                                        class="
                                            mx-auto
                                            h-32 w-32
                                            rounded-full
                                            object-cover
                                            ring-4
                                            ring-blue-500/10
                                            shadow-xl
                                        "
                                        alt="Candidate preview"
                                    >

                                </div>

                            </template>


                            {{-- Upload Icon --}}

                            <template x-if="!preview">

                                <div
                                    class="
                                        mb-5
                                        flex h-16 w-16
                                        items-center justify-center
                                        rounded-2xl
                                        bg-blue-50
                                        text-blue-600
                                        ring-1 ring-blue-100

                                        dark:bg-blue-500/10
                                        dark:text-blue-400
                                        dark:ring-blue-400/20
                                    "
                                >

                                    <x-heroicon-o-camera
                                        class="h-8 w-8"
                                    />

                                </div>

                            </template>


                            <p
                                class="
                                    text-base
                                    font-bold
                                    text-slate-900
                                    dark:text-white
                                "
                            >
                                Upload candidate photo
                            </p>

                            <p
                                class="
                                    mt-1.5
                                    text-sm
                                    text-slate-500
                                    dark:text-slate-400
                                "
                            >
                                JPG, JPEG, PNG or WEBP
                            </p>

                            <p
                                class="
                                    mt-1
                                    text-xs
                                    text-slate-400
                                    dark:text-slate-500
                                "
                            >
                                Maximum file size: 2MB
                            </p>


                            <label
                                for="photo"
                                class="
                                    mt-6
                                    inline-flex
                                    cursor-pointer
                                    items-center
                                    gap-2
                                    rounded-xl
                                    bg-blue-600
                                    px-5 py-2.5
                                    text-sm
                                    font-bold
                                    text-white
                                    shadow-lg
                                    shadow-blue-600/20
                                    transition-all

                                    hover:-translate-y-0.5
                                    hover:bg-blue-700
                                    hover:shadow-xl
                                "
                            >

                                <x-heroicon-o-arrow-up-tray
                                    class="h-4 w-4"
                                />

                                Choose Photo

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

                <div>

                    <label
                        for="bio"
                        class="
                            mb-2.5
                            block
                            text-sm
                            font-semibold
                            text-slate-700
                            dark:text-slate-200
                        "
                    >

                        Candidate Biography

                        <span
                            class="
                                ml-1
                                font-normal
                                text-slate-400
                            "
                        >
                            (Optional)
                        </span>

                    </label>


                    <textarea
                        id="bio"
                        name="bio"
                        rows="7"
                        placeholder="Tell voters about this candidate, their experience, qualifications or vision..."
                        class="
                            w-full
                            resize-none
                            rounded-2xl
                            border border-slate-200
                            bg-white
                            px-4 py-3.5
                            text-sm
                            leading-6
                            text-slate-900
                            shadow-sm
                            outline-none
                            transition-all

                            placeholder:text-slate-400

                            focus:border-blue-500
                            focus:ring-4
                            focus:ring-blue-500/10

                            dark:border-white/10
                            dark:bg-[#0B1730]
                            dark:text-white
                            dark:placeholder:text-slate-500
                            dark:focus:border-blue-500
                            dark:focus:ring-blue-500/10
                        "
                    >{{ old('bio') }}</textarea>


                    <div class="mt-2 flex items-start gap-2">

                        <x-heroicon-o-information-circle
                            class="
                                mt-0.5
                                h-4 w-4
                                shrink-0
                                text-slate-400
                            "
                        />

                        <p
                            class="
                                text-xs
                                leading-5
                                text-slate-400
                                dark:text-slate-500
                            "
                        >
                            This information may be displayed to voters
                            during the election.
                        </p>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- POSITION CONFIRMATION --}}
                {{-- ================================================= --}}

                <div
                    class="
                        rounded-2xl
                        border border-emerald-200
                        bg-emerald-50
                        p-5

                        dark:border-emerald-400/20
                        dark:bg-emerald-500/10
                    "
                >

                    <div class="flex items-start gap-4">

                        <div
                            class="
                                flex h-11 w-11 shrink-0
                                items-center justify-center
                                rounded-xl
                                bg-emerald-100
                                text-emerald-600

                                dark:bg-emerald-500/10
                                dark:text-emerald-400
                            "
                        >

                            <x-heroicon-o-check-circle
                                class="h-6 w-6"
                            />

                        </div>


                        <div class="min-w-0">

                            <p
                                class="
                                    font-bold
                                    text-emerald-800
                                    dark:text-emerald-300
                                "
                            >
                                Contesting Position
                            </p>

                            <p
                                class="
                                    mt-1
                                    text-sm
                                    leading-6
                                    text-emerald-700/80
                                    dark:text-emerald-300/70
                                "
                            >

                                This candidate will contest for:

                                <span
                                    class="
                                        font-bold
                                        text-emerald-700
                                        dark:text-emerald-300
                                    "
                                >
                                    {{ $position->name }}
                                </span>

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- FORM ACTIONS --}}
        {{-- ========================================================= --}}

        <div
            class="
                flex
                flex-col-reverse
                gap-3
                border-t
                border-slate-100
                bg-slate-50/70
                px-6 py-5
                sm:flex-row
                sm:justify-end
                sm:px-8

                dark:border-white/10
                dark:bg-[#0B1730]/60
            "
        >

            <a
                href="{{ route('elections.candidates', $election) }}"
                class="
                    inline-flex
                    items-center
                    justify-center
                    rounded-xl
                    border border-slate-200
                    bg-white
                    px-6 py-3
                    text-sm
                    font-bold
                    text-slate-600
                    shadow-sm
                    transition-all

                    hover:border-slate-300
                    hover:bg-slate-50
                    hover:text-slate-900

                    dark:border-white/10
                    dark:bg-white/5
                    dark:text-slate-300
                    dark:hover:bg-white/10
                    dark:hover:text-white
                "
            >
                Cancel
            </a>


            <button
                type="submit"
                class="
                    inline-flex
                    items-center
                    justify-center
                    gap-2
                    rounded-xl
                    bg-gradient-to-r
                    from-blue-600
                    to-blue-700
                    px-7 py-3
                    text-sm
                    font-bold
                    text-white
                    shadow-lg
                    shadow-blue-600/20
                    transition-all

                    hover:-translate-y-0.5
                    hover:from-blue-700
                    hover:to-blue-800
                    hover:shadow-xl
                    hover:shadow-blue-600/25
                "
            >

                <x-heroicon-o-check
                    class="h-5 w-5"
                />

                Add Candidate

            </button>

        </div>

    </form>

</div>

@endsection