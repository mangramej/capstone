@php use App\Modules\Enums\MilkRequestStatus; @endphp
<div class="bg-white p-6 rounded-md shadow">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 divide-x">
        <ul class="space-y-1">
            <li>
                <a
                    href="{{ route('champion.reports.milk-requests') }}"
                    class="block border rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700"
                >
                    Milk Requests
                </a>
            </li>

            <li>
                <a
                    href="{{ route('champion.reports.milk-bag-transactions') }}"
                    class="block border rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700"
                >
                    Milk Bag
                </a>
            </li>
        </ul>

        <div class="col-span-2 px-4 ">
            <form wire:submit.prevent="export">
                <p class="mt-1.5 text-sm text-gray-500">
                    Select the fields that you want to include:
                </p>
                <div class="space-y-4 w-full">
                    <x-select
                        label="Select Status"
                        placeholder="Status"
                        wire:model.defer="status"
                        :clearable="false"
                    >
                        <x-select.option label="All" value="all"/>
                        <x-select.option label="Accepted" value="{{ MilkRequestStatus::Accepted }}"/>
                        <x-select.option label="Assigned" value="{{ MilkRequestStatus::Assigned }}"/>
                        <x-select.option label="Delivered"
                                         value="{{ MilkRequestStatus::Delivered }}"/>
                        <x-select.option label="Confirmed"
                                         value="{{ MilkRequestStatus::Confirmed }}"/>
                    </x-select>
                    <fieldset class="border border-solid border-gray-300 p-3 rounded">
                        <legend class="text-sm text-gray-700 font-medium px-2">Date Range</legend>

                        <div id="date_range" class="flex items-center gap-2 justify-start">
                            <x-datetime-picker
                                without-time
                                label="Starting from"
                                wire:model.defer="from"
                            />
                            <x-datetime-picker
                                without-time
                                label="Up until"
                                wire:model.defer="to"
                            />
                        </div>
                    </fieldset>

                    <fieldset class="border border-solid border-gray-300 p-3 rounded">
                        <legend class="text-sm text-gray-700 font-medium px-2">Data Included</legend>
                        @error('dataIncluded') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror

                        <div class="space-y-2 flex flex-col">
                            <label class="text-sm text-gray-700 font-medium">
                                <input
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 transition ease"
                                    type="checkbox" value="ref_number" wire:model.defer="dataIncluded"
                                    @if(in_array('ref_number', $dataIncluded)) checked @endif
                                />
                                Reference Number
                            </label>
                            <label class="text-sm text-gray-700 font-medium">
                                <input
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 transition ease"
                                    type="checkbox" value="mother_name" wire:model.defer="dataIncluded"/>
                                Mother Name
                            </label>
                            <label class="text-sm text-gray-700 font-medium">
                                <input
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 transition ease"
                                    type="checkbox" value="baby_name" wire:model.defer="dataIncluded"/>
                                Baby Name
                            </label>
                            <label class="text-sm text-gray-700 font-medium">
                                <input
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 transition ease"
                                    type="checkbox" value="quantity" wire:model.defer="dataIncluded"/>
                                No of Bags
                            </label>
                            <label class="text-sm text-gray-700 font-medium">
                                <input
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 transition ease"
                                    type="checkbox" value="address" wire:model.defer="dataIncluded"/>
                                Address
                            </label>
                            <label class="text-sm text-gray-700 font-medium">
                                <input
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 transition ease"
                                    type="checkbox" value="phone_number" wire:model.defer="dataIncluded"/>
                                Phone Number
                            </label>
                            <label class="text-sm text-gray-700 font-medium">
                                <input
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 transition ease"
                                    type="checkbox" value="comment" wire:model.defer="dataIncluded"/>
                                Comment
                            </label>
                            <label class="text-sm text-gray-700 font-medium">
                                <input
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 transition ease"
                                    type="checkbox" value="provided_by" wire:model.defer="dataIncluded"/>
                                Provider Name
                            </label>
                        </div>
                    </fieldset>

                    <x-button icon="download" primary label="Export" type="submit" spinner/>
                </div>
            </form>
        </div>
    </div>
</div>
