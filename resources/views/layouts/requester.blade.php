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

                        <button
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'send_request_modal')"
                            href="#"
                            class="block shrink-0 rounded-lg bg-white px-4 p-2.5 text-gray-600 shadow-sm hover:text-gray-700"
                        >
                            Send a Request
                        </button>

                        <x-breeze-modal name="send_request_modal">
                            <livewire:requester.send-milk-request/>
                        </x-breeze-modal>

                        <a
                            href="{{ route('threads.index') }}"
                            class="block shrink-0 rounded-lg bg-white p-2.5 text-gray-600 shadow-sm hover:text-gray-700"
                        >
                            <span class="sr-only">Messages</span>
                            <x-icon name="chat" class="h-5 w-5"/>
                        </a>

                        <livewire:show-notification />

                        <div x-data="{ isActive: false }" class="relative w-full">
                            <button
                                x-on:click="isActive = !isActive"
                                class="block shrink-0 rounded-lg bg-white p-2.5 text-gray-600 shadow-sm hover:text-gray-700"
                            >
                                <x-icon name="cog" class="w-6 h-6"/>
                            </button>

                            <div
                                x-cloak
                                x-show="isActive"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                x-on:click.away="isActive = false"
                                x-on:keydown.escape.window="isActive = false"
                                class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                <!-- Active: "bg-gray-100", Not Active: "" -->
                                <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1"
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

            @yield('header')
        </div>
    </header>

    @yield('content')
@endsection
