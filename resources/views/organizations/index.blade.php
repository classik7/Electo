@extends('electo.layouts.dashboard')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4">

    @if(session('success'))
        <div class="mb-6 rounded-lg bg-green-100 p-4 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">
            My Organizations
        </h1>

        <a href="{{ route('organizations.create') }}"
           class="bg-blue-600 text-white px-5 py-3 rounded-lg">
            + New Organization
        </a>
    </div>

    @forelse($organizations as $organization)

        <div class="border rounded-xl p-6 mb-4">

            <h2 class="text-xl font-semibold">
                {{ $organization->name }}
            </h2>

            <p class="text-gray-600 mt-2">
                {{ $organization->description }}
            </p>

            <div class="mt-4 text-sm text-gray-500">
                {{ $organization->city }},
                {{ $organization->state }},
                {{ $organization->country }}
            </div>

        </div>

    @empty

        <div class="border rounded-xl p-10 text-center text-gray-500">
            You haven't created any organizations yet.
        </div>

    @endforelse

</div>
@endsection