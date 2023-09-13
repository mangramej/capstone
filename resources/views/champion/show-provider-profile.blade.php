@extends('layouts.champion')

@section('content')
    <div class="space-y-4">
        <div class="p-6 bg-white rounded shadow">
            <h3 class="font-semibold text-lg sm:text-xl"> {{ $user->fullname() }} </h3>

            <p class="text-sm sm:text-normal">
                {{ $user->email }}
            </p>
        </div>

        <div class="p-6 bg-white rounded shadow">
            <div class="flow-root">
                <dl class="-my-3 divide-y divide-gray-100 text-sm">
                    @if($milk_bag)
                        <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Become your provider at</dt>
                            <dd class="text-gray-700 sm:col-span-2">{{ $milk_bag->created_at->format('F j, Y') }}</dd>
                        </div>
                    @endif

                    @if($total_bag_provided)
                        <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Total bags provided</dt>
                            <dd class="text-gray-700 sm:col-span-2">{{ $total_bag_provided }} (milk bags)</dd>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Account created at</dt>
                        <dd class="text-gray-700 sm:col-span-2">{{ $user->created_at->format('F j, Y') }}</dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Date of Birth</dt>
                        <dd class="text-gray-700 sm:col-span-2">{{ $user->date_of_birth }}</dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Phone Number</dt>
                        <dd class="text-gray-700 sm:col-span-2">{{ $user->phone_number }}</dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Address</dt>
                        <dd class="text-gray-700 sm:col-span-2">
                            {{ $user->address() }}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

@endsection
