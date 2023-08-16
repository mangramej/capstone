<div class="p-4" wire:init="loadMilkRequests">
    <h1 class="font-medium text-lg">Recent Requests</h1>

    <div class="w-full lg:w-2/3 mt-4">
        <small class="text-gray-500">Filter:</small>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">
            <x-select
                placeholder="Status"
            >
                <x-select.option label="All" value="all"/>
                <x-select.option label="Pending" value="pending"/>
            </x-select>
            <x-select
                placeholder="Date"
            >
                <x-select.option label="All" value="all"/>
                <x-select.option label="Last 3 Months" value="past-three-months"/>
            </x-select>
        </div>
    </div>

    <div class="overflow-x-auto rounded-lg border border-gray-200 mt-2 mb-8">
        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
            <thead>
            <tr class="bg-gray-100">
                <th class="text-start whitespace-nowrap px-4 py-2 font-medium text-gray-600 uppercase">
                    Baby Name
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
                <th class="text-start whitespace-nowrap px-4 py-2 font-medium text-gray-600 uppercase">
                </th>
            </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
            @if($readyToLoad)
                @forelse($milk_requests as $request)
                    <tr>
                        <td class="whitespace-nowrap p-4 font-medium text-gray-900">
                            {{ $request->baby_name }}
                        </td>
                        <td class="whitespace-nowrap p-4 text-gray-600">
                            {{ $request->created_at->format('m/d/Y') }}
                        </td>
                        <td class="whitespace-nowrap p-4 text-gray-700 font-bold">
                            {{ $request->quantity }}
                        </td>
                        <td class="whitespace-nowrap p-4 text-gray-700">

                        </td>
                        <td class="whitespace-nowrap text-end px-4 text-gray-700">
                            <x-button xs primary label="View More"/>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-red-600">No result found.</td>
                    </tr>
                @endforelse
            @else
                <tr>
                    <td colspan="5">
                        <div class="pb-4 text-center space-y-4">
                            <span class="text-gray-600 font-medium">Fetching Results</span> <br>
                            <div
                                class="animate-spin inline-block w-6 h-6 border-[3px] border-current border-t-transparent text-blue-600 rounded-full"
                                role="status" aria-label="loading">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $milk_requests->links() }}
    </div>
</div>
