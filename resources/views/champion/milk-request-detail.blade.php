@extends('components.champion.layout')

@section('content')
    <div class="mt-4 grid grid-cols-1 lg:grid-cols-3 gap-4">
        <div class="col-span-1 lg:col-span-3">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-button sm secondary label="Go Back" href="{{ url()->previous() }}"/>
                </div>

                <div>
                    <div class="flex justify-end items-center gap-2">
                        <livewire:champion.update-request-status :milkRequest="$milkRequest"/>

                        <x-button.circle
                            href="{{ route('champion.show-requester-request-history', ['user' => $milkRequest->requester_id]) }}"
                            type="submit"
                            icon="menu-alt-2"
                            warning
                        />

                        <div>
                            <form action="{{ route('threads.create', [$milkRequest->requester]) }}"
                                  method="POST">
                                @csrf
                                @method('PUT')

                                <x-button.circle
                                    type="submit"
                                    icon="chat"
                                    info
                                />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-1 lg:col-span-2 space-y-4 sm:p-0">
            <x-card title="Milk Request Details">
                <div class="flow-root">
                    <dl class="-my-3 divide-y divide-gray-100 text-sm">
                        <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Reference Number</dt>
                            <dd class="text-gray-700 sm:col-span-2 font-bold">{{ $milkRequest->ref_number }}</dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Mother Name</dt>
                            <dd class="text-gray-700 sm:col-span-2">{{ $milkRequest->mother_name }}</dd>
                        </div>

                        {{--                                <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">--}}
                        {{--                                    <dt class="font-medium text-gray-900">Baby Name</dt>--}}
                        {{--                                    <dd class="text-gray-700 sm:col-span-2">{{ $milkRequest->baby_name }}</dd>--}}
                        {{--                                </div>--}}

                        <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">No of Bags</dt>
                            <dd class="text-gray-700 sm:col-span-2">{{ $milkRequest->quantity }}</dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Phone Number</dt>
                            <dd class="text-gray-700 sm:col-span-2">{{ $milkRequest->phone_number }}</dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Address</dt>
                            <dd class="text-gray-700 sm:col-span-2">{{ $milkRequest->address }}</dd>
                        </div>
                        <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Comment</dt>
                            <dd class="text-gray-700 sm:col-span-2">
                                {{ $milkRequest->comment ?: 'No comment provided.' }}
                            </dd>
                        </div>
                    </dl>
                </div>

            </x-card>
        </div>

        <div class="col-span-1">
            <livewire:champion.request-status-activity :milkRequest="$milkRequest"/>
        </div>
    </div>
@endsection
