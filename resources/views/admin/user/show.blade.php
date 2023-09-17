@extends('layouts.admin.app')

@section('content')
    <div class="w-full">
        <div class="flex justify-between items-center bg-white rounded-lg shadow-md p-6">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                    {{ $user->fullname() }} <span class="text-lg text-slate-500 font-normal">
                            ({{ ucfirst($user->type->value) }})
                        </span>
                </h2>
                <p class="text-slate-500 text-sm">{{ $user->email }}</p>
                <p class="text-slate-500 text-sm mt-2">Member since: {{ $user->created_at->format('F j, Y') }}</p>
            </div>

            <div>
                <x-bz.dropdown align="right">
                    <x-slot name="trigger">
                        <button type="button"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Manage') }}
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="divide-y">
                            <x-bz.dropdown-link-btn
                                class="flex items-center"
                                x-on:click.prevent="$dispatch('open-modal', 'user_edit_modal')">

                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                     class="bi bi-person-gear text-sky-600" viewBox="0 0 16 16">
                                    <path
                                        d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm.256 7a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Zm3.63-4.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382l.045-.148ZM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z"/>
                                </svg>

                                <span class="ml-3 font-semibold text-slate-700">{{ __('Edit') }}</span>
                            </x-bz.dropdown-link-btn>
                        </div>
                    </x-slot>
                </x-bz.dropdown>
            </div>
        </div>

        <div class="pt-12">
            <x-breeze-modal name="user_edit_modal">
                {{--                <livewire:profile.update-account-information :user="$user" />--}}

                <form method="POST" action="{{ route('admin.users.update', [$user]) }}" class="p-6">
                    @csrf
                    @method('PATCH')

                    <div class="mt-4">
                        <x-bz.input-label for="email" :value="__('Email')"/>
                        <x-bz.text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                         :value="old('email', $user->email)" required autocomplete="username"/>
                        <x-bz.input-error class="mt-2" :messages="$errors->get('email')"/>
                    </div>

                    <div class="mt-4">
                        <span class='block font-medium text-sm text-gray-700'>Email Status</span>
                        <label class="mt-2 test-slate-700">
                            <input type="radio" value='1'
                                   name="is_verified" @checked(!is_null($user->email_verified_at))>
                            Verified
                        </label>

                        <label class="ml-4 mt-2 test-slate-700">
                            <input type="radio" value='0'
                                   name="is_verified" @checked(is_null($user->email_verified_at))>
                            Unverified
                        </label>

                        <x-bz.input-error class="mt-2" :messages="$errors->get('is_verified')"/>
                    </div>

                    <div class="mt-4">
                        <x-bz.input-label for="password" :value="__('New Password')"/>
                        <x-bz.text-input id="password" name="password" type="password" class="mt-1 block w-full"
                                         autocomplete="new-password"/>
                        <x-bz.input-error :messages="$errors->get('password')" class="mt-2"/>
                    </div>

                    <div class="mt-4">
                        <x-bz.input-label for="password_confirmation" :value="__('Confirm Password')"/>
                        <x-bz.text-input id="password_confirmation" name="password_confirmation" type="password"
                                         class="mt-1 block w-full" autocomplete="new-password"/>
                        <x-bz.input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-bz.secondary-btn x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-bz.secondary-btn>

                        <x-bz.primary-btn class="ml-3">
                            {{ __('Update') }}
                        </x-bz.primary-btn>
                    </div>
                </form>
            </x-breeze-modal>


            <div class="p-6 bg-white rounded shadow">

                <h1 class="text-lg font-semibold">Activity Logs</h1>

                <div class="overflow-x-auto mt-4">
                    <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap text-start px-4 py-2 font-medium text-gray-900">
                                    Date and Time
                                </th>
                                <th class="whitespace-nowrap text-start px-4 py-2 font-medium text-gray-900">
                                    Action
                                </th>
                                <th class="whitespace-nowrap text-start px-4 py-2 font-medium text-gray-900">
                                    Description
                                </th>
                                <th class="whitespace-nowrap text-start px-4 py-2 font-medium text-gray-900">
                                    Action
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @forelse($activities as $activity)
                                <tr>
                                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                        {{ $activity->created_at->format('m/d/Y h:iA') }}
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $activity->log_name }}</td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $activity->description }}</td>
                                    <td class="px-4 py-2 text-gray-700">
                                        <button
                                            class="text-sky-500 hover:text-sky-600 hover:underline transition ease"
                                            x-data
                                            x-on:click="$dispatch('open-modal', 'activity_details_{{$activity->id}}_modal')">Details</button>

                                        <x-breeze-modal name="activity_details_{{$activity->id}}_modal">
                                            <div class="p-6">
                                                <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                                                    <thead>
                                                        <tr>
                                                            @if($activity->changes->has('attributes'))
                                                                <th class="text-start px-4 py-2 font-medium text-gray-900 capitalize">
                                                                    Attributes
                                                                </th>
                                                            @endif

                                                            @if($activity->changes->has('old'))
                                                                <th class="text-start px-4 py-2 font-medium text-gray-900 capitalize">
                                                                    Old Values
                                                                </th>
                                                            @endif
                                                        </tr>
                                                    </thead>

                                                    <tbody class="divide-y divide-gray-200">
                                                        <tr>
                                                            @if($attr = $activity->changes->get('attributes'))
                                                                <td class="px-4 py-2">
                                                                    <dl class="divide-y divide-gray-100 text-sm">
                                                                        @foreach($attr as $key => $value)
                                                                            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                                                                <dt class="font-medium text-gray-900 capitalize">{{$key}}</dt>
                                                                                <dd class="text-gray-700 sm:col-span-2 capitalize font-bold">{{$value}}</dd>
                                                                            </div>
                                                                        @endforeach
                                                                    </dl>
                                                                </td>
                                                            @endif

                                                            @if($old = $activity->changes->get('old'))
                                                                <td class="px-4 py-2">
                                                                    <dl class="divide-y divide-gray-100 text-sm">
                                                                        @foreach($old as $key => $value)
                                                                            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                                                                <dt class="font-medium text-gray-900 capitalize">{{$key}}</dt>
                                                                                <dd class="text-gray-700 sm:col-span-2 capitalize font-bold">{{$value}}</dd>
                                                                            </div>
                                                                        @endforeach
                                                                    </dl>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </x-breeze-modal>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="px-4 py-2">No result found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $activities->links() }}
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
