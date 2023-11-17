@extends('components.champion.layout')

@section('content')
    <section>
        <div class="grid grid-cols-3 gap-4">
            <div class="col-span-2 space-y-4">
                <div>
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                        <div class="col-span-3 flex gap-4">
                            <form action="{{ route('champion.my-providers.donor-application.approve', [$providerApplication]) }}" method="POST">
                                @csrf

                                <x-button
                                    type="submit"
                                    amber label="Approve Donor"
                                />
                            </form>

                            <form action="{{ route('champion.my-providers.donor-application.decline', [$providerApplication]) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <x-button
                                    type="submit"
                                    negative label="Decline Donor"
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
