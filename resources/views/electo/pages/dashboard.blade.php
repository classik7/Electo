@extends('electo.layouts.dashboard')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

    <!-- ================================================= -->
    <!-- WELCOME -->
    <!-- ================================================= -->

    <div
        class="mb-6
               overflow-hidden
               rounded-2xl
               border
               border-slate-200
               bg-white
               p-6
               shadow-xl
               backdrop-blur-xl
               transition-colors
               duration-300

               dark:border-white/10
               dark:bg-white/[0.04]"
    >

        <div
            class="flex
                   flex-col
                   gap-5

                   lg:flex-row
                   lg:items-center
                   lg:justify-between"
        >

            <!-- Welcome Text -->

            <div>

                <p
                    class="text-xs
                           font-semibold
                           uppercase
                           tracking-[0.18em]
                           text-cyan-500

                           dark:text-cyan-400"
                >

                    Electo Dashboard

                </p>


                <h1
                    class="mt-2
                           text-2xl
                           font-bold
                           text-slate-900

                           sm:text-3xl

                           dark:text-white"
                >

                    Welcome back,
                    {{ auth()->user()->name }} 👋

                </h1>


                <p
                    class="mt-2
                           max-w-2xl
                           text-sm
                           leading-6
                           text-slate-500

                           dark:text-slate-400"
                >

                    Manage your organizations, elections and voters
                    from one secure dashboard.

                </p>

            </div>


            <!-- Create Organization -->

            <a
                href="{{ route('organizations.create') }}"
                class="shrink-0"
            >

                <x-electo.button>

                    + Create Organization

                </x-electo.button>

            </a>

        </div>

    </div>


    <!-- ================================================= -->
    <!-- STATISTICS -->
    <!-- ================================================= -->

    <div
        class="grid
               grid-cols-1
               gap-6

               md:grid-cols-2

               xl:grid-cols-4"
    >

        <x-electo.stat-card
            title="Organizations"
            :value="$organizationCount"
            icon="🏢"
        />

        <x-electo.stat-card
            title="Active Elections"
            :value="$activeElectionCount"
            icon="🗳️"
            color="green"
        />

        <x-electo.stat-card
            title="Registered Voters"
            :value="$registeredVoterCount"
            icon="👥"
            color="yellow"
        />

        <x-electo.stat-card
            title="Votes Cast"
            :value="$votesCastCount"
            icon="✅"
            color="blue"
        />

    </div>


    <!-- ================================================= -->
    <!-- LOWER DASHBOARD -->
    <!-- ================================================= -->

    <div
        class="mt-6
               grid
               gap-6

               lg:grid-cols-2"
    >


        <!-- ============================================= -->
        <!-- QUICK ACTIONS -->
        <!-- ============================================= -->

        <x-electo.card>

            <div
                class="mb-5
                       flex
                       items-center
                       justify-between"
            >

                <div>

                    <h2
                        class="text-xl
                               font-bold
                               text-slate-900

                               dark:text-white"
                    >

                        Quick Actions

                    </h2>


                    <p
                        class="mt-1
                               text-sm
                               text-slate-500

                               dark:text-slate-400"
                    >

                        Common actions for managing your platform.

                    </p>

                </div>


                <span
                    class="flex
                           h-10
                           w-10
                           items-center
                           justify-center
                           rounded-xl
                           bg-cyan-500/10
                           text-lg"
                >

                    ⚡

                </span>

            </div>


            <div class="space-y-3">

                <a
                    href="{{ route('organizations.create') }}"
                    class="block"
                >

                    <x-electo.button class="w-full">

                        Create Organization

                    </x-electo.button>

                </a>


                <x-electo.button
                    variant="secondary"
                    class="w-full"
                >

                    Create Election

                </x-electo.button>


                <x-electo.button
                    variant="success"
                    class="w-full"
                >

                    Invite Members

                </x-electo.button>

            </div>

        </x-electo.card>


        <!-- ============================================= -->
        <!-- RECENT ACTIVITY -->
        <!-- ============================================= -->

        <x-electo.card>

            <div
                class="mb-5
                       flex
                       items-center
                       justify-between"
            >

                <div>

                    <h2
                        class="text-xl
                               font-bold
                               text-slate-900

                               dark:text-white"
                    >

                        Recent Activity

                    </h2>


                    <p
                        class="mt-1
                               text-sm
                               text-slate-500

                               dark:text-slate-400"
                    >

                        Latest activity across your account.

                    </p>

                </div>


                <span
                    class="flex
                           h-10
                           w-10
                           items-center
                           justify-center
                           rounded-xl
                           bg-blue-500/10
                           text-lg"
                >

                    🕐

                </span>

            </div>


            <div
                class="rounded-xl
                       border
                       border-slate-200
                       bg-slate-50
                       px-4
                       py-5

                       dark:border-white/5
                       dark:bg-white/[0.03]"
            >

                <p
                    class="text-sm
                           text-slate-500

                           dark:text-slate-400"
                >

                    No recent activities yet.

                </p>

            </div>

        </x-electo.card>


    </div>

@endsection