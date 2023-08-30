@extends('layouts.admin.app')

@section('content')
    <section>
        <div class="mx-auto max-w-screen-xl py-8 sm:px-6 lg:px-8">
            <div class="space-y-4">
                <livewire:profile.update-account-information />
{{--                <livewire:profile.update-personal-information />--}}
{{--                <livewire:profile.update-address-information />--}}
            </div>
        </div>
    </section>
@endsection
