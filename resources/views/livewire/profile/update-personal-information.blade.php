<section id="personal--info" class="bg-white p-6 rounded-md shadow w-full lg:w-2/3">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Personal Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your personal's information, date of birth and phone number.") }}
        </p>
    </header>

    <form wire:submit.prevent="save" class="mt-6 space-y-6">
        <x-input wire:model.defer="first_name" label="First Name *"/>

        <x-input wire:model.defer="middle_name" label="Middle Name"/>

        <x-input wire:model.defer="last_name" label="Last Name *"/>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <x-datetime-picker
                without-time
                label="Date of Birth *"
                wire:model.defer="date_of_birth"
            />

            <x-inputs.phone wire:model.defer="phone_number" label="Phone Number *"/>
        </div>

        <x-button type="submit" primary label="Update" />
    </form>
</section>
