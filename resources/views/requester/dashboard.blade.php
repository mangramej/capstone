@extends('layouts.requester')

@section('header')
    <div class="mt-8">
        <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">
            Dashboard
        </h1>

        <p class="mt-1.5 text-sm text-gray-500">
            Below are the history of your milk requests, along with their status.
        </p>
    </div>
@endsection

@section('content')
    <section>
        <div class="mx-auto max-w-screen-xl py-8 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3">
                <div class="col-span-1 lg:col-span-2">
                    <x-card>
                        <livewire:requester.recent-requests />
                    </x-card>
                </div>
            </div>
        </div>
    </section>
@endsection
