@extends('electo.layouts.app')

@section('page-title', 'Results')

@section('content')

<div class="space-y-6">

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <div
        class="relative overflow-hidden rounded-3xl
               border border-slate-200
               bg-white
               p-8
               shadow-xl shadow-slate-200/50
               dark:border-white/10
               dark:bg-[#132544]
               dark:shadow-xl"
    >

        {{-- Glow --}}

        <div
            class="absolute -right-20 -top-20
                   h-56 w-56
                   rounded-full
                   bg-blue-500/10
                   blur-3xl
                   dark:bg-blue-500/10"
        ></div>

        <div
            class="absolute -bottom-20 -left-20
                   h-48 w-48
                   rounded-full
                   bg-cyan-400/10
                   blur-3xl
                   dark:bg-cyan-400/10"
        ></div>


        <div class="relative">

            <div
                class="mb-2
                       text-xs
                       font-bold
                       uppercase
                       tracking-[0.25em]
                       text-cyan-600
                       dark:text-cyan-400"
            >
                Electo Results
            </div>


            <h2
                class="text-3xl
                       font-black
                       text-slate-900
                       dark:text-white"
            >
                Election Results
            </h2>


            <p
                class="mt-2
                       max-w-2xl
                       text-sm
                       text-slate-500
                       dark:text-slate-400"
            >
                View verified election results, winning candidates,
                vote counts and election statistics.
            </p>

        </div>

    </div>



    {{-- ========================================================= --}}
    {{-- ELECTIONS --}}
    {{-- ========================================================= --}}

    @if($elections->count())

        <div
            class="grid
                   gap-5
                   md:grid-cols-2
                   xl:grid-cols-3"
        >

            @foreach($elections as $election)

                <div
                    class="group relative overflow-hidden
                           rounded-2xl
                           border border-slate-200
                           bg-white
                           p-6
                           shadow-sm
                           transition-all
                           duration-300
                           hover:-translate-y-1
                           hover:border-cyan-300
                           hover:shadow-xl
                           hover:shadow-cyan-100/60
                           dark:border-white/10
                           dark:bg-[#132544]
                           dark:hover:border-cyan-400/30
                           dark:hover:shadow-[0_15px_40px_rgba(6,182,212,0.10)]"
                >

                    {{-- Glow --}}

                    <div
                        class="absolute
                               -right-10
                               -top-10
                               h-28
                               w-28
                               rounded-full
                               bg-blue-500/5
                               blur-2xl
                               transition
                               group-hover:bg-cyan-400/10
                               dark:bg-blue-500/10
                               dark:group-hover:bg-cyan-400/15"
                    ></div>


                    <div class="relative">

                        {{-- ================================================= --}}
                        {{-- STATUS --}}
                        {{-- ================================================= --}}

                        <div
                            class="flex
                                   items-center
                                   justify-between"
                        >

                            <span
                                class="inline-flex
                                       items-center
                                       gap-2
                                       rounded-full
                                       border
                                       border-slate-200
                                       bg-slate-50
                                       px-3
                                       py-1
                                       text-[10px]
                                       font-bold
                                       uppercase
                                       tracking-wider
                                       text-slate-600
                                       dark:border-white/10
                                       dark:bg-white/5
                                       dark:text-slate-300"
                            >

                                <span
                                    class="h-1.5
                                           w-1.5
                                           rounded-full
                                           bg-cyan-500
                                           dark:bg-cyan-400"
                                ></span>

                                Election

                            </span>


                            <span
                                class="text-xs
                                       text-slate-400
                                       dark:text-slate-500"
                            >
                                #{{ $election->id }}
                            </span>

                        </div>


                        {{-- ================================================= --}}
                        {{-- TITLE --}}
                        {{-- ================================================= --}}

                        <h3
                            class="mt-5
                                   text-xl
                                   font-black
                                   text-slate-900
                                   dark:text-white"
                        >
                            {{ $election->title }}
                        </h3>


                        {{-- ================================================= --}}
                        {{-- DESCRIPTION --}}
                        {{-- ================================================= --}}

                        <p
                            class="mt-2
                                   min-h-[48px]
                                   text-sm
                                   leading-6
                                   text-slate-500
                                   dark:text-slate-400"
                        >
                            {{ $election->description
                                ?: 'Official election results and winner information.' }}
                        </p>


                        {{-- ================================================= --}}
                        {{-- DATE --}}
                        {{-- ================================================= --}}

                        <div
                            class="mt-5
                                   flex
                                   items-center
                                   gap-2
                                   text-xs
                                   text-slate-500
                                   dark:text-slate-500"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4
                                       text-cyan-600
                                       dark:text-cyan-400"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                />

                            </svg>

                            {{ optional($election->created_at)->format('M j, Y') }}

                        </div>


                        {{-- ================================================= --}}
                        {{-- BUTTON --}}
                        {{-- ================================================= --}}

                        <a
                            href="{{ route('results.show', $election) }}"
                            class="mt-6
                                   flex
                                   w-full
                                   items-center
                                   justify-center
                                   gap-2
                                   rounded-xl
                                   bg-gradient-to-r
                                   from-blue-600
                                   to-cyan-500
                                   px-4
                                   py-3
                                   text-sm
                                   font-bold
                                   text-white
                                   shadow-lg
                                   shadow-blue-500/10
                                   transition-all
                                   duration-300
                                   hover:-translate-y-0.5
                                   hover:shadow-xl
                                   hover:shadow-cyan-500/20"
                        >

                            View Results

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4
                                       transition-transform
                                       group-hover:translate-x-1"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M5 12h14m-6-6l6 6-6 6"
                                />

                            </svg>

                        </a>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        {{-- ========================================================= --}}
        {{-- EMPTY STATE --}}
        {{-- ========================================================= --}}

        <div
            class="rounded-3xl
                   border border-slate-200
                   bg-white
                   px-6
                   py-16
                   text-center
                   shadow-sm
                   dark:border-white/10
                   dark:bg-[#132544]"
        >

            <div
                class="mx-auto
                       flex
                       h-16
                       w-16
                       items-center
                       justify-center
                       rounded-2xl
                       border
                       border-cyan-200
                       bg-cyan-50
                       text-cyan-600
                       dark:border-cyan-400/20
                       dark:bg-cyan-400/10
                       dark:text-cyan-300"
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
                        d="M9 17v-2m3 2v-4m3 4V9m2 10H7a2 2 0 01-2-2V7a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2z"
                    />

                </svg>

            </div>


            <h3
                class="mt-5
                       text-xl
                       font-bold
                       text-slate-900
                       dark:text-white"
            >
                No Election Results Yet
            </h3>


            <p
                class="mx-auto
                       mt-2
                       max-w-md
                       text-sm
                       text-slate-500
                       dark:text-slate-400"
            >
                Results will appear here once elections are available.
            </p>

        </div>

    @endif

</div>

@endsection