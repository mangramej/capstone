<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @livewireStyles
    @stack('head')
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
    <div class="shrink-0">
        @include('layouts.admin.side-nav')
    </div>

    <main class="ml-64 grow py-2 px-6 max-w-7xl">
        @include('layouts.admin.admin-nav')

        <div class="">
            <section class="mt-12 w-full">
                @yield('content')
            </section>
        </div>
    </main>
</div>
@livewireScripts
@stack('scripts')
</body>
</html>
