{{-- ========================================================= --}}
{{-- ELECTO GLASS CARD --}}
{{-- ========================================================= --}}

<div class="relative group">

    {{-- Outer ambient glow --}}
    <div
    class="absolute -inset-[1px]
           rounded-[26px]
           bg-gradient-to-br
           from-cyan-400/10
           via-blue-500/5
           to-indigo-500/10
           opacity-50
           blur-md
           transition
           duration-500
           group-hover:opacity-80

           dark:from-cyan-400/20
           dark:via-blue-500/10
           dark:to-indigo-500/20
           dark:opacity-70
           dark:group-hover:opacity-100">
</div>


    {{-- Glass surface --}}
    <div
        class="relative
               overflow-hidden
               rounded-[26px]

               border
               border-slate-200

               bg-white

               shadow-[0_20px_60px_rgba(15,23,42,.10)]

               ring-1
               ring-inset
               ring-slate-100

               transition-all
               duration-300

               group-hover:border-cyan-400/30

               dark:border-white/[0.10]

               dark:bg-gradient-to-br
               dark:from-[#172d50]
               dark:via-[#132544]
               dark:to-[#0d1c35]

               dark:shadow-[0_20px_60px_rgba(0,0,0,.30)]

               dark:ring-white/[0.04]

               dark:group-hover:border-cyan-400/20

               dark:group-hover:shadow-[0_25px_70px_rgba(0,0,0,.38)]"
    >

        {{-- Top reflection --}}
        <div
            class="pointer-events-none
                   absolute
                   inset-x-0
                   top-0
                   h-px
                   bg-gradient-to-r
                   from-transparent
                   via-slate-200
                   to-transparent

                   dark:via-white/20">
        </div>


        {{-- Soft internal glow --}}
        <div
            class="pointer-events-none
                   absolute
                   -right-20
                   -top-20
                   h-40
                   w-40
                   rounded-full
                   bg-cyan-500/[0.03]
                   blur-3xl

                   dark:bg-cyan-400/[0.06]">
        </div>


        {{-- Content --}}
        <div class="relative">

            {{ $slot }}

        </div>

    </div>

</div>