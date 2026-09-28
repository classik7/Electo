@extends('electo.layouts.dashboard')

@section('title', 'Create Organization')

@section('page-title', 'Create Organization')


@section('content')

<div class="mx-auto w-full max-w-6xl">


    {{-- =====================================================
         PAGE HEADER
    ====================================================== --}}

    <div
        class="mb-8
        flex
        flex-col
        gap-5
        sm:flex-row
        sm:items-center
        sm:justify-between"
    >

        <div>

            <div
                class="mb-2
                inline-flex
                items-center
                gap-2
                rounded-full
                border
                border-blue-100
                bg-blue-50
                px-3
                py-1.5
                text-xs
                font-bold
                uppercase
                tracking-wider
                text-blue-600"
            >

                <span
                    class="h-1.5
                    w-1.5
                    rounded-full
                    bg-blue-600"
                ></span>

                Organization

            </div>


            <h1
                class="text-3xl
                font-black
                tracking-tight
                text-slate-900
                sm:text-4xl"
            >
                Create Organization
            </h1>


            <p
                class="mt-2
                max-w-2xl
                text-sm
                leading-6
                text-slate-500
                sm:text-base"
            >
                Create a new organization to start managing secure
                digital elections with Electo.
            </p>

        </div>


        {{-- Back Button --}}

        <a
            href="{{ route('organizations.index') }}"
            class="inline-flex
            items-center
            justify-center
            gap-2
            rounded-xl
            border
            border-slate-200
            bg-white
            px-5
            py-3
            text-sm
            font-semibold
            text-slate-700
            shadow-sm
            transition
            duration-200
            hover:-translate-y-0.5
            hover:border-blue-200
            hover:bg-blue-50
            hover:text-blue-600
            hover:shadow-md"
        >

            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 19l-7-7 7-7"
                />

            </svg>

            Back

        </a>

    </div>



    {{-- =====================================================
         FORM CARD
    ====================================================== --}}

    <div
        class="relative
        overflow-hidden
        rounded-[28px]
        border
        border-slate-200/80
        bg-white
        shadow-[0_20px_60px_rgba(15,23,42,.08)]"
    >

        {{-- Top Accent --}}

        <div
            class="absolute
            inset-x-0
            top-0
            h-1
            bg-gradient-to-r
            from-blue-600
            via-blue-500
            to-cyan-400"
        ></div>


        {{-- Card Header --}}

        <div
            class="border-b
            border-slate-100
            px-6
            py-6
            sm:px-8
            lg:px-10"
        >

            <div class="flex items-start gap-4">

                <div
                    class="flex
                    h-12
                    w-12
                    shrink-0
                    items-center
                    justify-center
                    rounded-2xl
                    bg-blue-50
                    text-blue-600
                    ring-1
                    ring-blue-100"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M19 21H5a2 2 0 01-2-2V7a2 2 0 012-2h4l2-2h4l2 2h2a2 2 0 012 2v12a2 2 0 01-2 2z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M12 11v6m-3-3h6"
                        />

                    </svg>

                </div>


                <div>

                    <h2
                        class="text-lg
                        font-bold
                        text-slate-900"
                    >
                        Organization Details
                    </h2>

                    <p
                        class="mt-1
                        text-sm
                        leading-6
                        text-slate-500"
                    >
                        Provide the basic information about your
                        organization below.
                    </p>

                </div>

            </div>

        </div>



        {{-- =====================================================
             FORM
        ====================================================== --}}

        <form
            method="POST"
            action="{{ route('organizations.store') }}"
            class="px-6 py-8 sm:px-8 lg:px-10"
        >

            @csrf


            {{-- Form Fields --}}

            @include(
                'electo.organizations.partials.form'
            )


            {{-- =================================================
                 ACTIONS
            ================================================== --}}

            <div
                class="mt-10
                flex
                flex-col-reverse
                gap-3
                border-t
                border-slate-100
                pt-6
                sm:flex-row
                sm:justify-end"
            >

                <a
                    href="{{ route('organizations.index') }}"
                    class="inline-flex
                    items-center
                    justify-center
                    rounded-xl
                    border
                    border-slate-200
                    bg-white
                    px-6
                    py-3
                    text-sm
                    font-semibold
                    text-slate-700
                    transition
                    hover:bg-slate-50
                    hover:text-slate-900"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="inline-flex
                    items-center
                    justify-center
                    gap-2
                    rounded-xl
                    bg-gradient-to-r
                    from-blue-600
                    to-blue-500
                    px-6
                    py-3
                    text-sm
                    font-bold
                    text-white
                    shadow-lg
                    shadow-blue-500/20
                    transition
                    duration-200
                    hover:-translate-y-0.5
                    hover:from-blue-700
                    hover:to-blue-600
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
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 4v16m8-8H4"
                        />

                    </svg>

                    Create Organization

                </button>

            </div>

        </form>

    </div>



    {{-- =====================================================
         SECURITY NOTE
    ====================================================== --}}

    <div
        class="mt-5
        flex
        items-start
        gap-3
        rounded-2xl
        border
        border-blue-100
        bg-blue-50/70
        px-5
        py-4"
    >

        <div
            class="mt-0.5
            flex
            h-8
            w-8
            shrink-0
            items-center
            justify-center
            rounded-xl
            bg-white
            text-blue-600
            shadow-sm"
        >

            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                />

            </svg>

        </div>


        <div>

            <p
                class="text-sm
                font-semibold
                text-slate-800"
            >
                Your organization data is secure
            </p>

            <p
                class="mt-0.5
                text-xs
                leading-5
                text-slate-500"
            >
                Electo uses secure infrastructure to protect your
                organization and election data.
            </p>

        </div>

    </div>

</div>

@endsection