@extends('layouts.requester')

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
