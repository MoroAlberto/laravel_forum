<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ url('favicon.svg') }}" type="image/svg+xml">
    <link rel="icon" href="{{ url('favicon.ico') }}" sizes="any">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700;800&display=swap">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-100 text-slate-800">
<div class="min-h-screen bg-slate-100">
    @include('layouts.navigation')
    <x-toasts/>
    <!-- Page Content -->
    {{-- pages with a sidebar get a second column on large screens --}}
    <main @class([
        'mx-auto px-4 py-8 sm:px-6',
        'max-w-6xl lg:grid lg:grid-cols-[minmax(0,1fr)_18rem] lg:gap-8' => View::hasSection('sidebar'),
        'max-w-3xl' => ! View::hasSection('sidebar'),
    ])>
        <div>
            @if (session('error'))
                <x-alert message="{{ session('error') }}" type="error"></x-alert>
            @endif
            @if (session('success'))
                <x-alert message="{{ session('success') }}" type="success"></x-alert>
            @endif
            @yield('slot')
        </div>
        @hasSection('sidebar')
            <aside class="hidden space-y-4 lg:block">
                @yield('sidebar')
            </aside>
        @endif
    </main>
</div>
</body>
</html>
