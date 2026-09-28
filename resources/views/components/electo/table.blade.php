<div
    class="overflow-hidden
           rounded-2xl
           border
           border-slate-200
           bg-white
           shadow-lg
           transition-colors
           duration-300

           dark:border-white/10
           dark:bg-[#132544]"
>

    <div class="overflow-x-auto">

        <table
            class="min-w-full
                   divide-y
                   divide-slate-200

                   dark:divide-white/10"
        >

            {{ $slot }}

        </table>

    </div>

</div>