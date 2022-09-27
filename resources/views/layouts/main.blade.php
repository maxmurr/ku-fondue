<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>KU Fondue</title>
</head>

<body class="bg-[#F2F2F2]">
    @include('layouts._navbar')

    <div>
        @yield('content')
    </div>
    <script src="https://unpkg.com/flowbite@1.5.2/dist/flowbite.js"></script>
</body>

</html>
