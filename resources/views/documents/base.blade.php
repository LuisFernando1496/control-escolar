<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    {{-- <link href="{{ asset('bootstrap/css/bootstrap.css') }}" rel="stylesheet"> --}}
    @yield('head')
    <style>
        .page-break {
            page-break-after: always;
        }

        .center {
            margin-left: auto;
            margin-right: auto;
        }

        .bold-text {
            font-weight: bold;
        }

        .column {
            float: left;
            width: 25%;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

    </style>
</head>

<body>
    @yield('content')
</body>

</html>
