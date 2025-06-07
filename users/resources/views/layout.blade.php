<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>VibesSync</title>
        <link rel="icon" href="{{Vite::asset('resources/imgs/logo_main.png')}}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="flex flex-col min-h-screen">
        @yield('content')
    </body>
</html>
