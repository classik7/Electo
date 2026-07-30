<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>{{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">

</head>

<body
class="bg-[#081225] text-white min-h-screen overflow-x-hidden">

    {{-- Background Glow --}}

    <div
    class="fixed inset-0 -z-10">

        <div
        class="absolute top-0 left-0 h-96 w-96 rounded-full bg-blue-600/20 blur-3xl">
        </div>

        <div
        class="absolute bottom-0 right-0 h-[500px] w-[500px] rounded-full bg-purple-600/20 blur-3xl">
        </div>

    </div>

@yield('content')
</body>

</html>