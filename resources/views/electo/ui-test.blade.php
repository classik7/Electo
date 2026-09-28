<!DOCTYPE html>
<html>
<head>

    @vite(['resources/css/app.css','resources/js/app.js'])

</head>

<body class="p-20 space-y-6 bg-slate-100">

    <x-electo.ui.button>

        Primary Button

    </x-electo.ui.button>

    <x-electo.ui.button
        variant="secondary">

        Secondary

    </x-electo.ui.button>

    <x-electo.ui.button
        variant="danger">

        Delete

    </x-electo.ui.button>

    <x-electo.ui.button
        variant="success"
        icon="check-circle">

        Success

    </x-electo.ui.button>

    <x-electo.ui.button
        variant="outline">

        Outline

    </x-electo.ui.button>

</body>

</html>