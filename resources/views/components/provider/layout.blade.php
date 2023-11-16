<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @hasSection('title')
        <title>@yield('title') - {{ config('app.name') }}</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    <wireui:scripts/>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @livewireStyles
    @livewireScripts

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-[#D6C7AE]">
<x-notifications position="bottom-right"/>

<div class="bg-[#B3A492] w-full h-[200px]"></div>

<div class="-mt-48 mx-auto max-w-screen-xl px-4 py-8 sm:px-6 lg:px-8">
    <div class="grid gap-4 grid-cols-12">
        <div>
            <div class="flex justify-center items-center">
                <img class="rounded-full"
                     width="100%"
                     src="https://ui-avatars.com/api/?name={{ auth()->user()->first_name }}+{{ auth()->user()->last_name }}"
                     alt="avatar">
            </div>
        </div>
        <div class="col-span-11 flex items-center ">
            <div class="flex items-center space-x-4">
                <div class="bg-green-300 w-[15px] h-[15px] p-1 rounded-full"></div>

                <h1 class="text-4xl font-bold text-white">
                    {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                </h1>
            </div>
        </div>
    </div>

    <div class="mt-4 grid gap-4 grid-cols-12">
        <div class="col-span-1 space-y-4">
            <div class="h-[550px] bg-white rounded-lg text-gray-700 p-2 shadow-md flex flex-col">
                <a href="{{ route('dashboard') }}">
                    <x-logo class="w-full"/>
                </a>

                <span class="w-full text-center">
                        <a href="{{ route('profile') }}"
                           class="text-sm text-gray-600 font-bold decoration-2 hover:underline">View Profile</a>
                    </span>

                <span class="w-full mt-auto">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="w-full font-bold rounded hover:bg-gray-200 p-2 text-sm transition ease">
                                Logout
                            </button>
                        </form>
                    </span>
            </div>
        </div>

        <div class="col-span-11 space-y-4">
            @yield('content')
        </div>
    </div>
</div>

@stack('scripts')
</body>
</html>
