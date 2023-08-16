@extends('layouts.base')

@section('body')
    <header class="bg-gray-50">
        <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 lg:px-8">
            <div class="flex items-center sm:justify-between sm:gap-4">
                <div class="relative hidden sm:block">
                    <label class="sr-only" for="search"> Search </label>

                    <input
                        class="h-10 w-full rounded-lg border-none bg-white pe-10 ps-4 text-sm shadow-sm sm:w-56"
                        id="search"
                        type="search"
                        placeholder="Search website..."
                    />

                    <button
                        type="button"
                        class="absolute end-1 top-1/2 -translate-y-1/2 rounded-md bg-gray-50 p-2 text-gray-600 transition hover:text-gray-700"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                            />
                        </svg>
                    </button>
                </div>

                <div
                    class="flex flex-1 items-center gap-8 justify-end"
                >
                    <div class="flex gap-4">
                        <button
                            type="button"
                            class="block shrink-0 rounded-lg bg-white p-2.5 text-gray-600 shadow-sm hover:text-gray-700 sm:hidden"
                        >
                            <span class="sr-only">Search</span>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                />
                            </svg>
                        </button>

                        <button
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'send_request_modal')"
                            href="#"
                            class="block shrink-0 rounded-lg bg-white px-4 p-2.5 text-gray-600 shadow-sm hover:text-gray-700"
                        >
                            <span class="sr-only">Academy</span>
                            Send a Request
                        </button>

                        <x-breeze-modal name="send_request_modal">
                            <livewire:requester.send-milk-request />
                        </x-breeze-modal>





{{-- NOTIFICATION                       --}}
{{--                        <a--}}
{{--                            href="#"--}}
{{--                            class="block shrink-0 rounded-lg bg-white p-2.5 text-gray-600 shadow-sm hover:text-gray-700"--}}
{{--                        >--}}
{{--                            <span class="sr-only">Notifications</span>--}}
{{--                            <svg--}}
{{--                                xmlns="http://www.w3.org/2000/svg"--}}
{{--                                class="h-5 w-5"--}}
{{--                                fill="none"--}}
{{--                                viewBox="0 0 24 24"--}}
{{--                                stroke="currentColor"--}}
{{--                                stroke-width="2"--}}
{{--                            >--}}
{{--                                <path--}}
{{--                                    stroke-linecap="round"--}}
{{--                                    stroke-linejoin="round"--}}
{{--                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"--}}
{{--                                />--}}
{{--                            </svg>--}}
{{--                        </a>--}}

                        <div x-data="{ isActive: false }" class="relative w-full">
                            <button
                                x-on:click="isActive = !isActive"
                                class="block shrink-0 rounded-lg bg-white p-2.5 text-gray-600 shadow-sm hover:text-gray-700"
                            >
                                <x-icon name="cog" class="w-6 h-6" />
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
                                        href="#"
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

            <div class="mt-8">
                <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">
                    Welcome!
                </h1>

                <p class="mt-1.5 text-sm text-gray-500">
                    Below are the history of your milk requests, along with their status.
                </p>
            </div>
        </div>
    </header>

    @yield('content')

    @isset($slot)
        {{ $slot }}
    @endisset
@endsection
