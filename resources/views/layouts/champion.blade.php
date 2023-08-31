@extends('layouts.base')

@section('body')
    <nav x-data="{open: false}" class="bg-white shadow py-1.5">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <!-- Mobile menu button-->
                    <button @click="open = ! open" type="button"
                            class="relative inline-flex items-center justify-center rounded-md p-2 bg-amber-800 text-white"
                            aria-controls="mobile-menu" aria-expanded="false">
                        <span class="absolute -inset-0.5"></span>
                        <span class="sr-only">Open main menu</span>
                        <!--
                          Icon when menu is closed.

                          Menu open: "hidden", Menu closed: "block"
                        -->
                        <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                        </svg>
                        <!--
                          Icon when menu is open.

                          Menu open: "block", Menu closed: "hidden"
                        -->
                        <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex flex-shrink-0 items-center">
                        <x-logo />
                    </div>
                    <div class="hidden sm:ml-6 sm:block">
                        <div class="flex space-x-4 items-center h-full">
                            <x-nav-link title="Dashboard" href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" />
                            <x-nav-link title="Milk Bag" href="{{ route('champion.milk-bag.index') }}" :active="request()->routeIs('champion.milk-bag.*')" />
                            <x-nav-link title="Providers" href="{{ route('champion.my-providers') }}" :active="request()->routeIs('champion.my-providers')" />
                            <x-nav-link title="Messages" href="{{ route('threads.index') }}" :active="request()->routeIs('threads.*')" />
                        </div>
                    </div>
                </div>
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <!-- Profile dropdown -->
                    <div class="relative ml-3" x-data="{profile: false}">
                        <div>
                            <button type="button"
                                    @click="profile = !profile"
                                    class="relative flex rounded-full text-sm hover:bg-amber-700 hover:text-white transition ease"
                                    id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="absolute -inset-1.5"></span>
                                <span class="sr-only">Open user menu</span>
                                <x-icon name="cog" class="w-8 h-8"/>
                            </button>
                        </div>

                        <!--
                          Dropdown menu, show/hide based on menu state.

                          Entering: "transition ease-out duration-100"
                            From: "transform opacity-0 scale-95"
                            To: "transform opacity-100 scale-100"
                          Leaving: "transition ease-in duration-75"
                            From: "transform opacity-100 scale-100"
                            To: "transform opacity-0 scale-95"
                        -->
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
                            <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1"
                               id="user-menu-item-0">Profile</a>

                            <a href="{{ route('champion.reports.milk-requests') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1"
                               id="user-menu-item-0">Reports</a>

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

        <!-- Mobile menu, show/hide based on menu state. -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden" id="mobile-menu">
            <div class="space-y-1 px-2 pb-3 pt-2">
                <x-nav-link title="Dashboard" href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" />
                <x-nav-link title="Milk Bag" href="{{ route('champion.milk-bag.index') }}" :active="request()->routeIs('champion.milk-bag.*')" />
                <x-nav-link title="Providers" href="{{ route('champion.my-providers') }}" :active="request()->routeIs('champion.my-providers')" />
                <x-nav-link title="Messages" href="{{ route('threads.index') }}" :active="request()->routeIs('threads.*')" />
            </div>
        </div>
    </nav>

    <div class="mt-8 mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8">
        @yield('content')
    </div>
@endsection
