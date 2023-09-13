<div class="bg-white p-6 rounded-md shadow">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 divide-x">
        <ul class="space-y-1">
            <li>
                <a
                    href="{{ route('champion.reports.milk-requests') }}"
                    class="block border rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700"
                >
                    Milk Requests
                </a>
            </li>

            <li>
                <a
                    href="{{ route('champion.reports.milk-bag-transactions') }}"
                    class="block border rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700"
                >
                    Milk Bag
                </a>
            </li>
        </ul>

        <div class="col-span-2 px-4">
            <form wire:submit.prevent="export">
                <p class="mt-1.5 text-sm text-gray-500">
                    Select the fields that you want to include:
                </p>

                <div class="space-y-4 w-full">
                    <x-select
                        label="Select Provider *"
                        placeholder="Select one provider here"
                        :options="$providers"
                        option-label="full_name"
                        option-value="id"
                        option-description="email"
                        wire:model.defer="selectedProvider"
                    />

                    <x-button icon="download" primary label="Export" type="submit" spinner/>
                </div>
            </form>
        </div>
    </div>
</div>
