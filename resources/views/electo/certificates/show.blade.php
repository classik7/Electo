<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Certificate | {{ $certificate->candidate->name }}
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>


<body class="min-h-screen bg-slate-100 text-slate-900">


    <!-- ===================================================== -->
    <!-- TOP ACTION BAR -->
    <!-- ===================================================== -->

    <div
        class="print:hidden
               sticky top-0 z-50
               border-b border-slate-200
               bg-white/95
               px-6 py-4
               backdrop-blur-xl"
    >

        <div
            class="mx-auto
                   flex max-w-7xl
                   items-center
                   justify-between"
        >

            <!-- Electo -->

            <div class="flex items-center gap-3">

                <div
                    class="flex h-10 w-10
                           items-center justify-center
                           rounded-xl
                           bg-gradient-to-br
                           from-blue-600
                           to-cyan-500
                           text-lg
                           shadow-lg
                           shadow-blue-500/20"
                >
                    🗳️
                </div>

                <div>

                    <h1
                        class="text-lg
                               font-black
                               tracking-tight
                               text-slate-900"
                    >
                        Electo
                    </h1>

                    <p
                        class="text-[9px]
                               uppercase
                               tracking-[0.18em]
                               text-slate-400"
                    >
                        Secure Digital Elections
                    </p>

                </div>

            </div>


            <!-- Actions -->

            <div class="flex items-center gap-3">

                <a
                    href="{{ url()->previous() }}"
                    class="inline-flex
                           items-center
                           gap-2
                           rounded-xl
                           border border-slate-200
                           bg-white
                           px-4 py-2.5
                           text-xs
                           font-semibold
                           text-slate-600
                           transition
                           hover:border-blue-200
                           hover:bg-slate-50
                           hover:text-slate-900"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 19l-7-7 7-7"
                        />
                    </svg>

                    Back

                </a>


                <button
                    onclick="window.print()"
                    class="inline-flex
                           items-center
                           gap-2
                           rounded-xl
                           bg-gradient-to-r
                           from-blue-600
                           to-cyan-500
                           px-5 py-2.5
                           text-xs
                           font-bold
                           text-white
                           shadow-lg
                           shadow-blue-500/20
                           transition
                           hover:-translate-y-0.5
                           hover:shadow-blue-500/30"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 9V3h12v6M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2H18"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 14h12v7H6z"
                        />

                    </svg>

                    Print Certificate

                </button>

            </div>

        </div>

    </div>



    <!-- ===================================================== -->
    <!-- CERTIFICATE AREA -->
    <!-- ===================================================== -->

    <main
        class="flex
               min-h-[calc(100vh-73px)]
               items-center
               justify-center
               px-4
               py-10
               sm:px-8"
    >


        <!-- ================================================= -->
        <!-- CERTIFICATE -->
        <!-- ================================================= -->

        <div
            id="certificate"
            class="relative
                   w-full
                   max-w-5xl
                   overflow-hidden
                   bg-white
                   p-2
                   shadow-[0_25px_70px_rgba(15,23,42,0.12)]"
        >


            <!-- ================================================= -->
            <!-- OUTER PREMIUM BORDER -->
            <!-- ================================================= -->

            <div
                class="relative
                       overflow-hidden
                       border-[3px]
                       border-slate-800
                       bg-white"
            >


                <!-- Inner Border -->

                <div
                    class="m-2
                           border
                           border-blue-200
                           px-8
                           py-10
                           sm:px-14
                           sm:py-12"
                >


                    <!-- ================================================= -->
                    <!-- TOP DECORATIVE LINE -->
                    <!-- ================================================= -->

                    <div
                        class="mx-auto
                               h-1
                               w-32
                               rounded-full
                               bg-gradient-to-r
                               from-blue-600
                               to-cyan-400"
                    ></div>



                    <!-- ================================================= -->
                    <!-- ELECTO BRAND -->
                    <!-- ================================================= -->

                    <div
                        class="mt-5
                               flex
                               flex-col
                               items-center"
                    >

                        <!-- Logo -->

                        <div
                            class="flex
                                   h-16
                                   w-16
                                   items-center
                                   justify-center
                                   rounded-2xl
                                   border
                                   border-blue-200
                                   bg-gradient-to-br
                                   from-blue-600
                                   via-blue-500
                                   to-cyan-400
                                   text-3xl
                                   shadow-[0_8px_25px_rgba(37,99,235,0.18)]"
                        >
                            🗳️
                        </div>


                        <h2
                            class="mt-3
                                   text-3xl
                                   font-black
                                   tracking-tight
                                   text-slate-900"
                        >
                            Electo
                        </h2>


                        <p
                            class="mt-1
                                   text-[9px]
                                   font-bold
                                   uppercase
                                   tracking-[0.28em]
                                   text-blue-600"
                        >
                            Secure Digital Elections
                        </p>

                    </div>



                    <!-- ================================================= -->
                    <!-- TITLE -->
                    <!-- ================================================= -->

                    <div
                        class="mt-8
                               text-center"
                    >

                        <div
                            class="flex
                                   items-center
                                   justify-center
                                   gap-4"
                        >

                            <span
                                class="h-px
                                       w-20
                                       bg-gradient-to-r
                                       from-transparent
                                       to-blue-300"
                            ></span>

                            <p
                                class="text-[10px]
                                       font-bold
                                       uppercase
                                       tracking-[0.3em]
                                       text-blue-600"
                            >
                                Official Certificate
                            </p>

                            <span
                                class="h-px
                                       w-20
                                       bg-gradient-to-l
                                       from-transparent
                                       to-blue-300"
                            ></span>

                        </div>


                        <h1
                            class="mt-3
                                   text-3xl
                                   font-black
                                   uppercase
                                   tracking-[0.08em]
                                   text-slate-900
                                   sm:text-4xl"
                        >
                            Certificate of Election
                        </h1>

                    </div>



                    <!-- ================================================= -->
                    <!-- PRESENTED TO -->
                    <!-- ================================================= -->

                    <div
                        class="mt-10
                               text-center"
                    >

                        <p
                            class="text-[10px]
                                   font-semibold
                                   uppercase
                                   tracking-[0.25em]
                                   text-slate-500"
                        >
                            This certificate is proudly presented to
                        </p>


                        <h2
                            class="mt-5
                                   text-4xl
                                   font-black
                                   uppercase
                                   tracking-tight
                                   text-slate-900
                                   sm:text-5xl"
                        >
                            {{ $certificate->candidate->name }}
                        </h2>


                        <div
                            class="mx-auto
                                   mt-4
                                   h-1
                                   w-28
                                   rounded-full
                                   bg-gradient-to-r
                                   from-blue-600
                                   to-cyan-400"
                        ></div>


                        <p
                            class="mt-5
                                   text-[10px]
                                   font-bold
                                   uppercase
                                   tracking-[0.2em]
                                   text-slate-500"
                        >
                            Elected as
                        </p>


                        <p
                            class="mt-2
                                   text-2xl
                                   font-black
                                   text-blue-700"
                        >
                            {{ $certificate->position->name }}
                        </p>

                    </div>



                    <!-- ================================================= -->
                    <!-- ELECTION -->
                    <!-- ================================================= -->

                    <div
                        class="mx-auto
                               mt-8
                               max-w-2xl
                               border-y
                               border-slate-200
                               py-4
                               text-center"
                    >

                        <p
                            class="text-[8px]
                                   font-bold
                                   uppercase
                                   tracking-[0.2em]
                                   text-slate-400"
                        >
                            Election
                        </p>


                        <p
                            class="mt-1
                                   text-lg
                                   font-black
                                   text-slate-800"
                        >
                            {{ $certificate->election->title }}
                        </p>

                    </div>



                    <!-- ================================================= -->
                    <!-- OFFICIAL STATEMENT -->
                    <!-- ================================================= -->

                    <div
                        class="mx-auto
                               mt-8
                               max-w-3xl
                               text-center"
                    >

                        <p
                            class="text-sm
                                   leading-7
                                   text-slate-600"
                        >

                            This certificate officially recognizes

                            <span class="font-bold text-slate-900">
                                {{ $certificate->candidate->name }}
                            </span>

                            as the duly elected

                            <span class="font-bold text-blue-700">
                                {{ $certificate->position->name }}
                            </span>

                            in the

                            <span class="font-bold text-slate-900">
                                {{ $certificate->election->title }}
                            </span>

                            conducted through the Electo secure digital
                            election platform.

                        </p>

                    </div>


<!-- ================================================= -->
<!-- SIGNATURES -->
<!-- ================================================= -->

<div
    class="mt-10
           grid
           items-end
           gap-12
           sm:grid-cols-2"
>


    <!-- ================================================= -->
    <!-- ELECTION OFFICIAL -->
    <!-- ================================================= -->

    <div class="text-center">

        <!-- Manual Signature Line -->

        <div
            class="mx-auto
                   mb-3
                   h-px
                   max-w-[200px]
                   bg-slate-700"
        ></div>


        <p
            class="text-xs
                   font-black
                   uppercase
                   tracking-wider
                   text-slate-900"
        >
            Election Official
        </p>


        <p
            class="mt-1
                   text-[9px]
                   text-slate-500"
        >
            Authorized Signature
        </p>

    </div>



    <!-- ================================================= -->
    <!-- ELECTO -->
    <!-- ================================================= -->

    <div class="text-center">

        <!-- Signature -->

        <div
            class="flex
                   h-10
                   items-center
                   justify-center"
            aria-label="Official Electo digital signature"
        >

            <img
                src="{{ asset('images/electo-signature.png') }}"
                alt="Electo Digital Signature"
                class="h-10
                       w-auto
                       max-w-[160px]
                       object-contain"
            >

        </div>


        <!-- Electo Name -->

        <p
            class="mt-1
                   text-xs
                   font-black
                   uppercase
                   tracking-wider
                   text-slate-900"
        >
            Electo
        </p>


        <!-- Digital Signature -->

        <p
            class="mt-1
                   text-[7px]
                   font-bold
                   uppercase
                   tracking-[0.25em]
                   text-blue-600"
        >
            Digital Signature
        </p>


        <p
            class="mt-1
                   text-[9px]
                   text-slate-500"
        >
            Secure Digital Elections
        </p>

    </div>

</div>


                    <!-- ================================================= -->
                    <!-- FOOTER -->
                    <!-- ================================================= -->

                    <div
                        class="mt-10
                               border-t
                               border-slate-200
                               pt-5"
                    >

                        <div
                            class="grid
                                   items-center
                                   gap-6
                                   sm:grid-cols-[1fr_auto_1fr]"
                        >


                            <!-- Certificate Number -->

                            <div class="text-center sm:text-left">

                                <p
                                    class="text-[8px]
                                           font-bold
                                           uppercase
                                           tracking-[0.16em]
                                           text-slate-400"
                                >
                                    Certificate Number
                                </p>

                                <p
                                    class="mt-1
                                           text-xs
                                           font-bold
                                           text-slate-700"
                                >
                                    {{ $certificate->certificate_number }}
                                </p>

                            </div>



                            <!-- Issued -->

                            <div class="text-center">

                                <p
                                    class="text-[8px]
                                           font-bold
                                           uppercase
                                           tracking-[0.16em]
                                           text-slate-400"
                                >
                                    Issued
                                </p>

                                <p
                                    class="mt-1
                                           text-xs
                                           font-bold
                                           text-slate-700"
                                >
                                    {{ optional($certificate->issued_at)->format('F j, Y') }}
                                </p>

                            </div>



                            <!-- QR -->

                            <div
                                class="flex
                                       items-center
                                       justify-center
                                       gap-3
                                       sm:justify-end"
                            >

                                <div
                                    class="flex
                                           h-16
                                           w-16
                                           items-center
                                           justify-center
                                           border
                                           border-slate-200
                                           bg-white
                                           p-1"
                                >

                                    {!! QrCode::size(52)
                                        ->margin(0)
                                        ->generate(
                                            route(
                                                'certificates.verify',
                                                $certificate->verification_code
                                            )
                                        )
                                    !!}

                                </div>


                                <div class="text-left">

                                    <p
                                        class="text-[8px]
                                               font-bold
                                               uppercase
                                               tracking-[0.16em]
                                               text-slate-400"
                                    >
                                        Verification
                                    </p>

                                    <p
                                        class="mt-1
                                               text-[10px]
                                               font-bold
                                               text-blue-700"
                                    >
                                        {{ $certificate->verification_code }}
                                    </p>

                                    <p
                                        class="mt-1
                                               text-[7px]
                                               font-semibold
                                               uppercase
                                               tracking-wider
                                               text-slate-400"
                                    >
                                        Scan to verify
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>



                    <!-- ================================================= -->
                    <!-- VERIFIED -->
                    <!-- ================================================= -->

                    <div
                        class="mt-6
                               flex
                               items-center
                               justify-center
                               gap-2"
                    >

                        <span
                            class="flex
                                   h-6
                                   w-6
                                   items-center
                                   justify-center
                                   rounded-full
                                   bg-emerald-50
                                   text-emerald-600"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-3.5 w-3.5"
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

                        </span>


                        <span
                            class="text-[9px]
                                   font-bold
                                   uppercase
                                   tracking-[0.16em]
                                   text-emerald-600"
                        >
                            Official Electo Certificate
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </main>



    <!-- ===================================================== -->
    <!-- PRINT STYLES -->
    <!-- ===================================================== -->

  <style>

@media print {

    /* ===================================================== */
    /* A4 LANDSCAPE */
    /* ===================================================== */

    @page {
        size: A4 landscape;
        margin: 0;
    }


    html,
    body {
        width: 297mm !important;
        height: 210mm !important;
        margin: 0 !important;
        padding: 0 !important;
        background: #ffffff !important;
    }


    body {
        overflow: hidden !important;
    }


    /* ===================================================== */
    /* HIDE TOP ACTION BAR */
    /* ===================================================== */

    .print\:hidden {
        display: none !important;
    }


    /* ===================================================== */
    /* CERTIFICATE PAGE */
    /* ===================================================== */

    main {
        display: block !important;

        width: 297mm !important;
        height: 210mm !important;

        min-height: 0 !important;

        margin: 0 !important;

        padding: 5mm !important;

        box-sizing: border-box !important;
    }


    /* ===================================================== */
    /* OUTER CERTIFICATE */
    /* ===================================================== */

    #certificate {
        width: 287mm !important;
        height: 200mm !important;

        max-width: none !important;
        min-height: 0 !important;

        margin: 0 auto !important;

        padding: 2mm !important;

        box-sizing: border-box !important;

        background: #ffffff !important;

        box-shadow: none !important;

        overflow: hidden !important;
    }


    /* ===================================================== */
    /* OUTER BORDER */
    /* ===================================================== */

    #certificate > div {
        width: 100% !important;
        height: 100% !important;

        min-height: 0 !important;

        box-sizing: border-box !important;

        overflow: hidden !important;
    }


    /* ===================================================== */
    /* INNER BORDER / CONTENT */
    /* ===================================================== */

    #certificate > div > div {
        width: 100% !important;
        height: 100% !important;

        min-height: 0 !important;

        margin: 2mm !important;

        padding: 5mm 12mm !important;

        box-sizing: border-box !important;

        overflow: hidden !important;
    }


    /* ===================================================== */
    /* VERTICAL SPACING */
    /* ===================================================== */

    #certificate .mt-10 {
        margin-top: 4mm !important;
    }

    #certificate .mt-12 {
        margin-top: 5mm !important;
    }

    #certificate .mt-8 {
        margin-top: 3mm !important;
    }

    #certificate .mt-6 {
        margin-top: 2.5mm !important;
    }

    #certificate .mt-5 {
        margin-top: 2mm !important;
    }

    #certificate .mt-4 {
        margin-top: 1.5mm !important;
    }

    #certificate .mt-3 {
        margin-top: 1mm !important;
    }


    /* ===================================================== */
    /* BRAND */
    /* ===================================================== */

    #certificate .h-16 {
        height: 13mm !important;
    }

    #certificate .w-16 {
        width: 13mm !important;
    }


    /* ===================================================== */
    /* MAIN NAME */
    /* ===================================================== */

    #certificate h2.text-4xl,
    #certificate h2.sm\:text-5xl {
        font-size: 25pt !important;
        line-height: 1.05 !important;
    }


    /* ===================================================== */
    /* CERTIFICATE TITLE */
    /* ===================================================== */

    #certificate h1 {
        font-size: 24pt !important;
        line-height: 1.05 !important;
    }


    /* ===================================================== */
    /* POSITION */
    /* ===================================================== */

    #certificate .text-2xl {
        font-size: 16pt !important;
        line-height: 1.1 !important;
    }


    /* ===================================================== */
    /* SIGNATURE AREA */
    /* ===================================================== */

    #certificate img[alt="Electo Digital Signature"] {
        height: 8mm !important;
        width: auto !important;
        max-width: 35mm !important;
    }


    #certificate .h-10 {
        height: 8mm !important;
    }


    /* ===================================================== */
    /* FOOTER */
    /* ===================================================== */

    #certificate .pt-5 {
        padding-top: 2mm !important;
    }

    #certificate .pb-5 {
        padding-bottom: 1mm !important;
    }


    /* ===================================================== */
    /* QR CODE */
    /* ===================================================== */

    #certificate .h-16.w-16 {
        width: 14mm !important;
        height: 14mm !important;
    }


    #certificate .h-16.w-16 svg {
        width: 12mm !important;
        height: 12mm !important;
    }


    /* ===================================================== */
    /* VERIFIED FOOTER */
    /* ===================================================== */

    #certificate .h-6 {
        width: 5mm !important;
        height: 5mm !important;
    }


    /* ===================================================== */
    /* PREVENT BREAKS */
    /* ===================================================== */

    #certificate > div > div > * {
        break-inside: avoid !important;
        page-break-inside: avoid !important;
    }


    /* ===================================================== */
    /* FORCE CERTIFICATE TO STAY ON ONE PAGE */
    /* ===================================================== */

    #certificate,
    #certificate > div,
    #certificate > div > div {
        page-break-before: avoid !important;
        page-break-after: avoid !important;
    }

}

</style>


</body>

</html>