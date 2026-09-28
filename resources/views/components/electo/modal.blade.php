@props([
    'name',
    'title' => '',
])

<div
    x-data="{ open: false }"
    x-on:open-modal.window="
        if ($event.detail === '{{ $name }}') {
            open = true
        }
    "
    x-on:close-modal.window="
        if ($event.detail === '{{ $name }}') {
            open = false
        }
    "
    x-show="open"
    x-cloak
    x-on:keydown.escape.window="open = false"
    class="fixed inset-0 z-[999] overflow-y-auto"
    style="display: none;"
>

    {{-- =====================================================
         BACKDROP
    ====================================================== --}}

    <div
        x-show="open"
        x-transition.opacity
        x-on:click="open = false"
        class="fixed inset-0 bg-slate-950/55 backdrop-blur-sm">
    </div>


    {{-- =====================================================
         MODAL POSITION
    ====================================================== --}}

    <div
        class="relative flex min-h-full items-center
               justify-center p-4 sm:p-6">

        <div
            x-show="open"
            x-transition:enter="ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95 translate-y-2"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-2"
            x-on:click.stop
            class="relative w-full max-w-lg overflow-hidden
                   rounded-[28px] border border-slate-200
                   bg-white
                   shadow-[0_30px_100px_rgba(15,23,42,0.25)]">


            {{-- =================================================
                 HEADER
            ================================================== --}}

            <div
                class="flex items-center justify-between
                       border-b border-slate-100
                       bg-gradient-to-r from-slate-50 to-white
                       px-6 py-5">

                <div class="flex min-w-0 items-center gap-3">

                    <div
                        class="flex h-10 w-10 shrink-0 items-center
                               justify-center rounded-xl
                               bg-red-50 text-red-600">

                        <x-heroicon-o-exclamation-triangle
                            class="h-5 w-5"/>

                    </div>

                    <div class="min-w-0">

                        <h2
                            class="truncate text-lg font-extrabold
                                   text-slate-900">

                            {{ $title }}

                        </h2>

                        <p class="text-xs text-slate-500">
                            Please confirm this action
                        </p>

                    </div>

                </div>


                {{-- Close --}}

                <button
                    type="button"
                    x-on:click="open = false"
                    class="flex h-9 w-9 shrink-0 items-center
                           justify-center rounded-xl
                           text-slate-400 transition
                           hover:bg-slate-100 hover:text-slate-700">

                    <x-heroicon-o-x-mark class="h-5 w-5"/>

                </button>

            </div>


            {{-- =================================================
                 BODY
            ================================================== --}}

            <div class="p-6 sm:p-7">

                {{ $slot }}

            </div>

        </div>

    </div>

</div>