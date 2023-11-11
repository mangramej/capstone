<section id="address--info" class="bg-white p-6 rounded-md shadow w-full lg:w-2/3">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Address Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your address information, it should be your current living place.") }}
        </p>
    </header>

    <div class="mt-4">
        <div class="py-2 px-4 w-3/5 rounded border-2 shadow border-gray-800 bg-gray-100">
            <span class="text-sm font-bold text-start w-full">Current Address</span> <br>
            <span class="text-sm">
                {{ auth()->user()->address() }}
            </span>
        </div>

        <x-button
            class="mt-2"
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'add_address_modal')"
            primary label="Update"
        />

        <x-breeze-modal name="add_address_modal" disableOverflow>
            <x-card>
                <small class="text-gray-500">Fill all required fields: *</small>
                <form wire:submit.prevent="save" class="space-y-4">
                    <x-input wire:model.defer="street" label="Street Address *"/>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-select
                            label="Region *"
                            option-label="name"
                            option-value="region_id"
                            wire:model="selectedRegion"
                            :options="$regions"
                        />

{{--                        <x-select--}}
{{--                            label="Province *"--}}
{{--                            option-label="name"--}}
{{--                            option-value="province_id"--}}
{{--                            :options="$provinces"--}}
{{--                            wire:model="selectedProvince"--}}
{{--                        />--}}

                        <x-select
                            label="City *"
                            option-label="name"
                            option-value="city_id"
                            :options="$cities"
                            wire:model="selectedCity"
                        />

                        <x-select
                            label="Barangay *"
                            option-label="name"
                            option-value="id"
                            :options="$barangays"
                            wire:model="selectedBarangay"
                        />

                        <x-input label="Zip Code" wire:model.defer="zip_code" />
                    </div>

                    <div class="text-end">
                        <x-button wire:target="save" type="submit" primary label="Save" spinner/>
                    </div>
                </form>
            </x-card>
        </x-breeze-modal>
    </div>
</section>
