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

<body class="bg-gray-100">
<x-notifications position="bottom-right"/>


<div class="py-4 bg-white shadow-md">
    <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-4">
                <img class="rounded-full"
                     width="60px"
                     src="https://ui-avatars.com/api/?name={{ auth()->user()->first_name }}+{{ auth()->user()->last_name }}"
                     alt="avatar">
                <div>
                    <div>
                        <x-badge violet label="Requester" />

                        @if(auth()->user()->isVerifiedRequester())
                            <x-badge icon="check-circle" positive label="Verified" />
                        @else
                            <x-badge icon="x-circle" negative label="Verified" />
                        @endif
                    </div>
                    <span class="whitespace-nowrap font-bold">
                        {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                    </span>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <livewire:show-notification />
                <x-logo/>
            </div>
        </div>
    </div>
</div>

<div class="mt-4 mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-12 space-y-4">
        <div class="col-span-11">
            @yield('content')
        </div>

        <div class="col-span-1">
            <div class="flex flex-col space-y-4 items-center justify-center">
                <div class="w-full">
                    <a href="{{ route('dashboard') }}" class="flex justify-center items-center">
                        <span class="p-2 bg-gray-800 hover:bg-gray-700 rounded-full text-white transition ease cursor-pointer">
                            <x-icon name="home" class="w-8 h-8"/>
                        </span>
                    </a>
                </div>

                <div class="w-full">
                    <a href="{{ route('threads.index') }}" class="flex justify-center items-center">
                        <span class="p-2 bg-gray-800 hover:bg-gray-700 rounded-full text-white transition ease cursor-pointer">
                            <x-icon name="chat-alt" class="w-8 h-8"/>
                        </span>
                    </a>
                </div>

                <div class="relative" x-data="{profile: false}">
                    <div class="flex justify-center">
                        <button type="button"
                                @click="profile = !profile"
                                class="relative flex p-2 rounded-full text-sm bg-gray-800 hover:bg-gray-700 text-white transition ease"
                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="absolute -inset-1.5"></span>
                            <x-icon name="cog" class="w-8 h-8"/>
                        </button>
                    </div>
                    <div
                        x-cloak
                        x-show="profile"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        x-on:click.away="profile = false"
                        x-on:keydown.escape.window="profile = false"
                        class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                        <!-- Active: "bg-gray-100", Not Active: "" -->
                        <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                           role="menuitem" tabindex="-1"
                           id="user-menu-item-0">Profile</a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button
                                type="submit"
                                class="block w-full text-start px-4 py-2 text-sm text-gray-700 hover:bg-red-100"
                                role="menuitem"
                            >
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stack('scripts')
</body>
</html>
