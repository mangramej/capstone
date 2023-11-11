@extends('layouts.champion')

@section('content')
    <section>


        {{--            <div class="col-span-3 lg:col-span-2">--}}
        {{--                --}}
        {{--                <livewire:champion.provider-list/>--}}
        {{--                --}}
        {{--            </div>--}}

        {{--            <div class="col-span-3 lg:col-span-1">--}}
        {{--                --}}
        {{--                <livewire:champion.provider-list-count/>--}}
        {{--                --}}
        {{--            </div>--}}

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
                                class="group flex items-center justify-between rounded-lg px-4 py-2 text-gray-700 {{ request()->routeIs('champion.donation-center.*') ? 'bg-gray-100' : 'hover:bg-gray-100' }}"
                            >
                                <span class="text-sm font-medium"> Donation Center </span>
                            </a>
                        </li>
                    </ul>


                </x-card>
            </div>

            <div class="col-span-2 space-y-4">
                <div>
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                        <div class="col-span-3">
                            <form action="{{ route('champion.donor-application.approve', [$providerApplication]) }}" method="POST">
                                @csrf

                                <x-button
                                    type="submit"
                                    amber label="Approve Donor"
                                />
                            </form>
                        </div>
                    </div>
                </div>

                <x-card title="Donor Information">
                    <div class="flow-root">
                        <dl class="-my-3 divide-y divide-gray-100 text-sm">
                            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                <dt class="font-medium text-gray-900">Name</dt>
                                <dd class="text-gray-700 sm:col-span-2">{{ $providerApplication->user->fullname() }}</dd>
                            </div>

                            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                <dt class="font-medium text-gray-900">Email</dt>
                                <dd class="text-gray-700 sm:col-span-2">{{ $providerApplication->user->email }}</dd>
                            </div>

                            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                <dt class="font-medium text-gray-900">Contact Number</dt>
                                <dd class="text-gray-700 sm:col-span-2">{{ $providerApplication->user->phone_number }}</dd>
                            </div>

                            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                <dt class="font-medium text-gray-900">Address</dt>
                                <dd class="text-gray-700 sm:col-span-2">{{ $providerApplication->user->address() }}</dd>
                            </div>
                        </dl>
                    </div>
                </x-card>

                <x-card title="Pre Screening">
                    <div class="space-y-2">
                        @foreach(unserialize($providerApplication->preScreening->content) as $item)
                            <div>
                                <label>{{ $item['question'] }}</label>
                                <input type="text" value="{{ $item['answer'] }}" class="rounded-lg shadow bg-gray-50 font-semibold text-sm" readonly>
                            </div>
                        @endforeach
                    </div>
                </x-card>
            </div>
        </div>
    </section>
@endsection
