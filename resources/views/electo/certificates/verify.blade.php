<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Certificate Verification | Electo
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>


<body
    class="min-h-screen
           bg-[#071426]
           text-white
           flex
           items-center
           justify-center
           px-6"
>


    <div
        class="w-full
               max-w-xl
               rounded-[2rem]
               border
               border-cyan-400/20
               bg-white/[0.04]
               p-8
               text-center
               shadow-[0_30px_100px_rgba(0,0,0,0.4)]
               backdrop-blur-xl"
    >

        <!-- Logo -->

        <div
            class="mx-auto
                   flex
                   h-16
                   w-16
                   items-center
                   justify-center
                   rounded-2xl
                   bg-gradient-to-br
                   from-blue-600
                   to-cyan-400
                   text-3xl
                   shadow-lg
                   shadow-cyan-500/20"
        >
            🗳️
        </div>


        <h1
            class="mt-5
                   text-3xl
                   font-black"
        >
            Certificate Verified
        </h1>


        <div
            class="mx-auto
                   mt-3
                   flex
                   h-10
                   w-10
                   items-center
                   justify-center
                   rounded-full
                   bg-emerald-400/10
                   text-emerald-400"
        >

            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
            >

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M5 13l4 4L19 7"
                />

            </svg>

        </div>


        <p
            class="mt-5
                   text-sm
                   leading-6
                   text-slate-400"
        >
            This certificate has been successfully verified
            through the Electo secure digital election platform.
        </p>


        <!-- Candidate -->

        <div
            class="mt-8
                   rounded-2xl
                   border
                   border-white/10
                   bg-white/[0.03]
                   p-5"
        >

            <p
                class="text-[9px]
                       uppercase
                       tracking-[0.2em]
                       text-slate-500"
            >
                Certificate Holder
            </p>

            <p
                class="mt-2
                       text-2xl
                       font-black
                       text-cyan-300"
            >
                {{ $certificate->candidate->name }}
            </p>


            <p
                class="mt-4
                       text-xs
                       uppercase
                       tracking-wider
                       text-slate-500"
            >
                Elected As
            </p>

            <p
                class="mt-1
                       text-lg
                       font-bold
                       text-white"
            >
                {{ $certificate->position->name }}
            </p>


            <p
                class="mt-4
                       text-xs
                       uppercase
                       tracking-wider
                       text-slate-500"
            >
                Election
            </p>

            <p
                class="mt-1
                       text-sm
                       font-semibold
                       text-white"
            >
                {{ $certificate->election->title }}
            </p>

        </div>


        <!-- Verification Details -->

        <div
            class="mt-5
                   grid
                   gap-4
                   text-left
                   sm:grid-cols-2"
        >

            <div
                class="rounded-xl
                       border
                       border-white/10
                       bg-white/[0.025]
                       p-4"
            >

                <p
                    class="text-[8px]
                           uppercase
                           tracking-wider
                           text-slate-500"
                >
                    Certificate Number
                </p>

                <p
                    class="mt-1
                           text-xs
                           font-bold
                           text-slate-300"
                >
                    {{ $certificate->certificate_number }}
                </p>

            </div>


            <div
                class="rounded-xl
                       border
                       border-white/10
                       bg-white/[0.025]
                       p-4"
            >

                <p
                    class="text-[8px]
                           uppercase
                           tracking-wider
                           text-slate-500"
                >
                    Verification Code
                </p>

                <p
                    class="mt-1
                           text-xs
                           font-bold
                           text-cyan-300"
                >
                    {{ $certificate->verification_code }}
                </p>

            </div>

        </div>


        <div
            class="mt-6
                   text-[9px]
                   font-semibold
                   uppercase
                   tracking-[0.18em]
                   text-emerald-300"
        >
            ✓ Official Electo Certificate
        </div>

    </div>


</body>

</html>