@extends('components.champion.layout')

@section('content')
    <div class="grid grid-cols-3 gap-4">
        <div class="h-fit bg-white p-6 rounded-lg shadow-md border-l-4 border-red-600">
            <form method="GET" action="{{ route('champion.my-providers.donor-application.index') }}" class="space-y-2">
                <x-input label="Application ID" name="id" placeholder="type the application ID here" value="{{ request()->input('id') ?? '' }}"/>

                <x-button type="submit" primary label="Search" />
            </form>
        </div>

        <div class="col-span-2">
            @if($providerApplication)
                <livewire:champion.process-donor-application :application="$providerApplication" />
            @else
                <div class="bg-white rounded-lg shadow h-[600px] flex justify-center items-center opacity-75">
                    <div class="text-center">
                        <x-svg.two-document class="w-96 h-96 mb-4" />
                        <span class="text-3xl text-gray-600 font-medium uppercase">Nothing to show</span> <br>
                        <span class="mt-2 text-gray-400 text-sm">Try searching the application ID in the form</span>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
