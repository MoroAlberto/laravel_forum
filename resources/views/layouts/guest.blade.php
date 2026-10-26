<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" href="{{ url('favicon.svg') }}" type="image/svg+xml">
        <link rel="icon" href="{{ url('favicon.ico') }}" sizes="any">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-slate-100">
        <div class="font-sans text-gray-900 antialiased">
            <x-locale-switcher class="absolute right-4 top-4"/>
            {{ $slot }}
        </div>
    </body>
</html>
