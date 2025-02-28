<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/css/app.css') <!-- Jeśli używasz Vite -->
        <title>Laravel</title>
    </head>
    <body>
        <div id="app">
                   <example-component></example-component>
        </div>
        @vite('resources/js/app.js') <!-- Jeśli używasz Vite -->
    </body>
</html>
