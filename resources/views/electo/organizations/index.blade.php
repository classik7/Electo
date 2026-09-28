@extends('electo.layouts.dashboard')

@section('title', 'Organizations')
@section('page-title', 'Organizations')

@section('content')

    {{-- ========================================================= --}}
    {{-- PAGE HEADER --}}
    {{-- ========================================================= --}}

    <x-electo.page-header
        title="Organizations"
        subtitle="Manage all your organizations"
    >

        <x-slot:actions>

            <div class="flex items-center gap-3">

                {{-- Trash --}}
                <a href="{{ route('organizations.trash') }}">

                    <x-electo.button variant="secondary">

                        <span class="flex items-center gap-2">

                            <x-heroicon-o-trash class="w-5 h-5"/>

                            Trash

                        </span>

                    </x-electo.button>

                </a>


                {{-- New Organization --}}
                <a href="{{ route('organizations.create') }}">

                    <x-electo.button>

                        <span class="flex items-center gap-2">

                            <x-heroicon-o-plus class="w-5 h-5"/>

                            New Organization

                        </span>

                    </x-electo.button>

                </a>

            </div>

        </x-slot:actions>

    </x-electo.page-header>


    {{-- ========================================================= --}}
    {{-- SEARCH CARD --}}
    {{-- ========================================================= --}}

    <x-electo.card class="mb-6">

        <form method="GET">

            <div class="flex flex-col gap-4 md:flex-row">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search organizations by name or email..."
                    class="flex-1
                           rounded-xl
                           border
                           border-slate-200
                           bg-slate-50
                           px-4
                           py-3
                           text-slate-900
                           placeholder-slate-400
                           outline-none
                           transition

                           focus:border-blue-500
                           focus:ring-2
                           focus:ring-blue-500/30

                           dark:border-white/10
                           dark:bg-[#0B1730]
                           dark:text-white
                           dark:placeholder-gray-500"
                >


                <x-electo.button type="submit">

                    <span class="flex items-center gap-2">

                        <x-heroicon-o-magnifying-glass class="w-5 h-5"/>

                        Search

                    </span>

                </x-electo.button>


                @if(request('search'))

                    <a href="{{ route('organizations.index') }}">

                        <x-electo.button variant="secondary">

                            <span class="flex items-center gap-2">

                                <x-heroicon-o-x-mark class="w-5 h-5"/>

                                Clear

                            </span>

                        </x-electo.button>

                    </a>

                @endif

            </div>

        </form>

    </x-electo.card>


    {{-- ========================================================= --}}
    {{-- ORGANIZATIONS --}}
    {{-- ========================================================= --}}

    @if($organizations->count())

        <x-electo.table>

            <thead
                class="bg-slate-100
                       dark:bg-[#0B1730]"
            >

                <tr>

                    <th
                        class="px-6
                               py-4
                               text-left
                               font-semibold
                               text-slate-700

                               dark:text-white"
                    >
                        Organization
                    </th>


                    <th
                        class="px-6
                               py-4
                               text-left
                               font-semibold
                               text-slate-700

                               dark:text-white"
                    >
                        Status
                    </th>


                    <th
                        class="px-6
                               py-4
                               text-left
                               font-semibold
                               text-slate-700

                               dark:text-white"
                    >
                        Plan
                    </th>


                    <th
                        class="px-6
                               py-4
                               text-left
                               font-semibold
                               text-slate-700

                               dark:text-white"
                    >
                        Created
                    </th>


                    <th
                        class="px-6
                               py-4
                               text-right
                               font-semibold
                               text-slate-700

                               dark:text-white"
                    >
                        Actions
                    </th>

                </tr>

            </thead>


            <tbody
                class="divide-y
                       divide-slate-200

                       dark:divide-white/10"
            >

                @foreach($organizations as $organization)

                    <tr
    class="group
           bg-transparent
           transition-all
           duration-200

           hover:bg-slate-100

           dark:bg-transparent
           dark:hover:bg-[#1a3154]
           dark:hover:shadow-[inset_0_1px_0_rgba(34,211,238,0.15),inset_0_-1px_0_rgba(59,130,246,0.10)]"
>

                        {{-- Organization --}}
                        <td class="px-6 py-5">

                            <div>

                               <h3
    class="font-semibold
           text-slate-900
           transition-colors
           duration-200

           dark:text-white
           dark:group-hover:text-cyan-100"
>
    {{ $organization->name }}
</h3>

                               <p
    class="text-sm
           text-slate-500
           transition-colors
           duration-200

           dark:text-gray-400
           dark:group-hover:text-slate-300"
>
    {{ $organization->email ?: 'No email provided' }}
</p>

                            </div>

                        </td>


                        {{-- Status --}}
                        <td class="px-6 py-5">

                            <x-electo.badge
                                color="{{ $organization->status === 'active' ? 'green' : 'red' }}"
                            >

                                {{ ucfirst($organization->status) }}

                            </x-electo.badge>

                        </td>


                        {{-- Plan --}}
                        <td class="px-6 py-5">

                            <x-electo.badge color="blue">

                                {{ ucfirst($organization->subscription_plan) }}

                            </x-electo.badge>

                        </td>


                        {{-- Created --}}
                        <td
    class="px-6
           py-5
           text-slate-500
           transition-colors
           duration-200

           dark:text-gray-400
           dark:group-hover:text-slate-300"
>
    {{ $organization->created_at->format('d M Y') }}
</td>


                        {{-- Actions --}}
                        <td class="px-6 py-5">

                            <div class="flex justify-end">

                                <a
                                    href="{{ route('organizations.show', $organization) }}"
                                >

                                    <x-electo.button variant="secondary">

                                        <span class="flex items-center gap-2">

                                            <x-heroicon-o-eye class="w-5 h-5"/>

                                            View

                                        </span>

                                    </x-electo.button>

                                </a>

                            </div>

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </x-electo.table>


        {{-- ===================================================== --}}
        {{-- PAGINATION --}}
        {{-- ===================================================== --}}

        <div class="mt-6">

            {{ $organizations->links() }}

        </div>


    @else

        {{-- ===================================================== --}}
        {{-- EMPTY STATE --}}
        {{-- ===================================================== --}}

        <x-electo.empty-state
            title="No Organizations Yet"
            description="Create your first organization to begin managing elections."
        >

            <x-slot:actions>

                <a href="{{ route('organizations.create') }}">

                    <x-electo.button>

                        <span class="flex items-center gap-2">

                            <x-heroicon-o-plus class="w-5 h-5"/>

                            Create Organization

                        </span>

                    </x-electo.button>

                </a>

            </x-slot:actions>

        </x-electo.empty-state>

    @endif

@endsection