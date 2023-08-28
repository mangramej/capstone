<div class="bg-white p-6 rounded-lg shadow-md" wire:init="load">
    <h1 class="font-medium text-lg">Milk Bags</h1>

    <div class="w-full lg:w-2/3 mt-4">
        <small class="text-gray-500">Filter:</small>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">
{{--            <x-select--}}
{{--                placeholder="Status"--}}
{{--                wire:model="status"--}}
{{--            >--}}
{{--                <x-select.option label="Active" value="active"/>--}}
{{--                <x-select.option label="Inactive" value="inactive"/>--}}
{{--            </x-select>--}}
        </div>
    </div>

    <div class="overflow-x-auto rounded-lg border border-gray-200 mt-2 mb-8">
        @if($readyToLoad)
            <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                <thead>
                <tr class="bg-gray-100">
                    <th class="text-start whitespace-nowrap px-4 py-2 font-medium text-gray-600 uppercase">
                        Provider Name
                    </th>
                    <th class="text-start whitespace-nowrap px-4 py-2 font-medium text-gray-600 uppercase">
                        Total Provided
                    </th>
                    <th class="text-start whitespace-nowrap px-4 py-2 font-medium text-gray-600 uppercase">
                    </th>
                </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                @forelse($transactions as $t)
                    <tr>
                        <td class="whitespace-nowrap p-4 font-medium text-gray-900">
                            {{ $t->provider->fullname() }}
                        </td>
                        <td class="whitespace-nowrap p-4 text-gray-600">
                            {{ $t->total_milk_bags }} (Milk Bags)
                        </td>
                        <td class="whitespace-nowrap text-end px-4 text-gray-700">
                            <x-button xs primary outline label="View More" href="{{ route('champion.milk-bag.show', [$t]) }}" />
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
        {{ $transactions->links() }}
    </div>
</div>
