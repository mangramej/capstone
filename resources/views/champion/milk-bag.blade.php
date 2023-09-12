@extends('layouts.champion')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <div class="col-span-3">
            <x-button
                x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'add_milk_bag_modal')"
                amber label="Add Bag"
            />

            <x-breeze-modal name="add_milk_bag_modal" disableOverflow>
                <livewire:champion.add-milk-bag/>
            </x-breeze-modal>
        </div>

        <div class="col-span-3 lg:col-span-2">
            <livewire:champion.milk-bag-transaction-list/>
        </div>

        <div class="col-span-3 lg:col-span-1">
            <livewire:champion.milk-bag-total-count/>
        </div>
    </div>
@endsection
