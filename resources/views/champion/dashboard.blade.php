@extends('layouts.champion')

@section('content')
    <section>
        <div class="mx-auto max-w-screen-xl py-8 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                <div class="col-span-1 lg:col-span-2 space-y-4">
                    <div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4">
                            <div class="rounded-lg border border-gray-100 bg-white p-6 shadow">
                                <div>
                                    <p class="text-gray-500">Total Available Bags</p>

                                    <p class="text-2xl font-medium text-gray-900">{{ $total_milk_bags }}</p>
                                </div>
                            </div>

                            <div class="rounded-lg border border-gray-100 bg-white p-6 shadow">
                                <div>
                                    <p class="text-gray-500">Total Providers</p>

                                    <p class="text-2xl font-medium text-gray-900">{{ $total_provider }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <x-card>
                        <livewire:champion.milk-request-list/>
                    </x-card>
                </div>

                <div>
                    <div class="rounded-lg border border-gray-100 bg-white p-6 shadow">
                        <div>
                            <p class="text-gray-500">Total Request</p>

                            <p class="text-2xl font-medium text-gray-900">{{ $total_milk_requests }}</p>
                        </div>

                        <div class="mt-2 bg-gray-100 rounded p-1">
                            <table class="min-w-full divide-y-2 divide-gray-200 text-sm">
                                <thead>
                                <tr>
                                    <td colspan="2"
                                        class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                        Breakdown
                                    </td>
                                    <td class="text-end whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                        Status
                                    </td>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                <tr>
                                    <td colspan="2"
                                        class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $total_accepted_milk_request }}</td>
                                    <td class="text-end whitespace-nowrap px-4 py-2 text-green-700">
                                        <x-badge rounded positive label="Accepted"/>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2"
                                        class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $total_assigned_milk_request }}</td>
                                    <td class="text-end whitespace-nowrap px-4 py-2 text-sky-700">
                                        <x-badge rounded primary label="Provider Assigned"/>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2"
                                        class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $total_delivered_milk_request }}</td>
                                    <td class="text-end whitespace-nowrap px-4 py-2 text-violet-700">
                                        <x-badge rounded violet label="Delivered"/>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2"
                                        class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $total_confirmed_milk_request }}</td>
                                    <td class="text-end whitespace-nowrap px-4 py-2 text-gray-700">
                                        <x-badge rounded secondary label="Confirmed"/>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
