@extends('layouts.champion')

@section('content')
    <section>
        <div class="mx-auto max-w-screen-xl py-8 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                <div class="col-span-3">
                    <x-button sm secondary label="Go Back" href="{{ url()->previous() }}"/>
                </div>

                <div class="col-span-3 lg:col-span-2">
                    <x-card title="History">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm border rounded">
                                <tbody class="divide-y divide-gray-200">
                                    <tr>
                                        <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-gray-100">Provider Name</td>
                                        <td colspan="2" class="w-full whitespace-nowrap px-4 py-2 text-gray-700 font-medium">{{ $milk_bag->provider->fullname() }}</td>
                                    </tr>

                                    <tr>
                                        <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-gray-100">Total Bags Available</td>
                                        <td colspan="2" class="w-full whitespace-nowrap px-4 py-2 text-gray-700 font-medium">{{ $milk_bag->total_milk_bags }}</td>
                                    </tr>

                                    <tr>
                                        <td colspan="3">
                                            <table class="min-w-full divide-y-2 divide-gray-200 text-sm">
                                                <thead class="bg-gray-100">
                                                    <tr>
                                                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-700">
                                                            Quantity
                                                        </td>
                                                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-700">
                                                            Date
                                                        </td>
                                                    </tr>
                                                </thead>

                                                <tbody class="divide-y divide-gray-200">
                                                    @forelse($milk_bag->transactions as $t)
                                                        <tr>
                                                            <td class="whitespace-nowrap px-4 py-2">
                                                                @if($t->type === 'added')
                                                                    <span class="text-green-600 font-medium">+ {{ $t->quantity }}</span>
                                                                @else
                                                                    <span class="text-red-600 font-medium">
                                                                        - {{ $t->quantity }} ({{ $t->milk_request_ref_number }})
                                                                    </span>
                                                                @endif
                                                            </td>

                                                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                                                {{ $t->created_at->format('F j, Y h:i A') }}
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <td colspan="4" class="whitespace-nowrap px-4 py-2 text-gray-700">
                                                            No result found.
                                                        </td>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </x-card>
                </div>

            </div>
        </div>
    </section>
@endsection
