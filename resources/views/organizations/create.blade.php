@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4">

    <h1 class="text-3xl font-bold mb-8">
        Create Organization
    </h1>

    @if ($errors->any())
        <div class="mb-6 rounded-lg bg-red-100 p-4 text-red-700">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('organizations.store') }}" method="POST" class="space-y-6">

        @csrf

        <div>
            <label class="block font-medium mb-2">Organization Name</label>
            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                class="w-full border rounded-lg px-4 py-3"
                required>
        </div>

        <div>
            <label class="block font-medium mb-2">Email</label>
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="w-full border rounded-lg px-4 py-3">
        </div>

        <div>
            <label class="block font-medium mb-2">Phone</label>
            <input
                type="text"
                name="phone"
                value="{{ old('phone') }}"
                class="w-full border rounded-lg px-4 py-3">
        </div>

        <div>
            <label class="block font-medium mb-2">Website</label>
            <input
                type="url"
                name="website"
                value="{{ old('website') }}"
                class="w-full border rounded-lg px-4 py-3">
        </div>

        <div>
            <label class="block font-medium mb-2">Country</label>
            <input
                type="text"
                name="country"
                value="{{ old('country') }}"
                class="w-full border rounded-lg px-4 py-3">
        </div>

        <div>
            <label class="block font-medium mb-2">State</label>
            <input
                type="text"
                name="state"
                value="{{ old('state') }}"
                class="w-full border rounded-lg px-4 py-3">
        </div>

        <div>
            <label class="block font-medium mb-2">City</label>
            <input
                type="text"
                name="city"
                value="{{ old('city') }}"
                class="w-full border rounded-lg px-4 py-3">
        </div>

        <div>
            <label class="block font-medium mb-2">Address</label>
            <textarea
                name="address"
                rows="3"
                class="w-full border rounded-lg px-4 py-3">{{ old('address') }}</textarea>
        </div>

        <div>
            <label class="block font-medium mb-2">Description</label>
            <textarea
                name="description"
                rows="5"
                class="w-full border rounded-lg px-4 py-3">{{ old('description') }}</textarea>
        </div>

        <button
            type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">
            Create Organization
        </button>

    </form>

</div>
@endsection