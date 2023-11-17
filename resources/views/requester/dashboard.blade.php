@extends('components.requester.layout')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md border-t-8 border-violet-800">
        @if(auth()->user()->isVerifiedRequester())
            <livewire:requester.recent-requests />
        @else
            <div class="w-full h-full flex flex-col items-center justify-center space-y-4">
                <h2 class="text-3xl text-gray-700 font-bold uppercase">Get verified first</h2>
                <p class="text-gray-600">Before you start requesting for a breast milk, we need you to get verified first.</p>
                <x-svg.mother-holding-baby class="w-96 h-96" />
                <div class="mt-4"></div>

                <x-button href="{{ route('requester.get-verified') }}" primary label="Get Verified" />
            </div>
        @endif
    </div>
@endsection
