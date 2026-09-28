@if ($paginator->hasPages())

<nav role="navigation"
     aria-label="Pagination Navigation"
     class="flex flex-col md:flex-row items-center justify-between gap-4 mt-8">

    {{-- Mobile --}}
    <div class="flex w-full justify-between md:hidden">

        @if ($paginator->onFirstPage())

            <span class="px-4 py-2 rounded-xl bg-slate-800 text-gray-500 cursor-not-allowed">
                Previous
            </span>

        @else

            <a href="{{ $paginator->previousPageUrl() }}"
               rel="prev"
               class="px-4 py-2 rounded-xl bg-[#16213E] hover:bg-blue-600 transition text-white">
                Previous
            </a>

        @endif


        @if ($paginator->hasMorePages())

            <a href="{{ $paginator->nextPageUrl() }}"
               rel="next"
               class="px-4 py-2 rounded-xl bg-[#16213E] hover:bg-blue-600 transition text-white">
                Next
            </a>

        @else

            <span class="px-4 py-2 rounded-xl bg-slate-800 text-gray-500 cursor-not-allowed">
                Next
            </span>

        @endif

    </div>

    {{-- Desktop --}}
    <div class="hidden md:flex items-center justify-between w-full">

        <div class="text-sm text-gray-400">

            Showing

            <span class="font-semibold text-white">
                {{ $paginator->firstItem() }}
            </span>

            to

            <span class="font-semibold text-white">
                {{ $paginator->lastItem() }}
            </span>

            of

            <span class="font-semibold text-white">
                {{ $paginator->total() }}
            </span>

            results

        </div>

        <div class="flex items-center gap-2">

            {{-- Previous --}}

            @if ($paginator->onFirstPage())

                <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-800 text-gray-500">

                    ←

                </span>

            @else

                <a href="{{ $paginator->previousPageUrl() }}"
                   rel="prev"
                   class="w-10 h-10 flex items-center justify-center rounded-xl bg-[#16213E] hover:bg-blue-600 transition">

                    ←

                </a>

            @endif


            {{-- Page Numbers --}}

            @foreach ($elements as $element)

                @if (is_string($element))

                    <span class="px-2 text-gray-500">
                        {{ $element }}
                    </span>

                @endif


                @if (is_array($element))

                    @foreach ($element as $page => $url)

                        @if ($page == $paginator->currentPage())

                            <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-blue-600 text-white font-semibold">

                                {{ $page }}

                            </span>

                        @else

                            <a href="{{ $url }}"
                               class="w-10 h-10 flex items-center justify-center rounded-xl bg-[#16213E] hover:bg-blue-600 transition text-white">

                                {{ $page }}

                            </a>

                        @endif

                    @endforeach

                @endif

            @endforeach


            {{-- Next --}}

            @if ($paginator->hasMorePages())

                <a href="{{ $paginator->nextPageUrl() }}"
                   rel="next"
                   class="w-10 h-10 flex items-center justify-center rounded-xl bg-[#16213E] hover:bg-blue-600 transition">

                    →

                </a>

            @else

                <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-800 text-gray-500">

                    →

                </span>

            @endif

        </div>

    </div>

</nav>

@endif