@extends('layouts.'.auth()->user()->type->value)

@if(auth()->user()->type !== \App\Modules\Enums\UserEnum::Champion)
    @section('header')
        <div class="mt-8">
            <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">
                Profile
            </h1>

            <p class="mt-1.5 text-sm text-gray-500">
                You can update the information of your profile.
            </p>
        </div>
    @endsection
@endif

@section('content')
    <section>
        <div class="mx-auto max-w-screen-xl py-8 sm:px-6 lg:px-8">
            <div class="space-y-4">
                <livewire:profile.update-account-information />
                <livewire:profile.update-personal-information />
                <livewire:profile.update-address-information />
            </div>
        </div>
    </section>
@endsection
