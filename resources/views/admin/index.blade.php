@extends('layouts.admin.app')

@section('content')
    <div>
        <div>
            <x-bz.primary-btn
                x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'create-admin')">
                Create Admin
            </x-bz.primary-btn>
            <x-breeze-modal name="create-admin" :show="$errors->createAdmin->isNotEmpty()" focusable>
                <div class="p-6">

                    <form action="{{ route('admin.admin.store') }}" id="create-admin-form" method="POST">
                        @csrf

                        <div class="space-y-4">
                            <div>
                                <x-bz.input-label for="name" value="Name" />
                                <x-bz.text-input class="mt-1 block w-full py-1.5 px-4" label="Name" :value="old('name')" name="name" id="name"/>
                                <x-bz.input-error :messages="$errors->createAdmin->get('name')" class="mt-1" />
                            </div>

                            <div>
                                <x-bz.input-label for="email" value="Email" />
                                <x-bz.text-input class="mt-1 block w-full py-1.5 px-4" label="Email" :value="old('email')" name="email" id="email"/>
                                <x-bz.input-error :messages="$errors->createAdmin->get('email')" class="mt-1" />
                            </div>

                            <div>
                                <label>
                                    Role
                                    <select
                                        placeholder="Select here"
                                        name="role"
                                        class="mt-1 block w-full py-1.5 px-4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    >
                                        <option label="Super Admin" value="super-admin"/>
                                        <option label="Admin" value="admin" />
                                    </select>
                                </label>
                            </div>

                            <div>
                                <span class='block font-medium text-sm text-gray-700'>Email Status</span>
                                <label class="mt-2 test-slate-700">
                                    <input type="radio" value='1' name="is_verified" checked>
                                    Verified
                                </label>

                                <label class="ml-4 mt-2 test-slate-700">
                                    <input type="radio" value='0' name="is_verified">
                                    Unverified
                                </label>

                                <x-bz.input-error class="mt-2" :messages="$errors->get('is_verified')" />
                            </div>

                            <div>
                                <x-bz.input-label for="password" value="Password"/>
                                <input type="password" name="password" id="password" class="mt-1 block w-full py-1.5 space-x-4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <x-bz.input-error :messages="$errors->createAdmin->get('password')" class="mt-1" />
                            </div>

                            <div>
                                <x-bz.input-label for="password_confirmation" value="Confirm Password"/>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full py-1.5 space-x-4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <x-bz.input-error :messages="$errors->createAdmin->get('password_confirmation')" class="mt-1" />
                            </div>

                        </div>

                    </form>

                    <div class="mt-6 flex justify-end">
                        <x-bz.secondary-btn x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-bz.secondary-btn>

                        <x-bz.primary-btn class="ml-3" form="create-admin-form">
                            {{ __('Create') }}
                        </x-bz.primary-btn>
                    </div>

                </div>
            </x-breeze-modal>
        </div>


        <div>
            <livewire:admin.admin-table />
        </div>
    </div>
@endsection
