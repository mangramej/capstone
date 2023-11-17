@extends('components.champion.layout')

@section('content')
    <div class="grid grid-cols-3 gap-4">
        <livewire:champion.provider-list-count/>
        <div class="col-span-2">
            <livewire:champion.provider-list/>
        </div>
    </div>
@endsection
