<div class="bg-white p-6 rounded-lg shadow-md" wire:init="load">
    <h1 class="font-medium text-lg">My Providers</h1>

    <div class="w-full lg:w-2/3 mt-4">
        <small class="text-gray-500">Filter:</small>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">
            <x-select
                placeholder="Status"
                wire:model="status"
            >
                <x-select.option label="Active" value="active"/>
                <x-select.option label="Inactive" value="inactive"/>
            </x-select>
        </div>
    </div>

    <div class="overflow-x-auto rounded-lg border border-gray-200 mt-2 mb-8">
        @if($readyToLoad)
            <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="text-start whitespace-nowrap px-4 py-2 font-medium text-gray-600 uppercase">
                            Full Name
                        </th>
                        <th class="text-start whitespace-nowrap px-4 py-2 font-medium text-gray-600 uppercase">
                            Date Added
                        </th>
                        <th class="text-start whitespace-nowrap px-4 py-2 font-medium text-gray-600 uppercase">
                            Status
                        </th>
                        <th class="text-start whitespace-nowrap px-4 py-2 font-medium text-gray-600 uppercase">
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                @forelse($providers as $p)
                    <tr>
                        <td class="whitespace-nowrap p-4 font-medium text-gray-900">
                            <a href="{{ route('champion.my-providers.show-provider-profile', [$p->provider]) }}"
                                class="hover:text-sky-500 underline transition ease"
                            >
                                {{ $p->provider->fullname() }}
                            </a>
                        </td>
                        <td class="whitespace-nowrap p-4 text-gray-600">
                            {{ $p->created_at->format('m/d/Y') }}
                        </td>
                        <td class="whitespace-nowrap p-4 text-gray-700">
                            @if($p->status)
                                <x-badge positive label="Active" />
                            @else
                                <x-badge negative label="Inactive" />
                            @endif
                        </td>
                        <td class="whitespace-nowrap text-end px-4 text-gray-700">
                            @if($p->status)
                                <x-button wire:click="setInactive({{ $p->id }})" xs negative outline label="Set to Inactive" />
                            @else
                                <x-button wire:click="setActive({{ $p->id }})" xs positive outline label="Set to Active" />
                            @endif
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
        {{ $providers->links() }}
    </div>
</div>
