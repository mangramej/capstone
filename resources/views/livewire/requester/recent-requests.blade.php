<div class="px-4 h-[525px]" wire:init="loadMilkRequests">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-gray-700 font-bold text-xl uppercase">Requester Dashboard</h1>

        <div>
            <x-native-select label="Filter: Select Status" wire:model="status">
                <option value="all">All</option>
                <option value="pending">Pending</option>
                <option value="accepted">Accepted</option>
                <option value="assigned">Provider Assigned</option>
                <option value="delivered">Delivered</option>
                <option value="confirmed">Confirmed</option>
                <option value="declined">Declined</option>
            </x-native-select>
        </div>
    </div>

    <div class="overflow-x-auto rounded-lg border border-gray-200 mt-2 mb-8">
        @if($readyToLoad)
            <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                <thead>
                <tr class="bg-gray-100">
                    <th class="text-start whitespace-nowrap px-4 py-2 font-medium text-gray-600 uppercase">
                        Reference Number
                    </th>
                    <th class="text-start whitespace-nowrap px-4 py-2 font-medium text-gray-600 uppercase">
                        Bags
                    </th>
                    <th class="text-start whitespace-nowrap px-4 py-2 font-medium text-gray-600 uppercase">
                        Date
                    </th>
                    <th class="text-start whitespace-nowrap px-4 py-2 font-medium text-gray-600 uppercase">
                        Status
                    </th>
                    <th class="text-start whitespace-nowrap px-4 py-2 font-medium text-gray-600 uppercase">
                    </th>
                </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                @forelse($milk_requests as $request)
                    <tr>
                        <td class="whitespace-nowrap p-4 font-medium text-gray-900">
                            {{ $request->ref_number }}
                        </td>
                        <td class="whitespace-nowrap p-4 text-gray-700 font-bold">
                            {{ $request->quantity }}
                        </td>
                        <td class="whitespace-nowrap p-4 text-gray-600">
                            {{ $request->created_at->format('m/d/Y') }}
                        </td>
                        <td class="whitespace-nowrap p-4 text-gray-700">
                            <x-status-badge :status="$request->status" />
                        </td>
                        <td class="whitespace-nowrap text-end px-4 text-gray-700">
                            <x-button xs primary href="{{ route('requester.milk-request-detail', [$request]) }}" label="View More"/>
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
