<x-card title="Add a Provider">
    <form wire:submit.prevent="save">
        <small class="text-gray-500">Fill all required fields: *</small>
        <div class="space-y-4">
            <x-select
                label="Providers"
                placeholder="Select one provider here"
                :options="$providers"
                option-label="name"
                option-value="id"
                wire:model.defer="selectedProvider"
            />
        </div>

        <x-slot name="footer">
            <div class="flex justify-between items-center">
                <x-button label="Close" flat negative x-on:click="$dispatch('close')"/>
                <x-button type="submit" label="Save" primary spinner wire:click="save"/>
            </div>
        </x-slot>
    </form>
</x-card>
