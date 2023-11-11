@extends('layouts.champion')

@section('content')
    <section>
        <div class="grid grid-cols-3 gap-4">
            <div>
                <x-card>

                    <ul class="space-y-1">
                        <li>
                            <a
                                href="{{ route('champion.my-providers') }}"
                                class="group flex items-center justify-between rounded-lg px-4 py-2 text-gray-700 {{ request()->routeIs('champion.my-providers') ? 'bg-gray-100' : 'hover:bg-gray-100' }}"
                            >
                                <span class="text-sm font-medium">Donor Application</span>
                            </a>
                        </li>

                        <li>
                            <a
                                href="{{ route('champion.approved-donor') }}"
                                class="group flex items-center justify-between rounded-lg px-4 py-2 text-gray-700 {{ request()->routeIs('champion.show-milk-requests.recent') ? 'bg-gray-100' : 'hover:bg-gray-100' }}"
                            >
                                <span class="text-sm font-medium"> Approved Donor </span>
                            </a>
                        </li>

                        <li>
                            <a
                                href="{{ route('champion.location.index') }}"
                                class="group flex items-center justify-between rounded-lg px-4 py-2 text-gray-700 {{ request()->routeIs('champion.location.*') ? 'bg-gray-100' : 'hover:bg-gray-100' }}"
                            >
                                <span class="text-sm font-medium"> Donation Center </span>
                            </a>
                        </li>

                    </ul>


                </x-card>
            </div>

            <div class="col-span-2 space-y-4">
                <x-card title="Add Donation Center">
                    <form id="submitForm" method="POST" action="{{ route('champion.location.store') }}">
                        @csrf

                        <div class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">
                                    Name
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    placeholder="Hospital/Location name"
                                    class="mt-1 w-full rounded-md border-gray-200 shadow-sm sm:text-sm"
                                />

                                @error('name')
                                <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">
                                    Address
                                </label>

                                <input
                                    type="text"
                                    name="address"
                                    id="address"
                                    placeholder="Address"
                                    class="mt-1 w-full rounded-md border-gray-200 shadow-sm sm:text-sm"
                                />

                                @error('address')
                                <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <x-slot name="footer">
                            <div class="flex justify-end items-center">
                                <x-button type="submit" form="submitForm" label="Submit" primary />
                            </div>
                        </x-slot>
                    </form>
                </x-card>
            </div>
        </div>
    </section>
@endsection
