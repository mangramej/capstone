@extends('components.champion.layout')

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
                    {{--                    @if($milk_bag)--}}
                    {{--                        <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">--}}
                    {{--                            <dt class="font-medium text-gray-900">Become your provider at</dt>--}}
                    {{--                            <dd class="text-gray-700 sm:col-span-2">{{ $milk_bag->created_at->format('F j, Y') }}</dd>--}}
                    {{--                        </div>--}}
                    {{--                    @endif--}}

                    <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Donor Application ID</dt>
                        <dd class="text-gray-700 sm:col-span-2">{{ $user->donorApplication->application_id }}</dd>
                    </div>

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
                        <dd class="text-gray-700 sm:col-span-2">{{ $user->date_of_birth->format('F j, Y') }}</dd>
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


        @if($preScreen)
            <x-card title="Pre Screening">
                <div class="space-y-2">
                    @foreach(unserialize($preScreen->content) as $item)
                        <div>
                            <label>{{ $item['question'] }}</label>
                            <input type="text" value="{{ $item['answer'] }}"
                                   class="rounded-lg shadow bg-gray-50 font-semibold text-sm" readonly>
                        </div>
                    @endforeach
                </div>
            </x-card>
        @endif

        <x-card title="Attachment Medical Records">
            @if($user->donorApplication->attachments->isNotEmpty())
                <small class="text-gray-600">Click to download: </small>
                <ul class="mt-1 border-2 divide-y rounded-lg">
                    @foreach($user->donorApplication->attachments as $file)
                        <li class="px-6 py-4 cursor-pointer hover:bg-gray-100 hover:underline decoration-2 font-medium"
                            wire:click="downloadAttachment({{ $file->id }})">{{ $file->name }}</li>
                    @endforeach
                </ul>
            @else
                <h3 class="text-gray-600">No attachment found.</h3>
            @endif
        </x-card>
    </div>

@endsection
