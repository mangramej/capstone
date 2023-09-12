@extends('layouts.champion')

@section('content')
    <section>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <div class="col-span-3">
                <x-button
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'add_provider_modal')"
                    amber label="Add Provider"
                />

                <x-breeze-modal name="add_provider_modal" disableOverflow>
                    <livewire:champion.add-provider-to-list/>
                </x-breeze-modal>
            </div>

            <div class="col-span-3 lg:col-span-2">
                <livewire:champion.provider-list/>
            </div>

            <div class="col-span-3 lg:col-span-1">
                <livewire:champion.provider-list-count/>
            </div>
        </div>
    </section>
@endsection
