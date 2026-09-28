@props([
    'step' => 1,
])

<div class="mb-8">

    <div class="flex items-center">

        {{-- Step 1 --}}
        <div class="flex flex-col items-center">

            <div class="
                flex h-12 w-12 items-center justify-center rounded-full
                {{ $step >= 1 ? 'bg-blue-600 text-white' : 'bg-slate-700 text-gray-400' }}
            ">
                1
            </div>

            <span class="mt-3 text-sm font-medium">
                Type
            </span>

        </div>

        <div class="mx-3 h-1 flex-1 rounded bg-white/10">

            <div class="
                h-1 rounded bg-blue-600 transition-all duration-500
                {{ $step >= 2 ? 'w-full' : 'w-0' }}
            "></div>

        </div>

        {{-- Step 2 --}}
        <div class="flex flex-col items-center">

            <div class="
                flex h-12 w-12 items-center justify-center rounded-full
                {{ $step >= 2 ? 'bg-blue-600 text-white' : 'bg-slate-700 text-gray-400' }}
            ">
                2
            </div>

            <span class="mt-3 text-sm font-medium">
                Details
            </span>

        </div>

        <div class="mx-3 h-1 flex-1 rounded bg-white/10">

            <div class="
                h-1 rounded bg-blue-600 transition-all duration-500
                {{ $step >= 3 ? 'w-full' : 'w-0' }}
            "></div>

        </div>

        {{-- Step 3 --}}
        <div class="flex flex-col items-center">

            <div class="
                flex h-12 w-12 items-center justify-center rounded-full
                {{ $step >= 3 ? 'bg-blue-600 text-white' : 'bg-slate-700 text-gray-400' }}
            ">
                3
            </div>

            <span class="mt-3 text-sm font-medium">
                Schedule
            </span>

        </div>

        <div class="mx-3 h-1 flex-1 rounded bg-white/10">

            <div class="
                h-1 rounded bg-blue-600 transition-all duration-500
                {{ $step >= 4 ? 'w-full' : 'w-0' }}
            "></div>

        </div>

        {{-- Step 4 --}}
        <div class="flex flex-col items-center">

            <div class="
                flex h-12 w-12 items-center justify-center rounded-full
                {{ $step >= 4 ? 'bg-blue-600 text-white' : 'bg-slate-700 text-gray-400' }}
            ">
                4
            </div>

            <span class="mt-3 text-sm font-medium">
                Positions
            </span>

        </div>

    </div>

</div>