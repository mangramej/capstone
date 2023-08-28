<x-card title="Add Milk Bag">
    <form wire:submit.prevent="save">
        <small class="text-gray-500">Fill all required fields: *</small>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="col-span-1 sm:col-span-2">
                <x-select
                    label="Select Provider *"
                    placeholder="Select one provider here"
                    :options="$providers"
                    option-label="name"
                    option-value="id"
                    option-description="email"
                    wire:model.defer="selectedProvider"
                />
            </div>

            <div class="col-span-1">
                <x-inputs.number wire:model.defer="quantity" label="Quantity *" min="1" />
            </div>
        </div>

        <x-slot name="footer">
            <div class="flex justify-between items-center">
                <x-button label="Close" flat negative x-on:click="$dispatch('close')"/>
                <x-button type="submit" label="Save" primary spinner wire:click="save"/>
            </div>
        </x-slot>
    </form>
</x-card>
