@extends('components.requester.layout')

@section('content')
    <x-card>
        <div class="px-6">
            <h2 class="text-2xl font-bold text-gray-700">Get Verified</h2>
            <p class="text-sm text-gray-500">Please fill up the following:</p>

            <div class="mt-4">
                <livewire:requester.get-verified />
            </div>
        </div>
    </x-card>
@endsection
