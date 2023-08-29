@extends('layouts.base')

@section('body')
    <header class="bg-gray-50">
        <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 lg:px-8">
            <div class="flex items-center sm:justify-between sm:gap-4">
                <div class="relative">
                    <a href="{{ route('dashboard') }}">
                        <x-logo size="12"/>
                    </a>
                </div>

                <div class="flex flex-1 items-center gap-8 justify-end">
                    <div class="flex gap-1">
                        <a
                            href="{{ route('dashboard') }}"
                            class="block shrink-0 rounded-lg bg-white p-2.5 text-gray-600 shadow-sm hover:text-gray-700"
                        >
                            <span class="sr-only">Home</span>
                            <x-icon name="home" class="h-5 w-5"/>
                        </a>

                        <div x-data="{ isActive: false }" class="relative w-full">
                            <button
                                x-on:click="isActive = !isActive"
                                class="block shrink-0 rounded-lg bg-white p-2.5 text-gray-600 shadow-sm hover:text-gray-700"
                            >
                                <x-icon name="cog" class="w-6 h-6"/>
                            </button>

                            <div
                                class="absolute end-0 z-10 mt-2 w-56 rounded-md border border-gray-100 bg-white shadow-lg"
                                role="menu"
                                x-cloak
                                x-transition
                                x-show="isActive"
                                x-on:click.away="isActive = false"
                                x-on:keydown.escape.window="isActive = false"
                            >
                                <div class="p-2">
                                    <a
                                        href="{{ route('profile') }}"
                                        class="block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
                                        role="menuitem"
                                    >
                                        Profile
                                    </a>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button
                                            type="submit"
                                            class="flex w-full items-center gap-2 rounded-lg px-4 py-2 text-sm text-red-700 hover:bg-red-50"
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

            @yield('header')
        </div>
    </header>

    @yield('content')
@endsection
