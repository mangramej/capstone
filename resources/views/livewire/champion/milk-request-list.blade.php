@php use App\Modules\Enums\MilkRequestStatus; @endphp
<div class="p-4" wire:init="load">

    <div class="flex justify-between items-center">
        <h1 class="font-medium text-lg uppercase">Request List</h1>
        <x-button.circle wire:click="$refresh" primary icon="refresh" spinner/>
    </div>


    <div class="w-full lg:w-2/3 mt-4">
        <small class="text-gray-500">Filter:</small>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">
            <x-input label="Search" placeholder="Reference Number" wire:model.debounce.250ms="search"/>

            <x-select
                placeholder="Status"
                label="Select Status"
                wire:model="status"
                :clearable="false"
            >
                <x-select.option label="All" value="all"/>
                <x-select.option label="Accepted" value="{{ MilkRequestStatus::Accepted }}"/>
                <x-select.option label="Declined" value="{{ MilkRequestStatus::Declined }}"/>
                <x-select.option label="Assigned" value="{{ MilkRequestStatus::Assigned }}"/>
                <x-select.option label="Delivered" value="{{ MilkRequestStatus::Delivered }}"/>
                <x-select.option label="Confirmed" value="{{ MilkRequestStatus::Confirmed }}"/>
                <x-select.option label="Declined" value="declined"/>
            </x-select>
        </div>
    </div>

    <div class="overflow-x-auto rounded-lg border border-gray-200 mt-2 mb-8">
        @if($readyToLoad)
            <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                <thead>
                <tr class="bg-gray-100 border-t">
                    <th class="text-start whitespace-nowrap px-4 py-2 font-medium text-gray-600 uppercase">
                        Reference Number
                    </th>
                    <th class="text-start whitespace-nowrap px-4 py-2 font-medium text-gray-600 uppercase">
                        Date
                    </th>
                    <th class="text-start whitespace-nowrap px-4 py-2 font-medium text-gray-600 uppercase">
                        Bags
                    </th>
                    <th class="text-start whitespace-nowrap px-4 py-2 font-medium text-gray-600 uppercase">
                        Status
                    </th>
                    <th class="text-center whitespace-nowrap px-4 py-2 font-medium text-gray-600 uppercase">
                        Action
                    </th>

                </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                @forelse($milk_requests as $request)
                    <tr>
                        <td class="whitespace-nowrap p-4 font-medium text-gray-900">
                            {{ $request->ref_number }}
                        </td>
                        <td class="whitespace-nowrap p-4 text-gray-600">
                            {{ $request->created_at->format('m/d/Y h:i A') }}
                        </td>
                        <td class="whitespace-nowrap p-4 text-gray-700 font-bold">
                            {{ $request->quantity }}
                        </td>
                        <td class="whitespace-nowrap p-4 text-gray-700">
                            <x-status-badge :status="$request->status"/>
                        </td>
                        <td class="whitespace-nowrap text-end px-4 text-gray-700">
                            <x-button xs primary href="{{ route('champion.milk-request-detail', [$request]) }}"
                                      label="View More"/>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-gray-700 font-medium p-4">No result found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        @else
            <div class="pt-4 pb-8 bg-gray-100 text-center space-y-4">
                <span class="text-gray-600 font-medium">Fetching Results</span> <br>
                <div
                    class="animate-spin inline-block w-6 h-6 border-[3px] border-current border-t-transparent text-blue-600 rounded-full"
                    role="status" aria-label="loading">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        @endif
    </div>

    <div class="mt-4">
        {{ $milk_requests->links() }}
    </div>
</div>
