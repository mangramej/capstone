<div class="min-h-screen flex justify-center items-center">
    <div class="w-[600px] bg-white p-6 rounded-md shadow">
        <div class="text-center">
            <h2 class="mt-6 text-3xl font-extrabold text-center text-gray-900 leading-9">
                {{ $this->stepInfo()['label'] }}
            </h2>

            <p class="mt-2 text-sm text-center text-gray-600 leading-5 max-w">
                {{ $this->stepInfo()['description'] }}
            </p>

            <p class="mt-1 text-sm text-center text-gray-600 leading-5 max-w">
                or click here to
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="font-medium text-indigo-600 hover:underline hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                    sign out
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </p>
        </div>

        <div class="mt-12">
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

                    <x-select
                        label="Province *"
                        option-label="name"
                        option-value="province_id"
                        :options="$provinces"
                        wire:model="selectedProvince"
                    />

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
                    <x-button wire:target="save" type="submit" right-icon="arrow-right" primary label="Save" spinner/>
                </div>
            </form>
        </div>
    </div>
</div>
