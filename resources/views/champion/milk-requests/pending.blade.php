@extends('layouts.champion')

@section('content')
    <div class="grid grid-cols-4 gap-2">
        <div class="bg-white shadow rounded-lg">
            <div class="border-b text-center py-4 bg-gray-50 rounded-t-lg">
                <h1 class="text-gray-700 font-semibold">Milk Requests</h1>
            </div>

            <ul class="space-y-1 p-4">
                <li>
                    <a
                        href="{{ route('champion.show-milk-requests.pending') }}"
                        class="group flex items-center justify-between rounded-lg px-4 py-2 text-gray-700 {{ request()->routeIs('champion.show-milk-requests.pending') ? 'bg-gray-100' : 'hover:bg-gray-100' }}"
                    >
                        <span class="text-sm font-medium">New Requests </span>

                        <span
                            class="shrink-0 rounded-full bg-gray-100 px-3 py-0.5 text-xs text-gray-600 group-hover:bg-gray-200 group-hover:text-gray-700 font-semibold"
                        >
                            {{ $milk_request_pending_count }}
                        </span>
                    </a>
                </li>

                <li>
                    <a
                        href="{{ route('champion.show-milk-requests.recent') }}"
                        class="group flex items-center justify-between rounded-lg px-4 py-2 text-gray-700 {{ request()->routeIs('champion.show-milk-requests.recent') ? 'bg-gray-100' : 'hover:bg-gray-100' }}"
                    >
                        <span class="text-sm font-medium"> Recent Requests </span>

                        <span
                            class="shrink-0 rounded-full bg-gray-100 px-3 py-0.5 text-xs text-gray-600 group-hover:bg-gray-200 group-hover:text-gray-700 font-semibold"
                        >
                            {{ $milk_request_recent_count }}
                        </span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="col-span-3">
            <div class="grid grid-cols-3 gap-2">
                <div class="col-span-3">
                </div>

                <div class="col-span-3">
                    <livewire:champion.show-pending-milk-request />
                </div>
            </div>
        </div>
    </div>
@endsection
