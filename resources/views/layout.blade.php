<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ url('favicon.ico') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700;800&display=swap">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-slate-800">
<div class="min-h-screen bg-slate-100">
    @include('layouts.navigation')
    <!-- Page Content -->
    <main class="mx-auto max-w-3xl px-4 py-8 sm:px-6">
        @if (session('error'))
            <x-alert message="{{ session('error') }}" type="error"></x-alert>
        @endif
        @if (session('success'))
            <x-alert message="{{ session('success') }}" type="success"></x-alert>
        @endif
        @yield('slot')
    </main>
</div>
</body>
</html>
