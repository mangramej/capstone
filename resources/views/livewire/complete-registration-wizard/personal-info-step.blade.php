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
                <x-input wire:model.defer="first_name" label="First Name *"/>

                <x-input wire:model.defer="middle_name" label="Middle Name"/>

                <x-input wire:model.defer="last_name" label="Last Name *"/>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <x-datetime-picker
                        without-time
                        label="Date of Birth *"
                        wire:model.defer="date_of_birth"
                    />

                    <x-input wire:model.defer="phone_number" label="Phone Number *" />
                </div>

                <div class="text-end">
                    <x-button type="submit" right-icon="arrow-right" primary label="Save" spinner/>
                </div>
            </form>
        </div>
    </div>
</div>
