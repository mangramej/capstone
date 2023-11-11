@extends('layouts.champion')

@section('content')
    <section>
        {{--        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">--}}
        {{--            <div class="col-span-3">--}}
        {{--                <x-button--}}
        {{--                    x-data=""--}}
        {{--                    x-on:click.prevent="$dispatch('open-modal', 'add_provider_modal')"--}}
        {{--                    amber label="Add Provider"--}}
        {{--                />--}}

        {{--                <x-breeze-modal name="add_provider_modal" disableOverflow>--}}
        {{--                    <livewire:champion.add-provider-to-list/>--}}
        {{--                </x-breeze-modal>--}}
        {{--            </div>--}}

        {{--            <div class="col-span-3 lg:col-span-2">--}}
        {{--                --}}
        {{--                        <livewire:champion.provider-list/>--}}
        {{--                --}}
        {{--            </div>--}}

        {{--            <div class="col-span-3 lg:col-span-1">--}}
        {{--                --}}
        {{--                <livewire:champion.provider-list-count/>--}}
        {{--                --}}
        {{--            </div>--}}
        {{--        </div>--}}

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
                                href="{{ route('champion.show-milk-requests.recent') }}"
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

            <div class="col-span-2">
                <div class="space-y-4">
                    <div>
                        <livewire:champion.provider-list-count/>
                    </div>

                    <div>
                        <livewire:champion.provider-list/>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
