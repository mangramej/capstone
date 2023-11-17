@extends('components.champion.layout')

@section('content')
    <div class="grid grid-cols-3 gap-4">
        <div class="bg-[#EEE3CB] rounded-lg shadow-md text-gray-700 h-fit p-4 flex items-center ">
            <div class="divide-y-2 divide-gray-400">
                <livewire:champion.milk-bag-total-count />
                <livewire:champion.added-milk-bag-count />

                <div class="py-6 w-full grid grid-cols-2 gap-4 items-center">
                    <div class="flex justify-end">
                        <div
                            class="w-[125px] h-[125px] bg-red-600 text-white rounded-full border-4 border-red-800 flex items-center justify-center">
                            <span class="font-bold text-6xl">
                                {{ $total_deducted_milk_bags }}
                            </span>
                        </div>
                    </div>
                    <span class="font-bold uppercase">
                        Total Deducted Milk Bag
                    </span>
                </div>
            </div>
        </div>



        <div class="col-span-2">
            <div class="w-full mb-4">
                <x-button
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'add_milk_bag_modal')"
                    amber label="Add Bag"
                />

                <x-breeze-modal name="add_milk_bag_modal" disableOverflow>
                    <livewire:champion.add-milk-bag/>
                </x-breeze-modal>
            </div>

            <livewire:champion.milk-bag-transaction-list/>
        </div>
    </div>
@endsection
