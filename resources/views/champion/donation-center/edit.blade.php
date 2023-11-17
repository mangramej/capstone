@extends('components.champion.layout')

@section('content')
    <section>
        <div class="grid grid-cols-3 gap-4">
            <div class="col-span-2 space-y-4">
                <x-card title="Add Donation Center">
                    <form id="submitForm" method="POST" action="{{ route('champion.location.update', [$location]) }}">
                        @csrf
                        @method('PATCH')

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
                                    value="{{ $location->name }}"
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
                                    value="{{ $location->address }}"
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
