@extends('electo.layouts.app')

@section('title', 'Vote Submitted | Electo')

@section('content')

<div
    class="mx-auto flex min-h-[75vh] w-full max-w-4xl items-center justify-center px-4 py-10"
>

    <div class="w-full">

        {{-- ========================================================= --}}
        {{-- SUCCESS CARD --}}
        {{-- ========================================================= --}}

        <div
            class="overflow-hidden
                   rounded-3xl
                   border
                   border-emerald-200
                   bg-white
                   shadow-[0_20px_60px_rgba(15,23,42,0.10)]
                   transition-all
                   duration-300

                   dark:border-emerald-500/20
                   dark:bg-gradient-to-br
                   dark:from-emerald-500/[0.08]
                   dark:via-slate-900/60
                   dark:to-cyan-500/[0.06]
                   dark:shadow-2xl"
        >

            {{-- ===================================================== --}}
            {{-- TOP ACCENT --}}
            {{-- ===================================================== --}}

            <div
                class="h-1
                       w-full
                       bg-gradient-to-r
                       from-emerald-500
                       via-cyan-400
                       to-blue-500"
            ></div>


            <div
                class="px-6
                       py-12
                       text-center
                       sm:px-10
                       sm:py-16"
            >

                {{-- ================================================= --}}
                {{-- SUCCESS ICON --}}
                {{-- ================================================= --}}

                <div
                    class="mx-auto
                           flex
                           h-24
                           w-24
                           items-center
                           justify-center
                           rounded-full
                           bg-emerald-50
                           ring-8
                           ring-emerald-100

                           dark:bg-emerald-500/10
                           dark:ring-emerald-500/5"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-12 w-12 text-emerald-600 dark:text-emerald-400"
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

                    </svg>

                </div>


                {{-- ================================================= --}}
                {{-- HEADING --}}
                {{-- ================================================= --}}

                <p
                    class="mt-8
                           text-xs
                           font-semibold
                           uppercase
                           tracking-[0.2em]
                           text-emerald-600

                           dark:text-emerald-400"
                >
                    Vote Successfully Submitted
                </p>


                <h1
                    class="mt-3
                           text-3xl
                           font-black
                           tracking-tight
                           text-slate-900

                           dark:text-white

                           sm:text-4xl"
                >
                    Thank You for Voting
                </h1>


                <p
                    class="mx-auto
                           mt-4
                           max-w-2xl
                           text-sm
                           leading-7
                           text-slate-500

                           dark:text-gray-400

                           sm:text-base"
                >
                    Your vote has been securely recorded for this election.
                    You have successfully completed the voting process.
                </p>


                {{-- ================================================= --}}
                {{-- ELECTION DETAILS --}}
                {{-- ================================================= --}}

                <div
                    class="mx-auto
                           mt-10
                           grid
                           max-w-2xl
                           gap-4
                           text-left
                           sm:grid-cols-2"
                >

                    {{-- Election --}}

                    <div
                        class="rounded-2xl
                               border
                               border-slate-200
                               bg-slate-50
                               p-5
                               transition-all
                               duration-200

                               dark:border-white/10
                               dark:bg-white/[0.03]"
                    >

                        <p
                            class="text-xs
                                   font-semibold
                                   uppercase
                                   tracking-wider
                                   text-slate-500

                                   dark:text-gray-500"
                        >
                            Election
                        </p>


                        <p
                            class="mt-2
                                   font-bold
                                   text-slate-900

                                   dark:text-white"
                        >
                            {{ $election->title }}
                        </p>

                    </div>


                    {{-- Voter --}}

                    <div
                        class="rounded-2xl
                               border
                               border-slate-200
                               bg-slate-50
                               p-5
                               transition-all
                               duration-200

                               dark:border-white/10
                               dark:bg-white/[0.03]"
                    >

                        <p
                            class="text-xs
                                   font-semibold
                                   uppercase
                                   tracking-wider
                                   text-slate-500

                                   dark:text-gray-500"
                        >
                            Voter
                        </p>


                        <p
                            class="mt-2
                                   font-bold
                                   text-slate-900

                                   dark:text-white"
                        >
                            {{ $voter->name }}
                        </p>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- SESSION INFORMATION --}}
                {{-- ================================================= --}}

                <div
                    class="mx-auto
                           mt-4
                           max-w-2xl
                           rounded-2xl
                           border
                           border-slate-200
                           bg-slate-50
                           p-5
                           text-left

                           dark:border-white/10
                           dark:bg-black/10"
                >

                    <div
                        class="flex
                               flex-col
                               gap-4
                               sm:flex-row
                               sm:items-center
                               sm:justify-between"
                    >

                        <div>

                            <p
                                class="text-xs
                                       font-semibold
                                       uppercase
                                       tracking-wider
                                       text-slate-500

                                       dark:text-gray-500"
                            >
                                Voting Session
                            </p>


                            <p
                                class="mt-1
                                       font-mono
                                       text-sm
                                       font-semibold
                                       text-slate-900

                                       dark:text-white"
                            >
                                #{{ $session->id }}
                            </p>

                        </div>


                        <div class="flex items-center gap-2">

                            <span
                                class="h-2.5
                                       w-2.5
                                       rounded-full
                                       bg-emerald-500

                                       dark:bg-emerald-400"
                            ></span>


                            <span
                                class="text-sm
                                       font-semibold
                                       text-emerald-600

                                       dark:text-emerald-400"
                            >
                                Completed
                            </span>

                        </div>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- SECURITY MESSAGE --}}
                {{-- ================================================= --}}

                <div
                    class="mx-auto
                           mt-8
                           max-w-2xl
                           rounded-2xl
                           border
                           border-blue-200
                           bg-blue-50
                           p-5
                           text-left

                           dark:border-blue-500/20
                           dark:bg-blue-500/[0.05]"
                >

                    <div class="flex items-start gap-3">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="mt-0.5 h-5 w-5 shrink-0 text-blue-600 dark:text-blue-400"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"
                            />

                        </svg>


                        <div>

                            <p
                                class="font-semibold
                                       text-blue-700

                                       dark:text-blue-300"
                            >
                                Your vote is secure
                            </p>


                            <p
                                class="mt-1
                                       text-sm
                                       leading-6
                                       text-slate-500

                                       dark:text-gray-400"
                            >
                                Your ballot has been recorded by the Electo
                                voting system. You cannot vote again in this
                                election.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- ACTION --}}
                {{-- ================================================= --}}

                <div class="mt-10">

                    <a
                        href="{{ route('dashboard') }}"
                        class="inline-flex
                               items-center
                               justify-center
                               gap-2
                               rounded-xl
                               bg-gradient-to-r
                               from-blue-600
                               to-cyan-500
                               px-7
                               py-3.5
                               text-sm
                               font-bold
                               text-white
                               shadow-lg
                               shadow-blue-600/20
                               transition-all
                               duration-200
                               hover:scale-[1.02]
                               hover:opacity-90"
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
                                d="M3 12l9-9 9 9M5 10v10h14V10"
                            />

                        </svg>


                        Return to Dashboard

                    </a>

                </div>


                {{-- ================================================= --}}
                {{-- FOOTER --}}
                {{-- ================================================= --}}

                <div class="mt-8">

                    <p
                        class="text-xs
                               text-slate-400

                               dark:text-gray-600"
                    >
                        Electo — Secure Digital Elections
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection